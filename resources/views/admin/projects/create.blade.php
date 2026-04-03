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
                <div>
                    <label class="form-label">Type *</label>
                    <select name="type" class="form-input" required>
                        <option value="Web">Web</option>
                        <option value="Mobile">Mobile</option>
                        <option value="UI/UX">UI/UX</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="form-label">Short Description * (For Card)</label>
                <textarea name="description" rows="3" class="form-input resize-none" placeholder="Brief summary for project cards" required></textarea>
            </div>

            <div>
                <label class="form-label flex items-center gap-2">
                    <span>Introduction (Below Image)</span>
                    <span class="text-[10px] text-gray-500 font-normal">Optional narrative text</span>
                </label>
                <textarea name="introduction" rows="5" class="form-input resize-none" placeholder="Detailed narrative for the introduction section"></textarea>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-sm font-semibold text-white mb-6 underline decoration-primary-dark/30 underline-offset-8">Technical Details & Media</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Left: Tech Stack -->
                <div x-data="{ 
                    stack: '', 
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
                    
                    <!-- Tech Preview -->
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

                    <div class="pt-4 border-t border-white/5">
                        <label class="form-label mb-3">Project Features</label>
                        <textarea name="features" class="form-input py-3 text-xs h-32 resize-none" placeholder="Realtime Chat&#10;Secure Authentication&#10;Payment Integration"></textarea>
                        <p class="text-[9px] text-gray-600 mt-2 uppercase font-bold tracking-widest">Enter each feature on a new line (use Enter)</p>
                    </div>
                </div>

                <!-- Right: Image -->
                <div x-data="{ 
                    imagePreview: null,
                    handleFileSelect(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.imagePreview = URL.createObjectURL(file);
                        }
                    }
                }">
                    <label class="form-label mb-3">Project Image *</label>
                    
                    <!-- Preview Container -->
                    <div class="mb-4 aspect-video rounded-xl bg-white/2 border border-dashed border-white/10 flex items-center justify-center overflow-hidden transition-all duration-500"
                         :class="imagePreview ? 'border-primary-dark/30' : ''">
                        <template x-if="!imagePreview">
                            <div class="text-center">
                                <svg class="w-10 h-10 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">Image Preview</span>
                            </div>
                        </template>
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-full h-full object-cover animate-fade-in">
                        </template>
                    </div>

                    <input type="file" name="image" accept="image/*" @change="handleFileSelect" class="form-input text-xs py-4 @error('image') border-rose-500 @enderror" required>
                    @error('image')
                        <p class="text-[10px] text-rose-500 mt-1 uppercase font-bold tracking-wider">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bottom: URL -->
            <div class="mt-4">
                <label class="form-label mb-3">Project URL *</label>
                <input type="url" name="demo_url" class="form-input py-3" placeholder="https://example.com" required>
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
