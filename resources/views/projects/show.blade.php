@extends('layouts.app')
@section('title', $project->title)
@section('meta_description', $project->description)

@push('meta')
    <meta property="og:image" content="{{ $project->image ? Storage::url($project->image) : asset('profile.jpg') }}">
    <meta property="twitter:image" content="{{ $project->image ? Storage::url($project->image) : asset('profile.jpg') }}">
@endpush

@section('content')
    <div class="animate-fade-in-up stagger-1 max-w-4xl mx-auto">
        <!-- 1. Simple Back Navigation (Directly Matching Screenshot) -->
        <a href="{{ route('projects') }}"
            class="inline-flex items-center gap-2.5 text-gray-400 hover:text-white transition-colors mb-12 group">
            <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">Back</span>
        </a>

        <h1 class="text-3xl md:text-[38px] font-black text-primary-dark mb-6 tracking-tight leading-[1.1]">{{ $project->title }}
        </h1>
        <p class="text-[15.5px] md:text-[16px] text-gray-400 leading-relaxed font-medium mb-10 text-justify">
            {{ $project->description }}
        </p>

        <!-- 3. Dashed Divider (Style Match: Structural Separator) -->
        <div class="border-b border-dashed border-white/10 mb-8 w-full opacity-80"></div>

        <!-- 4. Metadata Rows (Views & Tech Stack - Clean Alignment) -->
        <div class="space-y-6 mb-12">
            <!-- Top Row: Project Views -->
            <div class="flex items-center gap-2 text-gray-500">
                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="text-[13.5px] font-bold tracking-wide">{{ $project->views_count ?? 1 }} views</span>
            </div>
 
            <!-- Bottom Row: Tech Stack Only -->
            <div class="flex items-center gap-6">
                <span class="text-[12px] font-black uppercase tracking-[0.2em] text-gray-500 shrink-0">Tech Stack :</span>
                <div class="flex flex-wrap items-center gap-5 md:gap-6">
                    @if($project->tech_stack)
                        @foreach($project->tech_stack as $tech)
                            <i class="{{ $tech }} colored text-[20px] md:text-[24px] transition-transform duration-300 hover:scale-110" 
                               title="{{ explode('-', $tech)[1] ?? $tech }}"></i>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
 
        <!-- 5. Project Media (Interactive with Overlay CTA) -->
        <div class="mb-12 rounded-2xl overflow-hidden border border-white/10 bg-black aspect-video relative group shadow-2xl">
            @if($project->image)
                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" 
                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:brightness-110">
                
                <!-- Floating Demo Overlay (Top-Right & Smaller) -->
                <div class="absolute inset-0 bg-linear-to-b from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <a href="{{ $project->demo_url }}" target="_blank" 
                   class="absolute top-6 right-6 w-11 h-11 rounded-xl bg-black/60 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:text-primary-dark hover:border-primary-dark/40 hover:bg-black/80 transition-all duration-300 -translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 shadow-2xl group/btn"
                   title="Live Demo">
                    <svg class="w-4.5 h-4.5 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-900 border-2 border-dashed border-white/5 rounded-2xl">
                    <svg class="w-20 h-20 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>

        <!-- 6. Introduction (Style Match: Emoji Book) -->
        <section class="mt-12 mb-16 animate-fade-in-up">
            <h2 class="text-[17px] font-bold text-gray-100 mb-6 uppercase tracking-widest flex items-center gap-3">
                <span class="text-2xl pt-0.5">📘</span>
                Introduction
                <div class="flex-1 h-px bg-white/5"></div>
            </h2>
            <p class="text-[15.5px] md:text-[16px] text-gray-400 leading-relaxed font-medium text-justify">
                {{ $project->introduction }}
            </p>

            <!-- Subsection Divider (Style Match) -->
            
        </section>

        <!-- 7. Features (Style Match: Emoji Rocket) -->
        @if($project->features && count($project->features) > 0)
            <section class="mt-16 animate-fade-in-up stagger-2 pb-20">
                <h2 class="text-[17px] font-bold text-gray-100 mb-8 uppercase tracking-widest flex items-center gap-3">
                    <span class="text-2xl pt-0.5">🚀</span>
                    Features
                    <div class="flex-1 h-px bg-white/5"></div>
                </h2>
                <div class="space-y-6">
                    @foreach($project->features as $feature)
                        @php
                            $parts = explode(':', $feature, 2);
                        @endphp
                        <div class="flex items-start gap-4">
                            <!-- Neutral Bullet (Reference Match: Light Gray Circle) -->
                            <div class="mt-2.5 shrink-0 w-2 h-2 rounded-full bg-white/20 border border-white/5 shadow-inner"></div>
                            <div class="text-[15px] md:text-[16px] text-gray-400 leading-relaxed font-medium">
                                @if(count($parts) > 1)
                                    <span class="font-bold text-gray-100">{{ trim($parts[0]) }}:</span> {{ trim($parts[1]) }}
                                @else
                                    {{ $feature }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection