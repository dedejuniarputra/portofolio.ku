@extends('layouts.admin')
@section('title', 'Edit Achievement')
@section('page-title', 'Edit Achievement: ' . $achievement->title)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        
        <div class="card p-8 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-lg bg-primary-dark/10 flex items-center justify-center border border-primary-dark/20 text-primary-dark">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Edit Achievement</h3>
                    <p class="text-[10px] text-gray-500 font-bold mt-1 uppercase tracking-wider">Update award details</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="form-label text-[10px]">Achievement Title *</label>
                    <input type="text" name="title" value="{{ old('title', $achievement->title) }}" class="form-input text-sm" required>
                </div>

                <div>
                    <label class="form-label text-[10px]">Description</label>
                    <textarea name="description" rows="4" class="form-input text-sm resize-none" placeholder="Provide some details about this achievement">{{ old('description', $achievement->description) }}</textarea>
                </div>

                <div class="pt-4 border-t border-white/5">
                    <label class="form-label text-[10px]">Certificate Image (Optional)</label>
                    <div class="mt-2 relative">
                        <div id="upload-zone" class="p-6 border-2 border-dashed border-white/10 rounded-2xl bg-white/2 hover:bg-white/5 transition-all text-center group cursor-pointer h-48 flex flex-col items-center justify-center gap-2 overflow-hidden">
                            <input type="file" name="image" id="file-input" accept="image/*,.pdf" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            
                            <!-- Default/Current State -->
                            <div id="placeholder-content" class="flex flex-col items-center gap-2 transition-all duration-300 {{ $achievement->image ? 'hidden' : '' }}">
                                <svg class="w-8 h-8 text-gray-600 group-hover:text-primary-dark transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Click to upload certificate or drop file</p>
                                <p class="text-[9px] text-gray-600 uppercase">JPG, PNG, WEBP or PDF (MAX. 5MB)</p>
                            </div>

                            <!-- Preview State -->
                            <div id="preview-container" class="{{ $achievement->image ? 'flex' : 'hidden' }} absolute inset-0 w-full h-full bg-surface flex items-center justify-center p-2 group-hover:scale-105 transition-transform duration-700">
                                @if($achievement->image)
                                    @if(Str::endsWith(strtolower($achievement->image), '.pdf'))
                                        <img id="image-preview" src="#" alt="Preview" class="hidden w-full h-full object-contain">
                                        <div id="pdf-preview" class="flex flex-col items-center gap-2 text-rose-500">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            <span id="pdf-name" class="text-[9px] font-black uppercase tracking-widest text-gray-400">Current PDF</span>
                                        </div>
                                    @else
                                        <img id="image-preview" src="{{ Storage::url($achievement->image) }}" alt="Preview" class="w-full h-full object-contain">
                                        <div id="pdf-preview" class="hidden flex-col gap-2 text-rose-500">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            <span id="pdf-name" class="text-[9px] font-black uppercase tracking-widest text-gray-400">PDF Document</span>
                                        </div>
                                    @endif
                                @else
                                    <img id="image-preview" src="#" alt="Preview" class="hidden w-full h-full object-contain">
                                    <div id="pdf-preview" class="hidden flex-col gap-2 text-rose-500">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span id="pdf-name" class="text-[9px] font-black uppercase tracking-widest text-gray-400">PDF Document</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Reset Button -->
                        <button type="button" id="reset-preview" class="hidden absolute -top-2 -right-2 z-20 w-8 h-8 rounded-full bg-rose-500 text-white shadow-lg items-center justify-center hover:scale-110 active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    @error('image')
                        <p class="text-[10px] text-rose-500 mt-1 uppercase font-bold tracking-wider">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 justify-end">
            <a href="{{ route('admin.achievements.index') }}" class="px-6 py-2.5 rounded-xl bg-white/5 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white transition-all">Cancel</a>
            <button type="submit" class="group flex items-center gap-2 px-8 py-2.5 rounded-xl bg-primary-dark/10 text-primary-dark border border-primary-dark/20 text-[10px] font-black uppercase tracking-widest hover:bg-primary-dark hover:text-black transition-all">
                <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Update Achievement
            </button>
        </div>

        @push('scripts')
        <script>
            const fileInput = document.getElementById('file-input');
            const placeholder = document.getElementById('placeholder-content');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const pdfPreview = document.getElementById('pdf-preview');
            const pdfName = document.getElementById('pdf-name');
            const resetButton = document.getElementById('reset-preview');

            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    const isImage = file.type.startsWith('image/');
                    const isPDF = file.type === 'application/pdf';

                    reader.onload = function(e) {
                        placeholder.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        previewContainer.classList.add('flex');
                        resetButton.classList.remove('hidden');
                        resetButton.classList.add('flex');

                        if (isImage) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            pdfPreview.classList.add('hidden');
                        } else if (isPDF) {
                            pdfName.textContent = file.name;
                            pdfPreview.classList.remove('hidden');
                            imagePreview.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });

            resetButton.addEventListener('click', function() {
                fileInput.value = '';
                @if(!$achievement->image)
                    placeholder.classList.remove('hidden');
                    previewContainer.classList.add('hidden');
                    previewContainer.classList.remove('flex');
                @else
                    // Revert to original image/pdf logic would be complex here, 
                    // simplest is to refresh or just clear selection.
                    // For now, we just clear the NEW selection and show a "clear" state or refresh.
                    window.location.reload(); 
                @endif
                resetButton.classList.add('hidden');
                resetButton.classList.remove('flex');
            });
        </script>
        @endpush
    </form>
</div>
@endsection
