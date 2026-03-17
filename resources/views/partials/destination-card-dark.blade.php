@php
    $colors = [
        'new-york-city' => '#0369a1, #0ea5e9',
        'paris'         => '#be123c, #fb7185',
        'rome'          => '#6d28d9, #a78bfa',
        'miami'         => '#c2410c, #fb923c',
        'barcelona'     => '#1d4ed8, #60a5fa',
        'san-francisco' => '#1e293b, #475569',
        'los-angeles'   => '#b45309, #fbbf24',
        'amsterdam'     => '#0f766e, #2dd4bf',
        'london'        => '#4c1d95, #8b5cf6',
        'prague'        => '#15803d, #4ade80',
        'las-vegas'     => '#047857, #34d399',
    ];
    $bg = $colors[$destination->slug] ?? ($destination->region === 'usa' ? '#0369a1, #0ea5e9' : '#6d28d9, #a78bfa');
@endphp

<a href="{{ route('destinations.show', $destination->slug) }}"
   class="group relative rounded-2xl overflow-hidden flex flex-col justify-end min-h-52 shadow-lg hover:-translate-y-1 transition-all duration-300">

    {{-- Background: real photo or gradient fallback --}}
    @if($destination->image)
        <img src="{{ $destination->image }}"
             alt="{{ $destination->name }}"
             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $bg }});"></div>
    @endif

    {{-- Gradient overlay bottom --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>

    {{-- Badges --}}
    <div class="absolute top-3 left-3 right-3 flex items-start justify-between gap-2">
        <span class="badge text-xs font-bold text-white uppercase tracking-wider
            {{ $destination->region === 'usa' ? 'bg-sky-500/80' : 'bg-violet-500/80' }}">
            {{ $destination->region === 'usa' ? '🇺🇸 USA' : '🇪🇺 EU' }}
        </span>
        @if($destination->tag)
        <span class="badge bg-black/40 text-white text-xs backdrop-blur-sm border border-white/10">
            {{ $destination->tag }}
        </span>
        @endif
    </div>

    {{-- Content --}}
    <div class="relative p-5">
        <h3 class="text-white font-bold text-lg leading-tight group-hover:text-sky-200 transition-colors">
            {{ $destination->name }}
        </h3>
        <p class="text-white/60 text-xs mt-0.5 mb-3">{{ $destination->country }}</p>
        <p class="text-white/70 text-sm leading-relaxed line-clamp-2 mb-3">{{ $destination->description }}</p>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-0.5">
                @for($i=1;$i<=5;$i++)
                <svg class="w-3 h-3 {{ $i <= $destination->rating ? 'text-amber-400' : 'text-white/20' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                @endfor
            </div>
            <span class="text-white/50 text-xs">{{ $destination->guides_count }} guides</span>
        </div>
    </div>
</a>
