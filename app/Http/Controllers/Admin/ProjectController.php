<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('display_order')->paginate(10);
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects',
            'description' => 'required|string',
            'problem_solution' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'role' => 'nullable|string',
            'display_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $uploadDir = 'uploads/projects';
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('image_file')->getClientOriginalName());
            $destination = public_path($uploadDir);

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('image_file')->move($destination, $filename);
            $validated['image_url'] = $uploadDir . '/' . $filename;
        }

        $validated['technologies'] = $request->has('technologies') && trim($request->technologies) !== ''
            ? array_map('trim', explode(',', $request->technologies))
            : null;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects,slug,' . $project->id,
            'description' => 'required|string',
            'problem_solution' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'role' => 'nullable|string',
            'display_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            if ($project->image_url) {
                $existingPath = ltrim($project->image_url, '/');
                $existingFullPath = public_path($existingPath);
                if (file_exists($existingFullPath)) {
                    unlink($existingFullPath);
                }
            }

            $uploadDir = 'uploads/projects';
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $request->file('image_file')->getClientOriginalName());
            $destination = public_path($uploadDir);

            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $request->file('image_file')->move($destination, $filename);
            $validated['image_url'] = $uploadDir . '/' . $filename;
        }

        $validated['technologies'] = $request->has('technologies') && trim($request->technologies) !== ''
            ? array_map('trim', explode(',', $request->technologies))
            : null;

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image_url) {
            $filePath = ltrim($project->image_url, '/');
            $fullPath = public_path($filePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
