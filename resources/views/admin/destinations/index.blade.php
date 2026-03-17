@extends('admin.layouts.app')

@section('page-title', 'Destinations')
@section('page-subtitle', 'Kelola data destinasi wisata')

@section('header-action')
<a href="{{ route('admin.destinations.create') }}"
   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Tambah Destinasi
</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-slate-600">Destinasi</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Negara</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Region</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-slate-600">Tag</th>
                    <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Rating</th>
                    <th class="text-center px-4 py-3.5 font-semibold text-slate-600">Featured</th>
                    <th class="text-right px-6 py-3.5 font-semibold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @if ($destinations->count() > 0)
                    @foreach ($destinations as $dest)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $dest->image }}" alt=""
                                     class="w-12 h-10 rounded-xl object-cover bg-slate-100 flex-shrink-0"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dest->name) }}&background=6366f1&color=fff&size=100'">
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $dest->name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $dest->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-slate-600">{{ $dest->country }}</td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $dest->region === 'usa' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ strtoupper($dest->region) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-slate-500 text-xs">{{ $dest->tag ?: '—' }}</td>
                        <td class="px-4 py-4 text-center">
                            <div class="flex items-center justify-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3.5 h-3.5 {{ $i <= $dest->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center">
                            @if($dest->featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">✓ Ya</span>
                            @else
                            <span class="text-slate-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.destinations.edit', $dest) }}"
                                   class="inline-flex items-center gap-1.5 text-xs font-medium text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.destinations.destroy', $dest) }}" onsubmit="return confirm('Hapus destinasi ini?')">
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
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        Belum ada destinasi
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if($destinations->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $destinations->links() }}
    </div>
    @endif
</div>
@endsection
