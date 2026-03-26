@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Contact Messages')

@section('content')
<div class="card overflow-hidden">
    <div class="divide-y" style="divide-color:#1f1f1f">
        @forelse($contacts as $contact)
        <div class="px-5 py-4 flex items-start gap-4 {{ !$contact->is_read ? 'bg-violet-950/10' : '' }}">
            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0" style="background:#1a0a2e;color:#a78bfa">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-0.5">
                    <p class="text-sm font-medium text-white">{{ $contact->name }}</p>
                    @if(!$contact->is_read)
                        <span class="w-2 h-2 rounded-full bg-violet-400 flex-shrink-0"></span>
                    @endif
                    <span class="text-xs ml-auto" style="color:#525252">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs mb-1" style="color:#a78bfa">{{ $contact->email }}</p>
                @if($contact->subject)
                    <p class="text-xs font-medium text-white mb-1">{{ $contact->subject }}</p>
                @endif
                <p class="text-xs leading-relaxed line-clamp-2" style="color:#737373">{{ $contact->message }}</p>
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <a href="{{ route('admin.contacts.show', $contact) }}" class="text-xs px-2.5 py-1 rounded transition-all" style="border:1px solid #2a2a2a;color:#a3a3a3">Read</a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete message?')">
                    @csrf @method('DELETE')
                    <button class="btn-danger">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-sm" style="color:#525252">
            <p>No messages yet.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $contacts->links() }}
</div>
@endsection
