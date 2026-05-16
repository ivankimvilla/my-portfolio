<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            // allow any file type (images, archives, docs, etc.) up to 10MB
            'resume' => 'required|file|max:10240',
        ]);

        $file = $request->file('resume');
        $ext = $file->getClientOriginalExtension();
        $storedFilename = 'resume.' . $ext;
        $uploadDir = public_path('uploads');

        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // move uploaded file
        $filePath = $uploadDir . DIRECTORY_SEPARATOR . $storedFilename;
        $file->move($uploadDir, $storedFilename);

        // persist metadata in DB (keep single record)
        $meta = [
            'filename' => $storedFilename,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => Auth::id(),
        ];

        $resume = Resume::first();
        if ($resume) {
            // remove previous file if different
            if ($resume->filename && $resume->filename !== $storedFilename) {
                @unlink($uploadDir . DIRECTORY_SEPARATOR . $resume->filename);
            }
            $resume->update($meta);
        } else {
            Resume::create($meta);
        }

        return back()->with('success', 'Resume uploaded successfully.');
    }

    public function download()
    {
        $uploadDir = public_path('uploads');
        // prefer DB-backed record
        $resume = Resume::first();
        if ($resume && $resume->filename) {
            $path = $uploadDir . DIRECTORY_SEPARATOR . $resume->filename;
            if (file_exists($path)) {
                return response()->download($path, $resume->original_name ?: $resume->filename);
            }
        }

        // fallback: try to find any resume.* file
        $candidates = glob($uploadDir . DIRECTORY_SEPARATOR . 'resume.*');
        if (! empty($candidates)) {
            $path = $candidates[0];
            return response()->download($path, basename($path));
        }

        abort(404, 'Resume not found.');
    }
}
