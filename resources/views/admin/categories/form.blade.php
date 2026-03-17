@extends('admin.layouts.app')

@section('page-title', isset($category->id) ? 'Edit Kategori' : 'Tambah Kategori')
@section('page-subtitle', 'Kategori untuk artikel blog')

@section('header-action')
<a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 px-4 py-2.5 rounded-xl transition">
    ← Kembali
</a>
@endsection

@section('content')
<div class="max-w-lg">
    <form method="POST"
          action="{{ isset($category->id) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
        @csrf
        @if(isset($category->id)) @method('PUT') @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-5">
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 text-slate-800 bg-slate-50"
                       placeholder="e.g. Travel Tips">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 text-slate-800 bg-slate-50"
                       placeholder="auto-generated">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Warna Badge</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="color" value="{{ old('color', $category->color ?? '#6366F1') }}" id="color-input"
                           class="w-12 h-10 rounded-xl cursor-pointer border border-slate-200 bg-slate-50 p-1">
                    <input type="text" id="color-text" value="{{ old('color', $category->color ?? '#6366F1') }}"
                           class="flex-1 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 text-slate-800 bg-slate-50 font-mono"
                           placeholder="#6366F1" readonly>
                    <span id="color-preview" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-white" style="background-color: {{ $category->color ?? '#6366F1' }}">
                        Preview
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 rounded-xl transition shadow-lg text-sm">
                {{ isset($category->id) ? '💾 Simpan Perubahan' : '✦ Tambah Kategori' }}
            </button>
        </div>
    </form>
</div>

<script>
const colorInput = document.getElementById('color-input');
const colorText  = document.getElementById('color-text');
const colorPreview = document.getElementById('color-preview');
colorInput?.addEventListener('input', (e) => {
    colorText.value = e.target.value;
    colorPreview.style.backgroundColor = e.target.value;
    // Update hidden field name to 'color'
    colorInput.name = 'color';
});
</script>
@endsection
