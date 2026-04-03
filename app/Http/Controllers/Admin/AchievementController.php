<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('order')->get();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);
        if ($request->hasFile('image')) {
            if (!Storage::disk('public')->exists('achievements')) {
                Storage::disk('public')->makeDirectory('achievements');
            }
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }
        Achievement::create($validated);
        return redirect()->route('admin.achievements.index')->with('success', 'Achievement berhasil ditambahkan!');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);
        if ($request->hasFile('image')) {
            if ($achievement->image) Storage::disk('public')->delete($achievement->image);
            if (!Storage::disk('public')->exists('achievements')) {
                Storage::disk('public')->makeDirectory('achievements');
            }
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }
        $achievement->update($validated);
        return redirect()->route('admin.achievements.index')->with('success', 'Achievement berhasil diperbarui!');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->image) Storage::disk('public')->delete($achievement->image);
        $achievement->delete();
        return back()->with('success', 'Achievement berhasil dihapus!');
    }
}
