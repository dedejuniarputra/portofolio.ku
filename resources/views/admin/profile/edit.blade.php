@extends('layouts.admin')
@section('title', 'Profile')
@section('page-title', 'Manage Profile')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')


        <!-- Personal Info -->
        <div class="card p-5 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Personal Information</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-input" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Location</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="form-input" placeholder="Indonesia 🇮🇩">
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <input type="text" name="status" value="{{ old('status', $profile->status) }}" class="form-input" placeholder="Open to Work">
                </div>
            </div>
            <div>
                <label class="form-label">Short Bio <span class="text-[10px] text-primary-dark ml-2 uppercase tracking-tighter">(Home Page)</span></label>
                <textarea name="bio" rows="3" class="form-input resize-none" placeholder="This bio appears on your Home page...">{{ old('bio', $profile->bio) }}</textarea>
            </div>
        </div>

        <!-- Contact & Social -->
        <div class="card p-5 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Contact & Social</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">GitHub URL</label>
                    <input type="url" name="github" value="{{ old('github', $profile->github) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram) }}" class="form-input">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                Save Changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Profile cleanup scripts
</script>
@endpush
@endsection
