<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $categories = SkillCategory::where('slug', '!=', 'all')->withCount('skills')->orderBy('order')->get();
        $skills = Skill::with('category')->orderBy('skill_category_id')->orderBy('order')->get();
        return view('home.index', compact('profile', 'categories', 'skills'));
    }
}
