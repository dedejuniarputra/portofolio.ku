@extends('layouts.app')
@section('title', 'Uses')
@section('content')
<div class="animate-fade-in-up stagger-1">
    <div class="section-title mb-2">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        Uses
    </div>
    <p class="text-sm mb-8" style="color:#737373">Tools and technologies I use daily.</p>

    <div class="space-y-8">
        @forelse($toolCategories as $category)
        <div class="animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <h2 class="text-sm font-semibold text-white mb-4 flex items-center gap-2">
                <span>{{ $category->icon }}</span>
                {{ $category->name }}
            </h2>
            <div class="space-y-3">
                @foreach($category->tools as $tool)
                <div class="card p-4 flex items-center gap-4">
                    @if($tool->icon && filter_var($tool->icon, FILTER_VALIDATE_URL) || (str_contains($tool->icon ?? '', '/')))
                        <img src="{{ Storage::url($tool->icon) }}" alt="{{ $tool->name }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                    @else
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 text-xl" style="background:#1a1a1a;border:1px solid #2a2a2a">
                            🔧
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h3 class="font-medium text-sm text-white">{{ $tool->name }}</h3>
                            @if($tool->url)
                                <a href="{{ $tool->url }}" target="_blank" class="text-gray-600 hover:text-[#00f2ff] transition-colors flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @endif
                        </div>
                        @if($tool->description)
                            <p class="text-xs leading-relaxed mt-0.5" style="color:#737373">{{ $tool->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="text-center py-16" style="color:#525252">
            <p class="text-sm">No tools added yet.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
