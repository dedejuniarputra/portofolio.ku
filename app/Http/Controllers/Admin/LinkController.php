<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('order')->get();
        return view('admin.links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);
        Link::create($validated);
        return back()->with('success', 'Link berhasil ditambahkan!');
    }

    public function update(Request $request, Link $link)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);
        $link->update($validated);
        return back()->with('success', 'Link berhasil diperbarui!');
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return back()->with('success', 'Link berhasil dihapus!');
    }
}
