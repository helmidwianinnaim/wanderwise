@extends('layouts.app')

@section('title', 'The WanderWise Blog — Travel Stories & Guides')
@section('meta_description', 'Honest guides, practical tips, and inspiring stories from destinations across the USA and Europe.')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
    <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-2">Travel Stories & Guides</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">The WanderWise Blog</h1>
    <p class="text-gray-500 text-base leading-relaxed max-w-xl">Honest guides, practical tips, and inspiring stories from destinations across the USA and Europe.</p>
</div>

{{-- ===== CATEGORY TABS ===== --}}
<div class="border-b border-gray-200 sticky top-14 z-40 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-0 overflow-x-auto scrollbar-none">
            <a href="{{ route('posts.index') }}"
               class="shrink-0 px-4 py-3.5 text-sm font-medium border-b-2 transition-colors
                      {{ $categorySlug === 'all' ? 'border-sky-500 text-sky-600' : 'border-transparent text-gray-500 hover:text-gray-900' }}">
                All Posts
            </a>
            <a href="{{ route('posts.index', ['category' => 'usa-travel']) }}"
               class="shrink-0 px-4 py-3.5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors">
                USA Travel
            </a>
            <a href="{{ route('posts.index', ['category' => 'europe-travel']) }}"
               class="shrink-0 px-4 py-3.5 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors">
                Europe Travel
            </a>
            @foreach($categories->take(5) as $cat)
            <a href="{{ route('posts.index', ['category' => $cat->slug]) }}"
               class="shrink-0 px-4 py-3.5 text-sm font-medium border-b-2 transition-colors
                      {{ $categorySlug === $cat->slug ? 'border-sky-500 text-sky-600' : 'border-transparent text-gray-500 hover:text-gray-900' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @php $featured = $posts->where('featured', true)->first(); $allPosts = $posts; @endphp

    {{-- ===== FEATURED ARTICLE HERO ===== --}}
    @if($featured)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-2xl overflow-hidden shadow-lg mb-12 border border-gray-100">
        {{-- Image side --}}
        <div class="relative min-h-56 lg:min-h-auto"
             style="@if($featured->image) background: url('{{ $featured->image }}') center/cover; @else background: linear-gradient(135deg, {{ $featured->category?->color ?? '#0EA5E9' }}dd, #111); @endif">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute top-4 left-4">
                <span class="badge bg-sky-500 text-white text-xs">★ Featured Article</span>
            </div>
            <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
                {{ $featured->read_time }} min read
            </div>
        </div>
        {{-- Content side --}}
        <div class="bg-white p-8 lg:p-10 flex flex-col justify-center">
            <div class="flex flex-wrap gap-2 mb-4">
                @if($featured->category)
                <span class="badge text-xs font-semibold uppercase tracking-wider" style="color: {{ $featured->category->color }}; background: {{ $featured->category->color }}20;">
                    {{ $featured->category->name }}
                </span>
                @endif
                <span class="badge bg-amber-50 text-amber-700 text-xs font-semibold uppercase tracking-wider">Most Popular</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight mb-3">
                {{ $featured->title }}
            </h2>
            <p class="text-gray-500 leading-relaxed mb-6 text-sm sm:text-base">{{ $featured->excerpt }}</p>
            <div class="flex items-center gap-3 mb-6 text-sm text-gray-400">
                <span class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-700 text-sm">
                    {{ strtoupper(substr($featured->author, 0, 1)) }}
                </span>
                <div>
                    <div class="font-semibold text-gray-700 text-xs">{{ $featured->author }}</div>
                    <div class="text-xs">{{ $featured->published_at?->format('M j, Y') }} · {{ $featured->read_time }} min read</div>
                </div>
            </div>
            <a href="{{ route('posts.show', $featured->slug) }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 hover:bg-sky-600 text-white font-semibold text-sm rounded-full transition-colors self-start">
                Read Full Article →
            </a>
        </div>
    </div>
    @endif

    {{-- ===== MAIN CONTENT + SIDEBAR ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Posts grid --}}
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($allPosts as $post)
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all overflow-hidden flex flex-col">
                    {{-- Image or colored header --}}
                    <div class="relative h-44 overflow-hidden"
                         style="@if($post->image) background: url('{{ $post->image }}') center/cover; @else background: linear-gradient(135deg, {{ $post->category?->color ?? '#6B7280' }}dd, {{ $post->category?->color ?? '#6B7280' }}88); @endif">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2 flex-wrap">
                            @if($post->category)
                            <span class="badge bg-white/90 text-xs font-semibold" style="color: {{ $post->category->color }};">
                                {{ $post->category->name }}
                            </span>
                            @endif
                            @if($post->featured)
                            <span class="badge bg-yellow-400 text-yellow-900 text-xs font-semibold">Featured</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-gray-900 text-sm leading-snug mb-2 group-hover:text-sky-600 transition-colors line-clamp-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 flex-1 mb-3">{{ $post->excerpt }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-400 pt-3 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 text-xs">
                                    {{ strtoupper(substr($post->author,0,1)) }}
                                </span>
                                <span>{{ $post->author }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-400">
                                <span>{{ $post->published_at?->format('M j') }}</span>
                                <span>·</span>
                                <span>{{ $post->read_time }} min</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-6">
            {{-- Most Read --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 text-sm">
                    🔥 Most Read
                </h3>
                <ol class="space-y-3">
                    @foreach($posts->sortByDesc('read_time')->take(5) as $i => $p)
                    <li class="flex items-start gap-3">
                        <span class="text-lg font-extrabold text-gray-200 leading-none shrink-0 w-6">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <div>
                            <a href="{{ route('posts.show', $p->slug) }}"
                               class="text-xs font-semibold text-gray-700 hover:text-sky-600 transition-colors leading-snug">
                                {{ $p->title }}
                            </a>
                            <div class="text-xs text-gray-400 mt-0.5">{{ $p->read_time }} min · {{ $p->published_at?->diffForHumans() }}</div>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>

            {{-- Browse Tags --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-4 text-sm">🏷️ Browse Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(['New York','Paris','Rome','Budget','Flights','Itinerary','Hotels','Food','Families','Road Trip','Luxury'] as $tag)
                    <a href="{{ route('posts.index') }}"
                       class="px-3 py-1.5 bg-gray-100 hover:bg-sky-50 hover:text-sky-700 text-gray-600 text-xs rounded-full font-medium transition-colors">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>

        </aside>
    </div>
</div>

@endsection
