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
                    @if(Str::endsWith(strtolower($a->image), '.pdf'))
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg flex items-center justify-center shrink-0 border border-white/5 bg-[#111]" title="PDF Document">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                    @else
                        <img src="{{ Storage::url($a->image) }}" class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg object-cover shrink-0 shadow-lg border border-white/5">
                    @endif
                @else
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg flex items-center justify-center shrink-0 text-xl border border-dashed border-white/10" style="background:#0a0a0a">🏆</div>
                @endif
                
                <!-- Mobile Only Actions (Next to icon) -->
                <div class="flex-1 sm:hidden flex flex-col justify-center gap-2">
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
                <div class="mb-2">
                    <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-primary-dark transition-colors truncate">
                        {{ $a->title }}
                    </h3>
                </div>

                <p class="text-[11px] sm:text-xs text-gray-500 line-clamp-2 max-w-3xl leading-relaxed">
                    {{ $a->description }}
                </p>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden sm:flex items-center gap-2 shrink-0 self-center border-l border-white/5 pl-8 ml-4">
                <a href="{{ route('admin.achievements.edit', $a) }}" 
                   class="p-2.5 rounded-xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all"
                   title="Edit Achievement">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
                <form action="{{ route('admin.achievements.destroy', $a) }}" method="POST" onsubmit="return confirm('Delete achievement?')">
                    @csrf @method('DELETE')
                    <button class="p-2.5 rounded-xl bg-rose-500/5 border border-rose-500/10 text-rose-500/60 hover:text-rose-500 hover:bg-rose-500/10 hover:border-rose-500/30 transition-all"
                            title="Delete Achievement">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
