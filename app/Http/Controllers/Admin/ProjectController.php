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
        $projects = Project::orderBy('order', 'asc')->orderBy('created_at', 'asc')->get();
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
            'category' => 'nullable|string|max:100',
            'description' => 'required|string',
            'introduction' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'demo_url' => 'required|url',
            'status' => 'nullable|in:completed,in-progress,archived',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['category'] = $request->input('category', 'Proyek Pribadi');
        $validated['status'] = $request->input('status', 'completed');
        $validated['is_featured'] = $request->boolean('is_featured', true);
        $validated['tech_stack'] = $request->tech_stack
            ? array_filter(array_map('trim', explode(',', $request->tech_stack)))
            : [];
        $validated['features'] = $request->features
            ? array_filter(array_map('trim', explode("\n", $request->features)))
            : [];

        if ($request->hasFile('image')) {
            if (!Storage::disk('public')->exists('projects')) {
                Storage::disk('public')->makeDirectory('projects');
            }
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
            'category' => 'nullable|string|max:100',
            'description' => 'required|string',
            'introduction' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'features' => 'nullable|string',
            'demo_url' => 'required|url',
            'status' => 'nullable|in:completed,in-progress,archived',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['category'] = $request->input('category', $project->category ?? 'Proyek Pribadi');
        $validated['status'] = $request->input('status', $project->status ?? 'completed');
        $validated['is_featured'] = $request->boolean('is_featured', $project->is_featured ?? true);
        $validated['tech_stack'] = $request->tech_stack
            ? array_filter(array_map('trim', explode(',', $request->tech_stack)))
            : [];
        $validated['features'] = $request->features
            ? array_filter(array_map('trim', explode("\n", $request->features)))
            : [];

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            if (!Storage::disk('public')->exists('projects')) {
                Storage::disk('public')->makeDirectory('projects');
            }
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
