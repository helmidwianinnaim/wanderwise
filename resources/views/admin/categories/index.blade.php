@extends('admin.layouts.app')

@section('page-title', 'Kategori Blog')
@section('page-subtitle', 'Kelola kategori artikel')

@section('header-action')
<a href="{{ route('admin.categories.create') }}"
   class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Kategori
</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
                <th class="text-left px-6 py-3.5 font-semibold text-slate-600">Kategori</th>
                <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Slug</th>
                <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Warna</th>
                <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Jumlah Posts</th>
                <th class="text-right px-6 py-3.5 font-semibold text-slate-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @if ($categories->count() > 0)
                @foreach ($categories as $cat)
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $cat->color }}"></div>
                            <span class="font-semibold text-slate-800">{{ $cat->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-slate-500 font-mono text-xs">{{ $cat->slug }}</td>
                    <td class="px-4 py-4 text-center">
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-white px-2.5 py-1 rounded-full" style="background-color: {{ $cat->color }}">
                            {{ $cat->color }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="bg-slate-100 text-slate-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $cat->posts_count }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $cat) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-medium text-sky-600 hover:text-sky-800 bg-sky-50 hover:bg-sky-100 px-3 py-1.5 rounded-lg transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori ini? Post terkait akan kehilangan kategorinya.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Belum ada kategori
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
