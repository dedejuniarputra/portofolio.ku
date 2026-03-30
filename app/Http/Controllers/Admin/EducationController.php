<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'institution_logo' => 'nullable|image|max:2048',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'gpa' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('institution_logo')) {
            if (!Storage::disk('public')->exists('educations')) {
                Storage::disk('public')->makeDirectory('educations');
            }
            $validated['institution_logo'] = $request->file('institution_logo')->store('educations', 'public');
        }

        Education::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Education added successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'institution_logo' => 'nullable|image|max:2048',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'gpa' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('institution_logo')) {
            if ($education->institution_logo) {
                Storage::disk('public')->delete($education->institution_logo);
            }
            if (!Storage::disk('public')->exists('educations')) {
                Storage::disk('public')->makeDirectory('educations');
            }
            $validated['institution_logo'] = $request->file('institution_logo')->store('educations', 'public');
        }

        $education->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        if ($education->institution_logo) {
            Storage::disk('public')->delete($education->institution_logo);
        }
        $education->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Education deleted successfully.');
    }
}
