<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create(): View
    {
        return view('admin.reviews.form', ['review' => new Review, 'mode' => 'create']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_avatars'] = $request->boolean('show_in_avatars');
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['stars'] = (int) $request->input('stars', 5);

        $review = new Review($data);
        $review->save();
        $this->handleUploads($request, $review);
        $review->save();

        return redirect()->route('admin.reviews.index')->with('ok', 'Отзыв создан.');
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.form', ['review' => $review, 'mode' => 'edit']);
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_avatars'] = $request->boolean('show_in_avatars');
        $data['sort_order'] = (int) $request->input('sort_order', 0);
        $data['stars'] = (int) $request->input('stars', 5);

        $review->fill($data);
        $this->handleUploads($request, $review);
        $review->save();

        return redirect()->route('admin.reviews.index')->with('ok', 'Сохранено.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->deleteStoredFiles($review);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('ok', 'Удалено.');
    }

    /** @return array<string, mixed> */
    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:500',
            'role_en' => 'nullable|string|max:500',
            'role_mobile' => 'nullable|string|max:255',
            'role_mobile_en' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'body_en' => 'nullable|string',
            'stars' => 'nullable|integer|min:1|max:5',
            'sort_order' => 'nullable|integer|min:0',
            'avatar_image' => 'nullable|image|max:5120',
        ]);
    }

    private function handleUploads(Request $request, Review $review): void
    {
        if (! $request->hasFile('avatar_image')) {
            return;
        }

        $disk = 'public';
        if ($review->avatar_image && ! str_starts_with($review->avatar_image, 'http')) {
            Storage::disk($disk)->delete($review->avatar_image);
        }

        $review->avatar_image = $request->file('avatar_image')
            ->store('reviews/'.$review->id, $disk);
    }

    private function deleteStoredFiles(Review $review): void
    {
        $disk = 'public';
        if ($review->avatar_image && ! str_starts_with($review->avatar_image, 'http')) {
            Storage::disk($disk)->delete($review->avatar_image);
        }
        Storage::disk($disk)->deleteDirectory('reviews/'.$review->id);
    }
}
