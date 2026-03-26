<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where('is_active', true)->orderBy('order');

        if ($request->has('type') && $request->type != 'All') {
            $query->where('type', $request->type);
        }

        if ($request->has('category') && $request->category != 'All') {
            $query->where('category', $request->category);
        }

        $projects = $query->get();
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->increment('views_count');
        return view('projects.show', compact('project'));
    }

    public function react(Project $project, Request $request)
    {
        $reactions = $project->reactions ?? [];
        $type = $request->input('type', 'heart');
        
        $reactions[$type] = ($reactions[$type] ?? 0) + 1;
        
        $project->update(['reactions' => $reactions]);
        
        return response()->json([
            'success' => true,
            'count' => $reactions[$type]
        ]);
    }
}
