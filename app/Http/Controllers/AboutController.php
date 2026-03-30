<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;

class AboutController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $experiences = Experience::orderBy('order')->get();
        $educations = Education::orderBy('order')->orderByDesc('start_date')->get();
        
        return view('about.index', compact('profile', 'experiences', 'educations'));
    }
}
