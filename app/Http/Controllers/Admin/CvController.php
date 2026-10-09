<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CvController extends Controller
{
    public function edit(): View
    {
        return view('admin.cv.edit', [
            'cvAvailable' => Storage::disk('public')->exists('cv/resume.pdf'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $request->file('cv')->storeAs('cv', 'resume.pdf', 'public');

        return redirect()
            ->route('admin.cv.edit')
            ->with('status', 'CV uploaded successfully.');
    }
}