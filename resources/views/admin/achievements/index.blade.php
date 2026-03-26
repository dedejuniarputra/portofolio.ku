@extends('layouts.admin')
@section('title', 'Achievements')
@section('page-title', 'Manage Achievements')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500">
        Total: {{ count($achievements) }} Achievements
    </div>
    <a href="{{ route('admin.achievements.create') }}" class="btn-primary flex items-center gap-2 w-full sm:w-auto justify-center py-2.5 text-xs">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Achievement
    </a>
</div>

<div class="card overflow-hidden">
    <div class="divide-y" style="divide-color:#141414">
        @forelse($achievements as $a)
        <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-stretch sm:items-start gap-4 sm:gap-6 hover:bg-white/2 transition-colors group">
            <!-- Icon/Image & Mobile Actions -->
            <div class="flex items-start gap-4 sm:block">
                @if($a->image)
                    <img src="{{ Storage::url($a->image) }}" class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg object-cover shrink-0 shadow-lg border border-white/5">
                @else
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg flex items-center justify-center shrink-0 text-xl border border-dashed border-white/10" style="background:#0a0a0a">🏆</div>
                @endif
                
                <!-- Mobile Only Actions (Next to icon) -->
                <div class="flex-1 sm:hidden flex flex-col justify-center gap-2">
                    <div class="flex items-center gap-2">
                        @if($a->type)
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-black uppercase tracking-wider" style="background:#111; color:#fbbf24; border:1px solid rgba(251,191,36,0.2)">{{ $a->type }}</span>
                        @endif
                        <span class="text-[9px] font-bold text-gray-500 truncate">{{ $a->issuer ?? '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.achievements.edit', $a) }}" class="flex-1 text-center py-1.5 rounded-lg bg-white/5 border border-white/10 text-[10px] font-bold text-gray-400 hover:text-white transition-all">Edit</a>
                        <form action="{{ route('admin.achievements.destroy', $a) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete achievement?')">
                            @csrf @method('DELETE')
                            <button class="w-full py-1.5 rounded-lg bg-rose-500/5 border border-rose-500/20 text-[10px] font-bold text-rose-500/80 hover:text-rose-500 transition-all">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1 min-w-0 flex flex-col justify-center">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-3 mb-2">
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-primary-dark transition-colors truncate">{{ $a->title }}</h3>
                    
                    <!-- Desktop Only Badges -->
                    <div class="hidden sm:flex items-center gap-2">
                        @if($a->type)
                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider" style="background:#111; color:#fbbf24; border:1px solid rgba(251,191,36,0.2)">{{ $a->type }}</span>
                        @endif
                        @if($a->category)
                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider" style="background:#111; color:#38bdf8; border:1px solid rgba(56,189,248,0.2)">{{ $a->category }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3 mb-2 text-[10px] sm:text-xs">
                    <span class="font-semibold text-gray-400 truncate">{{ $a->issuer ?? '-' }}</span>
                    @if($a->date)
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span class="text-gray-500">{{ $a->date ? $a->date->format('M Y') : '-' }}</span>
                    @endif
                    @if($a->credential_id)
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span class="font-mono text-[9px] text-gray-600">{{ $a->credential_id }}</span>
                    @endif
                </div>

                <p class="text-[11px] text-gray-500 line-clamp-1 max-w-2xl">{{ $a->description }}</p>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden sm:flex flex-col items-center gap-2 shrink-0 self-center">
                <a href="{{ route('admin.achievements.edit', $a) }}" 
                   class="w-20 text-center py-2 rounded-xl bg-[#111] border border-white/5 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white hover:border-white/20 transition-all">
                    Edit
                </a>
                <form action="{{ route('admin.achievements.destroy', $a) }}" method="POST" onsubmit="return confirm('Delete achievement?')">
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
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-gray-500 font-medium">No achievements found yet. Add your certificates!</p>
            <a href="{{ route('admin.achievements.create') }}" class="mt-4 inline-flex items-center gap-2 text-primary text-sm font-bold hover:underline">
                Add your first achievement →
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
