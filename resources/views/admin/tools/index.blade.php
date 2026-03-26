@extends('layouts.admin')
@section('title', 'Tools & Uses')
@section('page-title', 'Manage Tools & Uses')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Add Forms -->
    <div class="space-y-4">
        <div class="card p-5 border border-white/5">
            <h3 class="text-[11px] font-black uppercase tracking-widest text-gray-500 mb-4">Add New Tool</h3>
            <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="form-label text-[10px]!">Category *</label>
                    <select name="tool_category_id" class="form-input text-xs h-9 px-3" required>
                        <option value="">Select Category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label class="form-label !text-[10px]">Tool Name *</label><input type="text" name="name" class="form-input text-xs h-9 px-3" placeholder="e.g. VS Code" required></div>
                <div><label class="form-label !text-[10px]">Description</label><textarea name="description" rows="2" class="form-input text-xs px-3 py-2 resize-none" placeholder="Short description"></textarea></div>
                <div><label class="form-label !text-[10px]">URL</label><input type="url" name="url" class="form-input text-xs h-9 px-3" placeholder="https://..."></div>
                <div><label class="form-label !text-[10px]">Icon Image</label><input type="file" name="icon" accept="image/*" class="form-input text-[10px] py-1.5 px-3"></div>
                <button type="submit" class="btn-primary w-full py-2 text-xs">Add Tool</button>
            </form>
        </div>

        <div class="card p-5 border border-white/5">
            <h3 class="text-[10px]! font-black uppercase tracking-widest text-gray-500">Categories</h3>
            <form action="{{ route('admin.tools.categories.store') }}" method="POST" class="space-y-3">
                @csrf
                <div><label class="form-label text-[10px]!">Name</label><input type="text" name="name" class="form-input text-xs h-9 px-3" required></div>
                <div><label class="form-label text-[10px]!">Slug</label><input type="text" name="slug" class="form-input text-xs h-9 px-3" required></div>
                <div><label class="form-label text-[10px]!">Icon (emoji)</label><input type="text" name="icon" class="form-input text-xs h-9 px-3" placeholder="💻" maxlength="4"></div>
                <button type="submit" class="btn-primary w-full py-2 text-xs">Add Category</button>
            </form>
        </div>
    </div>

    <!-- Tools List -->
    <div class="lg:col-span-2">
        <div class="card overflow-hidden">
            <div class="px-5 py-3 border-b border-white/5 bg-white/1">
                <h3 class="text-[11px] font-black uppercase tracking-widest text-gray-500">All Tools ({{ count($tools) }})</h3>
            </div>
            <div class="divide-y" style="divide-color:#141414">
                @forelse($tools as $tool)
                <div class="px-5 py-3 flex items-center justify-between gap-4 hover:bg-white/2 transition-colors group">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <div class="w-9 h-9 rounded-lg bg-surface border border-white/5 flex items-center justify-center shrink-0 shadow-lg overflow-hidden">
                            @if($tool->icon)
                                <img src="{{ Storage::url($tool->icon) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm opacity-50">{{ $tool->category->icon ?? '🛠️' }}</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-extrabold text-white truncate group-hover:text-primary-dark transition-colors">{{ $tool->name }}</p>
                            <div class="flex items-center gap-1.5 min-w-0">
                                <span class="text-[10px] font-bold text-gray-600 truncate">{{ $tool->category->name ?? '-' }}</span>
                                @if($tool->url)
                                    <span class="w-1 h-1 rounded-full bg-white/5"></span>
                                    <span class="text-[9px] text-gray-700 truncate max-w-[120px]">{{ preg_replace('(^https?://)', '', $tool->url) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ route('admin.tools.edit', $tool) }}" 
                           class="w-14 text-center py-1.5 rounded-lg bg-white/5 border border-white/10 text-[10px] font-bold text-gray-400 hover:text-white transition-all">
                            Edit
                        </a>
                        <form action="{{ route('admin.tools.destroy', $tool) }}" method="POST" onsubmit="return confirm('Delete tool?')">
                            @csrf @method('DELETE')
                            <button class="w-full px-3 py-1.5 rounded-lg bg-rose-500/5 border border-rose-500/10 text-[10px] font-bold text-rose-500/60 hover:text-rose-500 hover:border-rose-500/30 transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-xs font-bold text-gray-700">No tools found yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
