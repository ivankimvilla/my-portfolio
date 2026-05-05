<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_active', true)
            ->orderBy('display_order')
            ->paginate(9);

        return view('pages.portfolio', ['projects' => $projects]);
    }

    public function show(Project $project)
    {
        return view('pages.portfolio-detail', ['project' => $project]);
    }
}
