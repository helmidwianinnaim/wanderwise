@extends('admin.layouts.app')

@section('page-title', isset($post->id) ? 'Edit Post' : 'Tambah Post')
@section('page-subtitle', isset($post->id) ? $post->title : 'Buat artikel blog baru')

@section('header-action')
<a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 px-4 py-2.5 rounded-xl transition">
    ← Kembali
</a>
@endsection

@section('content')
<form method="POST"
      action="{{ isset($post->id) ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if(isset($post->id)) @method('PUT') @endif

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
        <p class="font-semibold mb-1">Terdapat kesalahan:</p>
        <ul class="list-disc pl-5 space-y-0.5">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-5">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Konten Post</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Judul *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50"
                           placeholder="Judul artikel yang menarik...">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Slug (URL)</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50"
                               placeholder="auto-generated">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Author</label>
                        <input type="text" name="author" value="{{ old('author', $post->author ?? 'WanderWise Team') }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Ringkasan (Excerpt) *</label>
                    <textarea name="excerpt" rows="3" required
                              class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50 resize-none"
                              placeholder="Ringkasan singkat yang muncul di daftar blog...">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Konten Lengkap * <span class="normal-case text-slate-400 ml-1">(HTML diizinkan)</span></label>
                    <textarea name="content" rows="16" required id="content-editor"
                              class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50 resize-y"
                              placeholder="<p>Tulis konten artikel di sini...</p>">{{ old('content', $post->content) }}</textarea>
                    <p class="text-xs text-slate-400 mt-1">Gunakan HTML untuk formatting: &lt;h2&gt;, &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;&lt;li&gt;, dll.</p>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            {{-- Image --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Foto Utama</h3>

                @if(isset($post->id) && $post->image)
                <img src="{{ $post->image }}" id="current-img" alt="Current"
                     class="w-full h-40 object-cover rounded-xl bg-slate-100"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(substr($post->title ?? 'P', 0, 2)) }}&background=7c3aed&color=fff&size=200'">
                @endif

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Upload Foto</label>
                    <input type="file" name="image" accept="image/*" id="img-upload"
                           class="w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-violet-50 file:text-violet-700 file:font-medium hover:file:bg-violet-100 cursor-pointer">
                    <img id="img-preview" src="" alt="" class="w-full h-36 object-cover rounded-xl mt-3 hidden">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Atau URL Foto</label>
                    <input type="text" name="image_url" value="{{ old('image_url', (!str_starts_with($post->image ?? '', '/storage/') ? $post->image : '')) }}"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50"
                           placeholder="https://images.unsplash.com/...">
                </div>
            </div>

            {{-- Meta --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">
                <h3 class="font-semibold text-slate-700 text-sm pb-2 border-b border-slate-100">Meta & Opsi</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Kategori</label>
                    <select name="category_id" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50">
                        <option value="">— Tanpa Kategori —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Waktu Baca (menit)</label>
                    <input type="number" name="read_time" value="{{ old('read_time', $post->read_time ?? 5) }}" min="1"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at"
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 text-slate-800 bg-slate-50">
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $post->featured) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-10 h-6 bg-slate-200 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-all peer-checked:translate-x-4"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700">Featured Post</p>
                        <p class="text-xs text-slate-400">Tampil sebagai post unggulan</p>
                    </div>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white font-semibold py-3 rounded-xl transition-all shadow-lg text-sm">
                {{ isset($post->id) ? '💾 Simpan Perubahan' : '✦ Publish Post' }}
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
