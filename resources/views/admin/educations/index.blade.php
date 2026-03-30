@extends('layouts.admin')
@section('title', 'Education')
@section('page-title', 'Manage Education')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500">
        Total: {{ count($educations) }} Records
    </div>
    <a href="{{ route('admin.educations.create') }}" class="btn-primary flex items-center gap-2 w-full sm:w-auto justify-center py-2.5 text-xs">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Education
    </a>
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
                    <h3 class="text-sm font-bold text-white group-hover:text-primary-dark transition-colors truncate">{{ $edu->institution }}</h3>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-sky-500/10 text-sky-500 border border-sky-500/20">{{ $edu->degree }}</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] text-gray-500 font-medium">
                    <span class="text-gray-300">{{ $edu->field_of_study }}</span>
                    @if($edu->gpa)
                        <span class="w-1 h-1 rounded-full bg-white/10"></span>
                        <span>GPA: {{ $edu->gpa }}</span>
                    @endif
                    <span class="w-1 h-1 rounded-full bg-white/10"></span>
                    <span class="text-primary-dark/80">{{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}</span>
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
        <div class="p-20 text-center">
            <div class="w-16 h-16 rounded-2xl bg-white/2 border border-dashed border-gray-800 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <p class="text-gray-500 font-medium">No education records found.</p>
            <a href="{{ route('admin.educations.create') }}" class="mt-4 inline-flex items-center gap-2 text-primary text-sm font-bold hover:underline">
                Add your first education →
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
