@extends('admin.layouts.app')

@section('page-title', $config['label'])
@section('page-subtitle', 'Edit konten dan gambar halaman ini')

@section('header-action')
<div class="flex items-center gap-2">
    @foreach($pages as $key => $cfg)
    <a href="{{ route('admin.pages.edit', $key) }}"
       class="text-xs font-medium px-3 py-1.5 rounded-lg transition {{ $page === $key ? 'bg-indigo-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
        {{ $cfg['label'] }}
    </a>
    @endforeach
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">
    @csrf

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4 text-sm">
        <ul class="list-disc pl-5 space-y-0.5">
            @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        @foreach($config['fields'] as $key => $field)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 {{ $field['type'] === 'textarea' ? 'lg:col-span-2' : '' }}">
            <label class="block text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wide">
                {{ $field['label'] }}
            </label>

            @if($field['type'] === 'text')
                <input type="text" name="{{ $key }}" value="{{ old((string)$key, $settings[(string)$key] ?? '') }}"
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50 placeholder-slate-400"
                       placeholder="Isi konten di sini...">

            @elseif($field['type'] === 'textarea')
                <textarea name="{{ $key }}" rows="4"
                          class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50 resize-y placeholder-slate-400"
                          placeholder="Isi konten di sini...">{{ old((string)$key, $settings[(string)$key] ?? '') }}</textarea>

            @elseif($field['type'] === 'image')
                @php $currentImg = $settings[$key] ?? null; @endphp

                {{-- Current image preview --}}
                @if($currentImg)
                <div class="mb-3">
                    <img src="{{ $currentImg }}" alt="Current" id="preview-{{ $key }}"
                         class="w-full max-h-52 object-cover rounded-xl bg-slate-100"
                         onerror="this.style.display='none'">
                    <p class="text-xs text-slate-400 mt-1 truncate">{{ $currentImg }}</p>
                </div>
                @else
                <img id="preview-{{ $key }}" src="" alt="" class="w-full max-h-52 object-cover rounded-xl bg-slate-100 hidden mb-3">
                @endif

                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Upload dari komputer:</p>
                        <input type="file" name="{{ $key }}" accept="image/*"
                               data-preview="preview-{{ $key }}"
                               class="img-upload w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-medium hover:file:bg-indigo-100 cursor-pointer">
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Atau isi URL gambar:</p>
                        <input type="text" name="{{ $key }}_url" value="{{ old($key . '_url') }}"
                               class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 bg-slate-50 placeholder-slate-400"
                               placeholder="https://images.unsplash.com/...">
                    </div>
                </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="mt-6 flex items-center gap-4">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-xl transition shadow-lg text-sm">
            💾 Simpan Semua Perubahan
        </button>
        <p class="text-xs text-slate-400">Perubahan akan langsung tampil di situs</p>
    </div>
</form>

<script>
document.querySelectorAll('.img-upload').forEach(input => {
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const previewId = e.target.dataset.preview;
        const reader = new FileReader();
        reader.onload = ev => {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = ev.target.result;
                preview.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
