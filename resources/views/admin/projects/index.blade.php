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
        <div class="px-5 py-4 hover:bg-white/2 transition-colors group flex items-start sm:items-center gap-6">
            <!-- Project Image -->
            <div class="shrink-0">
                @if($p->image)
                    <img src="{{ Storage::url($p->image) }}" class="w-16 h-12 sm:w-20 sm:h-14 rounded-lg object-cover shadow-lg border border-white/5">
                @else
                    <div class="w-16 h-12 sm:w-20 sm:h-14 rounded-lg flex items-center justify-center border border-dashed border-white/10 bg-gray-950 text-base">📦</div>
                @endif
            </div>

            <!-- Project Info -->
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1 overflow-hidden">
                    <h3 class="text-sm font-bold text-white group-hover:text-primary-dark transition-colors truncate">{{ $p->title }}</h3>
                    
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-primary-dark/10 text-primary-dark border border-primary-dark/20">{{ $p->type }}</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider truncate">{{ $p->description }}</p>

                    @if($p->tech_stack)
                        <div class="flex items-center gap-2.5 mt-auto">
                            @foreach(array_slice($p->tech_stack, 0, 6) as $tech)
                                <i class="{{ $tech }} colored text-lg transition-transform duration-300 hover:scale-125" title="{{ explode('-', $tech)[1] ?? $tech }}"></i>
                            @endforeach
                            @if(count($p->tech_stack) > 6)
                                <span class="text-[9px] font-black text-gray-700 tracking-widest">+{{ count($p->tech_stack) - 6 }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3 shrink-0 border-l border-white/5 pl-8 ml-4">
                <a href="{{ route('admin.projects.edit', $p) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete project?')">
                    @csrf @method('DELETE')
                    <button class="flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-500/5 border border-rose-500/10 text-[10px] font-black uppercase tracking-widest text-rose-500/60 hover:text-rose-500 hover:bg-rose-500/10 hover:border-rose-500/30 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
