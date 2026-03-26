@extends('layouts.app')
@section('title', 'About')
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
                    <p>{{ $profile->bio ?? '' }}</p>
                    @if($profile && $profile->long_bio)
                        <p>{{ $profile->long_bio }}</p>
                    @endif
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
            
            <div class="space-y-4">
                @foreach($experiences as $exp)
                    <div class="card p-6" x-data="{ open: false }">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl flex items-center justify-center border shrink-0 bg-[#1a1a1a]" style="border-color:#2a2a2a">
                                @if($exp->company_logo)
                                    <img src="{{ Storage::url($exp->company_logo) }}" alt="{{ $exp->company }}" class="w-10 h-10 object-contain">
                                @else
                                    <svg class="w-6 h-6 text-neutral-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7h-4V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zm-8-2h2v2h-2V5zm8 14H4V9h16v10z"/></svg>
                                @endif
                            </div>
                            <div class="grow min-w-0">
                                <h3 class="text-base font-bold text-white mb-1 truncate">{{ $exp->title }}</h3>
                                <div class="text-xs font-medium space-y-1" style="color:#737373">
                                    <p class="flex items-center gap-1">
                                        {{ $exp->company }} <span class="mx-1">•</span> {{ $exp->location }} <span class="text-[10px] bg-neutral-800 px-1 rounded">ID</span>
                                    </p>
                                    <p>
                                        {{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }} <span class="mx-1">•</span> {{ $exp->duration }} <span class="mx-1">•</span> {{ $exp->type }} <span class="mx-1">•</span> {{ $exp->mode }}
                                    </p>
                                </div>

                                @if($exp->responsibilities || $exp->learnings || $exp->impact)
                                    <button @click="open = !open" class="mt-4 text-xs font-bold flex items-center gap-1 transition-colors" style="color:#737373" onmouseover="this.style.color='#e5e5e5'" onmouseout="this.style.color='#737373'">
                                        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        <span x-text="open ? 'Hide details' : 'Show details'"></span>
                                    </button>

                                    <div x-show="open" x-collapse x-cloak class="mt-6 space-y-6 pt-6 border-t" style="border-color:#2a2a2a">
                                        @if($exp->responsibilities)
                                            <div>
                                                <div class="flex items-center gap-2 mb-3">
                                                    <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                                    <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">Responsibilities</h4>
                                                </div>
                                                <ul class="space-y-2">
                                                    @foreach($exp->responsibilities as $res)
                                                        <li class="flex items-start gap-2 text-xs font-medium" style="color:#a3a3a3">
                                                            <span class="text-green-500 mt-0.5">✓</span>
                                                            <span>{{ $res }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            @if($exp->learnings)
                                                <div>
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707.707M12 18v1m-7-14h14a2 2 0 012 2v11a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                                                        <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">What I Learned</h4>
                                                    </div>
                                                    <ul class="space-y-2">
                                                        @foreach($exp->learnings as $item)
                                                            <li class="flex items-start gap-2 text-xs font-medium" style="color:#a3a3a3">
                                                                <span class="text-green-500 mt-0.5">✓</span>
                                                                <span>{{ $item }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if($exp->impact)
                                                <div>
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                                        <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-primary-dark">Impact</h4>
                                                    </div>
                                                    <ul class="space-y-2">
                                                        @foreach($exp->impact as $item)
                                                            <li class="flex items-start gap-2 text-xs font-medium" style="color:#a3a3a3">
                                                                <span class="text-green-500 mt-0.5">✓</span>
                                                                <span>{{ $item }}</span>
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
                @endforeach
            </div>
        </div>

        <!-- Education -->
        <div>
            <div class="flex items-center gap-2 mb-1">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                <h2 class="text-lg font-bold text-white leading-none">Education</h2>
            </div>
            <p class="text-sm mb-6 font-medium" style="color:#737373">My educational journey.</p>
            
            <div class="space-y-4">
                @foreach($educations as $edu)
                    <div class="card p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl flex items-center justify-center border shrink-0 bg-[#1a1a1a]" style="border-color:#2a2a2a">
                                @if($edu->institution_logo)
                                    <img src="{{ Storage::url($edu->institution_logo) }}" alt="{{ $edu->institution }}" class="w-10 h-10 object-contain">
                                @else
                                    <svg class="w-6 h-6 text-neutral-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM3.89 9L12 4.57 20.11 9 12 13.43 3.89 9z"/><path d="M12 15.5l-7-3.82V15a2 2 0 002 2h10a2 2 0 002-2v-3.32l-7 3.82z"/></svg>
                                @endif
                            </div>
                            <div class="grow min-w-0">
                                <h3 class="text-base font-bold text-white mb-1 truncate">{{ $edu->institution }}</h3>
                                <div class="text-xs font-medium space-y-1" style="color:#737373">
                                    <p class="flex items-center gap-1">
                                        {{ $edu->degree }} <span class="mx-1">•</span> {{ $edu->field_of_study }} @if($edu->gpa) <span class="mx-1">•</span> GPA: {{ $edu->gpa }} @endif
                                    </p>
                                    <p>
                                        {{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }} <span class="mx-1">•</span> {{ $edu->location }} <span class="text-[10px] bg-neutral-800 px-1 rounded">ID</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
