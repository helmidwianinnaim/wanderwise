<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — WanderWise CMS</title>
    <!-- Tailwind & Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        .nav-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200 text-sm font-medium; }
        .nav-link.active { @apply bg-sky-50 text-sky-700 font-semibold shadow-sm ring-1 ring-sky-600/10; }
        .nav-group { @apply text-[11px] font-bold uppercase tracking-widest text-slate-400 px-4 mt-6 mb-2; }
        .nav-icon { @apply w-5 h-5 text-slate-400 transition-colors duration-200; }
        .nav-link:hover .nav-icon { @apply text-slate-600; }
        .nav-link.active .nav-icon { @apply text-sky-600; }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-full min-h-screen">
        
        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-slate-900/40 z-20 lg:hidden backdrop-blur-sm" @click="sidebarOpen = false" style="display: none;"></div>

        {{-- ── Sidebar ──────────────────────────────────────── --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:static inset-y-0 left-0 w-64 bg-white flex flex-col flex-shrink-0 border-r border-slate-200 z-30 transition-transform duration-300 ease-in-out lg:translate-x-0">
            
            {{-- Logo --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center gap-1.5">
                    Wander<span class="text-sky-500">Wise</span>
                    <span class="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded-md border border-slate-200 relative -top-2">CMS</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-1">
                <p class="nav-group">Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h4v4H3zM3 15h4v4H3zM11 7h10M11 12h10M11 17h10"/></svg>
                    Dashboard
                </a>

                <p class="nav-group">Konten</p>
                <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Destinations
                </a>
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Blog Posts
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Kategori
                </a>

                <p class="nav-group">Halaman Statis</p>
                <a href="{{ route('admin.pages.edit', 'home') }}" class="nav-link {{ request()->is('admin/pages/home*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="{{ route('admin.pages.edit', 'about') }}" class="nav-link {{ request()->is('admin/pages/about*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tentang Kami
                </a>
                <a href="{{ route('admin.pages.edit', 'destinations') }}" class="nav-link {{ request()->is('admin/pages/destinations*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    Banner Destinations
                </a>
                <a href="{{ route('admin.pages.edit', 'blog') }}" class="nav-link {{ request()->is('admin/pages/blog*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Banner Blog
                </a>
                <a href="{{ route('admin.pages.edit', 'general') }}" class="nav-link {{ request()->is('admin/pages/general*') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Pengaturan Umum
                </a>
            </nav>

            {{-- Sidebar Footer --}}
            <div class="px-4 py-4 border-t border-slate-100 space-y-1 bg-slate-50/50">
                <a href="{{ url('/') }}" target="_blank" class="nav-link !text-slate-600">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Situs Publik
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile*') ? '!text-sky-600 !bg-sky-50' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Admin
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full text-left nav-link hover:!text-red-600 hover:!bg-red-50 transition-colors">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ── Main Content ──────────────────────────────────── --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            {{-- Top Header --}}
            <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-4 flex items-center justify-between z-10 sticky top-0 shadow-sm shadow-slate-200/20">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('page-subtitle')
                            <p class="text-slate-500 text-sm mt-0.5 font-medium hidden sm:block">@yield('page-subtitle')</p>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center gap-3 sm:gap-5">
                    @hasSection('header-action')
                        @yield('header-action')
                    @endif
                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 hover:opacity-80 transition group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors">{{ auth()->user()->name }}</p>
                            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-100 to-indigo-100 border border-sky-200 rounded-full flex items-center justify-center shadow-sm">
                            <span class="text-sky-700 font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </a>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="mx-4 sm:mx-8 mt-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200/60 text-emerald-800 rounded-xl px-4 py-3 text-sm shadow-sm font-medium">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="mx-4 sm:mx-8 mt-6 flex items-center gap-3 bg-red-50 border border-red-200/60 text-red-800 rounded-xl px-4 py-3 text-sm shadow-sm font-medium">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
