<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'status' => 'required|in:completed,in-progress,archived',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['tech_stack'] = $request->tech_stack
            ? array_filter(array_map('trim', explode(',', $request->tech_stack)))
            : [];

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'status' => 'required|in:completed,in-progress,archived',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['tech_stack'] = $request->tech_stack
            ? array_filter(array_map('trim', explode(',', $request->tech_stack)))
            : [];

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus!');
    }
}
