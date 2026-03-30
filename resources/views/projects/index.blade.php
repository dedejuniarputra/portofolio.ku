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
                 class="group relative bg-[#0d0d0d] border border-white/5 hover:border-primary-dark/40 transition-all duration-700 overflow-hidden shadow-[0_0_50px_rgba(0,0,0,0.5)] hover:shadow-[0_0_80px_rgba(0,0,0,0.8)] rounded-xl">
                <!-- Project Image -->
                <div class="relative aspect-video overflow-hidden">
                    @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                             loading="lazy" decoding="async" width="600" height="337">
                    @else
                        <div class="w-full h-full bg-surface-2 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif

                    <!-- Redirect Icon (Green Glow Style) -->
                    @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" 
                           class="absolute top-3 right-3 z-40 w-8 h-8 flex items-center justify-center bg-primary-dark/5 backdrop-blur-xl rounded-full border border-primary-dark/20 text-primary-dark hover:bg-primary-dark hover:text-black hover:scale-110 transition-all duration-500 shadow-[0_0_10px_rgba(13,226,130,0.2)] hover:shadow-[0_0_20px_rgba(13,226,130,0.5)] group"
                           title="Visit Project">
                            <svg class="w-3.5 h-3.5 transition-transform duration-500 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    @endif
                </div>

                <!-- Project Body -->
                <div class="p-4 md:p-5">
                    <h3 class="text-[17px] font-black text-white leading-tight mb-0.5 uppercase tracking-widest group-hover:text-primary-dark transition-colors duration-700">{{ $project->title }}</h3>
                    <p class="text-[12.5px] text-gray-400 leading-relaxed line-clamp-2">{{ $project->description }}</p>
                    
                    <!-- Tech Stack Icons & Star Reaction Row -->
                    <div class="flex items-center justify-between mt-2.5 pt-2.5 border-t border-white/5" x-data="{ 
                            count: {{ $project->reactions['star'] ?? 0 }},
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
                                    body: JSON.stringify({ type: 'star' })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if(data.success) this.count = data.count;
                                    this.loading = false;
                                })
                                .catch(() => this.loading = false);
                            }
                        }">
                        <div class="flex items-center gap-4 flex-wrap">
                            @if($project->tech_stack)
                                @foreach($project->tech_stack as $tech)
                                    <i class="{{ $tech }} colored text-[22px] transition-all duration-500 hover:scale-125" title="{{ explode('-', $tech)[1] ?? $tech }}"></i>
                                @endforeach
                            @endif
                        </div>

                        <!-- Star Appreciation Button -->
                        <button @click="react()" 
                           class="relative shrink-0 hover:scale-110 transition-all duration-500 group/link flex items-center gap-2.5 px-4 py-2 bg-white/3 rounded-full border border-white/5 hover:border-[#facc15]/30"
                           :class="loading ? 'opacity-50 pointer-events-none' : ''">
                            <div class="absolute inset-0 bg-[#facc15]/20 blur-xl opacity-0 group-hover/link:opacity-100 transition-opacity duration-700"></div>
                            <span class="relative text-[11px] font-black text-gray-400 group-hover/link:text-white transition-colors" x-text="count"></span>
                            <svg class="relative w-4.5 h-4.5 text-[#facc15] drop-shadow-[0_0_15px_rgba(250,204,21,0.8)] transition-transform group-active:scale-125" 
                                 fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </button>
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
