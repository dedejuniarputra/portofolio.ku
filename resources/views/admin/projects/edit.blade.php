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
                <div>
                    <label class="form-label">Type *</label>
                    <select name="type" class="form-input" required>
                        <option value="Web" {{ $project->type == 'Web' ? 'selected' : '' }}>Web</option>
                        <option value="Mobile" {{ $project->type == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="UI/UX" {{ $project->type == 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="form-label">Description *</label>
                <textarea name="description" rows="5" class="form-input resize-none" required>{{ old('description', $project->description) }}</textarea>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-sm font-semibold text-white mb-6 underline decoration-primary-dark/30 underline-offset-8">Technical Details & Media</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Left: Tech Stack -->
                <div x-data="{ 
                    stack: '{{ old('tech_stack', implode(', ', $project->tech_stack ?? [])) }}', 
                    get icons() { 
                        return this.stack.split(',').map(s => s.trim()).filter(s => s.length > 0); 
                    } 
                }" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="form-label mb-0">Tech Stack *</label>
                        <a href="https://devicon.dev/" target="_blank" class="text-[10px] font-bold text-primary-dark hover:underline flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Explore Icons
                        </a>
                    </div>
                    <input type="text" name="tech_stack" x-model="stack" class="form-input py-3" placeholder="e.g. devicon-laravel-original, ...">
                    
                    <!-- Preview -->
                    <div class="p-4 rounded-xl bg-white/2 border border-dashed border-white/5 min-h-[100px] flex flex-wrap items-center gap-4">
                        <template x-if="icons.length === 0">
                            <span class="text-[10px] text-gray-600 font-bold uppercase tracking-widest mx-auto">Icon Preview</span>
                        </template>
                        <template x-for="icon in icons" :key="icon">
                            <div class="flex flex-col items-center gap-1 group">
                                <i :class="icon + ' colored'" class="text-3xl transition-transform duration-300 group-hover:scale-110"></i>
                                <span x-text="icon.split('-')[1]" class="text-[8px] font-black uppercase text-gray-600"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Right: Image -->
                <div>
                    <label class="form-label mb-3">Project Image</label>
                    @if($project->image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($project->image) }}" class="w-40 h-28 rounded-lg object-contain bg-[#111] border border-white/5">
                            <p class="text-[9px] text-gray-600 mt-1 uppercase font-bold tracking-widest">Current Image</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="form-input text-xs py-4 @error('image') border-rose-500 @enderror">
                    @error('image')
                        <p class="text-[10px] text-rose-500 mt-1 uppercase font-bold tracking-wider">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bottom: URL -->
            <div class="mt-4">
                <label class="form-label mb-3">Project URL *</label>
                <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="form-input py-3" required>
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
