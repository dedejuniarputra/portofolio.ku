@extends('layouts.app')
@section('title', $project->title)
@section('meta_description', $project->description)

@push('meta')
    <meta property="og:image" content="{{ $project->image ? Storage::url($project->image) : asset('profile.jpg') }}">
    <meta property="twitter:image" content="{{ $project->image ? Storage::url($project->image) : asset('profile.jpg') }}">
@endpush

@section('content')
<div class="animate-fade-in-up stagger-1">
    <!-- Header Navigation -->
    <a href="{{ route('projects') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-white transition-colors mb-8 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span class="text-sm font-medium">Back</span>
    </a>

    <!-- Title & Description -->
    <h1 class="text-3xl font-black text-gray-100 mb-4">{{ $project->title }}</h1>
    <p class="text-lg text-gray-400 mb-8 leading-relaxed">{{ $project->description }}</p>

    <!-- Project Stats & Links -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 py-6 border-y border-dashed border-gray-800 mb-10">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span class="text-sm font-bold">{{ $project->views_count }} views</span>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-gray-500">Technologies:</span>
                <div class="flex items-center gap-3">
                    @if($project->tech_stack)
                        @foreach($project->tech_stack as $tech)
                            <i class="{{ $tech }} colored text-lg transition-transform duration-300 hover:scale-125" title="{{ explode('-', $tech)[1] ?? $tech }}"></i>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-2 px-4 py-2 border border-gray-800 rounded-lg text-sm font-bold text-gray-400 hover:text-white hover:border-gray-600 transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    <span class="text-yellow-500">Source Code</span>
                </a>
            @endif
            @if($project->demo_url)
                <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center gap-2 px-4 py-2 border border-gray-800 rounded-lg text-sm font-bold text-gray-400 hover:text-white hover:border-gray-600 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="text-yellow-500">Live Demo</span>
                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </a>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <div class="space-y-12">
        <!-- Main Image -->
        <div class="rounded-2xl overflow-hidden border border-gray-800 bg-gray-900 aspect-video">
            @if($project->image)
                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }} - Project Screenshot" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-800">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            @endif
        </div>

        <!-- Introduction -->
        <section>
            <div class="flex items-center gap-3 mb-6">
                <span class="p-1 rounded bg-blue-500/20 text-blue-400">📘</span>
                <h2 class="text-xl font-bold text-gray-100 uppercase tracking-wide">Introduction</h2>
            </div>
            <div class="prose prose-invert max-w-none text-gray-400 leading-relaxed text-[15px]">
                {!! nl2br(e($project->long_description ?? $project->description)) !!}
            </div>
        </section>

        <!-- Tech Stack -->
        @if($project->tech_stack)
        <section>
            <div class="flex items-center gap-3 mb-6">
                <span class="p-1 rounded bg-purple-500/20 text-purple-400">⚙️</span>
                <h2 class="text-xl font-bold text-gray-100 uppercase tracking-wide">Tech Stack</h2>
            </div>
            <div class="space-y-4">
                <p class="text-sm text-gray-500">This project is powered by:</p>
                <ul class="space-y-4">
                    @foreach($project->tech_stack as $tech)
                        <li class="flex items-center gap-4 group">
                            <i class="{{ $tech }} colored text-2xl transition-all duration-500 hover:scale-125"></i>
                            <span class="text-sm font-bold uppercase tracking-widest text-gray-400 group-hover:text-primary transition-colors">{{ explode('-', $tech)[1] ?? $tech }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        @endif
    </div>
</div>
@endsection
