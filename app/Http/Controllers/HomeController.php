<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->limit(3)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->limit(3)
            ->get();

        return view('home', [
            'featuredProjects' => $featuredProjects,
            'services' => $services,
            'testimonials' => $testimonials,
        ]);
    }
}
