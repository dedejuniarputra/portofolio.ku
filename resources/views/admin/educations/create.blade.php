@extends('layouts.admin')
@section('title', 'Add Education')
@section('page-title', 'Add Education Record')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.educations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="card p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Institution Details</h3>
            
            <div>
                <label class="form-label">Institution Name *</label>
                <input type="text" name="institution" class="form-input" placeholder="e.g. University of Indonesia" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-input" placeholder="e.g. Depok, ID" required>
                </div>
                <div>
                    <label class="form-label">Institution Logo</label>
                    <input type="file" name="institution_logo" class="form-input text-xs pt-2 @error('institution_logo') border-rose-500 @enderror">
                    @error('institution_logo')
                        <p class="text-[10px] text-rose-500 mt-1 uppercase font-bold tracking-wider">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Academic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Degree *</label>
                    <input type="text" name="degree" class="form-input" placeholder="e.g. Bachelor's Degree" required>
                </div>
                <div>
                    <label class="form-label">Field of Study *</label>
                    <input type="text" name="field_of_study" class="form-input" placeholder="e.g. Computer Science" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="form-label">GPA</label>
                    <input type="text" name="gpa" class="form-input" placeholder="e.g. 3.8/4.0">
                </div>
                <div>
                    <label class="form-label">Start Date *</label>
                    <input type="text" name="start_date" class="form-input" placeholder="e.g. 2018" required>
                </div>
                <div>
                    <label class="form-label">End Date</label>
                    <input type="text" name="end_date" class="form-input" placeholder="e.g. 2022">
                </div>
            </div>

            <div>
                <label class="form-label">Display Order</label>
                <input type="number" name="order" value="0" class="form-input">
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.educations.index') }}" class="px-6 py-2.5 rounded-xl border border-white/5 text-xs font-bold text-gray-500 hover:text-white hover:bg-white/5 transition-all">
                Cancel
            </a>
            <button type="submit" class="btn-primary py-2.5 px-8 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save Education
            </button>
        </div>
    </form>
</div>
@endsection
