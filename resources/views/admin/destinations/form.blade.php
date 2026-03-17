@extends('admin.layouts.app')

@section('page-title', isset($destination->id) ? 'Edit Destinasi' : 'Tambah Destinasi')
@section('page-subtitle', isset($destination->id) ? $destination->name : 'Buat destinasi baru')

@section('header-action')
<a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 px-4 py-2.5 rounded-xl transition">
    ← Kembali
</a>
@endsection

@section('content')
<form method="POST"
      action="{{ isset($destination->id) ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if(isset($destination->id)) @method('PUT') @endif

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
        <p class="font-semibold mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc pl-5 space-y-0.5">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Fields --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-5">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Informasi Utama</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Nama Destinasi *</label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}" required
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50"
                               placeholder="e.g. New York City">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Slug (URL)</label>
                        <input type="text" name="slug" value="{{ old('slug', $destination->slug) }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50"
                               placeholder="auto-generated">
                        <p class="text-xs text-slate-400 mt-1">Kosongkan untuk generate otomatis dari nama</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Negara *</label>
                        <input type="text" name="country" value="{{ old('country', $destination->country) }}" required
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50"
                               placeholder="e.g. United States">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Region *</label>
                        <select name="region" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50">
                            <option value="">Pilih Region</option>
                            <option value="usa"    {{ old('region', $destination->region) === 'usa'    ? 'selected' : '' }}>USA</option>
                            <option value="europe" {{ old('region', $destination->region) === 'europe' ? 'selected' : '' }}>Europe</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Tag / Badge</label>
                        <input type="text" name="tag" value="{{ old('tag', $destination->tag) }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50"
                               placeholder="e.g. Top Pick, Hidden Gem">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Jumlah Guides</label>
                        <input type="number" name="guides_count" value="{{ old('guides_count', $destination->guides_count ?? 0) }}" min="0"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Rating (1–5)</label>
                        <input type="number" name="rating" value="{{ old('rating', $destination->rating ?? 5) }}" min="1" max="5"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Deskripsi *</label>
                        <textarea name="description" rows="5" required
                                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50 resize-none"
                                  placeholder="Deskripsi lengkap tentang destinasi ini...">{{ old('description', $destination->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Fields --}}
        <div class="space-y-5">
            {{-- Image --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Foto Destinasi</h3>

                @if(isset($destination->id) && $destination->image)
                <div class="relative">
                    <img src="{{ $destination->image }}" id="current-img" alt="Current"
                         class="w-full h-44 object-cover rounded-xl bg-slate-100"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($destination->name ?? 'D') }}&background=6366f1&color=fff&size=200'">
                    <p class="text-xs text-slate-400 mt-1.5 truncate">Foto saat ini</p>
                </div>
                @endif

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Upload Foto Baru</label>
                    <input type="file" name="image" accept="image/*" id="img-upload"
                           class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-medium hover:file:bg-indigo-100 cursor-pointer">
                    <img id="img-preview" src="" alt="" class="w-full h-40 object-cover rounded-xl mt-3 hidden bg-slate-100">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Atau URL Foto</label>
                    <input type="text" name="image_url" value="{{ old('image_url', (!str_starts_with($destination->image ?? '', '/storage/') ? $destination->image : '')) }}"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50"
                           placeholder="https://images.unsplash.com/...">
                    <p class="text-xs text-slate-400 mt-1">Upload foto prioritas di atas URL</p>
                </div>
            </div>

            {{-- Gallery Photos --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Galeri Foto</h3>

                @if(isset($destination->id) && is_array($destination->gallery_photos) && count($destination->gallery_photos) > 0)
                <div class="space-y-2">
                    <p class="text-xs font-medium text-slate-500">Foto Saat Ini (Centang untuk menghapus)</p>
                    <div class="grid grid-cols-2 lg:grid-cols-2 gap-3">
                        @foreach($destination->gallery_photos as $index => $photo)
                        <div class="relative group">
                            <img src="{{ $photo['url'] }}" alt="Gallery photo" class="w-full h-24 object-cover rounded-xl bg-slate-100">
                            <label class="absolute top-2 right-2 bg-white/90 rounded-md p-1.5 cursor-pointer flex items-center gap-1.5 shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                <input type="checkbox" name="delete_gallery[]" value="{{ $index }}" class="rounded text-red-500 w-4 h-4 border-slate-300">
                                <span class="text-xs font-semibold text-red-600">Hapus</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Upload Foto Galeri (Bisa Lebih Dari Satu)</label>
                    <input type="file" name="gallery_files[]" accept="image/*" multiple
                           class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-medium hover:file:bg-indigo-100 cursor-pointer">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Atau URL Foto Terpisah Baris</label>
                    <textarea name="gallery_urls" rows="3"
                              class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50 resize-none"
                              placeholder="https://images.unsplash.com/...&#10;https://images.unsplash.com/..."></textarea>
                </div>
            </div>

            {{-- Options --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Opsi</h3>
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $destination->featured) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-10 h-6 bg-slate-200 peer-checked:bg-indigo-600 rounded-full transition-colors"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-all peer-checked:translate-x-4"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700">Featured</p>
                        <p class="text-xs text-slate-400">Tampil di homepage</p>
                    </div>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-all shadow-lg text-sm">
                {{ isset($destination->id) ? '💾 Simpan Perubahan' : '✦ Tambah Destinasi' }}
            </button>
        </div>
    </div>
</form>

<script>
document.getElementById('img-upload')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        const preview = document.getElementById('img-preview');
        preview.src = ev.target.result;
        preview.classList.remove('hidden');
        const curr = document.getElementById('current-img');
        if (curr) curr.src = ev.target.result;
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
