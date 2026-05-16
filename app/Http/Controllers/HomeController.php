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
            ->where('slug', '!=', 'certificate')
            ->where('title', 'not like', '%certificate%')
            ->orderBy('display_order')
            ->get();

        $testimonials = Testimonial::approved()
            ->active()
            ->orderBy('display_order')
            ->limit(6)
            ->get();

        $hasMoreTestimonials = Testimonial::approved()
            ->active()
            ->count() > 6;

        return view('home', [
            'featuredProjects' => $featuredProjects,
            'services' => $services,
            'testimonials' => $testimonials,
            'hasMoreTestimonials' => $hasMoreTestimonials,
        ]);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::approved()
            ->active()
            ->orderBy('display_order')
            ->get();

        return view('pages.testimonials', [
            'testimonials' => $testimonials,
        ]);
    }
}
