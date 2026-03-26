<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#0a0a0a;font-family:Inter,sans-serif">

<div x-data="{ isSidebarOpen: false }" class="flex min-h-screen">
    <!-- Admin Sidebar -->
    <aside 
        :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        class="fixed left-0 top-0 h-full w-64 border-r flex flex-col pt-8 pb-6 px-4 z-50 transition-transform duration-300 ease-in-out md:sticky overflow-y-auto custom-scrollbar" 
        style="background:#0d0d0d;border-color:#1f1f1f"
    >
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 px-2">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl overflow-hidden border border-white/5 shadow-2xl group-hover:scale-110 transition-transform duration-300">
                    <img src="/logo.png" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-primary-dark group-hover:text-white transition-colors">Admin Panel</p>
                    <p class="text-[10px] font-bold text-gray-500 truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                </div>
            </a>
            <!-- Close button for mobile -->
            <button @click="isSidebarOpen = false" class="md:hidden p-1.5 rounded-lg bg-white/5 text-gray-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Nav -->
        <nav class="flex-1 space-y-1">
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active nav-active-glow' : 'hover:nav-active-glow' }} relative group block">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.profile.*') ? 'bg-[#161616] text-primary-dark shadow-[0_4px_20px_rgba(13,226,130,0.15)]' : 'text-gray-400 hover:text-primary-dark hover:bg-[#161616]' }}">
                    <svg class="w-4 h-4 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">Profile</span>
                </div>
            </a>
            <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active nav-active-glow' : 'hover:nav-active-glow' }} relative group block">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.skills.*') ? 'bg-[#161616] text-primary-dark shadow-[0_4px_20px_rgba(13,226,130,0.15)]' : 'text-gray-400 hover:text-primary-dark hover:bg-[#161616]' }}">
                    <svg class="w-4 h-4 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/><path d="m14.5 4-5 16"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">Skills</span>
                </div>
            </a>
            <a href="{{ route('admin.achievements.index') }}" class="sidebar-link {{ request()->routeIs('admin.achievements.*') ? 'active nav-active-glow' : 'hover:nav-active-glow' }} relative group block">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.achievements.*') ? 'bg-[#161616] text-primary-dark shadow-[0_4px_20px_rgba(13,226,130,0.15)]' : 'text-gray-400 hover:text-primary-dark hover:bg-[#161616]' }}">
                    <svg class="w-4 h-4 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.75z"/><path d="m9 12 2 2 4-4"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">Award</span>
                </div>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active nav-active-glow' : 'hover:nav-active-glow' }} relative group block">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.projects.*') ? 'bg-[#161616] text-primary-dark shadow-[0_4px_20px_rgba(13,226,130,0.15)]' : 'text-gray-400 hover:text-primary-dark hover:bg-[#161616]' }}">
                    <svg class="w-4 h-4 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.1 6.27a2 2 0 0 0 0 3.66l9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09a2 2 0 0 0 0-3.66z"/><path d="m2.1 14.74 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/><path d="m2.1 10.42 9.07 4.09a2 2 0 0 0 1.66 0l9.07-4.09"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">Project</span>
                </div>
            </a>
            <a href="{{ route('admin.tools.index') }}" class="sidebar-link {{ request()->routeIs('admin.tools.*') ? 'active nav-active-glow' : 'hover:nav-active-glow' }} relative group block">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.tools.*') ? 'bg-[#161616] text-primary-dark shadow-[0_4px_20px_rgba(13,226,130,0.15)]' : 'text-gray-400 hover:text-primary-dark hover:bg-[#161616]' }}">
                    <svg class="w-4 h-4 shrink-0 icon-container" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">Tools</span>
                </div>
            </a>
        </nav>

        <!-- Footer -->
        <div class="border-t pt-6 space-y-1 px-2" style="border-color:#1f1f1f">
            <a href="{{ route('home') }}" class="sidebar-link relative group block text-gray-500 hover:text-white transition-all" target="_blank">
                <div class="flex items-center gap-3 py-2.5 px-4 rounded-xl hover:bg-[#161616] transition-all hover:nav-active-glow">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="text-xs font-bold whitespace-nowrap">View Portfolio</span>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full py-2.5 px-4 rounded-xl text-xs font-bold text-rose-500/80 hover:text-rose-500 hover:bg-rose-500/5 transition-all">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span class="whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div 
        x-show="isSidebarOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="isSidebarOpen = false" 
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 md:hidden"
    ></div>

    <!-- Content -->
    <main class="flex-1 min-h-screen">
        <!-- Top bar (Mobile) -->
        <div class="md:hidden border-b px-6 py-4 flex items-center justify-between sticky top-0 z-30" style="background:rgba(10,10,10,0.8);backdrop-filter:blur(20px);border-color:#1f1f1f">
            <div class="flex items-center gap-4">
                <button @click="isSidebarOpen = true" class="p-2 -ml-2 rounded-xl bg-white/5 text-white hover:bg-white/10 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
                <h1 class="text-xs font-black uppercase tracking-[0.3em] text-white">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="w-8 h-8 rounded-lg overflow-hidden border border-white/5 shadow-lg">
                <img src="/logo.png" alt="Logo" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Top bar (Desktop) -->
        <div class="hidden md:flex border-b px-10 py-5 items-center justify-between sticky top-0 z-30" style="background:#0a0a0a;border-color:#1f1f1f">
            <h1 class="text-xs font-black uppercase tracking-[0.3em] text-primary-dark">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <div class="w-9 h-9 rounded-xl overflow-hidden border border-white/5 shadow-2xl">
                    <img src="/logo.png" alt="Logo" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div class="px-6 md:px-10 py-8 max-w-6xl">
            @yield('content')
        </div>
    </main>
</div>

@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Only run on desktop/fine-pointer devices
        if (window.matchMedia('(pointer: fine)').matches) {
            const dot = document.createElement('div');
            dot.className = 'cursor-dot';
            document.body.appendChild(dot);
 
            let mouseX = 0;
            let mouseY = 0;
            let isMoving = false;
            let lastSparkleTime = 0;

            const createSparkle = (x, y) => {
                const now = Date.now();
                if (now - lastSparkleTime < 25) return;
                lastSparkleTime = now;

                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                
                const size = Math.random() * 3 + 2;
                const duration = Math.random() * 0.4 + 0.4;
                const dx = (Math.random() - 0.5) * 50;
                const dy = (Math.random() - 0.5) * 50;

                sparkle.style.width = `${size}px`;
                sparkle.style.height = `${size}px`;
                sparkle.style.left = `${x}px`;
                sparkle.style.top = `${y}px`;
                sparkle.style.setProperty('--dx', `${dx}px`);
                sparkle.style.setProperty('--dy', `${dy}px`);
                sparkle.style.setProperty('--duration', `${duration}s`);

                document.body.appendChild(sparkle);
                setTimeout(() => sparkle.remove(), duration * 1000);
            };
 
            window.addEventListener('mousemove', (e) => {
                if (!isMoving) {
                    dot.style.opacity = '1';
                    document.documentElement.classList.add('custom-cursor-active');
                    isMoving = true;
                }
                mouseX = e.clientX;
                mouseY = e.clientY;
                dot.style.left = mouseX + 'px';
                dot.style.top = mouseY + 'px';

                createSparkle(mouseX, mouseY);
            });

            // Hover detection
            const interactives = 'a, button, [role="button"], input, textarea, select, .sidebar-link';
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

            document.addEventListener('mouseleave', () => {
                dot.style.opacity = '0';
            });
            document.addEventListener('mouseenter', () => {
                dot.style.opacity = '1';
            });
        }
    });
</script>
</body>
</html>
