<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\ImageUploadOptimizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.form', ['project' => new Project, 'mode' => 'create']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedAttributes($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['features'] = $this->parseFeatures($request->input('features_text'));
        $data['features_en'] = $this->parseFeatures($request->input('features_text_en'));
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) $request->input('sort_order', 0);

        $project = new Project($data);
        $project->save();
        $this->handleUploads($request, $project);
        $project->save();

        return redirect()->route('admin.projects.index')->with('ok', 'Проект создан.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', ['project' => $project, 'mode' => 'edit']);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validatedAttributes($request, $project->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['features'] = $this->parseFeatures($request->input('features_text'));
        $data['features_en'] = $this->parseFeatures($request->input('features_text_en'));
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) $request->input('sort_order', 0);

        $project->fill($data);
        $this->handleUploads($request, $project);
        $project->save();

        return redirect()
            ->route('admin.projects.edit', $project)
            ->with('ok', 'Сохранено. Новые фото галереи добавлены к существующим — можно сортировать.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteStoredFiles($project);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('ok', 'Удалено.');
    }

    /** @return array<string, mixed> */
    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $slugRule = 'nullable|string|max:190';
        if ($ignoreId) {
            $slugRule .= '|unique:projects,slug,'.$ignoreId;
        } else {
            $slugRule .= '|unique:projects,slug';
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => $slugRule,
            'tagline' => 'nullable|string|max:2000',
            'card_blurb' => 'nullable|string|max:180',
            'meta_client' => 'nullable|string|max:255',
            'meta_service' => 'nullable|string|max:500',
            'meta_date' => 'nullable|string|max:255',
            'overview_p1' => 'nullable|string',
            'overview_p2' => 'nullable|string',
            'overview_p3' => 'nullable|string',
            'accent_line' => 'nullable|string|max:2000',
            'live_url' => 'nullable|string|max:2000',
            'name_en' => 'nullable|string|max:255',
            'tagline_en' => 'nullable|string|max:2000',
            'card_blurb_en' => 'nullable|string|max:180',
            'meta_client_en' => 'nullable|string|max:255',
            'meta_service_en' => 'nullable|string|max:2000',
            'meta_date_en' => 'nullable|string|max:255',
            'overview_p1_en' => 'nullable|string',
            'overview_p2_en' => 'nullable|string',
            'overview_p3_en' => 'nullable|string',
            'accent_line_en' => 'nullable|string|max:2000',
            'seo_title_en' => 'nullable|string|max:255',
            'seo_description_en' => 'nullable|string|max:2000',
            'card_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:8192',
            'logo_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg|max:4096',
            'banner_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:8192',
            // append: новые файлы; существующие пути приходят отдельно (gallery_existing_order)
            'gallery_images' => 'nullable|array|max:12',
            'gallery_images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:8192',
            'gallery_existing_order' => 'nullable|array',
            'gallery_existing_order.*' => 'nullable|string|max:2048',
            'gallery_remove' => 'nullable|array',
            'gallery_remove.*' => 'nullable|string|max:2048',
        ], [
            'gallery_images.*.max' => 'Каждое фото галереи — максимум 8 МБ. Сожми перед загрузкой или грузи по 2–3 за раз.',
            'gallery_images.*.mimes' => 'Галерея: только jpg, jpeg, png, webp, gif (не HEIC).',
            'card_image.max' => 'Превью — максимум 8 МБ.',
            'card_image.mimes' => 'Превью: jpg/png/webp/gif.',
            'banner_image.max' => 'Баннер — максимум 8 МБ.',
            'banner_image.mimes' => 'Баннер: jpg/png/webp/gif.',
            'logo_image.mimes' => 'Логотип: jpg/png/webp/gif/svg.',
        ]);
    }

    /**
     * Атрибуты модели без upload-полей.
     * Иначе fill(gallery_images => UploadedFile[]) затирает пути и «новые 1–2 фото» сносят всю галерею.
     *
     * @return array<string, mixed>
     */
    private function validatedAttributes(Request $request, ?int $ignoreId = null): array
    {
        $data = $this->validated($request, $ignoreId);

        unset(
            $data['card_image'],
            $data['logo_image'],
            $data['banner_image'],
            $data['gallery_images'],
            $data['gallery_existing_order'],
            $data['gallery_remove'],
        );

        return $data;
    }

    private function parseFeatures(?string $text): array
    {
        $text = $text ?? '';
        $lines = preg_split("/\r\n|\n|\r/", $text) ?: [];

        return array_values(array_filter(array_map('trim', $lines), fn ($l) => $l !== ''));
    }

    private function handleUploads(Request $request, Project $project): void
    {
        @ini_set('memory_limit', '512M');

        $disk = 'public';
        $base = 'projects/'.$project->id;

        foreach (['card_image', 'logo_image', 'banner_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($project->{$field}) {
                    Storage::disk($disk)->delete($project->{$field});
                }
                // Логотип из кроппера уже маленький — не раздуваем ресайзом агрессивно
                $maxEdge = $field === 'logo_image' ? 1024 : 2800;
                $project->{$field} = ImageUploadOptimizer::store(
                    $request->file($field),
                    $base,
                    $disk,
                    $maxEdge
                );
            }
        }

        $existing = array_values(array_filter($project->gallery_images ?? []));
        $remove = array_values(array_filter((array) $request->input('gallery_remove', [])));

        if ($remove !== []) {
            foreach ($remove as $p) {
                if ($p && ! str_starts_with($p, 'http')) {
                    Storage::disk($disk)->delete($p);
                }
            }
            $existing = array_values(array_filter($existing, fn ($p) => ! in_array($p, $remove, true)));
        }

        $requestedOrder = array_values(array_filter((array) $request->input('gallery_existing_order', [])));
        if ($requestedOrder !== []) {
            $present = array_flip($existing);
            $ordered = [];
            foreach ($requestedOrder as $p) {
                if (isset($present[$p])) {
                    $ordered[] = $p;
                    unset($present[$p]);
                }
            }
            foreach ($existing as $p) {
                if (isset($present[$p])) {
                    $ordered[] = $p;
                }
            }
            $existing = $ordered;
        }

        $newPaths = [];
        foreach ($request->file('gallery_images', []) as $file) {
            if ($file && $file->isValid()) {
                $newPaths[] = ImageUploadOptimizer::store($file, $base.'/gallery', $disk, 2800);
            }
        }

        $gallery = array_values(array_filter(array_merge($existing, $newPaths)));
        if ($gallery !== [] || $remove !== [] || $newPaths !== [] || $requestedOrder !== []) {
            $project->gallery_images = $gallery !== [] ? $gallery : null;
        }
    }

    private function deleteStoredFiles(Project $project): void
    {
        $disk = 'public';
        foreach (['card_image', 'logo_image', 'banner_image'] as $f) {
            if ($project->{$f} && ! str_starts_with($project->{$f}, 'http')) {
                Storage::disk($disk)->delete($project->{$f});
            }
        }
        foreach ($project->gallery_images ?? [] as $p) {
            if ($p && ! str_starts_with($p, 'http')) {
                Storage::disk($disk)->delete($p);
            }
        }
        Storage::disk($disk)->deleteDirectory('projects/'.$project->id);
    }
}
