<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Ресайз/сжатие админ-аплоадов: сырые PNG 4K иначе валят PHP memory (128M) на validate/save.
 */
final class ImageUploadOptimizer
{
    public static function store(UploadedFile $file, string $directory, string $disk = 'public', int $maxEdge = 2800): string
    {
        @ini_set('memory_limit', '512M');

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }

        // SVG не трогаем
        if ($ext === 'svg' || str_contains((string) $file->getMimeType(), 'svg')) {
            return $file->store($directory, $disk);
        }

        $tmp = $file->getRealPath();
        if (! $tmp || ! is_file($tmp)) {
            return $file->store($directory, $disk);
        }

        $info = @getimagesize($tmp);
        if ($info === false) {
            return $file->store($directory, $disk);
        }

        [$width, $height, $type] = $info;
        $src = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($tmp),
            IMAGETYPE_PNG => @imagecreatefrompng($tmp),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($tmp) : false,
            IMAGETYPE_GIF => @imagecreatefromgif($tmp),
            default => false,
        };

        if ($src === false) {
            return $file->store($directory, $disk);
        }

        $maxDim = max($width, $height);
        // Не трогаем, если и так влезает и файл не гигантский
        $filesize = filesize($tmp) ?: 0;
        if ($maxDim <= $maxEdge && $filesize <= 2_500_000 && in_array($type, [IMAGETYPE_JPEG, IMAGETYPE_WEBP], true)) {
            imagedestroy($src);

            return $file->store($directory, $disk);
        }

        $scale = $maxDim > $maxEdge ? ($maxEdge / $maxDim) : 1.0;
        $newW = max(1, (int) round($width * $scale));
        $newH = max(1, (int) round($height * $scale));

        $dst = imagecreatetruecolor($newW, $newH);
        if ($dst === false) {
            imagedestroy($src);

            return $file->store($directory, $disk);
        }

        $preserveAlpha = in_array($type, [IMAGETYPE_PNG, IMAGETYPE_WEBP], true);
        if ($preserveAlpha) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefilledrectangle($dst, 0, 0, $newW, $newH, $transparent);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $width, $height);
        imagedestroy($src);

        // Фото без альфы → jpeg (мягко); с альфой → webp/png
        $hasAlpha = $preserveAlpha && self::hasMeaningfulAlpha($dst);
        if ($hasAlpha) {
            $outExt = function_exists('imagewebp') ? 'webp' : 'png';
        } else {
            $outExt = 'jpg';
        }

        $filename = bin2hex(random_bytes(16)).'.'.$outExt;
        $relative = trim($directory, '/').'/'.$filename;
        $absolute = Storage::disk($disk)->path($relative);
        if (! is_dir(dirname($absolute))) {
            mkdir(dirname($absolute), 0755, true);
        }

        $ok = match ($outExt) {
            'jpg' => imagejpeg($dst, $absolute, 90),
            'webp' => imagewebp($dst, $absolute, 90),
            default => imagepng($dst, $absolute, 4),
        };
        imagedestroy($dst);

        if (! $ok || ! is_file($absolute)) {
            return $file->store($directory, $disk);
        }

        return $relative;
    }

    /** Пережать уже лежащий файл (card/banner после ручного аплоада). */
    public static function recompressStored(string $relativePath, string $disk = 'public', int $maxEdge = 2800): ?string
    {
        @ini_set('memory_limit', '512M');

        if ($relativePath === '' || str_starts_with($relativePath, 'http')) {
            return null;
        }

        $full = Storage::disk($disk)->path($relativePath);
        if (! is_file($full)) {
            return null;
        }

        $size = filesize($full) ?: 0;
        $info = @getimagesize($full);
        if ($info === false) {
            return null;
        }

        [$width, $height] = $info;
        // Только реально тяжёлые / огромные
        if ($size < 3_000_000 && max($width, $height) <= $maxEdge) {
            return null;
        }

        $uploaded = new UploadedFile($full, basename($full), $info['mime'] ?? null, null, true);
        $dir = trim(str_replace('\\', '/', dirname($relativePath)), '.');
        $newPath = self::store($uploaded, $dir === '' ? '' : $dir, $disk, $maxEdge);

        if ($newPath !== $relativePath) {
            Storage::disk($disk)->delete($relativePath);
        }

        return $newPath;
    }

    private static function hasMeaningfulAlpha(\GdImage $img): bool
    {
        $w = imagesx($img);
        $h = imagesy($img);
        $stepX = max(1, (int) floor($w / 24));
        $stepY = max(1, (int) floor($h / 24));
        for ($y = 0; $y < $h; $y += $stepY) {
            for ($x = 0; $x < $w; $x += $stepX) {
                $rgba = imagecolorat($img, $x, $y);
                $alpha = ($rgba & 0x7F000000) >> 24;
                if ($alpha > 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
