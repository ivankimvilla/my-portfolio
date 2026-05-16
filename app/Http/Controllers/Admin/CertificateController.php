<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::latest()->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'description' => 'nullable|string',
            'certificate_file' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('certificate_file')) {
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('certificate_file')->getClientOriginalName());
            $destination = public_path('uploads/certificates');

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('certificate_file')->move($destination, $filename);
            $validated['certificate_path'] = 'uploads/certificates/' . $filename;
        }

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'description' => 'nullable|string',
            'certificate_file' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', $certificate->is_active);

        if ($request->hasFile('certificate_file')) {
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('certificate_file')->getClientOriginalName());
            $destination = public_path('uploads/certificates');

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            try {
                $request->file('certificate_file')->move($destination, $filename);
                $newPath = 'uploads/certificates/' . $filename;

                // Check if file was moved successfully
                if (file_exists($destination . '/' . $filename)) {
                    // Only update path and delete old file after successful move
                    if ($certificate->certificate_path && file_exists(public_path($certificate->certificate_path))) {
                        unlink(public_path($certificate->certificate_path));
                    }
                    $validated['certificate_path'] = $newPath;
                } else {
                    // File move failed, return with error
                    return redirect()->back()->withErrors(['certificate_file' => 'Failed to upload certificate file.'])->withInput();
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['certificate_file' => 'Failed to upload certificate file: ' . $e->getMessage()])->withInput();
            }
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        if ($certificate->certificate_path && file_exists(public_path($certificate->certificate_path))) {
            unlink(public_path($certificate->certificate_path));
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully!');
    }
}
