@extends('layouts.admin')
@section('title', 'Skills')
@section('page-title', 'Manage Skills')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Add Skill Form -->
    <div class="lg:col-span-1 space-y-4">
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-white mb-4">Add New Skill</h3>
            <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="form-label">Category *</label>
                    <select name="skill_category_id" class="form-input" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Skill Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. Laravel" required>
                </div>
                <div>
                    <label class="form-label">Icon Class <span style="color:#525252">(devicon)</span></label>
                    <input type="text" name="icon" class="form-input" placeholder="devicon-laravel-plain">
                </div>
                <div>
                    <label class="form-label">Color (hex)</label>
                    <div class="flex gap-2">
                        <input type="color" name="color" value="#a78bfa" class="w-10 h-9 rounded cursor-pointer" style="background:transparent;border:1px solid #2a2a2a;padding:2px">
                        <input type="text" name="color_text" class="form-input flex-1" placeholder="#ff2d20" oninput="this.previousElementSibling.value=this.value">
                    </div>
                </div>
                <label class="flex items-center gap-2 cursor-pointer pb-2">
                    <input type="checkbox" name="is_featured" class="w-3.5 h-3.5 rounded" style="accent-color:#7c3aed">
                    <span class="text-xs" style="color:#a3a3a3">Featured</span>
                </label>
                <button type="submit" class="btn-primary w-full">Add Skill</button>
            </form>
        </div>

        <!-- Add Category -->
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-white mb-4">Add Category</h3>
            <form action="{{ route('admin.skills.categories.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. DevOps" required>
                </div>
                <div>
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-input" placeholder="e.g. devops" required>
                </div>
                <button type="submit" class="btn-primary w-full shadow-lg shadow-primary-dark/10">Add Category</button>
            </form>
        </div>
    </div>

    <!-- Skills List -->
    <div class="lg:col-span-2">
<div class="card overflow-hidden">
    <div class="px-5 py-3 border-b border-white/5 bg-white/[0.01]">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Categories ({{ count($categories) }})</h3>
    </div>
    <div class="divide-y" style="divide-color:#141414">
        @forelse($skills as $skill)
        <div class="px-5 py-3 flex items-center justify-between gap-4 hover:bg-white/2 transition-colors group">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-8 h-8 rounded-lg bg-surface border border-white/5 flex items-center justify-center shrink-0 shadow-lg">
                    @if($skill->icon && str_starts_with($skill->icon, 'devicon'))
                        <i class="{{ $skill->icon }} text-base" style="color: {{ $skill->color ?? '#a3a3a3' }}"></i>
                    @else
                        <span class="w-2.5 h-2.5 rounded-full shadow-[0_0_8px_currentColor]" style="color: {{ $skill->color ?? '#a78bfa' }}; background: currentColor"></span>
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-extrabold text-white truncate group-hover:text-primary-dark transition-colors">{{ $skill->name }}</p>
                    <p class="text-[10px] font-bold text-gray-600 truncate">{{ $skill->category->name ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button onclick="openEditSkill({{ $skill->id }}, '{{ $skill->skill_category_id }}', '{{ addslashes($skill->name) }}', '{{ $skill->icon }}', '{{ $skill->color }}', {{ $skill->is_featured ? 'true' : 'false' }})"
                    class="w-14 text-center py-1.5 rounded-lg bg-white/5 border border-white/10 text-[10px] font-bold text-gray-400 hover:text-white hover:border-white/20 transition-all">
                    Edit
                </button>
                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete skill?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500/5 border border-rose-500/10 text-[10px] font-bold text-rose-500/60 hover:text-rose-500 hover:border-rose-500/30 transition-all">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-xs font-bold text-gray-700">No skills added yet.</div>
        @endforelse
    </div>
</div>
    </div>
</div>

<!-- Edit Skill Modal -->
<div id="edit-skill-modal" class="fixed inset-0 z-50 hidden" style="background:rgba(0,0,0,0.8)">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md card p-6">
            <h3 class="text-sm font-semibold text-white mb-4">Edit Skill</h3>
            <form id="edit-skill-form" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <div>
                    <label class="form-label">Category</label>
                    <select name="skill_category_id" id="edit-category" class="form-input">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Name</label>
                    <input type="text" name="name" id="edit-name" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Icon</label>
                    <input type="text" name="icon" id="edit-icon" class="form-input">
                </div>
                <div>
                    <label class="form-label">Color</label>
                    <input type="text" name="color" id="edit-color" class="form-input">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" id="edit-featured" class="w-3.5 h-3.5" style="accent-color:#7c3aed">
                    <span class="text-xs" style="color:#a3a3a3">Featured</span>
                </label>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="btn-primary flex-1">Update</button>
                    <button type="button" onclick="closeEditSkill()" class="flex-1 px-4 py-2 rounded-lg text-sm" style="border:1px solid #2a2a2a;color:#a3a3a3">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
<script>
function openEditSkill(id, catId, name, icon, color, featured) {
    document.getElementById('edit-skill-form').action = '/admin/skills/' + id;
    document.getElementById('edit-category').value = catId;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-icon').value = icon;
    document.getElementById('edit-color').value = color;
    document.getElementById('edit-featured').checked = featured;
    document.getElementById('edit-skill-modal').classList.remove('hidden');
}
function closeEditSkill() {
    document.getElementById('edit-skill-modal').classList.add('hidden');
}
</script>
@endpush
@endsection
