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

        if ($request->hasFile('certificate_file')) {
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('certificate_file')->getClientOriginalName());
            $destination = public_path('certificates');

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('certificate_file')->move($destination, $filename);
            $validated['certificate_path'] = 'certificates/' . $filename;
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

        if ($request->hasFile('certificate_file')) {
            if ($certificate->certificate_path && file_exists(public_path($certificate->certificate_path))) {
                unlink(public_path($certificate->certificate_path));
            }

            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('certificate_file')->getClientOriginalName());
            $destination = public_path('certificates');

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('certificate_file')->move($destination, $filename);
            $validated['certificate_path'] = 'certificates/' . $filename;
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully!');
    }
}
