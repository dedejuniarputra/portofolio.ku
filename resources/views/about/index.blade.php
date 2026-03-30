@extends('layouts.app')
@section('title', 'About')

@push('meta')
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="animate-fade-in-up stagger-1">

    <div class="space-y-10">
        <!-- Biography -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <h2 class="text-lg font-bold text-white leading-none">Biography</h2>
            </div>
            <div class="card p-6">
                <div class="text-sm leading-relaxed space-y-4 font-medium text-justify" style="color:#a3a3a3">
                    @if($profile && $profile->long_bio)
                        <p>{{ $profile->long_bio }}</p>
                    @else
                        <p class="text-neutral-500 italic">Biography hasn't been added yet.</p>
                    @endif
                </div>

                {{-- Signature --}}
                <div class="mt-5">
                    <p class="text-sm font-medium" style="color:#a3a3a3">Best regards,</p>
                    <img src="{{ asset('signature.png') }}" alt="Tanda tangan Dede" class="h-20 mt-1 object-contain">
                </div>
            </div>
        </div>

        <!-- Career -->
        <div>
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                <h2 class="text-lg font-bold text-white leading-none">Career</h2>
            </div>
            <p class="text-sm mb-6 font-medium" style="color:#737373">My professional journey.</p>
            
            <div class="card overflow-hidden">
                <div class="divide-y" style="divide-color:#141414">
                    @forelse($experiences as $exp)
                        <div class="p-5 hover:bg-white/2 transition-colors group" x-data="{ open: false }">
                            <div class="flex items-start gap-4 sm:gap-6">
                                <div class="shrink-0">
                                    @if($exp->company_logo)
                                        <img src="{{ Storage::url($exp->company_logo) }}" alt="{{ $exp->company }}" class="w-12 h-12 rounded-lg object-contain bg-[#111] border border-white/5 shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center border border-dashed border-white/10 bg-gray-950 text-xl">💼</div>
                                    @endif
                                </div>
                                <div class="grow min-w-0">
                                    <div class="flex items-center gap-2 sm:gap-3 mb-1">
                                        <h3 class="text-base font-bold text-white group-hover:text-primary-dark transition-colors truncate flex-1 min-w-0">{{ $exp->title }}</h3>
                                        <span class="shrink-0 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-primary-dark/10 text-primary-dark border border-primary-dark/20 whitespace-nowrap">{{ $exp->type }}</span>
                                    </div>
                                    <div class="text-[11px] font-medium space-y-1.5 mt-1 text-gray-400">
                                        <p class="flex flex-wrap items-center gap-2">
                                            <span class="text-gray-300 font-bold uppercase tracking-tight text-[10px]">{{ $exp->company }}</span>
                                            <span class="w-1 h-1 rounded-full bg-white/10 hidden sm:block"></span>
                                            <span class="hidden sm:inline-flex items-center gap-1 text-gray-300 font-bold uppercase tracking-wider text-[10px]">
                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                {{ $exp->location }} 
                                            </span>
                                        </p>
                                        <p class="flex flex-wrap items-center gap-2">
                                            <span class="text-primary-dark/80 font-bold tracking-tight text-[11px]">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</span>
                                            @if($exp->duration) 
                                                <span class="w-1 h-1 rounded-full bg-white/10"></span>
                                                <span class="text-gray-300 font-bold text-[10px] uppercase tracking-wider">{{ $exp->duration }}</span> 
                                            @endif
                                            <span class="w-1 h-1 rounded-full bg-white/10"></span>
                                            <span class="text-gray-300 font-bold text-[10px] uppercase tracking-wider">{{ $exp->mode }}</span>
                                            <span class="sm:hidden w-1 h-1 rounded-full bg-white/10"></span>
                                            <span class="sm:hidden inline-flex items-center gap-1 text-gray-300 font-bold uppercase tracking-wider text-[10px]">{{ $exp->location }}</span>
                                        </p>
                                    </div>

                                    @if($exp->responsibilities || $exp->learnings || $exp->impact)
                                        <button @click="open = !open" class="mt-4 text-[11px] font-bold flex items-center gap-1.5 text-gray-500 group-hover:text-gray-300 transition-colors">
                                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            <span x-text="open ? 'Hide details' : 'Show details'"></span>
                                        </button>

                                        <div x-show="open" x-collapse x-cloak class="mt-5 pt-5 border-t border-white/5 space-y-6">
                                            @if($exp->responsibilities)
                                                <div>
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                                        <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">Responsibilities</h4>
                                                    </div>
                                                    <ul class="space-y-2.5">
                                                        @foreach($exp->responsibilities as $res)
                                                            <li class="flex items-start gap-2.5 text-xs text-gray-400 font-medium">
                                                                <span class="text-primary-dark mt-0.5">✓</span>
                                                                <span class="leading-relaxed">{{ $res }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                @if($exp->learnings)
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-3">
                                                            <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">What I Learned</h4>
                                                        </div>
                                                        <ul class="space-y-2">
                                                            @foreach($exp->learnings as $item)
                                                                <li class="flex items-start gap-2.5 text-xs text-gray-400 font-medium">
                                                                    <span class="text-primary-dark mt-0.5">✓</span>
                                                                    <span class="leading-relaxed">{{ $item }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                @if($exp->impact)
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-3">
                                                            <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">Impact</h4>
                                                        </div>
                                                        <ul class="space-y-2">
                                                            @foreach($exp->impact as $item)
                                                                <li class="flex items-start gap-2.5 text-xs text-gray-400 font-medium">
                                                                    <span class="text-primary-dark mt-0.5">✓</span>
                                                                    <span class="leading-relaxed">{{ $item }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-gray-600 text-[10px] font-black uppercase tracking-widest">No professional experience listed.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Education -->
        <div>
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                <h2 class="text-lg font-bold text-white leading-none">Education</h2>
            </div>
            <p class="text-sm mb-6 font-medium" style="color:#737373">My educational journey.</p>
            
            <div class="card overflow-hidden">
                <div class="divide-y" style="divide-color:#141414">
                    @forelse($educations as $edu)
                        <div class="p-5 hover:bg-white/2 transition-colors group">
                            <div class="flex items-start gap-4 sm:gap-6">
                                <div class="shrink-0">
                                    @if($edu->institution_logo)
                                        <img src="{{ Storage::url($edu->institution_logo) }}" alt="{{ $edu->institution }}" class="w-12 h-12 rounded-lg object-contain bg-[#111] border border-white/5 shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center border border-dashed border-white/10 bg-gray-950 text-xl">🎓</div>
                                    @endif
                                </div>
                                <div class="grow min-w-0">
                                    <div class="flex items-center gap-2 sm:gap-3 mb-1">
                                        <h3 class="text-base font-bold text-white group-hover:text-sky-500 transition-colors truncate flex-1 min-w-0">{{ $edu->institution }}</h3>
                                        <span class="shrink-0 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-sky-500/10 text-sky-500 border border-sky-500/20 whitespace-nowrap">{{ $edu->degree }}</span>
                                    </div>
                                    <div class="text-[11px] font-medium space-y-1.5 mt-1 text-gray-400">
                                        <p class="flex flex-wrap items-center gap-2">
                                            <span class="text-gray-300 font-bold uppercase tracking-tight text-[10px]">{{ $edu->field_of_study }}</span>
                                            @if($edu->gpa)
                                                <span class="w-1 h-1 rounded-full bg-white/10"></span>
                                                <span class="text-gray-300 font-bold uppercase tracking-wider text-[10px]">GPA: {{ $edu->gpa }}</span>
                                            @endif
                                            <span class="w-1 h-1 rounded-full bg-white/10 hidden sm:block"></span>
                                            <span class="hidden sm:inline-flex items-center gap-1 text-gray-300 font-bold uppercase tracking-wider text-[10px]">
                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                {{ $edu->location }}
                                            </span>
                                        </p>
                                        <p class="flex flex-wrap items-center gap-2">
                                            <span class="text-sky-500/80 font-bold tracking-tight text-[11px]">{{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}</span>
                                            <span class="sm:hidden w-1 h-1 rounded-full bg-white/10"></span>
                                            <span class="sm:hidden inline-flex items-center gap-1 text-gray-300 font-bold uppercase tracking-wider text-[10px]">{{ $edu->location }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-gray-600 text-[10px] font-black uppercase tracking-widest">No educational background yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
@endsection
