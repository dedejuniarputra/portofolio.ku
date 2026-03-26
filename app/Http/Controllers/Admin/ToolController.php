<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\ToolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->orderBy('tool_category_id')->orderBy('order')->get();
        $categories = ToolCategory::orderBy('order')->get();
        return view('admin.tools.index', compact('tools', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_category_id' => 'required|exists:tool_categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
        ]);
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('tools', 'public');
        }
        Tool::create($validated);
        return redirect()->route('admin.tools.index')->with('success', 'Tool berhasil ditambahkan!');
    }

    public function edit(Tool $tool)
    {
        $categories = ToolCategory::orderBy('order')->get();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'tool_category_id' => 'required|exists:tool_categories,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'nullable|integer',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
        ]);
        if ($request->hasFile('icon')) {
            if ($tool->icon) Storage::disk('public')->delete($tool->icon);
            $validated['icon'] = $request->file('icon')->store('tools', 'public');
        }
        $tool->update($validated);
        return redirect()->route('admin.tools.index')->with('success', 'Tool berhasil diperbarui!');
    }

    public function destroy(Tool $tool)
    {
        if ($tool->icon) Storage::disk('public')->delete($tool->icon);
        $tool->delete();
        return back()->with('success', 'Tool berhasil dihapus!');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|unique:tool_categories,slug',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
        ]);
        ToolCategory::create($validated);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroyCategory(ToolCategory $toolCategory)
    {
        $toolCategory->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
