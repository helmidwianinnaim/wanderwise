@extends('layouts.app')

@section('title', $post->title . ' — WanderWise')
@section('meta_description', $post->excerpt)

@section('content')

{{-- Hero --}}
<div class="py-14 relative overflow-hidden"
     style="@if($post->image) background: url('{{ $post->image }}') center/cover; @else background: linear-gradient(135deg, {{ $post->category?->color ?? '#0EA5E9' }}cc, {{ $post->category?->color ?? '#0EA5E9' }}88); @endif">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <a href="{{ route('posts.index') }}"
           class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Blog
        </a>

        @if($post->category)
            <div class="mb-4">
                <span class="badge text-white border border-white/30 bg-white/20 backdrop-blur-sm text-sm px-4 py-1.5">
                    {{ $post->category->name }}
                </span>
            </div>
        @endif

        <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">{{ $post->title }}</h1>

        <div class="flex items-center justify-center gap-4 mt-6 text-white/70 text-sm">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr($post->author, 0, 1)) }}
                </span>
                {{ $post->author }}
            </div>
            <span>·</span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $post->read_time }} min read
            </span>
            @if($post->published_at)
                <span>·</span>
                <span>{{ $post->published_at->format('M d, Y') }}</span>
            @endif
        </div>
    </div>
</div>

{{-- Content --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        {{-- Article body --}}
        <article class="lg:col-span-3">
            <div class="card p-8 sm:p-10">
                <p class="text-xl text-gray-600 font-medium leading-relaxed border-l-4 pl-5 mb-8"
                   style="border-color: {{ $post->category?->color ?? '#0EA5E9' }};">
                    {{ $post->excerpt }}
                </p>

                <div class="prose prose-lg prose-gray max-w-none
                            prose-headings:font-bold prose-headings:text-gray-900
                            prose-p:leading-relaxed prose-p:text-gray-600
                            prose-a:text-sky-600 prose-a:no-underline hover:prose-a:underline">
                    {!! $post->content !!}
                </div>

                {{-- Tags --}}
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-wrap gap-2">
                    @if($post->category)
                        <span class="badge text-sm px-4 py-1.5 font-medium"
                              style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                            # {{ $post->category->name }}
                        </span>
                    @endif
                    <span class="badge bg-gray-100 text-gray-600 text-sm px-4 py-1.5">
                        # Travel
                    </span>
                </div>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside class="space-y-6">
            {{-- About author --}}
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-4">About the Author</h3>
                <div class="flex items-center gap-3">
                    <span class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-bold text-lg"
                          style="background-color: {{ $post->category?->color ?? '#0EA5E9' }};">
                        {{ strtoupper(substr($post->author, 0, 1)) }}
                    </span>
                    <div>
                        <div class="font-semibold text-gray-900">{{ $post->author }}</div>
                        <div class="text-xs text-gray-500">WanderWise Writer</div>
                    </div>
                </div>
            </div>

            {{-- Category CTA --}}
            @if($post->category)
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-2">More in {{ $post->category->name }}</h3>
                <p class="text-sm text-gray-500 mb-4">Explore more articles in this category.</p>
                <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}"
                   class="block text-center py-2.5 rounded-2xl text-sm font-semibold text-white transition-all hover:-translate-y-0.5"
                   style="background-color: {{ $post->category->color }};">
                    Browse {{ $post->category->name }}
                </a>
            </div>
            @endif

            {{-- Destinations CTA --}}
            <div class="card p-6 bg-gradient-to-br from-sky-500 to-blue-600 border-0 text-white">
                <h3 class="font-bold mb-2">Ready to Explore?</h3>
                <p class="text-white/75 text-sm mb-4">Find your next destination.</p>
                <a href="{{ route('destinations.index') }}" class="btn-secondary text-sm w-full justify-center">
                    View Destinations
                </a>
            </div>
        </aside>
    </div>

    {{-- Related Posts --}}
    @if($related->count())
        <div class="mt-14">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">You Might Also Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $relPost)
                    <a href="{{ route('posts.show', $relPost->slug) }}" class="card group overflow-hidden flex flex-col">
                        <div class="h-28 flex items-end p-4"
                             style="background: linear-gradient(135deg, {{ $relPost->category?->color ?? '#6B7280' }}99, {{ $relPost->category?->color ?? '#6B7280' }}cc);">
                            @if($relPost->category)
                                <span class="badge bg-white/90 text-xs" style="color: {{ $relPost->category->color }};">
                                    {{ $relPost->category->name }}
                                </span>
                            @endif
                        </div>
                        <div class="p-4 flex-1">
                            <h4 class="font-bold text-gray-900 text-sm leading-snug mb-2 group-hover:text-sky-600 transition-colors">
                                {{ $relPost->title }}
                            </h4>
                            <span class="text-xs text-gray-400">{{ $relPost->read_time }} min read</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection
