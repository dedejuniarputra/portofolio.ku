<?php

namespace App\Http\Controllers;

use App\Models\Achievement;

class AchievementsController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('order')->get();
        return view('achievements.index', compact('achievements'));
    }
}
