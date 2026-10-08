<?php

namespace App\Http\Controllers;

use App\Actions\Works\WorkImageService;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PublicWorkController extends Controller
{
    public function index(Request $request): View
    {
        $categories = collect(['Web Development', 'UI/UX Design'])
            ->merge(Work::published()
            ->whereNotNull('category')
            ->where('category', '<>', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category'))
            ->unique()
            ->values();
        $category = $request->query('category');

        if (! is_string($category) || ! $categories->contains($category)) {
            $category = null;
        }

        $query = Work::published()
            ->select(Work::PUBLIC_LIST_COLUMNS)
            ->orderBy('sort_order')
            ->orderByDesc('created_at');

        if ($category !== null) {
            $query->where('category', $category);
        }

        $works = $query->paginate(12)->withQueryString();

        return view('pages.works', compact('works', 'categories', 'category'));
    }

    public function show(Work $work): View
    {
        abort_unless($work->status === 'published', 404);

        return view('pages.work-detail', compact('work'));
    }

    public function image(Work $work, Request $request, WorkImageService $images): Response
    {
        abort_unless($work->status === 'published' || $request->user()?->is_admin, 404);

        return $images->response($work, $request, $work->status === 'published');
    }
}
