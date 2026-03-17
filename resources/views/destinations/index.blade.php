@extends('layouts.app')

@section('title', ($region === 'usa' ? 'USA Travel' : ($region === 'europe' ? 'Europe Travel' : 'Destinations')) . ' — WanderWise')
@section('meta_description', $region === 'usa' ? 'Explore the best cities in the United States — New York, LA, San Francisco, Miami and more.' : 'Discover Europe\'s top destinations — Paris, Rome, Barcelona, Amsterdam and beyond.')

@section('content')

{{-- ===== HERO ===== --}}
@php
    $heroBg = 'bg-gray-950'; // default all
    if ($region === 'usa') $heroBg = 'bg-gradient-to-r from-[#0d1f3b] md:via-[#132c4d] to-[#1c385c]';
    if ($region === 'europe') $heroBg = 'bg-gradient-to-r from-[#6b2515] md:via-[#8a331c] to-[#aa472a]'; 
@endphp
<div class="{{ $heroBg }} text-white relative overflow-hidden">
    {{-- Optional Watermark (USA / EU) based on mockup --}}
    @if($region === 'usa')
        <div class="absolute right-0 top-1/2 -translate-y-1/2 text-[300px] font-extrabold text-white/5 pointer-events-none select-none leading-none -mr-10">USA</div>
    @elseif($region === 'europe')
        <div class="absolute right-0 top-1/2 -translate-y-1/2 text-[300px] font-extrabold text-white/5 pointer-events-none select-none leading-none mr-10">EU</div>
    @endif
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div>
                {{-- Breadcrumb --}}
                @php
                    $filterLabels = ['east-coast'=>'East Coast','west-coast'=>'West Coast','national-parks'=>'National Parks','budget'=>'Budget-Friendly','western-europe'=>'Western Europe','mediterranean'=>'Mediterranean','uk'=>'United Kingdom','czech'=>'Czech Republic','france'=>'France','italy'=>'Italy','spain'=>'Spain'];
                    $breadcrumbRegion = $region === 'usa' ? 'USA Travel' : ($region === 'europe' ? 'Europe Travel' : 'All Destinations');
                @endphp
                <nav class="text-xs text-gray-500 mb-4 flex items-center gap-1.5">
                    <a href="{{ route('home') }}" class="hover:text-gray-300 transition-colors">Home</a>
                    <span>/</span>
                    @if($filter !== '')
                        <a href="{{ route('destinations.index', array_filter(['region' => $region !== 'all' ? $region : null])) }}" class="hover:text-gray-300 transition-colors">{{ $breadcrumbRegion }}</a>
                        <span>/</span>
                        <span class="text-gray-300">{{ $filterLabels[(string)$filter] ?? $filter }}</span>
                    @else
                        <span class="text-gray-300">{{ $breadcrumbRegion }}</span>
                    @endif
                </nav>

                <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight mb-3">
                    @if($region === 'usa')
                        Explore the<br><span class="text-sky-400 italic">United States</span>
                    @elseif($region === 'europe')
                        Discover<br><span class="text-violet-400 italic">Beautiful Europe</span>
                    @else
                        All <span class="text-sky-400 italic">Destinations</span>
                    @endif
                </h1>

                <p class="text-gray-400 text-base leading-relaxed max-w-lg mb-6">
                    @if($region === 'usa')
                        From the iconic skyline of New York to the sun-soaked shores of Miami — your complete guide to America's most incredible destinations, written from real experience.
                    @elseif($region === 'europe')
                        From the romantic streets of Paris to the sun-drenched plazas of Rome — comprehensive guides, honest tips, and perfect itineraries for every European adventure.
                    @else
                        {{ $totalCount }} handpicked destinations across the USA and Europe, curated by experienced travelers.
                    @endif
                </p>

                {{-- Search term indicator --}}
                @if($searchQuery)
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-full text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Results for "<span class="font-semibold">{{ $searchQuery }}</span>"
                    <a href="{{ route('destinations.index') }}" class="ml-1 text-white/60 hover:text-white transition-colors text-xs font-medium">✕ Clear</a>
                </div>
                @endif
            </div>

            {{-- Stats (Moved to right column, replacing old pills) --}}
            @php
                $articlesTotal = \App\Models\Post::count();
                $itinerariesTotal = \App\Models\Post::whereHas('category', fn($q) => $q->where('name','like','%Itinerary%')->orWhere('slug','like','%itinerary%'))->count();
                if($itinerariesTotal === 0) $itinerariesTotal = \App\Models\Post::where('title','like','%Itinerary%')->orWhere('title','like','%Days%')->count();
            @endphp
            <div class="flex mt-6 lg:mt-0 lg:justify-end">
                <div class="inline-flex items-center gap-6 sm:gap-10 bg-white/5 backdrop-blur-md px-8 py-6 rounded-3xl border border-white/10 shadow-2xl">
                    <div class="text-center">
                        <div class="text-4xl font-extrabold text-white mb-1">{{ $region === 'usa' ? $usaCount : ($region === 'europe' ? $europeCount : $totalCount) }}+</div>
                        <div class="text-xs text-blue-200 uppercase tracking-widest font-bold">{{ $region === 'usa' ? 'US Cities' : 'Cities' }}</div>
                    </div>
                    <div class="h-12 w-px bg-white/20"></div>
                    <div class="text-center">
                        <div class="text-4xl font-extrabold text-white mb-1">{{ $articlesTotal > 0 ? $articlesTotal : '200' }}+</div>
                        <div class="text-xs text-blue-200 uppercase tracking-widest font-bold">Articles</div>
                    </div>
                    <div class="h-12 w-px bg-white/20"></div>
                    <div class="text-center">
                        <div class="text-4xl font-extrabold text-white mb-1">{{ $itinerariesTotal > 0 ? $itinerariesTotal : '40' }}+</div>
                        <div class="text-xs text-blue-200 uppercase tracking-widest font-bold">Itineraries</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== FILTER BAR ===== --}}
<div class="bg-white border-b border-gray-100 sticky top-14 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-3">
            <div class="flex gap-1.5 flex-wrap">

                @if($region === 'usa')
                    {{-- USA-specific filters --}}
                    <a href="{{ route('destinations.index', ['region' => 'usa']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === '' ? 'bg-sky-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🇺🇸 All USA
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'usa', 'filter' => 'east-coast']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'east-coast' ? 'bg-sky-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🗽 East Coast
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'usa', 'filter' => 'west-coast']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'west-coast' ? 'bg-sky-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🌉 West Coast
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'usa', 'filter' => 'national-parks']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'national-parks' ? 'bg-sky-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden md:inline-flex">
                        🏜️ National Parks
                    </a>
                    <a href="{{ route('destinations.index', ['filter' => 'budget']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'budget' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden md:inline-flex">
                        💰 Budget-Friendly
                    </a>

                @elseif($region === 'europe')
                    {{-- Europe-specific filters --}}
                    <a href="{{ route('destinations.index', ['region' => 'europe']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === '' ? 'bg-violet-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🇪🇺 All Europe
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'europe', 'filter' => 'western-europe']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'western-europe' ? 'bg-violet-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🗼 Western Europe
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'europe', 'filter' => 'mediterranean']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'mediterranean' ? 'bg-violet-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🏖️ Mediterranean
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'europe', 'filter' => 'uk']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'uk' ? 'bg-violet-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden sm:inline-flex">
                        🇬🇧 United Kingdom
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'europe', 'filter' => 'czech']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'czech' ? 'bg-violet-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden md:inline-flex">
                        🇨🇿 Czech Republic
                    </a>
                    <a href="{{ route('destinations.index', ['filter' => 'budget']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'budget' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden md:inline-flex">
                        💰 Budget-Friendly
                    </a>

                @else
                    {{-- All Destinations filters --}}
                    <a href="{{ route('destinations.index') }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === '' && $region === 'all' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        🌍 All Cities
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'usa']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all text-gray-500 hover:text-gray-900 hover:bg-gray-100">
                        🇺🇸 USA
                    </a>
                    <a href="{{ route('destinations.index', ['region' => 'europe']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all text-gray-500 hover:text-gray-900 hover:bg-gray-100">
                        🇪🇺 Europe
                    </a>
                    <a href="{{ route('destinations.index', ['filter' => 'budget']) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ $filter === 'budget' ? 'bg-amber-500 text-white' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} hidden sm:inline-flex">
                        💰 Budget-Friendly
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- ===== DESTINATION LIST (Landscape) + Sidebar ===== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        <div class="lg:col-span-3 space-y-6">
            @if ($destinations->count() > 0)
                @foreach ($destinations as $destination)
                @php
                    $colors = [
                        'new-york-city' => '#0369a1, #0ea5e9', // Blue
                        'paris'         => '#be123c, #fb7185', // Red/Pink
                        'rome'          => '#6d28d9, #a78bfa', // Purple
                        'miami'         => '#c2410c, #fb923c', // Orange
                        'barcelona'     => '#1d4ed8, #60a5fa', // Blue
                        'san-francisco' => '#1e293b, #475569', // Dark Slate
                        'los-angeles'   => '#b45309, #fbbf24', // Amber
                        'amsterdam'     => '#0f766e, #2dd4bf', // Teal
                        'london'        => '#4c1d95, #8b5cf6', // Violet
                        'prague'        => '#15803d, #4ade80', // Green
                        'las-vegas'     => '#047857, #34d399', // Emerald
                    ];
                    $bg = $colors[$destination->slug] ?? ($destination->region === 'usa' ? '#0369a1, #0ea5e9' : '#6d28d9, #a78bfa');
                @endphp
                <a href="{{ route('destinations.show', $destination->slug) }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 overflow-hidden flex flex-col sm:flex-row">

                {{-- Image thumbnail --}}
                    <div class="relative w-full sm:w-52 md:w-64 shrink-0 h-44 sm:h-auto overflow-hidden">
                        @if($destination->image)
                            <img src="{{ $destination->image }}"
                                 alt="{{ $destination->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        @else
                            <div class="w-full h-full" style="background: linear-gradient(135deg, {{ $bg }});"></div>
                        @endif
                        {{-- Tag badge --}}
                        @if($destination->tag)
                        <div class="absolute top-3 left-3">
                            <span class="badge text-xs font-semibold bg-black/40 text-white backdrop-blur-sm border border-white/10">
                                {{ $destination->tag }}
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 p-5 sm:p-6 flex flex-col justify-between min-w-0">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-sky-600 transition-colors leading-tight">
                                        {{ $destination->name }}
                                    </h3>
                                    <p class="text-sm font-semibold mt-0.5"
                                       style="color: {{ $destination->region === 'usa' ? '#0EA5E9' : '#8B5CF6' }};">
                                        {{ $destination->region === 'usa' ? 'City of ' . $destination->name : 'The ' . $destination->name }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    @for($i=1;$i<=5;$i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $destination->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                    <span class="text-xs text-gray-400 ml-1">{{ $destination->rating }}.0</span>
                                </div>
                            </div>

                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">{{ $destination->description }}</p>

                            {{-- Tags --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="badge text-xs {{ $destination->region === 'usa' ? 'bg-sky-50 text-sky-700' : 'bg-violet-50 text-violet-700' }}">
                                    {{ $destination->region === 'usa' ? '🏙️ City Break' : '🏛️ Culture' }}
                                </span>
                                <span class="badge text-xs bg-gray-100 text-gray-600">
                                    {{ $destination->region === 'usa' ? '🍕 Food Scene' : '🎨 Art & History' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-400 space-y-0.5">
                                <div>Best time: <span class="text-gray-600 font-medium">{{ $destination->region === 'usa' ? 'Apr–Jun, Sep–Nov' : 'Apr–May, Sep–Oct' }}</span></div>
                                <div>Stay: <span class="text-gray-600 font-medium">3–5 days</span> &nbsp;·&nbsp; Budget: <span class="text-gray-600 font-medium">$$–$$$</span></div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 hover:bg-sky-600 text-white text-xs font-semibold rounded-full transition-colors">
                                Read Guide
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            @else
                @if($noResults)
                {{-- Search Not Found State --}}
                <div class="col-span-full py-12">
                    <div class="max-w-lg mx-auto bg-white rounded-3xl border border-gray-100 shadow-sm p-8 text-center">
                        <div class="text-5xl mb-4">🗺️</div>
                        <h2 class="text-xl font-extrabold text-gray-900 mb-2">Not in our guides yet</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-2">
                            We currently cover destinations in the <strong>USA</strong> and <strong>Europe</strong> only.
                        </p>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            "<span class="font-semibold text-gray-700">{{ $searchQuery }}</span>" isn't in our guides yet — but here are some places we love:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                            @foreach($popularDestinations as $pop)
                            @php
                                $suggestColors = ['new-york-city'=>'#0369a1,#0ea5e9','paris'=>'#be123c,#fb7185','rome'=>'#6d28d9,#a78bfa','london'=>'#4c1d95,#8b5cf6','amsterdam'=>'#0f766e,#2dd4bf','barcelona'=>'#1d4ed8,#60a5fa'];
                                $suggestBg = $suggestColors[$pop->slug] ?? '#0369a1,#0ea5e9';
                            @endphp
                            <a href="{{ route('destinations.show', $pop->slug) }}"
                               class="flex flex-col items-center gap-2 p-4 rounded-2xl text-white font-bold text-sm hover:scale-105 transition-transform shadow-sm"
                               style="background: linear-gradient(135deg, {{ $suggestBg }});">
                                <span class="text-2xl">
                                    @if($pop->slug==='paris')🗼@elseif($pop->slug==='rome')🏛️@elseif($pop->slug==='new-york-city')🗽@elseif($pop->slug==='london')🎡@elseif($pop->slug==='amsterdam')🚲@elseif($pop->slug==='barcelona')🎨@else📍@endif
                                </span>
                                <span>{{ $pop->name }}</span>
                                <span class="text-white/70 text-xs font-normal">{{ $pop->country }}</span>
                            </a>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mb-4">📍 Our guides currently cover: United States & Europe</p>
                        <a href="{{ route('destinations.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-full transition-colors">
                            Browse all destinations →
                        </a>
                    </div>
                </div>
                @else
                <div class="text-center py-16 text-gray-400">
                    <p class="text-lg font-medium">No destinations found.</p>
                </div>
                @endif
            @endif
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-6">

            {{-- Quick Tip --}}
            <div class="bg-amber-50 rounded-2xl border border-amber-100 p-5">
                <h3 class="font-bold text-amber-900 mb-2 flex items-center gap-2 text-sm">
                    <span>💡</span> Quick Tip
                </h3>
                <p class="text-amber-800 text-xs leading-relaxed">
                    Book domestic flights 3–6 weeks in advance for the best fares. Use Google Flights price alerts to track your target routes automatically.
                </p>
            </div>

            {{-- Top Itineraries --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 text-sm">
                    <span class="text-lg">📋</span> Top Itineraries
                </h3>
                <ul class="space-y-2.5">
                    @foreach([['title'=>'NYC 5-Day Classic'],['title'=>'Pacific Coast Hwy'],['title'=>'Vegas + Grand Canyon'],['title'=>'Florida Road Trip']] as $it)
                    <li class="flex items-center justify-between text-sm">
                        <span class="text-gray-700">{{ $it['title'] }}</span>
                        <a href="{{ route('posts.index', ['category' => 'itineraries']) }}"
                           class="text-sky-500 hover:text-sky-600 text-xs font-semibold transition-colors">Guide →</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Popular blogs CTA --}}
            <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl p-5 text-white">
                <h3 class="font-bold mb-1 text-sm">📖 Latest Guides</h3>
                <p class="text-white/75 text-xs mb-3 leading-relaxed">Read our latest travel articles, tips, and itineraries.</p>
                <a href="{{ route('posts.index') }}" class="block text-center py-2 bg-white text-sky-600 text-sm font-semibold rounded-xl hover:bg-sky-50 transition-colors">
                    Browse the Blog →
                </a>
            </div>
        </aside>
    </div>
</div>



@endsection
