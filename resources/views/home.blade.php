@extends('layouts.app')

@section('title', 'WanderWise — Practical Travel Guides for USA & Europe')
@section('meta_description', 'Practical travel guides for the USA and Europe — written from real experience. Find destinations, itineraries, and honest tips.')

@section('content')

{{-- ===== HERO ===== --}}
<section class="bg-white text-gray-900 overflow-hidden relative">
    {{-- Decorative subtle background gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-sky-50/50 via-white to-white pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            {{-- Left: copy --}}
            <div>
                <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-4">USA & Europe Travel Guides</p>
                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight text-gray-900">
                    Travel Smarter.<br>
                    Explore <span class="text-sky-500 italic">Further.</span>
                </h1>
                <p class="mt-5 text-gray-500 text-base sm:text-lg leading-relaxed max-w-lg">
                    Practical guides, honest tips, and real itineraries for the USA and Europe — written by people who've actually been there.
                </p>

                {{-- Stats with countUp animation via vanilla JS (using IDs) --}}
                <div class="flex items-center gap-8 mt-8">
                    <div>
                        <div class="text-2xl font-extrabold text-gray-900" id="stat-dest">{{ $destinationsCount }}+</div>
                        <div class="text-xs text-gray-500 mt-0.5 font-medium">Destinations</div>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div>
                        <div class="text-2xl font-extrabold text-gray-900" id="stat-art">{{ $articlesCount }}+</div>
                        <div class="text-xs text-gray-500 mt-0.5 font-medium">Articles</div>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div>
                        <div class="text-2xl font-extrabold text-gray-900" id="stat-itin">{{ $itinerariesCount }}+</div>
                        <div class="text-xs text-gray-500 mt-0.5 font-medium">Itineraries</div>
                    </div>
                </div>

                {{-- Live Search Component --}}
                <div x-data="liveSearch()" class="mt-8 w-full max-w-md relative z-50">
                    <div class="flex gap-2 relative">
                        <div class="flex-1 relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="q" x-model="query" x-ref="searchInput"
                                   @input.debounce.300ms="fetchResults"
                                   @focus="open = true"
                                   @click.away="open = false"
                                   @keydown.enter.prevent="doSearch()"
                                   :placeholder="currentPlaceholder"
                                   autocomplete="off"
                                   class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 shadow-sm rounded-full text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition-all">
                        </div>
                        <button type="button"
                                @click="doSearch()"
                                class="px-6 py-3 bg-sky-500 hover:bg-sky-400 text-white font-semibold text-sm rounded-full shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Search
                        </button>
                    </div>

                    {{-- Dropdown Results --}}
                    <div x-show="open && (query.length > 0)" x-transition.opacity
                         class="absolute top-14 left-0 w-full bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden py-2" style="display: none;">
                        
                        {{-- Loading State --}}
                        <div x-show="loading" class="px-4 py-3 text-center text-sm text-gray-400">Searching...</div>
                        
                        {{-- Results --}}
                        <template x-if="!loading && results.length > 0">
                            <div>
                                <template x-for="item in results" :key="item.id">
                                    <a :href="'/destinations/' + item.slug" @click.prevent="goToResult(item)" class="flex items-center gap-4 px-4 py-3 hover:bg-sky-50 transition-colors border-b border-gray-50 last:border-0">
                                        {{-- Thumbnail --}}
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 shrink-0 overflow-hidden shadow-sm">
                                            <img x-show="item.image" :src="item.image.startsWith('http') ? item.image : '/storage/'+item.image" class="w-full h-full object-cover">
                                            <div x-show="!item.image" class="w-full h-full bg-gradient-to-br from-sky-400 to-blue-600"></div>
                                        </div>
                                        {{-- Content --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="text-base font-bold text-gray-900 truncate" x-text="item.name"></div>
                                            <div class="text-xs text-gray-500 truncate mt-0.5">
                                                <span x-text="item.country"></span> <span class="mx-1 text-gray-300">•</span> <span class="capitalize" x-text="item.region"></span>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </template>

                        {{-- Empty State (Custom Not Found) --}}
                        <div x-show="!loading && results.length === 0 && query.length > 1" class="px-5 py-6 text-center">
                            <div class="text-4xl mb-3">🗺️</div>
                            <h4 class="font-bold text-gray-900 text-base mb-2">Not in our guides yet</h4>
                            <p class="text-xs text-gray-500 mb-4 mx-auto leading-relaxed">
                                We currently cover destinations in the USA and Europe only. '<span x-text="query" class="font-semibold text-gray-700"></span>' isn't in our guides yet — but here are some places we love:
                            </p>
                            <div class="flex flex-col gap-2 text-left mb-4">
                                @php
                                    $suggestions = \App\Models\Destination::whereIn('slug', ['new-york-city', 'paris', 'rome'])->get();
                                @endphp
                                @foreach($suggestions as $sg)
                                    <a href="{{ route('destinations.show', $sg->slug) }}" class="text-sm font-medium text-gray-700 hover:text-sky-600 bg-gray-50 rounded-lg px-3 py-2 flex items-center justify-between group transition-colors">
                                        <span>{{ $sg->name }}</span>
                                        <span class="text-gray-300 group-hover:text-sky-400">→</span>
                                    </a>
                                @endforeach
                            </div>
                            <p class="text-[11px] font-medium text-gray-400 border-t border-gray-100 pt-3">
                                📍 Our guides currently cover: United States & Europe
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Right: Real destination photos --}}
            <div class="hidden lg:block relative">
                {{-- Main large photo --}}
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('destinations.show', 'new-york-city') }}"
                       class="col-span-1 row-span-2 relative rounded-2xl overflow-hidden h-72 group shadow-xl">
                        <img src="https://images.unsplash.com/photo-1500916434205-0c77489c6cf7?w=600&q=80"
                             alt="New York City"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <span class="text-xs text-sky-300 font-semibold uppercase tracking-wider">#1 Most Visited · 🇺🇸 USA</span>
                            <h3 class="text-white font-bold text-lg leading-tight">New York City</h3>
                            <p class="text-white/60 text-xs">The City That Never Sleeps</p>
                        </div>
                    </a>
                    <a href="{{ route('destinations.show', 'paris') }}"
                       class="relative rounded-2xl overflow-hidden h-[136px] group shadow-xl">
                        <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=400&q=80"
                             alt="Paris"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <span class="text-xs text-white/60 uppercase tracking-wider font-semibold">🇫🇷 France</span>
                            <h3 class="text-white font-bold text-sm">Paris</h3>
                        </div>
                    </a>
                    <a href="{{ route('destinations.show', 'rome') }}"
                       class="relative rounded-2xl overflow-hidden h-[136px] group shadow-xl">
                        <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=400&q=80"
                             alt="Rome"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <span class="text-xs text-white/60 uppercase tracking-wider font-semibold">🇮🇹 Italy</span>
                            <h3 class="text-white font-bold text-sm">Rome</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== WHERE WILL YOU GO NEXT ===== --}}
<section class="py-14 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-sky-500 text-xs font-semibold uppercase tracking-widest mb-1">Featured Destinations</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Where Will You Go Next?</h2>
            </div>
            <a href="{{ route('destinations.index') }}"
               class="hidden sm:inline-flex text-sm text-sky-600 font-semibold hover:text-sky-700 transition-colors items-center gap-1">
                View all cities →
            </a>
        </div>

        {{-- USA --}}
        <div class="mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">🇺🇸 United States</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            @foreach($featuredUsaDestinations->take(3) as $dest)
                @include('partials.destination-card-dark', ['destination' => $dest])
            @endforeach
        </div>

        {{-- Europe --}}
        <div class="mb-3">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">🇪🇺 Europe</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredEuropeDestinations->take(3) as $dest)
                @include('partials.destination-card-dark', ['destination' => $dest])
            @endforeach
        </div>
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="py-14 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['n'=>'01','title'=>'Find Your Destination','desc'=>'Browse 120+ curated destination guides for the USA and Europe.'],
                ['n'=>'02','title'=>'Pick an Itinerary','desc'=>'Choose from 500+ itineraries covering every budget and travel style.'],
                ['n'=>'03','title'=>'Read the Tips','desc'=>'Get insiders advice on flights, hotels, restaurants, & things to do.'],
                ['n'=>'04','title'=>'Travel with Confidence','desc'=>'Pack your bags knowing everything you need to explore awaits.'],
            ] as $step)
            <div class="flex gap-4">
                <div class="text-3xl font-extrabold text-gray-100 leading-none select-none shrink-0">{{ $step['n'] }}</div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1.5 text-sm">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== LATEST GUIDES / BLOG ===== --}}
<section class="py-14 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-sky-500 text-xs font-semibold uppercase tracking-widest mb-1">Latest Guides</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">From the Blog</h2>
            </div>
            <a href="{{ route('posts.index') }}" class="hidden sm:inline-flex text-sm text-sky-600 font-semibold hover:text-sky-700 transition-colors">All articles →</a>
        </div>

        @php $hero = $latestPosts->first(); $rest = $latestPosts->skip(1)->take(4); @endphp

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            {{-- Hero post --}}
            @if($hero)
            <a href="{{ route('posts.show', $hero->slug) }}"
               class="lg:col-span-2 group relative rounded-2xl overflow-hidden flex flex-col justify-end min-h-64 shadow-lg">
                {{-- Background image or gradient --}}
                @if($hero->image)
                    <img src="{{ $hero->image }}" alt="{{ $hero->title }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $hero->category?->color ?? '#0EA5E9' }}dd, #111);"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                <div class="relative p-6">
                    @if($hero->featured)
                        <span class="badge bg-sky-500 text-white text-xs mb-3">★ Featured Article</span>
                    @endif
                    @if($hero->category)
                        <span class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: {{ $hero->category->color }};">{{ $hero->category->name }}</span>
                    @endif
                    <h3 class="text-white font-bold text-lg leading-snug group-hover:text-sky-200 transition-colors">{{ $hero->title }}</h3>
                    <p class="text-white/60 text-sm mt-2 line-clamp-2">{{ $hero->excerpt }}</p>
                    <div class="flex items-center gap-3 mt-4 text-xs text-white/50">
                        <span>{{ $hero->author }}</span>
                        <span>·</span>
                        <span>{{ $hero->published_at?->format('M j, Y') }}</span>
                        <span>·</span>
                        <span>{{ $hero->read_time }} min</span>
                    </div>
                </div>
            </a>
            @endif

            {{-- Other posts grid --}}
            <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach($rest as $post)
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col">
                    <div class="h-40 relative overflow-hidden">
                        @if($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        @else
                            <div class="w-full h-full" style="background: linear-gradient(135deg, {{ $post->category?->color ?? '#6B7280' }}cc, {{ $post->category?->color ?? '#6B7280' }}66);"></div>
                        @endif
                        @if($post->category)
                        <span class="absolute top-3 left-3 badge bg-white/90 text-xs font-semibold" style="color:{{ $post->category->color }};">
                            {{ $post->category->name }}
                        </span>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <h4 class="font-bold text-gray-900 text-sm leading-snug mb-1 group-hover:text-sky-600 transition-colors line-clamp-2">{{ $post->title }}</h4>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 flex-1">{{ $post->excerpt }}</p>
                        <div class="flex items-center gap-2 mt-3 text-xs text-gray-400">
                            <span class="w-5 h-5 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600 text-xs">{{ strtoupper(substr($post->author,0,1)) }}</span>
                            <span>{{ $post->author }}</span>
                            <span>·</span>
                            <span>{{ $post->read_time }} min</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('liveSearch', () => ({
            query: '',
            results: [],
            loading: false,
            open: false,
            placeholders: [
                "Search a destination... e.g. New York",
                "Search a destination... e.g. Paris",
                "Search a destination... e.g. Rome",
                "Search a destination... e.g. Barcelona",
                "Search a destination... e.g. Prague"
            ],
            currentPlaceholder: "Search a destination... e.g. New York",
            placeholderIndex: 0,
            
            init() {
                // Feature 1: Auto Focus on First Load
                setTimeout(() => {
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    }
                }, 100);

                // Feature 1: Animate Placeholder
                setInterval(() => {
                    this.placeholderIndex = (this.placeholderIndex + 1) % this.placeholders.length;
                    this.currentPlaceholder = this.placeholders[this.placeholderIndex];
                }, 2500);
            },

            async fetchResults() {
                if (this.query.trim().length < 2) {
                    this.results = [];
                    this.open = false;
                    return;
                }
                
                this.loading = true;
                this.open = true;
                
                try {
                    const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
                    const data = await response.json();
                    this.results = data;
                } catch (error) {
                    console.error("Error fetching search results", error);
                    this.results = [];
                } finally {
                    this.loading = false;
                }
            },

            async goToResult(item) {
                // Feature 6: Increment Search Count before redirect
                try {
                    await fetch('/api/search/increment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ id: item.id })
                    });
                } catch (error) {
                    console.error("Error incrementing search count", error);
                }
                
                // Redirect to destination
                window.location.href = `/destinations/${item.slug}`;
            },

            doSearch() {
                const q = this.query.trim();
                if (q.length < 2) {
                    // Show a hint on the input rather than navigating
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.classList.add('ring-2', 'ring-red-300', 'border-red-300');
                        this.$refs.searchInput.placeholder = 'Please type at least 2 characters...';
                        setTimeout(() => {
                            this.$refs.searchInput.classList.remove('ring-2', 'ring-red-300', 'border-red-300');
                            this.currentPlaceholder = this.placeholders[this.placeholderIndex];
                        }, 2000);
                        this.$refs.searchInput.focus();
                    }
                    return;
                }
                window.location.href = `/destinations?q=${encodeURIComponent(q)}`;
            }
        }));
    });

    // CountUp animation using IDs (runs after DOM ready)
    document.addEventListener('DOMContentLoaded', function() {
        function animateCount(id, target, duration = 1500) {
            const el = document.getElementById(id);
            if (!el || target <= 0) return;
            el.innerText = '0+';
            let startTime = null;
            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                el.innerText = Math.floor(progress * target) + '+';
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }
        animateCount('stat-dest', {{ $destinationsCount }});
        animateCount('stat-art', {{ $articlesCount }});
        animateCount('stat-itin', {{ $itinerariesCount }});
    });
</script>
@endpush
