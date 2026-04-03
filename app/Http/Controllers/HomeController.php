<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Project;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $categories = SkillCategory::where('slug', '!=', 'all')->withCount('skills')->orderBy('order')->get();
        $skills = Skill::with('category')->orderBy('skill_category_id')->orderBy('order')->get();

        // Fetch GitHub Stats Server-side & Cache for 1 hour
        $github = Cache::remember('github_stats', 3600, function () {
            try {
                $response = Http::timeout(5)->get('https://api.github.com/users/dedejuniarputra');
                if ($response->successful()) {
                    return $response->json();
                }
            } catch (\Exception $e) {
                return null;
            }
            return null;
        });

        return view('home.index', compact('profile', 'categories', 'skills', 'github'));
    }
}
