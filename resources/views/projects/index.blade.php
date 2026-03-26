@extends('layouts.app')
@section('title', 'Projects')
@section('content')
<div x-data="{ 
    type: '{{ request('type', 'All') }}',
    category: '{{ request('category', 'All') }}',
    filter(t, c) {
        window.location.href = `{{ route('projects') }}?type=${t}&category=${c}`;
    }
}" class="animate-fade-in-up stagger-1">
    
    <div class="section-title mb-2">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
        Projects
    </div>
    <p class="text-[15px] font-medium mb-10 text-gray-400">Showcase of my personal and open-source projects.</p>

    <!-- Filters -->
    <div class="space-y-6 md:space-y-4 mb-10 pb-6 border-b border-dashed border-gray-800">
        <!-- Type Filter -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest min-w-[60px]">Type</span>
            <div class="flex flex-wrap gap-2">
                @foreach(['All', 'Web', 'Mobile'] as $t)
                    <button @click="filter('{{ $t }}', category)" 
                        :class="type === '{{ $t }}' ? 'bg-[#facc15] text-black border-[#facc15]' : 'bg-[#1a1a1a] text-gray-400 border-[#262626] hover:border-gray-600'"
                        class="px-4 py-1 rounded-full text-[12px] font-bold border transition-all duration-300">
                        {{ $t }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest min-w-[60px]">Category</span>
            <div class="flex flex-wrap gap-2">
                @foreach(['All', 'Personal Projects', 'Internship', 'Freelance', 'Competition'] as $c)
                    <button @click="filter(type, '{{ $c }}')" 
                        :class="category === '{{ $c }}' ? 'bg-[#facc15] text-black border-[#facc15]' : 'bg-[#1a1a1a] text-gray-400 border-[#262626] hover:border-gray-600'"
                        class="px-4 py-1 rounded-full text-[12px] font-bold border transition-all duration-300">
                        {{ $c }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    @if(count($projects) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">
            @foreach($projects as $project)
            <div class="group h-full bg-[#0d0d0d] rounded-2xl border border-[#262626] hover:border-primary/50 transition-all duration-500 overflow-hidden flex flex-col">
                <!-- Project Image & Hover Overlay -->
                <div class="relative aspect-video overflow-hidden">
                    @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    @if($project->is_featured)
                        <div class="absolute top-3 right-3 bg-[#facc15] text-black px-2 py-1 rounded shadow-lg text-[10px] font-black uppercase tracking-tighter flex items-center gap-1 z-10 transition-transform duration-500 group-hover:translate-x-1">
                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M11 1.07l1.246 3.514A1 1 0 0013.195 5.3l3.649.034a1 1 0 01.558 1.718l-2.91 2.213a1 1 0 00-.35 1.077l1.08 3.507a1 1 0 01-1.523 1.109l-3.033-2.148a1 1 0 00-1.134 0l-3.033 2.148a1 1 0 01-1.523-1.109l1.08-3.507a1 1 0 00-.35-1.077L2.6 7.052a1 1 0 01.558-1.718l3.649-.034a1 1 0 00.949-.716L9 1.07a1 1 0 011.898 0z"/></svg>
                            Featured
                        </div>
                    @endif

                    <!-- Hover Overlay -->
                    <a href="{{ route('projects.show', $project) }}" class="absolute inset-0 bg-black/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px]">
                        <span class="flex items-center gap-2 text-white font-bold text-[15px] translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            View Project
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Project Body -->
                <div class="p-5 md:p-6 flex flex-col flex-grow">
                    <a href="{{ route('projects.show', $project) }}" class="inline-block group/title">
                        <h3 class="text-base md:text-lg font-bold text-gray-100 group-hover/title:text-primary transition-colors mb-2 line-clamp-2 min-h-12">{{ $project->title }}</h3>
                    </a>
                    <p class="text-[14px] text-gray-500 leading-relaxed line-clamp-2 mb-6">{{ $project->description }}</p>
                    
                    <!-- Tech Stack & Reactions -->
                    <div class="mt-auto flex items-center justify-between gap-4 pt-4 border-t border-white/5">
                        <div class="flex items-center gap-2 flex-wrap min-w-0">
                            @if($project->tech_stack)
                                @foreach($project->tech_stack as $tech)
                                    <div class="w-5 h-5 flex items-center justify-center grayscale group-hover:grayscale-0 transition-all duration-500" title="{{ $tech }}">
                                        @include('components.tech-icon', ['name' => $tech])
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Simple Like Counter -->
                        <div x-data="{ 
                                count: {{ $project->reactions['heart'] ?? 0 }},
                                loading: false,
                                react() {
                                    if(this.loading) return;
                                    this.loading = true;
                                    fetch('{{ route('projects.react', $project) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ type: 'heart' })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if(data.success) this.count = data.count;
                                        this.loading = false;
                                    })
                                    .catch(() => this.loading = false);
                                }
                            }" 
                            @click="react()"
                            class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#1a1a1a] border border-[#262626] text-[11px] sm:text-[12px] font-bold text-gray-400 group/like cursor-pointer hover:border-rose-500/30 hover:bg-rose-500/5 transition-all shrink-0 active:scale-95"
                            :class="loading ? 'opacity-50 pointer-events-none' : ''">
                            <span class="text-rose-500 group-hover/like:scale-125 transition-transform duration-300">❤️</span>
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-[#0d0d0d] rounded-2xl border border-dashed border-[#262626]">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-800 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <p class="text-gray-500 font-medium">No projects found for this filter.</p>
        </div>
    @endif
</div>
@endsection
