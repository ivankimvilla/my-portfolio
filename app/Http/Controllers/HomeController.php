<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $works = Work::published()
            ->select(Work::PUBLIC_LIST_COLUMNS)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('pages.home', compact('works'));
    }
}
