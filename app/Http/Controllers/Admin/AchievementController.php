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
            'issuer' => 'nullable|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'credential_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
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
            'issuer' => 'nullable|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'credential_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($achievement->image) Storage::disk('public')->delete($achievement->image);
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
