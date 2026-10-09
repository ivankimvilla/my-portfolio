<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Works\WorkImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Work;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WorkController extends Controller
{
    public function index(): View
    {
        $works = Work::query()
            ->select(Work::ADMIN_LIST_COLUMNS)
            ->orderBy('sort_order')
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('admin.works.index', compact('works'));
    }

    public function create(): View
    {
        return view('admin.works.create', ['work' => new Work(['status' => 'published'])]);
    }

    public function store(StoreWorkRequest $request, WorkImageService $images): RedirectResponse
    {
        $attributes = $request->safe()->except(['image', 'gallery_images', 'tools']);
        $work = new Work($attributes);
        $work->status = 'published';
        $work->slug = $this->uniqueSlug($attributes['title']);
        $work->full_description = $attributes['short_description'];
        $work->tools = $this->parseTools($request->validated('tools'));
        $images->attach($work, $request->file('image'));
        $work->save();
        $images->attachGallery($work, $request->file('gallery_images', []));

        return redirect()
            ->route('admin.works.index')
            ->with('status', 'Work created.');
    }

    public function edit(Work $work): View
    {
        $work->load('galleryImages');

        return view('admin.works.edit', compact('work'));
    }

    public function update(UpdateWorkRequest $request, Work $work, WorkImageService $images): RedirectResponse
    {
        $attributes = $request->safe()->except(['image', 'gallery_images', 'tools']);
        $descriptionTracksSummary = $work->full_description === $work->short_description;

        $work->fill($attributes);
        $work->tools = $this->parseTools($request->validated('tools'));

        if (Str::slug($attributes['title']) !== $work->slug) {
            $work->slug = $this->uniqueSlug($attributes['title'], $work);
        }

        if ($descriptionTracksSummary) {
            $work->full_description = $attributes['short_description'];
        }

        if ($request->hasFile('image')) {
            $images->attach($work, $request->file('image'));
        }

        $work->save();
        $images->attachGallery($work, $request->file('gallery_images', []));

        return redirect()
            ->route('admin.works.index')
            ->with('status', 'Work updated.');
    }

    public function destroy(Work $work): RedirectResponse
    {
        $work->delete();

        return redirect()
            ->route('admin.works.index')
            ->with('status', 'Work deleted.');
    }

    private function uniqueSlug(string $title, ?Work $ignore = null): string
    {
        $base = substr(Str::slug($title) ?: 'work', 0, 230);
        $slug = $base;
        $suffix = 2;

        while (true) {
            $query = Work::query()->where('slug', $slug);

            if ($ignore) {
                $query->where('id', '<>', $ignore->getKey());
            }

            if (! $query->exists()) {
                return $slug;
            }

            $slug = $base.'-'.$suffix++;
        }
    }

    private function parseTools(?string $tools): array
    {
        $items = array_map(static fn (string $tool): string => trim($tool), explode(',', $tools ?? ''));

        return array_values(array_unique(array_filter($items, static fn (string $tool): bool => $tool !== '')));
    }
}
