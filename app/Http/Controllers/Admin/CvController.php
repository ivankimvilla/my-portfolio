<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CvController extends Controller
{
    public function edit(): View
    {
        return view('admin.cv.edit', [
            'cvAvailable' => Cv::query()->exists(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $file = $request->file('cv');
        $cv = Cv::query()->firstOrNew(['id' => 1]);
        $cv->fill([
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => 'application/pdf',
            'file_blob' => $file->getContent(),
        ])->save();

        return redirect()
            ->route('admin.cv.edit')
            ->with('status', 'CV uploaded successfully.');
    }
}