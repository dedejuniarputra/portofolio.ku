@extends('layouts.admin')
@section('title', 'Projects')
@section('page-title', 'Manage Projects')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500">
        Total: {{ count($projects) }} Projects
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary flex items-center gap-2 w-full sm:w-auto justify-center py-2.5 text-xs">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Project
    </a>
</div>

<div class="card overflow-hidden">
    <div class="divide-y" style="divide-color:#141414">
        @forelse($projects as $p)
        <div class="px-5 py-4 hover:bg-white/2 transition-colors group">
            <!-- Project Image & Mobile Actions -->
            <div class="flex items-start gap-4 sm:block">
                @if($p->image)
                    <img src="{{ Storage::url($p->image) }}" class="w-20 h-14 sm:w-24 sm:h-16 rounded-lg object-cover shrink-0 shadow-lg border border-white/5">
                @else
                    <div class="w-20 h-14 sm:w-24 sm:h-16 rounded-lg flex items-center justify-center shrink-0 text-lg border border-dashed border-white/10 bg-gray-950">📦</div>
                @endif
                
                <!-- Mobile Only Actions (Next to image) -->
                <div class="flex-1 sm:hidden flex flex-col justify-center gap-2">
                    <div class="flex items-center gap-2">
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-black uppercase tracking-wider bg-primary-dark/10 text-primary-dark border border-primary-dark/20">{{ $p->type }}</span>
                        <span class="status-badge status-{{ $p->status }} !text-[9px] px-2 py-0.5">{{ str_replace('-', ' ', $p->status) }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.projects.edit', $p) }}" class="flex-1 text-center py-1.5 rounded-lg bg-white/5 border border-white/10 text-[10px] font-bold text-gray-400 hover:text-white transition-all">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete project?')">
                            @csrf @method('DELETE')
                            <button class="w-full py-1.5 rounded-lg bg-rose-500/5 border border-rose-500/20 text-[10px] font-bold text-rose-500/80 hover:text-rose-500 transition-all">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Project Info -->
            <div class="flex-1 min-w-0 flex flex-col">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-3 mb-2">
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-primary-dark transition-colors truncate">{{ $p->title }}</h3>
                    
                    <!-- Desktop Only Badges -->
                    <div class="hidden sm:flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded-full text-[9px]! font-black uppercase tracking-wider bg-primary-dark/10 text-primary-dark border border-primary-dark/20">{{ $p->type }}</span>
                        <span class="px-2 py-0.5 rounded-full text-[9px]! font-black uppercase tracking-wider bg-sky-500/10 text-sky-500 border border-sky-500/20">{{ $p->category }}</span>
                        <span class="status-badge status-{{ $p->status }} text-[10px]">{{ str_replace('-', ' ', $p->status) }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-3">
                    @if($p->is_featured) 
                        <span class="px-2 py-0.5 rounded-full bg-[#fbbf24]/5 text-[#fbbf24] text-[9px] font-black uppercase tracking-widest border border-[#fbbf24]/20 flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-[#fbbf24] animate-pulse"></span>
                            Home Featured
                        </span> 
                    @endif
                    <p class="text-[11px] text-gray-500 line-clamp-1 flex-1">{{ $p->description }}</p>
                </div>

                @if($p->tech_stack)
                    <div class="flex flex-wrap gap-1.5 mt-auto">
                        @foreach(array_slice($p->tech_stack, 0, 5) as $tech)
                            <span class="text-[9px] px-2 py-0.5 rounded-md font-bold text-gray-400 border border-white/[0.05]" style="background:rgba(255,255,255,0.02)">{{ $tech }}</span>
                        @endforeach
                        @if(count($p->tech_stack) > 5)
                            <span class="text-[9px] px-1 py-0.5 text-gray-600 font-bold">+{{ count($p->tech_stack) - 5 }}</span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Desktop Actions -->
            <div class="hidden sm:flex flex-col items-center gap-2 shrink-0 self-center">
                <a href="{{ route('admin.projects.edit', $p) }}" 
                   class="w-20 text-center py-2 rounded-xl bg-[#111] border border-white/5 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:border-white/20 transition-all">
                    Edit
                </a>
                <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete project?')">
                    @csrf @method('DELETE')
                    <button class="w-20 py-2 rounded-xl bg-rose-500/5 border border-rose-500/10 text-[10px] font-black uppercase tracking-widest text-rose-500/60 hover:text-rose-500 hover:border-rose-500/30 transition-all">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-20 text-center">
            <div class="w-16 h-16 rounded-2xl bg-white/2 border border-dashed border-gray-800 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <p class="text-gray-500 font-medium">No projects found. Build something cool!</p>
            <a href="{{ route('admin.projects.create') }}" class="mt-4 inline-flex items-center gap-2 text-primary text-sm font-bold hover:underline">
                Create your first project →
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
