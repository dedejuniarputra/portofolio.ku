@extends('layouts.admin')
@section('title', 'Edit Tool')
@section('page-title', 'Edit Tool: ' . $tool->name)

@section('content')
<div class="max-w-2xl">
    <div class="card p-6">
        <form action="{{ route('admin.tools.update', $tool) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            
            <div>
                <label class="form-label">Category *</label>
                <select name="tool_category_id" class="form-input" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $tool->tool_category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label">Tool Name *</label>
                <input type="text" name="name" value="{{ old('name', $tool->name) }}" class="form-input" required>
            </div>

            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-input resize-none">{{ old('description', $tool->description) }}</textarea>
            </div>

            <div>
                <label class="form-label">URL</label>
                <input type="url" name="url" value="{{ old('url', $tool->url) }}" class="form-input" placeholder="https://example.com">
            </div>

            <div>
                <label class="form-label">Icon Image</label>
                @if($tool->icon)
                    <div class="mb-2">
                        <img src="{{ Storage::url($tool->icon) }}" class="w-10 h-10 rounded object-cover border border-[#222]">
                    </div>
                @endif
                <input type="file" name="icon" accept="image/*" class="form-input text-xs">
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="btn-primary flex-1 py-2.5">Update Tool</button>
                <a href="{{ route('admin.tools.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-center border border-[#2a2a2a] text-muted hover:text-white transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
