<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $siteName = \App\Models\SiteSetting::get('site_name', 'WanderWise');
        $siteDesc = \App\Models\SiteSetting::get('site_description', 'Practical travel guides for the USA and Europe, written from real experience.');
        $favicon  = \App\Models\SiteSetting::get('site_favicon_image');
    @endphp
    <meta name="description" content="@yield('meta_description', $siteDesc)">
    <title>@yield('title', $siteName) — Practical Travel Guides</title>
    @if($favicon)
        <link rel="icon" type="image/png" href="{{ $favicon }}">
    @elseif(file_exists(public_path('favicon.ico')))
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white font-sans text-gray-900 antialiased">

    {{-- ===== ADMIN BAR (visible only when logged in as admin) ===== --}}
    @auth
    @if(auth()->user()->is_admin)
    <div class="bg-white text-xs px-4 py-2 flex items-center justify-between sticky top-0 z-[100] border-b border-gray-200">
        <div class="flex items-center gap-2">
            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
            <span class="text-[13px] font-medium text-gray-600">Admin Mode</span>
        </div>
        <div class="flex items-center gap-4 text-[13px] font-medium text-gray-400">
            <span class="hidden md:inline">{{ request()->getHost() }}</span>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 rounded-md text-gray-600 hover:bg-gray-50 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Site</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 rounded-md text-gray-600 hover:bg-gray-50 transition">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endauth

    {{-- ===== NAVBAR ===== --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @php $logoUrl = \App\Models\SiteSetting::get('site_logo_image'); @endphp
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ \App\Models\SiteSetting::get('site_name', 'WanderWise') }}" class="h-8 w-auto">
                    @elseif(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="WanderWise" class="h-8 w-auto">
                    @elseif(file_exists(public_path('images/logo.svg')))
                        <img src="{{ asset('images/logo.svg') }}" alt="WanderWise" class="h-8 w-auto">
                    @else
                        <span class="text-lg font-extrabold text-gray-900 tracking-tight">
                            {{ \App\Models\SiteSetting::get('site_name', 'Wander') }}<span class="text-sky-500">{{ \App\Models\SiteSetting::get('site_name') ? '' : 'Wise' }}</span>
                        </span>
                    @endif
                </a>

                {{-- Nav --}}
                <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-sky-600 font-semibold' : 'hover:text-gray-900 transition-colors' }}">Home</a>
                    <a href="{{ route('destinations.index', ['region' => 'usa']) }}" class="{{ request()->routeIs('destinations.*') && request('region') === 'usa' ? 'text-sky-600 font-semibold' : 'hover:text-gray-900 transition-colors' }}">USA Travel</a>
                    <a href="{{ route('destinations.index', ['region' => 'europe']) }}" class="{{ request()->routeIs('destinations.*') && request('region') === 'europe' ? 'text-sky-600 font-semibold' : 'hover:text-gray-900 transition-colors' }}">Europe Travel</a>
                    <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'text-sky-600 font-semibold' : 'hover:text-gray-900 transition-colors' }}">Blog</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-sky-600 font-semibold' : 'hover:text-gray-900 transition-colors' }}">About</a>
                </div>

                {{-- Mobile menu btn --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div id="mobile-menu" class="hidden md:hidden py-3 pb-4 border-t border-gray-100 space-y-1 text-sm">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Home</a>
                <a href="{{ route('destinations.index', ['region' => 'usa']) }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">USA Travel</a>
                <a href="{{ route('destinations.index', ['region' => 'europe']) }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Europe Travel</a>
                <a href="{{ route('posts.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Blog</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">About</a>
            </div>
        </div>
    </nav>

    {{-- ===== CONTENT ===== --}}
    <main>@yield('content')</main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-slate-50 border-t border-slate-200 text-slate-500 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                {{-- Brand & Socials --}}
                <div class="md:col-span-1">
                    @php $footerLogoUrl = \App\Models\SiteSetting::get('site_logo_image'); @endphp
                    @if($footerLogoUrl)
                        <img src="{{ $footerLogoUrl }}" alt="{{ \App\Models\SiteSetting::get('site_name', 'WanderWise') }}" class="h-8 w-auto mb-5">
                    @elseif(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="WanderWise" class="h-8 w-auto mb-5">
                    @elseif(file_exists(public_path('images/logo.svg')))
                        <img src="{{ asset('images/logo.svg') }}" alt="WanderWise" class="h-8 w-auto mb-5">
                    @else
                        <div class="text-slate-900 font-extrabold text-2xl mb-5">
                            {{ \App\Models\SiteSetting::get('site_name', 'Wander') }}<span class="text-sky-600">{{ \App\Models\SiteSetting::get('site_name') ? '' : 'Wise' }}</span>
                        </div>
                    @endif
                    <p class="leading-relaxed mb-6">{{ \App\Models\SiteSetting::get('site_description', 'Practical travel guides for the USA and Europe — written from real experience.') }}</p>
                    
                    {{-- Social Media Links --}}
                    @php
                        $instagram = \App\Models\SiteSetting::get('social_instagram');
                        $facebook  = \App\Models\SiteSetting::get('social_facebook');
                        $twitter   = \App\Models\SiteSetting::get('social_twitter');
                    @endphp
                    
                    @if($instagram || $facebook || $twitter)
                    <div class="flex items-center gap-4">
                        @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-pink-600 transition-colors" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-blue-600 transition-colors" title="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        @endif
                        @if($twitter)
                        <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-indigo-500 transition-colors" title="Twitter / X">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- USA Travel --}}
                <div>
                    <h4 class="text-slate-900 font-bold mb-4 text-xs uppercase tracking-wider">USA Travel</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('destinations.show', 'new-york-city') }}" class="hover:text-sky-600 transition-colors">New York</a></li>
                        <li><a href="{{ route('destinations.show', 'los-angeles') }}" class="hover:text-sky-600 transition-colors">Los Angeles</a></li>
                        <li><a href="{{ route('destinations.show', 'san-francisco') }}" class="hover:text-sky-600 transition-colors">San Francisco</a></li>
                        <li><a href="{{ route('destinations.show', 'miami') }}" class="hover:text-sky-600 transition-colors">Miami</a></li>
                        <li><a href="{{ route('destinations.index', ['region' => 'usa']) }}" class="hover:text-sky-600 transition-colors font-medium">View All →</a></li>
                    </ul>
                </div>

                {{-- Europe Travel --}}
                <div>
                    <h4 class="text-slate-900 font-bold mb-4 text-xs uppercase tracking-wider">Europe Travel</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('destinations.show', 'paris') }}" class="hover:text-sky-600 transition-colors">Paris</a></li>
                        <li><a href="{{ route('destinations.show', 'rome') }}" class="hover:text-sky-600 transition-colors">Rome</a></li>
                        <li><a href="{{ route('destinations.show', 'barcelona') }}" class="hover:text-sky-600 transition-colors">Barcelona</a></li>
                        <li><a href="{{ route('destinations.show', 'amsterdam') }}" class="hover:text-sky-600 transition-colors">Amsterdam</a></li>
                        <li><a href="{{ route('destinations.index', ['region' => 'europe']) }}" class="hover:text-sky-600 transition-colors font-medium">View All →</a></li>
                    </ul>
                </div>

                {{-- More --}}
                <div>
                    <h4 class="text-slate-900 font-bold mb-4 text-xs uppercase tracking-wider">More</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('about') }}" class="hover:text-sky-600 transition-colors">About Us</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-sky-600 transition-colors">Blog</a></li>
                        <li><a href="{{ route('posts.index', ['category' => 'travel-tips']) }}" class="hover:text-sky-600 transition-colors">Travel Tips</a></li>
                        <li><a href="{{ route('posts.index', ['category' => 'itineraries']) }}" class="hover:text-sky-600 transition-colors">Itineraries</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-200 mt-16 pt-10 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-400">
                <p>© {{ date('Y') }} WanderWise. All rights reserved.</p>
                <div class="flex items-center gap-2">
                    <span class="font-medium text-slate-500">Made for travelers who love to explore.</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>
