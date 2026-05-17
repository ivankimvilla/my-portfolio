<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $perPage = (int) request('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 100) : 10;

        $approved = Testimonial::approved()->orderBy('display_order')->paginate($perPage, ['*'], 'approved_page');
        $pending = Testimonial::pending()->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'pending_page');
        return view('admin.testimonials.index', compact('approved', 'pending'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'client_image' => 'nullable|image|max:5120',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_url' => 'nullable|url',
            'display_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_approved'] = true;

        if ($request->hasFile('client_image')) {
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('client_image')->getClientOriginalName());
            $uploadDir = 'uploads/testimonials';
            $destination = public_path($uploadDir);

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('client_image')->move($destination, $filename);
            $validated['client_image'] = $uploadDir . '/' . $filename;
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'client_image' => 'nullable|image|max:5120',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_url' => 'nullable|url',
            'display_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_approved'] = true;

        if ($request->hasFile('client_image')) {
            $existingImage = $testimonial->getRawOriginal('client_image');

            if ($existingImage && file_exists(public_path(ltrim($existingImage, '/')))) {
                unlink(public_path(ltrim($existingImage, '/')));
            }

            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('client_image')->getClientOriginalName());
            $uploadDir = 'uploads/testimonials';
            $destination = public_path($uploadDir);

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('client_image')->move($destination, $filename);
            $validated['client_image'] = $uploadDir . '/' . $filename;
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $existingImage = $testimonial->getRawOriginal('client_image');

        if ($existingImage && file_exists(public_path(ltrim($existingImage, '/')))) {
            unlink(public_path(ltrim($existingImage, '/')));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update([
            'is_approved' => true,
            'is_active' => true,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial approved and activated!');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial rejected and removed!');
    }
}
