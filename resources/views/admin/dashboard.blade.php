@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan konten WanderWise')

@section('content')
<div class="space-y-8">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        @php
        $cards = [
            ['label' => 'Destinations',          'value' => $stats['destinations'],          'color' => 'indigo', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Blog Posts',            'value' => $stats['posts'],                 'color' => 'violet', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['label' => 'Kategori',              'value' => $stats['categories'],            'color' => 'sky',    'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
            ['label' => 'Dest. Featured',        'value' => $stats['featured_destinations'], 'color' => 'amber',  'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
            ['label' => 'Posts Featured',        'value' => $stats['featured_posts'],        'color' => 'rose',   'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
        ];
        $colorMap = [
            'indigo' => ['bg' => 'bg-indigo-50', 'icon' => 'bg-indigo-600', 'text' => 'text-indigo-700'],
            'violet' => ['bg' => 'bg-violet-50', 'icon' => 'bg-violet-600', 'text' => 'text-violet-700'],
            'sky'    => ['bg' => 'bg-sky-50',    'icon' => 'bg-sky-600',    'text' => 'text-sky-700'],
            'amber'  => ['bg' => 'bg-amber-50',  'icon' => 'bg-amber-500',  'text' => 'text-amber-700'],
            'rose'   => ['bg' => 'bg-rose-50',   'icon' => 'bg-rose-600',   'text' => 'text-rose-700'],
        ];
        @endphp

        @foreach($cards as $card)
        @php $c = $colorMap[$card['color']]; @endphp
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 {{ $c['icon'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @foreach(explode(' ', $card['icon']) as $path)
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/>
                    @endforeach
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $card['value'] }}</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ $card['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.destinations.create') }}" class="group bg-indigo-600 hover:bg-indigo-700 rounded-2xl p-5 text-white transition-all duration-200 shadow-lg hover:shadow-indigo-200 flex items-center gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <span class="font-semibold text-sm">Tambah Destinasi</span>
        </a>
        <a href="{{ route('admin.posts.create') }}" class="group bg-violet-600 hover:bg-violet-700 rounded-2xl p-5 text-white transition-all duration-200 shadow-lg hover:shadow-violet-200 flex items-center gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <span class="font-semibold text-sm">Tambah Post</span>
        </a>
        <a href="{{ route('admin.pages.edit', 'about') }}" class="group bg-sky-600 hover:bg-sky-700 rounded-2xl p-5 text-white transition-all duration-200 shadow-lg hover:shadow-sky-200 flex items-center gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <span class="font-semibold text-sm">Edit About</span>
        </a>
        <a href="{{ route('admin.pages.edit', 'general') }}" class="group bg-slate-700 hover:bg-slate-800 rounded-2xl p-5 text-white transition-all duration-200 shadow-lg flex items-center gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="font-semibold text-sm">Pengaturan Situs</span>
        </a>
    </div>

    {{-- Recent Items --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Destinations --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">Destinasi Terbaru</h3>
                <a href="{{ route('admin.destinations.index') }}" class="text-xs text-indigo-600 hover:underline">Lihat Semua →</a>
            </div>
            <ul class="divide-y divide-slate-50">
                @foreach($recentDestinations as $dest)
                <li class="flex items-center gap-4 px-6 py-3">
                    <img src="{{ $dest->image }}" alt="" class="w-10 h-10 rounded-lg object-cover bg-slate-100 flex-shrink-0"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dest->name) }}&background=6366f1&color=fff'">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $dest->name }}</p>
                        <p class="text-xs text-slate-400">{{ $dest->country }} · {{ ucfirst($dest->region) }}</p>
                    </div>
                    @if($dest->featured)
                    <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full font-medium">Featured</span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Recent Posts --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800 text-sm">Posts Terbaru</h3>
                <a href="{{ route('admin.posts.index') }}" class="text-xs text-violet-600 hover:underline">Lihat Semua →</a>
            </div>
            <ul class="divide-y divide-slate-50">
                @foreach($recentPosts as $post)
                <li class="flex items-center gap-4 px-6 py-3">
                    <img src="{{ $post->image }}" alt="" class="w-10 h-10 rounded-lg object-cover bg-slate-100 flex-shrink-0"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($post->title) }}&background=7c3aed&color=fff'">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $post->title }}</p>
                        <p class="text-xs text-slate-400">{{ $post->author }} · {{ $post->read_time }} min</p>
                    </div>
                    @if($post->featured)
                    <span class="text-xs bg-violet-100 text-violet-700 px-2 py-0.5 rounded-full font-medium">Featured</span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection
