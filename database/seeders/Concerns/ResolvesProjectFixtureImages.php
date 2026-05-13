<?php

namespace Database\Seeders\Concerns;

trait ResolvesProjectFixtureImages
{
    /**
     * Ищет файл в каталоге: предпочтительно webp, иначе png (часть ассетов может остаться png, напр. логотип).
     *
     * @return array{path: string, filename: string}
     */
    protected function resolveFixtureFile(string $dir, string $basenameWithoutExt): array
    {
        foreach (['webp', 'png'] as $ext) {
            $path = $dir.'/'.$basenameWithoutExt.'.'.$ext;
            if (is_file($path)) {
                return ['path' => $path, 'filename' => $basenameWithoutExt.'.'.$ext];
            }
        }

        throw new \RuntimeException('Missing fixture: '.$dir.'/'.$basenameWithoutExt.'.{webp,png}');
    }
}
