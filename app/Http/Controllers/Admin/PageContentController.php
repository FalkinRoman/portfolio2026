<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Support\Cms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageContentController extends Controller
{
    /** @var list<string> */
    private array $tabs = ['services', 'process', 'pricing', 'toolkit', 'studio', 'faq', 'footer', 'about', 'projects_chrome'];

    public function edit(Request $request): View
    {
        $tab = (string) $request->query('tab', 'services');
        if (! in_array($tab, $this->tabs, true)) {
            $tab = 'services';
        }

        $content = SiteContent::current();
        $home = is_array($content->home) ? $content->home : SiteContent::defaultHome();
        $locale = (string) $request->query('locale', 'ru');
        if (! in_array($locale, ['ru', 'en'], true)) {
            $locale = 'ru';
        }

        $section = $home[$locale][$tab] ?? SiteContent::defaultLocaleHome($locale)[$tab] ?? [];

        return view('admin.content.edit', [
            'content' => $content,
            'tab' => $tab,
            'locale' => $locale,
            'section' => $section,
            'tabs' => $this->tabs,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $tab = (string) $request->input('tab', 'services');
        $locale = (string) $request->input('locale', 'ru');
        if (! in_array($tab, $this->tabs, true)) {
            $tab = 'services';
        }
        if (! in_array($locale, ['ru', 'en'], true)) {
            $locale = 'ru';
        }

        $content = SiteContent::current();
        $home = is_array($content->home) ? $content->home : SiteContent::defaultHome();
        if (! isset($home['ru']) || ! is_array($home['ru'])) {
            $home = SiteContent::defaultHome();
        }
        if (! isset($home[$locale]) || ! is_array($home[$locale])) {
            $home[$locale] = SiteContent::defaultLocaleHome($locale);
        }

        $existing = $home[$locale][$tab] ?? [];
        $section = match ($tab) {
            'services' => $this->parseServices($request, is_array($existing) ? $existing : []),
            'process' => $this->parseProcess($request),
            'pricing' => $this->parsePricing($request),
            'toolkit' => $this->parseToolkit($request, is_array($existing) ? $existing : []),
            'studio' => $this->parseStudio($request),
            'faq' => $this->parseFaq($request),
            'footer' => $this->parseFooter($request),
            'about' => $this->parseAbout($request),
            'projects_chrome' => $this->parseChrome($request),
            default => $existing,
        };

        $home[$locale][$tab] = $section;
        $content->home = $home;
        $content->save();
        Cms::flush();

        return redirect()
            ->route('admin.content.edit', ['tab' => $tab, 'locale' => $locale])
            ->with('ok', 'Секция «'.$tab.'» ('.$locale.') сохранена.');
    }

    /** @param array<string, mixed> $existing */
    private function parseServices(Request $request, array $existing): array
    {
        $itemsIn = (array) $request->input('items', []);
        $existingItems = array_values($existing['items'] ?? []);
        $items = [];

        foreach ($itemsIn as $i => $row) {
            if (! is_array($row)) {
                continue;
            }
            $title = trim((string) ($row['title'] ?? ''));
            if ($title === '') {
                continue;
            }
            $images = array_values($existingItems[$i]['images'] ?? ['', '', '']);
            while (count($images) < 3) {
                $images[] = '';
            }
            for ($n = 0; $n < 3; $n++) {
                $file = $request->file("items.$i.image_$n");
                if ($file && $file->isValid()) {
                    if (! empty($images[$n]) && ! str_starts_with($images[$n], 'assets/') && ! str_starts_with($images[$n], 'http')) {
                        Storage::disk('public')->delete($images[$n]);
                    }
                    $images[$n] = $file->store('cms/services', 'public');
                }
            }
            $items[] = [
                'title' => $title,
                'images' => array_slice($images, 0, 3),
            ];
        }

        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'items' => $items !== [] ? $items : ($existingItems ?: []),
        ];
    }

    private function parseProcess(Request $request): array
    {
        $steps = [];
        foreach ((array) $request->input('steps', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $h = trim((string) ($row['h'] ?? ''));
            $t = trim((string) ($row['t'] ?? ''));
            $p = trim((string) ($row['p'] ?? ''));
            if ($h === '' && $t === '' && $p === '') {
                continue;
            }
            $steps[] = compact('h', 't', 'p');
        }

        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'steps' => $steps,
        ];
    }

    private function parsePricing(Request $request): array
    {
        $plans = [];
        foreach ((array) $request->input('plans', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $title = trim((string) ($row['title'] ?? ''));
            if ($title === '') {
                continue;
            }
            $key = trim((string) ($row['key'] ?? ''));
            if ($key === '') {
                $key = Str::slug($title) ?: 'plan';
            }
            $pointsRaw = (string) ($row['points_text'] ?? '');
            $points = array_values(array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $pointsRaw) ?: [])));
            $plans[] = [
                'key' => $key,
                'tab' => trim((string) ($row['tab'] ?? $title)),
                'title' => $title,
                'sub' => trim((string) ($row['sub'] ?? '')),
                'hi' => trim((string) ($row['hi'] ?? '')),
                'price_html' => (string) ($row['price_html'] ?? ''),
                'points' => $points,
            ];
        }

        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'discuss' => trim((string) $request->input('discuss', '')),
            'plans' => $plans,
        ];
    }

    /** @param array<string, mixed> $existing */
    private function parseToolkit(Request $request, array $existing): array
    {
        $existingItems = array_values($existing['items'] ?? []);
        $items = [];
        foreach ((array) $request->input('items', []) as $i => $row) {
            if (! is_array($row)) {
                continue;
            }
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }
            $icon = (string) ($existingItems[$i]['icon'] ?? 'assets/icons/stack/react.svg');
            $file = $request->file("items.$i.icon_file");
            if ($file && $file->isValid()) {
                if ($icon && ! str_starts_with($icon, 'assets/') && ! str_starts_with($icon, 'http')) {
                    Storage::disk('public')->delete($icon);
                }
                $icon = $file->store('cms/stack', 'public');
            } elseif (! empty($row['icon'])) {
                $icon = trim((string) $row['icon']);
            }
            $items[] = [
                'name' => $name,
                'desc' => trim((string) ($row['desc'] ?? '')),
                'icon' => $icon,
                'pct' => max(0, min(100, (int) ($row['pct'] ?? 0))),
            ];
        }

        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'items' => $items,
        ];
    }

    private function parseStudio(Request $request): array
    {
        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'role_line' => trim((string) $request->input('role_line', '')),
            'body' => trim((string) $request->input('body', '')),
            'cta_label' => trim((string) $request->input('cta_label', '')),
        ];
    }

    private function parseFaq(Request $request): array
    {
        $items = [];
        foreach ((array) $request->input('items', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $q = trim((string) ($row['q'] ?? ''));
            $a = trim((string) ($row['a'] ?? ''));
            if ($q === '' && $a === '') {
                continue;
            }
            $items[] = compact('q', 'a');
        }

        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'more_q' => trim((string) $request->input('more_q', '')),
            'write' => trim((string) $request->input('write', '')),
            'items' => $items,
        ];
    }

    private function parseFooter(Request $request): array
    {
        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
            'channels' => trim((string) $request->input('channels', '')),
            'meetings' => trim((string) $request->input('meetings', '')),
            'copy' => trim((string) $request->input('copy', '')),
        ];
    }

    private function parseAbout(Request $request): array
    {
        $exp = array_values(array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", (string) $request->input('exp_text', '')) ?: [])));
        $edu = array_values(array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", (string) $request->input('edu_text', '')) ?: [])));

        return [
            'role' => trim((string) $request->input('role', '')),
            'hi' => trim((string) $request->input('hi', '')),
            'desc' => trim((string) $request->input('desc', '')),
            'exp_h' => trim((string) $request->input('exp_h', '')),
            'exp' => $exp,
            'edu_h' => trim((string) $request->input('edu_h', '')),
            'edu' => $edu,
        ];
    }

    private function parseChrome(Request $request): array
    {
        return [
            'chip' => trim((string) $request->input('chip', '')),
            'h2' => (string) $request->input('h2', ''),
            'lead' => trim((string) $request->input('lead', '')),
        ];
    }
}
