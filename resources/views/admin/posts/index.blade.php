@extends('admin.layouts.app')

@section('page-title', 'Blog Posts')
@section('page-subtitle', 'Kelola artikel dan konten blog')

@section('header-action')
<a href="{{ route('admin.posts.create') }}"
   class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Post
</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-slate-600">Post</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Kategori</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Author</th>
                    <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Baca</th>
                    <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Featured</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Dipublikasi</th>
                    <th class="text-right px-6 py-3.5 font-semibold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $post->image }}" alt=""
                                     class="w-12 h-10 rounded-xl object-cover bg-slate-100 flex-shrink-0"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(substr($post->title,0,2)) }}&background=7c3aed&color=fff&size=100'">
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-slate-800 truncate max-w-xs">{{ $post->title }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ $post->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            @if($post->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                            @else <span class="text-slate-300 text-xs">—</span> @endif
                        </td>
                        <td class="px-4 py-4 text-slate-600 text-xs">{{ $post->author }}</td>
                        <td class="px-4 py-4 text-center text-xs text-slate-500">{{ $post->read_time }} min</td>
                        <td class="px-4 py-4 text-center">
                            @if($post->featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-violet-100 text-violet-700">✓ Ya</span>
                            @else <span class="text-slate-300 text-xs">—</span> @endif
                        </td>
                        <td class="px-4 py-4 text-xs text-slate-500">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                   class="inline-flex items-center gap-1.5 text-xs font-medium text-violet-600 hover:text-violet-800 bg-violet-50 hover:bg-violet-100 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
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
                    <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Belum ada post
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
