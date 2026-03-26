<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('category')->orderBy('skill_category_id')->orderBy('order')->get();
        $categories = SkillCategory::where('slug', '!=', 'all')->orderBy('order')->get();
        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
        ]);
        $validated['is_featured'] = $request->boolean('is_featured');
        Skill::create($validated);
        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'skill_category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
        ]);
        $validated['is_featured'] = $request->boolean('is_featured');
        $skill->update($validated);
        return back()->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }

    // Skill Category CRUD
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|unique:skill_categories,slug',
            'order' => 'nullable|integer',
        ]);
        SkillCategory::create($validated);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroyCategory(SkillCategory $skillCategory)
    {
        $skillCategory->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
