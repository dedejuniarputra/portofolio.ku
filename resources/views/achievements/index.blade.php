@extends('layouts.app')
@section('title', 'Achievements')
@section('content')
<div x-data="{ 
    showModal: false, 
    activeAchievement: null,
    openModal(achievement) {
        this.activeAchievement = achievement;
        this.showModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeModal() {
        this.showModal = false;
        document.body.style.overflow = 'auto';
    }
}" @keydown.escape.window="closeModal()">
    
    <div class="animate-fade-in-up stagger-1">
        <div class="section-title mb-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
            Achievements
        </div>
        <p class="text-[15px] font-medium mb-10 text-gray-400">My professional certifications and achievements.</p>
        
        <div class="mb-4">
            <div class="text-[14px] font-bold text-gray-400 mb-6">
                Total: {{ count($achievements) }}
            </div>
        </div>

        @if(count($achievements) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($achievements as $achievement)
                <div class="bg-[#141414] rounded-2xl border border-[#1f1f1f] overflow-hidden flex flex-col transition-all duration-300 hover:border-[#333] group animate-fade-in-up" 
                     style="animation-delay: {{ $loop->index * 0.1 }}s">
                    
                    <!-- Certificate Image Container -->
                    <div class="relative aspect-[4/3] overflow-hidden bg-black cursor-pointer" 
                         @click="openModal({{ json_encode([
                            'title' => $achievement->title,
                            'issuer' => $achievement->issuer,
                            'credential_id' => $achievement->credential_id,
                            'type' => $achievement->type,
                            'category' => $achievement->category,
                            'date' => $achievement->date ? $achievement->date->format('F Y') : '-',
                            'image' => $achievement->image ? Storage::url($achievement->image) : null,
                            'url' => $achievement->credential_url
                         ]) }})">
                        @if($achievement->image)
                            <img src="{{ Storage::url($achievement->image) }}" alt="{{ $achievement->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-[#1a1a1a]">
                                <svg class="w-12 h-12 text-[#262626] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-[10px] font-bold text-[#262626] uppercase tracking-widest">Sertifikat</span>
                            </div>
                        @endif
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/80 backdrop-blur-[2px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex items-center gap-1.5 text-white font-bold text-[11px] uppercase tracking-wider translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                View Details
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-5 md:p-6 flex-1 flex flex-col">
                        <div class="text-[#737373] text-[11px] tracking-widest font-bold mb-2 uppercase truncate">
                            {{ $achievement->credential_id ?? 'No Credential ID' }}
                        </div>
                        <h3 class="text-white font-bold text-base md:text-[17px] leading-tight mb-1 group-hover:text-[#00f2ff] transition-colors">
                            {{ $achievement->title }}
                        </h3>
                        <p class="text-[#a3a3a3] text-[13px] mb-5">{{ $achievement->issuer }}</p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mt-auto mb-6">
                            @if($achievement->type)
                                <span class="px-3 py-1 rounded-full border border-[#262626] bg-[#1a1a1a] text-[#a3a3a3] text-[11px] font-bold">
                                    {{ $achievement->type }}
                                </span>
                            @endif
                            @if($achievement->category)
                                <span class="px-3 py-1 rounded-full border border-[#262626] bg-[#1a1a1a] text-[#a3a3a3] text-[11px] font-bold">
                                    {{ $achievement->category }}
                                </span>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-5 border-t border-[#1f1f1f]">
                            <div class="text-[#525252] text-[11px] font-black uppercase tracking-wider">
                                ISSUED ON {{ $achievement->date ? $achievement->date->format('F Y') : '-' }}
                            </div>
                            <div class="flex items-center gap-3">
                                @if($achievement->credential_url)
                                    <a href="{{ $achievement->credential_url }}" target="_blank" class="text-[#525252] hover:text-[#00f2ff] transition-colors" title="View Original Credential">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-[#141414] rounded-3xl border border-[#1f1f1f]">
                <svg class="w-16 h-16 mx-auto mb-4 text-[#262626]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-[#525252] font-bold">No awards added yet.</p>
            </div>
        @endif
    </div>

    <!-- Detail Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" @click="closeModal()" 
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
            
            <!-- Modal Content -->
            <div class="relative bg-[#0a0a0a] border border-[#1f1f1f] rounded-3xl max-w-5xl w-full max-h-[90vh] overflow-hidden flex flex-col md:flex-row shadow-2xl"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Large Image Section -->
                <div class="flex-1 bg-black flex items-center justify-center overflow-auto p-4 lg:p-8">
                    <img :src="activeAchievement.image" :alt="activeAchievement.title" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                </div>

                <!-- Info Section -->
                <div class="w-full md:w-[320px] lg:w-[380px] p-8 lg:p-10 border-l border-[#1f1f1f] bg-[#0d0d0d] flex flex-col overflow-y-auto">
                    <button @click="closeModal()" class="absolute top-6 right-6 p-2 rounded-full hover:bg-white/10 text-gray-400 hover:text-white transition-all z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <h2 class="text-white font-black text-2xl lg:text-3xl leading-tight mb-4 pr-10" x-text="activeAchievement.title"></h2>
                    <p class="text-[#a3a3a3] text-lg mb-8" x-text="activeAchievement.issuer"></p>

                    <div class="space-y-6">
                        <div>
                            <div class="text-[#525252] text-[11px] font-black uppercase tracking-widest mb-1">CREDENTIAL ID</div>
                            <div class="text-[#d4d4d4] font-bold break-all" x-text="activeAchievement.credential_id"></div>
                        </div>
                        <div>
                            <div class="text-[#525252] text-[11px] font-black uppercase tracking-widest mb-1">TYPE</div>
                            <div class="text-[#d4d4d4] font-bold" x-text="activeAchievement.type"></div>
                        </div>
                        <div>
                            <div class="text-[#525252] text-[11px] font-black uppercase tracking-widest mb-1">CATEGORY</div>
                            <div class="text-[#d4d4d4] font-bold" x-text="activeAchievement.category"></div>
                        </div>
                        <div>
                            <div class="text-[#525252] text-[11px] font-black uppercase tracking-widest mb-1">ISSUE DATE</div>
                            <div class="text-[#d4d4d4] font-bold" x-text="activeAchievement.date"></div>
                        </div>
                    </div>

                    <div class="mt-auto pt-10">
                        <template x-if="activeAchievement.url">
                            <a :href="activeAchievement.url" target="_blank" 
                               class="flex items-center justify-center gap-2 w-full py-2 rounded-xl bg-white/5 border border-white/10 text-white font-bold transition-all hover:bg-white/10 hover:scale-[1.02] active:scale-95">
                                View Original
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection
