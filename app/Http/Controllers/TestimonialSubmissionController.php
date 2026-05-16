<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialSubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'content' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'project_url' => 'nullable|url',
            'consent' => 'required',
        ]);

        // Create testimonial in pending state (not approved, not active)
        Testimonial::create([
            'client_name' => $validated['client_name'],
            'client_company' => $validated['client_company'],
            'client_title' => $validated['client_title'],
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'project_url' => $validated['project_url'],
            'ip_address' => $request->ip(),
            'is_active' => false,
            'is_approved' => false,
            'is_featured' => false,
            'display_order' => 0,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your testimonial has been submitted for review.'
            ]);
        }

        return redirect(url('/#testimonials'))->with('success', 'Thank you! Your testimonial has been submitted for review.');
    }
}
