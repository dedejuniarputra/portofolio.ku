<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectView;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where('is_active', true)->orderBy('order', 'asc')->orderBy('created_at', 'asc');

        if ($request->has('type') && $request->type != 'All') {
            $query->where('type', $request->type);
        }

        $projects = $query->get();
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project, Request $request)
    {
        $ip = $request->ip();
        
        // Check if this IP has viewed this project in the last 24 hours
        $alreadyViewed = ProjectView::where('project_id', $project->id)
            ->where('ip_address', $ip)
            ->where('created_at', '>', now()->subHours(24))
            ->exists();

        if (!$alreadyViewed) {
            ProjectView::create([
                'project_id' => $project->id,
                'ip_address' => $ip
            ]);
            $project->increment('views_count');
        }

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
