@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
    @php
    $statItems = [
        ['label' => 'Skills', 'value' => $stats['skills'], 'icon' => '💻', 'route' => 'admin.skills.index', 'color' => '#00f2ff'],
        ['label' => 'Achievements', 'value' => $stats['achievements'], 'icon' => '🏆', 'route' => 'admin.achievements.index', 'color' => '#facc15'],
        ['label' => 'Projects', 'value' => $stats['projects'], 'icon' => '📦', 'route' => 'admin.projects.index', 'color' => '#0de282'],
        ['label' => 'Messages', 'value' => $stats['contacts'], 'icon' => '✉️', 'route' => 'admin.contacts.index', 'color' => '#f472b6'],
        ['label' => 'Unread', 'value' => $stats['unread_contacts'], 'icon' => '🔔', 'route' => 'admin.contacts.index', 'color' => '#fbbf24'],
    ];
    @endphp

    @foreach($statItems as $item)
    <a href="{{ route($item['route']) }}" class="card p-6 border-white/5 hover:border-primary-dark/30 hover:shadow-[0_0_20px_rgba(13,226,130,0.1)] transition-all group relative overflow-hidden">
        <div class="text-2xl mb-3 opacity-80 group-hover:scale-110 group-hover:opacity-100 transition-all duration-300">{{ $item['icon'] }}</div>
        <div class="text-3xl font-black text-white mb-1">{{ $item['value'] }}</div>
        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 group-hover:text-primary-dark transition-colors">{{ $item['label'] }}</div>
        
        <!-- Subtle accent line -->
        <div class="absolute bottom-0 left-0 h-0.5 bg-primary-dark transition-all duration-300 w-0 group-hover:w-full opacity-50"></div>
    </a>
    @endforeach
</div>

<!-- Recent Messages -->
<div class="animate-fade-in" style="animation-delay: 0.1s">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-gray-500">Recent Messages</h2>
    </div>

    @if($recentContacts->count() > 0)
        <div class="grid gap-3">
            @foreach($recentContacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact) }}" class="card p-5 flex items-start gap-5 border-white/5 hover:border-primary-dark/30 hover:shadow-[0_0_20px_rgba(13,226,130,0.05)] transition-all group">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-black bg-primary-dark/10 text-primary-dark border border-primary-dark/20 group-hover:bg-primary-dark group-hover:text-black transition-all">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-bold text-white group-hover:text-primary-dark transition-colors flex items-center gap-2">
                            {{ $contact->name }}
                            @if(!$contact->is_read)
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-dark shadow-[0_0_8px_#0de282]"></span>
                            @endif
                        </p>
                        <span class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest">{{ $contact->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs mt-1 text-gray-400 line-clamp-1 opacity-80 group-hover:opacity-100 transition-opacity">{{ $contact->subject ?? $contact->message }}</p>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div class="card p-12 text-center border-white/5" style="background:rgba(255,255,255,0.02)">
            <svg class="w-10 h-10 mx-auto mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-xs font-bold uppercase tracking-widest text-gray-600">No messages yet.</p>
        </div>
    @endif
</div>
@endsection
