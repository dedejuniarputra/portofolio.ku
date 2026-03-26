@extends('layouts.admin')
@section('title', 'Add Achievement')
@section('page-title', 'Add New Achievement')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Achievement Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-input" placeholder="Achievement title" required>
                </div>
                <div>
                    <label class="form-label">Issuer</label>
                    <input type="text" name="issuer" class="form-input" placeholder="e.g. Google, Dicoding">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Type</label>
                    <input type="text" name="type" class="form-input" placeholder="e.g. Sertifikat">
                </div>
                <div>
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-input" placeholder="e.g. Backend">
                </div>
            </div>

            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-input resize-none" placeholder="Provide some details about this achievement"></textarea>
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-sm font-semibold text-white mb-2">Credentials & Media</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Credential ID</label>
                    <input type="text" name="credential_id" class="form-input">
                </div>
                <div>
                    <label class="form-label">Credential URL</label>
                    <input type="url" name="credential_url" class="form-input" placeholder="https://example.com/verify">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-input">
                </div>
            </div>

            <div>
                <label class="form-label">Certificate Image (Optional)</label>
                <input type="file" name="image" accept="image/*" class="form-input text-xs">
            </div>
        </div>

        <div class="flex items-center gap-3 justify-end">
            <a href="{{ route('admin.achievements.index') }}" class="px-6 py-2 rounded-lg text-sm font-semibold" style="border:1px solid #2a2a2a; color:#a3a3a3">Cancel</a>
            <button type="submit" class="btn-primary flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Save Achievement
            </button>
        </div>
    </form>
</div>
@endsection
