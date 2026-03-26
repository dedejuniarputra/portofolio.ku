@extends('layouts.admin')
@section('title', 'Message')
@section('page-title', 'View Message')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 text-sm mb-4 transition-colors" style="color:#737373" onmouseover="this.style.color='#a78bfa'" onmouseout="this.style.color='#737373'">
        ← Back to Messages
    </a>

    <div class="card p-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg" style="background:#1a0a2e;color:#a78bfa">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-semibold text-white">{{ $contact->name }}</h2>
                <a href="mailto:{{ $contact->email }}" class="text-sm" style="color:#a78bfa">{{ $contact->email }}</a>
            </div>
            <span class="ml-auto text-xs" style="color:#525252">{{ $contact->created_at->format('d M Y, H:i') }}</span>
        </div>

        @if($contact->subject)
            <div class="mb-4 pb-4 border-b" style="border-color:#1f1f1f">
                <p class="text-xs mb-1" style="color:#737373">Subject</p>
                <p class="text-sm font-medium text-white">{{ $contact->subject }}</p>
            </div>
        @endif

        <div>
            <p class="text-xs mb-2" style="color:#737373">Message</p>
            <p class="text-sm leading-relaxed" style="color:#d4d4d4">{{ $contact->message }}</p>
        </div>

        <div class="mt-6 pt-5 border-t flex gap-3" style="border-color:#1f1f1f">
            <a href="mailto:{{ $contact->email }}" class="btn-primary flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Reply via Email
            </a>
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button class="btn-danger py-2 px-3">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
