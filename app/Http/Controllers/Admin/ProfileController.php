<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate(['id' => 1], [
            'name' => 'Your Name',
            'bio' => 'Your bio here',
            'location' => 'Indonesia',
            'status' => 'Open to Work',
        ]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'long_bio' => 'nullable|string',
            'location' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:100',
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);


        $profile->update($validated);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
