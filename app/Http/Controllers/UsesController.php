<?php

namespace App\Http\Controllers;

use App\Models\ToolCategory;

class UsesController extends Controller
{
    public function index()
    {
        $toolCategories = ToolCategory::with(['tools' => function($q){ $q->orderBy('order'); }])->orderBy('order')->get();
        return view('uses.index', compact('toolCategories'));
    }
}
