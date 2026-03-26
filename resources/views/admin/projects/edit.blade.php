@extends('layouts.admin')
@section('title', 'Edit Project')
@section('page-title', 'Edit Project: ' . $project->title)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        
        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="form-input" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Type *</label>
                        <select name="type" class="form-input" required>
                            <option value="Web" {{ $project->type == 'Web' ? 'selected' : '' }}>Web</option>
                            <option value="Mobile" {{ $project->type == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-input" required>
                            @foreach(['Proyek Pribadi', 'Magang', 'Freelance', 'Lomba'] as $cat)
                                <option value="{{ $cat }}" {{ $project->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="form-label">Short Description *</label>
                <textarea name="description" rows="2" class="form-input resize-none" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div>
                <label class="form-label">Long Description</label>
                <textarea name="long_description" rows="5" class="form-input resize-none">{{ old('long_description', $project->long_description) }}</textarea>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Technical Details & Links</h3>
            <div>
                <label class="form-label">Tech Stack (comma separated)</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', implode(', ', $project->tech_stack ?? [])) }}" class="form-input">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Demo URL</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="form-input">
                </div>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Settings & Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input">
                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="in-progress" {{ $project->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="archived" {{ $project->status == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }} style="accent-color:#7c3aed">
                        <span class="text-xs group-hover:text-white transition-colors" style="color:#a3a3a3">Featured on Home Page</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="form-label">Project Image</label>
                @if($project->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($project->image) }}" class="w-32 h-20 rounded-lg object-cover">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="form-input text-xs">
            </div>
        </div>

        <div class="flex items-center gap-3 justify-end">
            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 rounded-lg text-sm font-semibold" style="border:1px solid #2a2a2a; color:#a3a3a3">Cancel</a>
            <button type="submit" class="btn-primary flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
