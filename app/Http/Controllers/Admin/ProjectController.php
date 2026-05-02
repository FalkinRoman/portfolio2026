<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
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
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['features'] = $this->parseFeatures($request->input('features_text', ''));
        $data['features_en'] = $this->parseFeatures($request->input('features_text_en', ''));
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
        $data = $this->validated($request, $project->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['features'] = $this->parseFeatures($request->input('features_text', ''));
        $data['features_en'] = $this->parseFeatures($request->input('features_text_en', ''));
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) $request->input('sort_order', 0);

        $project->fill($data);
        $this->handleUploads($request, $project);
        $project->save();

        return redirect()->route('admin.projects.index')->with('ok', 'Сохранено.');
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
            'meta_client' => 'nullable|string|max:255',
            'meta_service' => 'nullable|string|max:500',
            'meta_date' => 'nullable|string|max:255',
            'overview_p1' => 'nullable|string',
            'overview_p2' => 'nullable|string',
            'overview_p3' => 'nullable|string',
            'accent_line' => 'nullable|string|max:2000',
            'live_url' => 'nullable|url|max:2000',
            'name_en' => 'nullable|string|max:255',
            'tagline_en' => 'nullable|string|max:2000',
            'meta_client_en' => 'nullable|string|max:255',
            'meta_service_en' => 'nullable|string|max:2000',
            'meta_date_en' => 'nullable|string|max:255',
            'overview_p1_en' => 'nullable|string',
            'overview_p2_en' => 'nullable|string',
            'overview_p3_en' => 'nullable|string',
            'accent_line_en' => 'nullable|string|max:2000',
            'seo_title_en' => 'nullable|string|max:255',
            'seo_description_en' => 'nullable|string|max:2000',
        ]);
    }

    private function parseFeatures(string $text): array
    {
        $lines = preg_split("/\r\n|\n|\r/", $text) ?: [];

        return array_values(array_filter(array_map('trim', $lines), fn ($l) => $l !== ''));
    }

    private function handleUploads(Request $request, Project $project): void
    {
        $disk = 'public';
        $base = 'projects/'.$project->id;

        foreach (['card_image', 'logo_image', 'banner_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($project->{$field}) {
                    Storage::disk($disk)->delete($project->{$field});
                }
                $path = $request->file($field)->store($base, $disk);
                $project->{$field} = $path;
            }
        }

        if ($request->hasFile('gallery_images')) {
            $old = $project->gallery_images ?? [];
            foreach ($old as $p) {
                if ($p && ! str_starts_with($p, 'http')) {
                    Storage::disk($disk)->delete($p);
                }
            }
            $paths = [];
            foreach ($request->file('gallery_images', []) as $file) {
                if ($file && $file->isValid()) {
                    $paths[] = $file->store($base.'/gallery', $disk);
                }
            }
            if ($paths !== []) {
                $project->gallery_images = $paths;
            }
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
