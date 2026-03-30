@extends('layouts.admin')
@section('title', 'Career')
@section('page-title', 'Manage Career')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500">
        Workspace Management
    </div>
    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
        <a href="{{ route('admin.experiences.create') }}" class="btn-primary flex items-center gap-2 flex-1 sm:flex-initial justify-center py-2.5 text-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Career
        </a>
        <a href="{{ route('admin.educations.create') }}" class="px-5 py-2.5 rounded-xl bg-sky-500/10 text-sky-500 border border-sky-500/20 text-[10px] font-black uppercase tracking-widest hover:bg-sky-500 hover:text-black transition-all flex items-center gap-2 flex-1 sm:flex-initial justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Education
        </a>
    </div>
</div>

<!-- Biography Section -->
<div class="mb-12">
    <div class="card p-8 border border-white/5 bg-white/2">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-primary-dark/10 flex items-center justify-center border border-primary-dark/20 text-primary-dark">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-white">About Biography</h3>
                    <p class="text-[10px] text-gray-500 font-bold mt-1 uppercase tracking-wider">Public "About" page introduction</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('admin.experiences.biography.update') }}" method="POST" class="space-y-6">
            @csrf
            <textarea name="long_bio" rows="5" class="form-input text-sm leading-relaxed bg-[#0d0d0d] border-white/5 focus:border-primary-dark/30 transition-all resize-none px-4 py-3" placeholder="Write your full biography here...">{{ \App\Models\Profile::first()->long_bio }}</textarea>
            <div class="flex justify-end">
                <button type="submit" class="group flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary-dark/10 text-primary-dark border border-primary-dark/20 text-[10px] font-black uppercase tracking-widest hover:bg-primary-dark hover:text-black transition-all">
                    <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Update Biography
                </button>
            </div>
        </form>
    </div>
</div>

<div class="flex items-center gap-2 mb-6">
    <div class="w-1.5 h-1.5 rounded-full bg-primary-dark shadow-[0_0_8px_rgba(13,226,130,0.5)]"></div>
    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Career History and Experiences</div>
</div>

<div class="card overflow-hidden">
    <div class="divide-y" style="divide-color:#141414">
        @forelse($experiences as $exp)
            <!-- ... Career Item ... -->
            <div class="px-5 py-4 hover:bg-white/2 transition-colors group flex items-center gap-6">
                <div class="shrink-0">
                    @if($exp->company_logo)
                        <img src="{{ Storage::url($exp->company_logo) }}" class="w-12 h-12 rounded-lg object-contain bg-[#111] border border-white/5">
                    @else
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center border border-dashed border-white/10 bg-gray-950 text-lg">💼</div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-1">
                        <h3 class="text-sm font-bold text-white group-hover:text-primary-dark transition-colors truncate flex-1 min-w-0">{{ $exp->title }}</h3>
                        <span class="shrink-0 whitespace-nowrap px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-primary-dark/10 text-primary-dark border border-primary-dark/20">{{ $exp->type }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-[11px] text-gray-500 font-medium">
                        <span class="text-gray-300 font-bold uppercase tracking-tight text-[10px]">{{ $exp->company }}</span>
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $exp->location }}
                        </span>
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span class="text-primary-dark/80 font-bold tracking-tight">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</span>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-3 shrink-0 border-l border-white/5 pl-8 ml-4">
                    <a href="{{ route('admin.experiences.edit', $exp) }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Delete experience?')">
                        @csrf @method('DELETE')
                        <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-500/5 border border-rose-500/10 text-[10px] font-black uppercase tracking-widest text-rose-500/60 hover:text-rose-500 hover:bg-rose-500/10 hover:border-rose-500/30 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-12 text-center text-gray-600 text-[10px] font-black uppercase tracking-widest">No career history yet</div>
        @endforelse
    </div>
</div>

<div class="flex items-center gap-2 mt-12 mb-6">
    <div class="w-1.5 h-1.5 rounded-full bg-sky-500 shadow-[0_0_8px_rgba(14,165,233,0.5)]"></div>
    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Education Background</div>
</div>

<div class="card overflow-hidden">
    <div class="divide-y" style="divide-color:#141414">
        @forelse($educations as $edu)
        <div class="px-5 py-4 hover:bg-white/2 transition-colors group flex items-center gap-6">
            <!-- Logo -->
            <div class="shrink-0">
                @if($edu->institution_logo)
                    <img src="{{ Storage::url($edu->institution_logo) }}" class="w-12 h-12 rounded-lg object-contain bg-[#111] border border-white/5">
                @else
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center border border-dashed border-white/10 bg-gray-950 text-xl">🎓</div>
                @endif
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1">
                    <h3 class="text-sm font-bold text-white group-hover:text-sky-500 transition-colors truncate flex-1 min-w-0">{{ $edu->institution }}</h3>
                    <span class="shrink-0 whitespace-nowrap px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-sky-500/10 text-sky-500 border border-sky-500/20">{{ $edu->degree }}</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] text-gray-500 font-medium">
                    <span class="text-gray-300 font-bold uppercase tracking-tight text-[10px]">{{ $edu->field_of_study }}</span>
                    @if($edu->gpa)
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span class="font-bold tracking-tight">GPA: {{ $edu->gpa }}</span>
                    @endif
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="text-sky-500/80 font-bold tracking-tight">{{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="hidden sm:flex items-center gap-3 shrink-0 border-l border-white/5 pl-8 ml-4">
                <a href="{{ route('admin.educations.edit', $edu) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('admin.educations.destroy', $edu) }}" method="POST" onsubmit="return confirm('Delete education?')">
                    @csrf @method('DELETE')
                    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-500/5 border border-rose-500/10 text-[10px] font-black uppercase tracking-widest text-rose-500/60 hover:text-rose-500 hover:bg-rose-500/10 hover:border-rose-500/30 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-gray-600 text-[10px] font-black uppercase tracking-widest">No education records yet</div>
        @endforelse
    </div>
</div>
@endsection
