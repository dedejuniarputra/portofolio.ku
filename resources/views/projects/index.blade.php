@extends('layouts.app')
@section('title', 'Projects')
@section('meta_description', 'Explore a showcase of personal and open-source projects by Dede Juniar Putra, ranging from web applications to specialized local tools.')
@section('content')
<div x-data="{ 
    type: '{{ request('type', 'All') }}',
    showAll: false,
    limit: 4,
    filter(t) {
        window.location.href = `{{ route('projects') }}?type=${t}`;
    }
}" class="animate-fade-in-up stagger-1">
    
    <div class="section-title mb-2">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
        FEATURED PROJECTS
    </div>
    <p class="text-[15px] font-medium mb-10 text-gray-400">Showcase of my personal and open-source projects.</p>

    <!-- Project Filters (Simple Tags) -->
    <div class="flex flex-wrap items-center gap-3 mb-12">
        @foreach(['All', 'Mobile', 'Web', 'UI/UX'] as $t)
            <button @click="filter('{{ $t }}')" 
                :class="type === '{{ $t }}' ? 'bg-primary-dark/10 text-primary-dark border-primary-dark/40 shadow-[0_0_15px_rgba(13,226,130,0.1)]' : 'bg-[#121212] text-gray-500 border-white/5 hover:border-white/10 shadow-lg'"
                class="px-5 py-2 rounded-full text-[12px] font-bold border transition-all duration-300 active:scale-95 group">
                {{ $t }}
            </button>
        @endforeach
    </div>

    @if(count($projects) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">
            @foreach($projects as $project)
            <div x-show="showAll || {{ $loop->index }} < limit" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 style="{{ $loop->index >= 4 ? 'display: none;' : '' }}"
                 class="group relative bg-[#0d0d0d] border border-white/5 hover:border-primary-dark/30 rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 shadow-2xl flex flex-col h-full animate-fade-in-up stagger-1">
                
                <!-- Project Image & Overlay -->
                <div class="relative aspect-video overflow-hidden border-b border-white/5">
                    @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-900 flex items-center justify-center text-gray-800">
                            <svg class="w-12 h-12 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    <!-- Hover Effect: View Project (Style Match: Gambar 2 - Reduced Size) -->
                    <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center backdrop-blur-sm shadow-inner">
                        <a href="{{ route('projects.show', $project) }}" class="flex items-center gap-2.5 text-white font-medium text-xl tracking-tight transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 hover:scale-105 active:scale-95">
                            <span class="opacity-90">View Project</span>
                            <svg class="w-6 h-6 opacity-80 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Project Content -->
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex-1">
                        <h3 class="text-xl font-black text-primary-dark mb-2 uppercase tracking-wide transition-colors duration-500">{{ $project->title }}</h3>
                        <p class="text-[13px] text-gray-400 leading-relaxed line-clamp-2 mb-4 font-medium">{{ $project->description }}</p>
                    </div>

                    <!-- Tech Stack Icons (Enhancement Merged) -->
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5">
                        <div class="flex items-center gap-4 flex-wrap">
                            @if($project->tech_stack)
                                @foreach($project->tech_stack as $tech)
                                    <div class="group/icon">
                                        <i class="{{ $tech }} colored text-lg transition-transform duration-300 group-hover/icon:scale-110" title="{{ ucfirst(explode('-', $tech)[1] ?? $tech) }}"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Reactions (Enhancement Kept) -->
                        <div x-data="{ 
                            count: {{ $project->reactions['star'] ?? 0 }},
                            loading: false,
                            toggle() {
                                if(this.loading) return;
                                this.loading = true;
                                fetch('{{ route('projects.react', $project) }}', {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ type: 'star' })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if(data.success) this.count = data.count;
                                    this.loading = false;
                                })
                                .catch(() => this.loading = false);
                            }
                        }" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/5 hover:border-yellow-500/30 transition-all cursor-pointer select-none group/heart" @click.stop="toggle()">
                            <span class="text-[11px] font-black text-gray-500 group-hover/heart:text-white transition-colors" x-text="count"></span>
                            <svg class="w-4 h-4 text-yellow-500 drop-shadow-[0_0_8px_rgba(250,204,21,0.5)] transition-transform group-active:scale-125" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($projects) > 4)
            <div class="mt-12 flex justify-center">
                <button @click="showAll = !showAll" 
                        class="relative px-6 py-2 rounded-full border border-white/5 bg-[#0d0d0d] text-gray-400 text-xs font-bold hover:bg-[#121212] hover:text-white hover:border-primary-dark/50 transition-all duration-300 flex items-center gap-2 hover:shadow-[0_0_20px_rgba(13,226,130,0.2)] active:scale-95 group">
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
        @endif
    @else
        <div class="text-center py-20 bg-[#0d0d0d] rounded-xl border border-dashed border-border text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-800 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <p class="font-medium">No projects found for this filter.</p>
        </div>
    @endif
</div>
@endsection
