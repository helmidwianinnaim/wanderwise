{{-- Destination Card Partial --}}
<a href="{{ route('destinations.show', $destination->slug) }}"
   class="card group overflow-hidden flex flex-col block">

    {{-- Image / Gradient placeholder --}}
    <div class="relative h-44 overflow-hidden
        @if($destination->region === 'usa') bg-gradient-to-br from-sky-400 to-blue-600
        @else bg-gradient-to-br from-violet-400 to-purple-700 @endif">

        {{-- Region badge top-left --}}
        <div class="absolute top-3 left-3">
            <span class="badge text-white text-xs
                @if($destination->region === 'usa') bg-sky-500/80 @else bg-violet-500/80 @endif
                backdrop-blur-sm border border-white/20">
                {{ strtoupper($destination->region) }}
            </span>
        </div>

        {{-- Tag badge top-right --}}
        @if($destination->tag)
            <div class="absolute top-3 right-3">
                <span class="badge bg-white/90 text-gray-800 text-xs shadow-sm">
                    {{ $destination->tag }}
                </span>
            </div>
        @endif

        {{-- Decorative element --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-10 group-hover:opacity-20 transition-opacity">
            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>

        {{-- City name overlay --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/50">
            <h3 class="text-white font-bold text-lg leading-tight group-hover:text-sky-200 transition-colors">
                {{ $destination->name }}
            </h3>
            <p class="text-white/70 text-xs mt-0.5">{{ $destination->country }}</p>
        </div>
    </div>

    {{-- Card body --}}
    <div class="p-4 flex flex-col flex-1">
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 flex-1">
            {{ $destination->description }}
        </p>

        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
            {{-- Rating --}}
            <div class="flex items-center gap-1">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-3.5 h-3.5 {{ $i <= $destination->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
            {{-- Guides count --}}
            <span class="text-xs text-gray-400 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                {{ $destination->guides_count }} guides
            </span>
        </div>
    </div>
</a>
