@extends('layouts.app')
@section('title', 'Achievements')
@section('content')
<div class="animate-fade-in-up stagger-1">
    <div class="section-title mb-2">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
        Achievements
    </div>
    <p class="text-[15px] font-medium mb-8 text-gray-400">My professional certifications and achievements.</p>
    
    @if(count($achievements) > 0)
        <div x-data="{ 
                showAll: false, 
                limit: window.innerWidth < 768 ? 4 : 6 
             }" 
             x-init="window.addEventListener('resize', () => { limit = window.innerWidth < 768 ? 4 : 6 })"
             class="pb-20">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-full px-4 md:px-0">
                @foreach($achievements as $achievement)
                <div x-data="{ active: false }"
                     @mouseenter="active = true" 
                     @mouseleave="active = false"
                     @click="active = !active"
                     @click.away="active = false"
                    class="group relative aspect-3/2 rounded-2xl overflow-hidden bg-[#0d0d0d] border transition-all duration-700 hover:scale-[1.02] animate-fade-in-up hover:shadow-2xl hover:shadow-primary-dark/10 shadow-[0_0_50px_rgba(0,0,0,0.7)]" 
                    :class="active ? 'border-primary-dark/40 shadow-[0_0_30px_rgba(13,226,130,0.1)]' : 'border-white/5'"
                     x-show="showAll || {{ $loop->index }} < limit"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     style="animation-delay: {{ $loop->index * 0.1 }}s; {{ $loop->index >= 6 ? 'display: none;' : '' }}">
                    
                    <!-- Background Media Layer -->
                    <div class="absolute inset-0 overflow-hidden">
                        @if($achievement->image)
                            @if(Str::endsWith(strtolower($achievement->image), '.pdf'))
                                <div class="w-full h-full flex flex-col items-center justify-center bg-surface">
                                    <div class="w-24 md:w-32 h-24 md:h-32 rounded-none bg-rose-500/3 flex items-center justify-center border border-rose-500/10 text-rose-500/20 mb-4 transition-all duration-1000"
                                         :class="{ 'scale-110 text-rose-500 bg-rose-500/10': active }">
                                        <svg class="w-12 md:w-16 h-12 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.75" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    </div>
                                    <span class="text-[10px] md:text-sm font-black text-gray-800 uppercase tracking-widest transition-all duration-1000"
                                          :class="{ 'text-gray-600': active }">Official Record</span>
                                </div>
                            @else
                                <!-- Dual-Layer Dynamic Fit (Handles any orientation without cropping) -->
                                <div class="relative w-full h-full bg-[#050505]">
                                    <!-- Blurred Background Layer (Optional, for atmospheric fill) -->
                                    <img src="{{ Storage::url($achievement->image) }}" alt="" 
                                         class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-20 scale-110 pointer-events-none"
                                         loading="lazy" decoding="async" width="600" height="400">
                                    
                                    <!-- Main Foreground Layer (Full Visibility) -->
                                    <img src="{{ Storage::url($achievement->image) }}" alt="{{ $achievement->title }}" 
                                         class="relative w-full h-full object-contain transition-all duration-[2s]"
                                         :class="{ 'scale-105': active }"
                                         style="image-orientation: from-image;"
                                         loading="lazy" decoding="async" width="600" height="400">
                                </div>
                            @endif
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-surface">
                                <div class="w-24 md:w-32 h-24 md:h-32 rounded-none bg-primary-dark/3 flex items-center justify-center border border-primary-dark/10 text-primary-dark/20 mb-4 transition-all duration-1000"
                                     :class="{ 'scale-110 text-primary-dark bg-primary-dark/10': active }">
                                    <svg class="w-12 md:w-16 h-12 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <span class="text-[10px] md:text-sm font-black text-gray-800 uppercase tracking-widest">Recognition</span>
                            </div>
                        @endif
                    </div>

                    <!-- Hover Masking & Minimalist Bottom Label (Non-Intrusive) -->
                    <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent transition-all duration-500 flex flex-col justify-end p-6 md:p-8 text-left z-10"
                         :class="active ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                        <div class="transform transition-all duration-700 ease-out text-white max-w-full"
                             :class="active ? 'translate-y-0' : 'translate-y-4'">
                            <!-- Title (Minimalist Scale) -->
                            <h3 class="text-base md:text-xl font-semibold tracking-wide mb-2 leading-tight drop-shadow-xl">
                                {{ $achievement->title }}
                            </h3>
                            
                            <!-- Thin Accent Line -->
                            <div class="w-8 md:w-12 h-px bg-primary-dark mb-2 shadow-[0_0_5px_rgba(34,197,94,0.3)]"></div>

                            <!-- Subtitle (Elegant, Small Label) -->
                            @if($achievement->description)
                                <p class="text-primary-dark/90 font-black uppercase tracking-[0.4em] text-[8px] md:text-[10px] transition-all duration-700">
                                    {{ $achievement->description }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Edge Glow -->
                    <div class="absolute inset-0 border-4 transition-all duration-1000 rounded-none pointer-events-none"
                         :class="active ? 'border-primary-dark/10' : 'border-primary-dark/0'"></div>
                </div>
                @endforeach
            </div>

            <template x-if="{{ count($achievements) }} > limit">
                <div class="mt-12 flex justify-center">
                    <button x-on:click="showAll = !showAll" aria-label="Toggle achievements visibility"
                            class="relative px-6 py-2 rounded-full border border-white/5 bg-[#1a1a1a] text-gray-400 text-xs font-bold hover:bg-[#222] hover:text-white hover:border-primary-dark/50 transition-all duration-300 flex items-center gap-2 hover:shadow-[0_0_20px_rgba(13,226,130,0.2)] group">
                        <span x-text="showAll ? 'Show Less' : 'Load More'" class="relative z-10"></span>
                        <svg class="relative z-10 w-3.5 h-3.5 transition-transform duration-500" 
                             :class="showAll ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <!-- Inner Glow (Green) -->
                        <div class="absolute inset-0 rounded-full bg-primary-dark/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    </button>
                </div>
            </template>
        </div>
    @else
        <div class="text-center py-60 bg-[#0d0d0d] rounded-2xl border border-white/5 mx-auto max-w-6xl">
            <svg class="w-32 h-32 mx-auto mb-12 text-white/5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/></svg>
            <p class="text-gray-900 font-black text-xl uppercase tracking-[1.5em]">Stillness</p>
        </div>
    @endif
</div>
@endsection
