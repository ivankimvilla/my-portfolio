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
            $path = $request->file('image_file')->store('projects', 'public');
            $validated['image_url'] = 'storage/' . $path;
            // Copy to public/storage for accessibility
            $source = storage_path('app/public/' . $path);
            $destination = public_path('storage/' . $path);
            if (!file_exists(dirname($destination))) {
                mkdir(dirname($destination), 0755, true);
            }
            copy($source, $destination);
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
            if ($project->image_url && str_starts_with($project->image_url, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $project->image_url));
                // Also delete from public/storage
                $oldPath = public_path($project->image_url);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $path = $request->file('image_file')->store('projects', 'public');
            $validated['image_url'] = 'storage/' . $path;
            // Copy to public/storage
            $source = storage_path('app/public/' . $path);
            $destination = public_path('storage/' . $path);
            if (!file_exists(dirname($destination))) {
                mkdir(dirname($destination), 0755, true);
            }
            copy($source, $destination);
        }

        $validated['technologies'] = $request->has('technologies') && trim($request->technologies) !== ''
            ? array_map('trim', explode(',', $request->technologies))
            : null;

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image_url && str_starts_with($project->image_url, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $project->image_url));
            // Also delete from public/storage
            $filePath = public_path($project->image_url);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
