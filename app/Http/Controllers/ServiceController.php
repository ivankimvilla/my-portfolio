<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->where('slug', '!=', 'certificate')
            ->where('title', 'not like', '%certificate%')
            ->orderBy('display_order')
            ->get();

        return view('pages.services', ['services' => $services]);
    }

    public function show(Service $service)
    {
        return view('pages.service-detail', ['service' => $service]);
    }
}
