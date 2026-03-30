@extends('layouts.admin')
@section('title', 'Edit Education')
@section('page-title', 'Edit Education Record')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.educations.update', $education) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="card p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Institution Details</h3>
            
            <div>
                <label class="form-label">Institution Name *</label>
                <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" class="form-input" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $education->location) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Institution Logo</label>
                    @if($education->institution_logo)
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ Storage::url($education->institution_logo) }}" class="w-8 h-8 rounded-lg object-contain bg-[#111]">
                            <span class="text-[10px] text-gray-600">Current logo</span>
                        </div>
                    @endif
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
                    <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Field of Study *</label>
                    <input type="text" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}" class="form-input" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="form-label">GPA</label>
                    <input type="text" name="gpa" value="{{ old('gpa', $education->gpa) }}" class="form-input" placeholder="e.g. 3.8/4.0">
                </div>
                <div>
                    <label class="form-label">Start Date *</label>
                    <input type="text" name="start_date" value="{{ old('start_date', $education->start_date) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">End Date</label>
                    <input type="text" name="end_date" value="{{ old('end_date', $education->end_date) }}" class="form-input" placeholder="e.g. 2022">
                </div>
            </div>

            <div>
                <label class="form-label">Display Order</label>
                <input type="number" name="order" value="{{ old('order', $education->order) }}" class="form-input">
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.educations.index') }}" class="px-6 py-2.5 rounded-xl border border-white/5 text-xs font-bold text-gray-500 hover:text-white hover:bg-white/5 transition-all">
                Cancel
            </a>
            <button type="submit" class="btn-primary py-2.5 px-8 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Update Education
            </button>
        </div>
    </form>
</div>
@endsection
