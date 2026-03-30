@extends('layouts.admin')
@section('title', 'Edit Experience')
@section('page-title', 'Edit Experience')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left: Basic Info -->
            <div class="md:col-span-2 space-y-6">
                <div class="card p-6 space-y-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">General Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Company Name *</label>
                            <input type="text" name="company" value="{{ old('company', $experience->company) }}" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Job Title *</label>
                            <input type="text" name="title" value="{{ old('title', $experience->title) }}" class="form-input" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Location *</label>
                            <input type="text" name="location" value="{{ old('location', $experience->location) }}" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Company Logo</label>
                            @if($experience->company_logo)
                                <div class="flex items-center gap-3 mb-2">
                                    <img src="{{ Storage::url($experience->company_logo) }}" class="w-8 h-8 rounded-lg object-contain bg-[#111]">
                                    <span class="text-[10px] text-gray-600">Current logo</span>
                                </div>
                            @endif
                            <input type="file" name="company_logo" class="form-input text-xs pt-2 @error('company_logo') border-rose-500 @enderror">
                            @error('company_logo')
                                <p class="text-[10px] text-rose-500 mt-1 uppercase font-bold tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="text" name="start_date" value="{{ old('start_date', $experience->start_date) }}" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="text" name="end_date" value="{{ old('end_date', $experience->end_date) }}" class="form-input" placeholder="e.g. Present">
                        </div>
                        <div>
                            <label class="form-label">Duration</label>
                            <input type="text" name="duration" value="{{ old('duration', $experience->duration) }}" class="form-input" placeholder="e.g. 6 mos">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label">Type *</label>
                            <select name="type" class="form-input" required>
                                <option value="Full-time" {{ $experience->type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ $experience->type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Freelance" {{ $experience->type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Contract" {{ $experience->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ $experience->type == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Mode *</label>
                            <select name="mode" class="form-input" required>
                                <option value="Remote" {{ $experience->mode == 'Remote' ? 'selected' : '' }}>Remote</option>
                                <option value="On-site" {{ $experience->mode == 'On-site' ? 'selected' : '' }}>On-site</option>
                                <option value="Hybrid" {{ $experience->mode == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Order</label>
                            <input type="number" name="order" value="{{ old('order', $experience->order) }}" class="form-input">
                        </div>
                    </div>
                </div>

                <!-- Dynamic Lists (Alpine.js) -->
                <div x-data="{ 
                    responsibilities: {{ json_encode($experience->responsibilities ?? ['']) }}, 
                    learnings: {{ json_encode($experience->learnings ?? ['']) }}, 
                    impact: {{ json_encode($experience->impact ?? ['']) }} 
                }" class="space-y-6">
                    
                    <!-- Responsibilities -->
                    <div class="card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Responsibilities</h3>
                            <button type="button" @click="responsibilities.push('')" class="text-[10px] font-bold text-primary-dark hover:underline">+ Add Item</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(item, index) in responsibilities" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" name="responsibilities[]" x-model="responsibilities[index]" class="form-input text-xs">
                                    <button type="button" @click="responsibilities.splice(index, 1)" class="p-2 text-rose-500 hover:bg-rose-500/10 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Learnings -->
                    <div class="card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Learnings</h3>
                            <button type="button" @click="learnings.push('')" class="text-[10px] font-bold text-primary-dark hover:underline">+ Add Item</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(item, index) in learnings" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" name="learnings[]" x-model="learnings[index]" class="form-input text-xs">
                                    <button type="button" @click="learnings.splice(index, 1)" class="p-2 text-rose-500 hover:bg-rose-500/10 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Impact -->
                    <div class="card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Impact</h3>
                            <button type="button" @click="impact.push('')" class="text-[10px] font-bold text-primary-dark hover:underline">+ Add Item</button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(item, index) in impact" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" name="impact[]" x-model="impact[index]" class="form-input text-xs">
                                    <button type="button" @click="impact.splice(index, 1)" class="p-2 text-rose-500 hover:bg-rose-500/10 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Action Box -->
            <div class="space-y-6">
                <div class="card p-6 sticky top-24">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Actions</h3>
                    <p class="text-[11px] text-gray-500 mb-6">Last updated: {{ $experience->updated_at->diffForHumans() }}</p>
                    
                    <div class="space-y-3">
                        <button type="submit" class="btn-primary w-full py-3 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Update Experience
                        </button>
                        <a href="{{ route('admin.experiences.index') }}" class="block text-center py-3 rounded-xl border border-white/5 text-xs font-bold text-gray-500 hover:text-white hover:bg-white/5 transition-all">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
