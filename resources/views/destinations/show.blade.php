@extends('layouts.app')

@section('title', $destination->name . ' — WanderWise')
@section('meta_description', $destination->description)

@section('content')

{{-- Hero --}}
<div class="relative overflow-hidden min-h-[360px] flex items-end">
    {{-- Background image --}}
    @if($destination->image)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $destination->image }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    @else
        <div class="absolute inset-0 @if($destination->region === 'usa') bg-gradient-to-br from-sky-500 to-blue-700 @else bg-gradient-to-br from-violet-500 to-indigo-700 @endif"></div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="mb-4">
            <a href="{{ route('destinations.index', ['region' => $destination->region]) }}"
               class="inline-flex items-center gap-1.5 text-white/70 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to {{ ucfirst($destination->region) === 'Usa' ? 'USA Travel' : 'Europe Travel' }}
            </a>
        </div>

        <div class="flex flex-wrap items-start gap-3 mb-4">
            <span class="badge bg-white/20 text-white border border-white/30 backdrop-blur-sm text-xs">
                {{ strtoupper($destination->region) }}
            </span>
            @if($destination->tag)
                <span class="badge bg-white/90 text-gray-800 text-xs shadow">
                    {{ $destination->tag }}
                </span>
            @endif
        </div>

        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-2">{{ $destination->name }}</h1>
        <p class="text-white/70 text-lg flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ $destination->country }}
        </p>
    </div>
</div>

{{-- Content --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- About card --}}
            <div class="card p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About {{ $destination->name }}</h2>
                <p class="text-gray-600 text-lg leading-relaxed">{{ $destination->description }}</p>

                <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-gray-100">
                    <div class="text-center p-4 bg-gray-50 rounded-2xl">
                        <div class="text-2xl font-bold text-gray-900">{{ $destination->guides_count }}</div>
                        <div class="text-xs text-gray-500 mt-1">Guides Available</div>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-2xl">
                        <div class="flex justify-center gap-0.5 mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $destination->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <div class="text-xs text-gray-500">Rating</div>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-2xl">
                        @if($destination->featured)
                            <div class="text-2xl mb-1">⭐</div>
                            <div class="text-xs text-gray-500">Featured Pick</div>
                        @else
                            <div class="text-2xl mb-1">📍</div>
                            <div class="text-xs text-gray-500">{{ ucfirst($destination->region) }}</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Photo Gallery --}}
            @php
                $galleryPhotos = [
                    'new-york-city' => [
                        ['url'=>'https://images.unsplash.com/photo-1534430480872-3498386e7856?w=600&q=80','label'=>'Manhattan Skyline'],
                        ['url'=>'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=600&q=80','label'=>'Central Park'],
                        ['url'=>'https://images.unsplash.com/photo-1518235506717-e1ed3306a89b?w=600&q=80','label'=>'Brooklyn Bridge'],
                        ['url'=>'https://images.unsplash.com/photo-1419431069886-eba3f5311d15?w=600&q=80','label'=>'Times Square'],
                    ],
                    'los-angeles' => [
                        ['url'=>'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&q=80','label'=>'Hollywood Hills'],
                        ['url'=>'https://images.unsplash.com/photo-1507721999472-8ed4421c4af2?w=600&q=80','label'=>'Venice Beach'],
                        ['url'=>'https://images.unsplash.com/photo-1580655653885-65763b2597d1?w=600&q=80','label'=>'Santa Monica Pier'],
                        ['url'=>'https://images.unsplash.com/photo-1609924211018-5526c55bad5b?w=600&q=80','label'=>'Downtown LA'],
                    ],
                    'san-francisco' => [
                        ['url'=>'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=600&q=80','label'=>'Golden Gate Bridge'],
                        ['url'=>'https://images.unsplash.com/photo-1474552226712-ac0f0961a954?w=600&q=80','label'=>'Lombard Street'],
                        ['url'=>'https://images.unsplash.com/photo-1533294455009-a77b7557d2d1?w=600&q=80','label'=>'Fisherman\'s Wharf'],
                        ['url'=>'https://images.unsplash.com/photo-1506146332389-18140dc7b2fb?w=600&q=80','label'=>'Cable Car'],
                    ],
                    'miami' => [
                        ['url'=>'https://images.unsplash.com/photo-1529824604648-8d3f04f09d52?w=600&q=80','label'=>'South Beach'],
                        ['url'=>'https://images.unsplash.com/photo-1568128444624-8ec15aa0a35c?w=600&q=80','label'=>'Art Deco District'],
                        ['url'=>'https://images.unsplash.com/photo-1514214246283-d427a95c5d2f?w=600&q=80','label'=>'Wynwood Walls'],
                        ['url'=>'https://images.unsplash.com/photo-1543158181-e6f9f6712055?w=600&q=80','label'=>'Miami Nightlife'],
                    ],
                    'las-vegas' => [
                        ['url'=>'https://images.unsplash.com/photo-1581351721010-8cf859cb14a4?w=600&q=80','label'=>'The Strip at Night'],
                        ['url'=>'https://images.unsplash.com/photo-1563898960-3e21af2b9a56?w=600&q=80','label'=>'Fremont Street'],
                        ['url'=>'https://images.unsplash.com/photo-1572362727984-83ff4a02f4ab?w=600&q=80','label'=>'Grand Canyon Nearby'],
                        ['url'=>'https://images.unsplash.com/photo-1607462109225-6b64ae2dd3cb?w=600&q=80','label'=>'Casino Interiors'],
                    ],
                    'paris' => [
                        ['url'=>'https://images.unsplash.com/photo-1499856871958-5b9357976b82?w=600&q=80','label'=>'Eiffel Tower'],
                        ['url'=>'https://images.unsplash.com/photo-1553109648-be40c3b3b8c3?w=600&q=80','label'=>'Seine River'],
                        ['url'=>'https://images.unsplash.com/photo-1550340499-a6c60fc8287c?w=600&q=80','label'=>'Montmartre'],
                        ['url'=>'https://images.unsplash.com/photo-1464817739973-0128fe77aaa1?w=600&q=80','label'=>'Louvre Museum'],
                    ],
                    'rome' => [
                        ['url'=>'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&q=80','label'=>'Colosseum'],
                        ['url'=>'https://images.unsplash.com/photo-1555992336-03a23c7b20ee?w=600&q=80','label'=>'Trevi Fountain'],
                        ['url'=>'https://images.unsplash.com/photo-1531572753322-ad063cecc140?w=600&q=80','label'=>'Vatican'],
                        ['url'=>'https://images.unsplash.com/photo-1604580864964-0462f5d5b1a8?w=600&q=80','label'=>'Trastevere'],
                    ],
                    'barcelona' => [
                        ['url'=>'https://images.unsplash.com/photo-1583422409516-2895a77efded?w=600&q=80','label'=>'Sagrada Família'],
                        ['url'=>'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=600&q=80','label'=>'Gothic Quarter'],
                        ['url'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','label'=>'Park Güell'],
                        ['url'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80','label'=>'Barceloneta Beach'],
                    ],
                    'amsterdam' => [
                        ['url'=>'https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?w=600&q=80','label'=>'Canal Ring'],
                        ['url'=>'https://images.unsplash.com/photo-1512470876302-972faa2aa9a4?w=600&q=80','label'=>'City Canals'],
                        ['url'=>'https://images.unsplash.com/photo-1534351590666-13e3e96b5017?w=600&q=80','label'=>'Rijksmuseum'],
                        ['url'=>'https://images.unsplash.com/photo-1579275542618-a1dfed5f54ba?w=600&q=80','label'=>'Tulip Season'],
                    ],
                    'london' => [
                        ['url'=>'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=600&q=80','label'=>'Tower Bridge'],
                        ['url'=>'https://images.unsplash.com/photo-1529655683826-aba9b3e77383?w=600&q=80','label'=>'Big Ben'],
                        ['url'=>'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=600&q=80','label'=>'Borough Market'],
                        ['url'=>'https://images.unsplash.com/photo-1520986606214-8b456906c813?w=600&q=80','label'=>'Shoreditch'],
                    ],
                    'prague' => [
                        ['url'=>'https://images.unsplash.com/photo-1541849546-216549ae216d?w=600&q=80','label'=>'Old Town Square'],
                        ['url'=>'https://images.unsplash.com/photo-1592906209472-a36b1f3782ef?w=600&q=80','label'=>'Charles Bridge'],
                        ['url'=>'https://images.unsplash.com/photo-1568625503028-1dc3c028b2f5?w=600&q=80','label'=>'Prague Castle'],
                        ['url'=>'https://images.unsplash.com/photo-1519677100203-a0e668c92439?w=600&q=80','label'=>'Astronomical Clock'],
                    ],
                ];
                $photos = (is_array($destination->gallery_photos) && count($destination->gallery_photos) > 0) 
                    ? $destination->gallery_photos 
                    : ($galleryPhotos[$destination->slug] ?? []);
            @endphp

            @if(!empty($photos))
            <div class="card p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>📸</span> Photo Gallery — {{ $destination->name }}
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($photos as $i => $photo)
                    <div class="relative rounded-xl overflow-hidden {{ $i === 0 ? 'col-span-2 row-span-2 h-48' : 'h-24' }} group cursor-pointer">
                        <img src="{{ $photo['url'] }}"
                             alt="{{ $photo['label'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 lazy-img"
                             loading="lazy">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-white text-xs font-medium">{{ $photo['label'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Quick info --}}
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-4">Quick Info</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-3 text-gray-600">
                        <span class="w-8 h-8 bg-sky-50 rounded-xl flex items-center justify-center shrink-0">🌍</span>
                        <span><strong class="text-gray-900">Country:</strong> {{ $destination->country }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-600">
                        <span class="w-8 h-8 bg-sky-50 rounded-xl flex items-center justify-center shrink-0">🗺️</span>
                        <span><strong class="text-gray-900">Region:</strong> {{ ucfirst($destination->region) }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-600">
                        <span class="w-8 h-8 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">📚</span>
                        <span><strong class="text-gray-900">Guides:</strong> {{ $destination->guides_count }}</span>
                    </li>
                    @if($destination->tag)
                    <li class="flex items-center gap-3 text-gray-600">
                        <span class="w-8 h-8 bg-green-50 rounded-xl flex items-center justify-center shrink-0">🏷️</span>
                        <span><strong class="text-gray-900">Tag:</strong> {{ $destination->tag }}</span>
                    </li>
                    @endif
                </ul>
            </div>

            {{-- CTA --}}
            <div class="card p-6 bg-gradient-to-br from-sky-500 to-blue-600 text-white border-0">
                <h3 class="font-bold mb-2">Read Travel Guides</h3>
                <p class="text-white/75 text-sm mb-4">Explore articles and tips for {{ $destination->name }}.</p>
                <a href="{{ route('posts.index') }}" class="btn-secondary text-sm w-full justify-center">
                    Browse the Blog
                </a>
            </div>
        </div>
    </div>

    {{-- Related --}}
    @if($related->count())
        <div class="mt-14">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">More in {{ ucfirst($destination->region) }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($related as $dest)
                    @include('partials.destination-card', ['destination' => $dest])
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection
