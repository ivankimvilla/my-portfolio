<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('slug', '!=', 'certificate')
            ->where('title', 'not like', '%certificate%')
            ->orderBy('display_order')
            ->paginate(10);

        return view('admin.services.index', ['services' => $services]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'deliverables' => 'nullable|string',
            'tools' => 'nullable|string',
            'price_range' => 'nullable|string|max:100',
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['deliverables'] = $request->has('deliverables')
            ? array_filter(array_map('trim', explode("\n", str_replace('\r\n', '\n', $request->deliverables))))
            : null;

        $validated['tools'] = $request->has('tools')
            ? array_filter(array_map('trim', preg_split('/[\r\n,]+/', $request->tools)))
            : null;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug,' . $service->id,
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'deliverables' => 'nullable|string',
            'tools' => 'nullable|string',
            'price_range' => 'nullable|string|max:100',
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['deliverables'] = $request->has('deliverables')
            ? array_filter(array_map('trim', explode("\n", str_replace('\r\n', '\n', $request->deliverables))))
            : null;

        $validated['tools'] = $request->has('tools')
            ? array_filter(array_map('trim', preg_split('/[\r\n,]+/', $request->tools)))
            : null;

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        if ($service->certificate_path && Storage::disk('public')->exists($service->certificate_path)) {
            Storage::disk('public')->delete($service->certificate_path);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }
}
