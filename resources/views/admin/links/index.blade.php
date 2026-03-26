@extends('layouts.admin')
@section('title', 'Links')
@section('page-title', 'Manage Links')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Add Form -->
    <div>
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-white mb-4">Add Link</h3>
            <form action="{{ route('admin.links.store') }}" method="POST" class="space-y-3">
                @csrf
                <div><label class="form-label">Title *</label><input type="text" name="title" class="form-input" required></div>
                <div><label class="form-label">URL *</label><input type="url" name="url" class="form-input" required></div>
                <div>
                    <label class="form-label">Icon</label>
                    <select name="icon" class="form-input">
                        <option value="globe">🌐 Globe</option>
                        <option value="github">GitHub</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="instagram">Instagram</option>
                        <option value="twitter">Twitter</option>
                        <option value="youtube">YouTube</option>
                    </select>
                </div>
                <div><label class="form-label">Description</label><input type="text" name="description" class="form-input" placeholder="Short description"></div>
                <div>
                    <label class="form-label">Category</label>
                    <select name="category" class="form-input">
                        <option value="social">Social</option>
                        <option value="project">Project</option>
                        <option value="resource">Resource</option>
                    </select>
                </div>
                <div><label class="form-label">Order</label><input type="number" name="order" class="form-input" value="0"></div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" checked style="accent-color:#7c3aed">
                    <span class="text-xs" style="color:#a3a3a3">Active</span>
                </label>
                <button type="submit" class="btn-primary w-full">Add Link</button>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="lg:col-span-2">
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b" style="border-color:#1f1f1f">
                <h3 class="text-sm font-semibold text-white">All Links ({{ $links->count() }})</h3>
            </div>
            <div class="divide-y" style="divide-color:#1f1f1f">
                @forelse($links as $link)
                <div class="px-5 py-3 flex items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-white flex items-center gap-2">
                            {{ $link->title }}
                            @if(!$link->is_active) <span class="text-xs" style="color:#ef4444">(inactive)</span> @endif
                        </p>
                        <p class="text-xs truncate" style="color:#525252">{{ $link->url }}</p>
                    </div>
                    <form action="{{ route('admin.links.destroy', $link) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn-danger">Delete</button>
                    </form>
                </div>
                @empty
                <div class="p-8 text-center text-sm" style="color:#525252">No links yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
