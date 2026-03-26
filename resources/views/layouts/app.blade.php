<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name')) | Portfolio</title>
    <meta name="description" content="@yield('meta_description', 'Personal portfolio website of Dede Juniar Putra. Showcase of projects, skills, and professional achievements.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('app.name')) | Portfolio">
    <meta property="og:description" content="@yield('meta_description', 'Personal portfolio website of Dede Juniar Putra.')">
    <meta property="og:image" content="{{ asset('profile.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', config('app.name')) | Portfolio">
    <meta property="twitter:description" content="@yield('meta_description', 'Personal portfolio website of Dede Juniar Putra.')">
    <meta property="twitter:image" content="{{ asset('profile.jpg') }}">

    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" style="background:#0a0a0a">

<div class="max-w-6xl mx-auto flex min-h-screen relative">
    <!-- Sidebar -->
    <aside class="hidden md:flex w-72 shrink-0 border-r flex-col py-8 px-2.5 z-40 sticky top-0 h-screen overflow-y-auto" style="background:#0a0a0a;border-color:#1f1f1f;scrollbar-width:none;-ms-overflow-style:none;">
        <style>aside::-webkit-scrollbar { display: none; }</style>

        <!-- Profile Section -->
        <div class="flex flex-col items-center justify-center text-center mb-6 px-2">
            @php $profile = $profile ?? \App\Models\Profile::first(); @endphp
            <div class="relative mb-3">
                <img
                    src="/profile.jpg"
                    alt="Dede Juniar Putra - Software Developer Indonesia"
                    class="w-20 h-20 rounded-full object-cover border-2"
                    style="border-color:#2a2a2a"
                >
                <div class="absolute bottom-0 right-0 w-5 h-5 rounded-full bg-green-500 border-2" style="border-color:#0a0a0a"></div>
            </div>
            <div class="flex items-center gap-1.5 mb-2">
                <h2 class="font-extrabold text-lg text-white">{{ $profile->name ?? config('app.name') }}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-blue-500 shrink-0">
                  <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </div>
            <!-- Rotating Tagline Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 mt-1 rounded-full" style="background:rgba(0, 242, 255, 0.05); border:1px solid rgba(0, 242, 255, 0.2);">
                <!-- Glowing Dot -->
                <span class="relative flex h-2 w-2 shrink-0">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color:#00f2ff"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2" style="background-color:#00f2ff"></span>
                </span>
                <!-- Text -->
                <span id="rotating-tagline" class="text-xs font-extrabold transition-opacity duration-500" style="color:#0de282;">
                    Open To Work
                </span>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Rotating tagline
                    const texts = ['Open To Work', 'Hire Me', 'Relax for a moment'];
                    let currentIndex = 1;
                    const desktopEl = document.getElementById('rotating-tagline');
                    const mobileEl = document.getElementById('mobile-rotating-tagline');
                    const elements = [desktopEl, mobileEl].filter(el => el !== null);

                    if(elements.length > 0) {
                        setInterval(() => {
                            elements.forEach(el => el.style.opacity = '0');
                            setTimeout(() => {
                                elements.forEach(el => el.textContent = texts[currentIndex]);
                                elements.forEach(el => el.style.opacity = '1');
                                currentIndex = (currentIndex + 1) % texts.length;
                            }, 500); 
                        }, 3000);
                    }
                });
            </script>

            <!-- Social Icons in Pill -->
            <div class="flex items-center justify-center rounded-full mt-6 mb-5 px-3 py-1.5 gap-2 w-fit mx-auto" style="background:#161616; border:1px solid #222;">
                @if($profile && $profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:text-white hover:bg-[#2a2a2a] transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                @endif
                @if($profile && $profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:text-blue-400 hover:bg-[#2a2a2a] transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                @endif
                @if($profile && $profile->instagram)
                    <a href="{{ $profile->instagram }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:text-pink-400 hover:bg-[#2a2a2a] transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif
            </div>
            
            <div class="w-full h-px mb-4" style="background:rgba(255,255,255,0.03)"></div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-2.5 mt-2">
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active nav-active-glow' : '' }}">
                <div class="flex items-center gap-3 flex-1">
                    <svg class="w-6 h-6 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    <span class="text-[10px] font-black tracking-widest uppercase">Home</span>
                </div>
            </a>
            <a href="{{ route('about') }}" class="sidebar-link {{ request()->routeIs('about') ? 'active nav-active-glow' : '' }}">
                <div class="flex items-center gap-3 flex-1">
                    <svg class="w-6 h-6 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="text-[10px] font-black tracking-widest uppercase">About</span>
                </div>
            </a>
            <a href="{{ route('achievements') }}" class="sidebar-link {{ request()->routeIs('achievements') ? 'active nav-active-glow' : '' }}">
                <div class="flex items-center gap-3 flex-1">
                    <svg class="w-6 h-6 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
                    <span class="text-[10px] font-black tracking-widest uppercase">Award</span>
                </div>
            </a>
            <a href="{{ route('projects') }}" class="sidebar-link {{ request()->routeIs('projects') ? 'active nav-active-glow' : '' }}">
                <div class="flex items-center gap-3 flex-1">
                    <svg class="w-6 h-6 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.1 6.27a2 2 0 0 0 0 3.66l9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09a2 2 0 0 0 0-3.66z"/><path d="m2.1 14.74 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/><path d="m2.1 10.42 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/></svg>
                    <span class="text-[10px] font-black tracking-widest uppercase">Project</span>
                </div>
            </a>
            <a href="{{ route('contact') }}" class="sidebar-link {{ request()->routeIs('contact') ? 'active nav-active-glow' : '' }}">
                <div class="flex items-center gap-3 flex-1">
                    <svg class="w-6 h-6 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    <span class="text-[10px] font-black tracking-widest uppercase">Contact</span>
                </div>
            </a>
        </nav>

        <!-- Bottom: Login link -->
        <div class="border-t pt-6 mt-6" style="border-color:#1f1f1f">
            @auth
                <a href="{{ route('admin.profile.edit') }}" class="sidebar-link relative group block transition-all duration-300">
                    <div class="flex items-center justify-center py-2.5 px-4 rounded-xl hover:bg-[#161616] text-[#555] hover:text-primary-dark hover:nav-active-glow transition-all whitespace-nowrap">
                        <span class="text-xs font-bold uppercase tracking-widest">Admin Panel</span>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="sidebar-link relative group block transition-all duration-300">
                    <div class="flex items-center justify-center py-2.5 px-4 rounded-xl hover:bg-[#161616] text-[#555] hover:text-primary-dark hover:nav-active-glow transition-all whitespace-nowrap">
                        <span class="text-xs font-bold uppercase tracking-widest">Login</span>
                    </div>
                </a>
            @endauth
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-h-screen w-full pb-20 md:pb-0">
        <!-- Mobile Top Profile Header -->
        <header class="md:hidden sticky top-0 z-40 bg-surface/20 backdrop-blur-2xl border-b border-white/10 px-6 py-4 flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <img 
                        src="/profile.jpg" 
                        alt="{{ $profile->name ?? 'Profile' }}" 
                        class="w-10 h-10 rounded-full object-cover border border-white/10"
                    >
                    <div class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-green-500 border-2" style="border-color:#0a0a0a"></div>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <h1 class="text-sm font-extrabold text-white leading-tight">{{ $profile->name ?? config('app.name') }}</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-blue-500 shrink-0">
                            <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex items-center gap-1.5 min-h-[14px]">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color:#00f2ff"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5" style="background-color:#00f2ff"></span>
                        </span>
                        <span id="mobile-rotating-tagline" class="text-[10px] font-extrabold transition-opacity duration-500" style="color:#0de282;">
                            Open To Work
                        </span>
                    </div>
                </div>
            </div>

            @guest
                <a href="{{ route('login') }}" class="relative group px-4 py-2 rounded-xl bg-[#161616] border border-white/5 text-xs font-bold text-gray-400 hover:text-primary-dark hover:nav-active-glow transition-all active:scale-95 tracking-widest uppercase">
                    Login
                </a>
            @else
                <a href="{{ route('admin.profile.edit') }}" class="relative group px-4 py-2 rounded-xl bg-[#161616] border border-primary-dark/10 text-xs font-bold text-primary-dark hover:text-primary-dark hover:nav-active-glow transition-all active:scale-95 tracking-widest uppercase">
                    Admin
                </a>
            @endguest
        </header>

        <div class="px-6 md:px-10 py-10 md:py-16 max-w-4xl">
            @yield('content')
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-6 left-6 right-6 h-16 bg-[#161616]/80 backdrop-blur-xl border border-white/5 rounded-2xl flex items-center justify-around px-4 z-50 shadow-2xl">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-primary-dark nav-active-glow' : 'text-neutral-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span class="text-[10px] font-bold uppercase tracking-tighter">Home</span>
        </a>
        <a href="{{ route('about') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('about') ? 'text-primary-dark nav-active-glow' : 'text-neutral-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <span class="text-[10px] font-bold uppercase tracking-tighter">About</span>
        </a>
        <a href="{{ route('achievements') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('achievements') ? 'text-primary-dark nav-active-glow' : 'text-neutral-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
            <span class="text-[10px] font-bold uppercase tracking-tighter">Award</span>
        </a>
        <a href="{{ route('projects') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('projects') ? 'text-primary-dark nav-active-glow' : 'text-neutral-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.1 6.27a2 2 0 0 0 0 3.66l9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09a2 2 0 0 0 0-3.66z"/><path d="m2.1 14.74 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/><path d="m2.1 10.42 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/></svg>
            <span class="text-[10px] font-bold uppercase tracking-tighter">Project</span>
        </a>
        <a href="{{ route('contact') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('contact') ? 'text-primary-dark nav-active-glow' : 'text-neutral-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            <span class="text-[10px] font-bold uppercase tracking-tighter">Contact</span>
        </a>
    </nav>
</div>

@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Only run on desktop/fine-pointer devices
        if (window.matchMedia('(pointer: fine)').matches) {
            const dot = document.createElement('div');
            dot.className = 'cursor-dot';
            document.body.appendChild(dot);
 
            let mouseX = 0, mouseY = 0;
            let dotX = 0, dotY = 0;
            let isMoving = false;
            let lastSparkleTime = 0;

            const createSparkle = (x, y) => {
                const now = Date.now();
                if (now - lastSparkleTime < 25) return; 
                lastSparkleTime = now;

                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                
                const size = Math.random() * 4 + 2; 
                const duration = Math.random() * 0.5 + 0.5;
                const dx = (Math.random() - 0.5) * 80;
                const dy = (Math.random() - 0.5) * 80;

                const colors = ['#ffffff', '#ffcc00', '#ff9900', '#00f2ff', '#bd00ff'];
                const color = colors[Math.floor(Math.random() * colors.length)];

                sparkle.style.width = `${size}px`;
                sparkle.style.height = `${size}px`;
                sparkle.style.left = `${x}px`;
                sparkle.style.top = `${y}px`;
                sparkle.style.backgroundColor = color;
                sparkle.style.boxShadow = `0 0 10px ${color}, 0 0 20px ${color}`;
                sparkle.style.setProperty('--dx', `${dx}px`);
                sparkle.style.setProperty('--dy', `${dy}px`);
                sparkle.style.setProperty('--duration', `${duration}s`);

                document.body.appendChild(sparkle);
                setTimeout(() => sparkle.remove(), duration * 1000);
            };

            const updateCursor = () => {
                const lerp = 0.2;
                dotX += (mouseX - dotX) * lerp;
                dotY += (mouseY - dotY) * lerp;
                
                dot.style.left = dotX + 'px';
                dot.style.top = dotY + 'px';
                
                requestAnimationFrame(updateCursor);
            };
            updateCursor();
 
            window.addEventListener('mousemove', (e) => {
                if (!isMoving) {
                    dot.style.opacity = '1';
                    document.documentElement.classList.add('custom-cursor-active');
                    isMoving = true;
                }
                mouseX = e.clientX;
                mouseY = e.clientY;
                createSparkle(mouseX, mouseY);
            });

            // Hover detection
            const interactives = 'a, button, [role="button"], input, textarea, .code-tab, .sidebar-link';
            document.body.addEventListener('mouseover', (e) => {
                if (e.target.closest(interactives)) {
                    document.body.classList.add('cursor-hover');
                }
            });
            document.body.addEventListener('mouseout', (e) => {
                if (e.target.closest(interactives)) {
                    document.body.classList.remove('cursor-hover');
                }
            });

            // Hide if mouse leaves window
            document.addEventListener('mouseleave', () => {
                dot.style.opacity = '0';
            });
            document.addEventListener('mouseenter', () => {
                dot.style.opacity = '1';
            });
        }

        // Sample Framer Motion animation
        if (window.motion) {
            window.motion.animate(
                "main > div", 
                { opacity: [0, 1], y: [20, 0] }, 
                { duration: 0.8, ease: "easeOut" }
            );
        }
    });
</script>
</body>
</html>
