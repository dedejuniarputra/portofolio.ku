<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->orderByDesc('start_date')->get();
        $educations = Education::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.experiences.index', compact('experiences', 'educations'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'company_logo' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'mode' => 'required|string|max:255',
            'responsibilities' => 'nullable|array',
            'learnings' => 'nullable|array',
            'impact' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('company_logo')) {
            if (!Storage::disk('public')->exists('experiences')) {
                Storage::disk('public')->makeDirectory('experiences');
            }
            $validated['company_logo'] = $request->file('company_logo')->store('experiences', 'public');
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience added successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'company_logo' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'mode' => 'required|string|max:255',
            'responsibilities' => 'nullable|array',
            'learnings' => 'nullable|array',
            'impact' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($experience->company_logo) {
                Storage::disk('public')->delete($experience->company_logo);
            }
            if (!Storage::disk('public')->exists('experiences')) {
                Storage::disk('public')->makeDirectory('experiences');
            }
            $validated['company_logo'] = $request->file('company_logo')->store('experiences', 'public');
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        if ($experience->company_logo) {
            Storage::disk('public')->delete($experience->company_logo);
        }
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }

    public function updateBiography(Request $request)
    {
        $validated = $request->validate([
            'long_bio' => 'nullable|string',
        ]);

        $profile = \App\Models\Profile::first();
        $profile->update([
            'long_bio' => $validated['long_bio']
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Biography updated successfully.');
    }
}
