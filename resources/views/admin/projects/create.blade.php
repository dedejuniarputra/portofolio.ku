@extends('layouts.admin')
@section('title', 'Add Project')
@section('page-title', 'Add New Project')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-input" placeholder="Project name" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Type *</label>
                        <select name="type" class="form-input" required>
                            <option value="Web">Web</option>
                            <option value="Mobile">Mobile</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-input" required>
                            <option value="Proyek Pribadi">Proyek Pribadi</option>
                            <option value="Magang">Magang</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Lomba">Lomba</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="form-label">Short Description *</label>
                <textarea name="description" rows="2" class="form-input resize-none" placeholder="Brief overview of the project" required></textarea>
            </div>

            <div>
                <label class="form-label">Long Description</label>
                <textarea name="long_description" rows="5" class="form-input resize-none" placeholder="Detailed project information"></textarea>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Technical Details & Links</h3>
            <div>
                <label class="form-label">Tech Stack (comma separated)</label>
                <input type="text" name="tech_stack" class="form-input" placeholder="Laravel, TailwindCSS, MySQL, Alpine.js">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Demo URL</label>
                    <input type="url" name="demo_url" class="form-input" placeholder="https://demo.example.com">
                </div>
                <div>
                    <label class="form-label">GitHub URL</label>
                    <input type="url" name="github_url" class="form-input" placeholder="https://github.com/username/project">
                </div>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Settings & Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input">
                        <option value="completed">Completed</option>
                        <option value="in-progress">In Progress</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="is_featured" value="1" style="accent-color:#7c3aed">
                        <span class="text-xs group-hover:text-white transition-colors" style="color:#a3a3a3">Featured on Home Page</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="form-label">Project Image</label>
                <input type="file" name="image" accept="image/*" class="form-input text-xs">
            </div>
        </div>

        <div class="flex items-center gap-3 justify-end">
            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2 rounded-lg text-sm font-semibold" style="border:1px solid #2a2a2a; color:#a3a3a3">Cancel</a>
            <button type="submit" class="btn-primary flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Publish Project
            </button>
        </div>
    </form>
</div>
@endsection
