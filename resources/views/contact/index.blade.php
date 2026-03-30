@extends('layouts.app')
@section('title', 'Contact')
@section('content')
@php $profile = $profile ?? \App\Models\Profile::first(); @endphp
<div class="animate-fade-in-up stagger-1">
    <div class="section-title mb-2">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        Contact
    </div>
    <p class="text-[15px] font-medium mb-10 text-gray-400">Let's get in touch.</p>

    <!-- Social Media Section -->
    <div class="space-y-6">
        <div class="pt-8 border-t border-dashed border-gray-800">
            <h2 class="text-[16px] font-bold text-gray-100 mb-8">Find me on social media</h2>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- GMAIL (Large) -->
            <div class="md:col-span-2 group relative overflow-hidden rounded-2xl bg-linear-to-br from-[#b91c1c] via-[#7f1d1d] to-black border border-white/5 p-8 transition-all duration-500 hover:scale-[1.01] hover:shadow-2xl hover:shadow-red-900/20">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Stay Connected</h3>
                        <p class="text-white/70 text-sm font-medium max-w-md leading-relaxed">Reach out via email for any inquiries or collaborations.</p>
                    </div>
                    <div class="mt-8 flex items-end justify-between">
                        <a href="mailto:dedejuniarputra99@gmail.com" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white px-6 py-2.5 rounded-xl text-sm font-black transition-all">
                            Go to Gmail
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <!-- Gmail Icon -->
                        <div class="w-16 h-16 text-white opacity-90 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INSTAGRAM -->
            <div class="group relative overflow-hidden rounded-2xl bg-linear-to-tr from-[#facc15] via-[#ec4899] to-[#8b5cf6] border border-white/5 p-8 transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl hover:shadow-pink-500/10">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Follow My Journey</h3>
                        <p class="text-white/80 text-sm font-medium leading-relaxed">Follow my creative journey.</p>
                    </div>
                    <div class="mt-12 flex items-end justify-between">
                        <a href="https://www.instagram.com/dedejp_/" target="_blank" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white px-5 py-2.5 rounded-xl text-sm font-black transition-all">
                            Go to Instagram
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="w-14 h-14 text-white opacity-90 transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-6">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.669-.072-4.949-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LINKEDIN -->
            <div class="group relative overflow-hidden rounded-2xl bg-linear-to-br from-[#0284c7] via-[#0369a1] to-black border border-white/5 p-8 transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl hover:shadow-blue-500/10">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Let's Connect</h3>
                        <p class="text-white/80 text-sm font-medium leading-relaxed">Connect with me professionally.</p>
                    </div>
                    <div class="mt-12 flex items-end justify-between">
                        <a href="https://www.linkedin.com/in/dede-juniar-putra-2234032a1/" target="_blank" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white px-5 py-2.5 rounded-xl text-sm font-black transition-all">
                            Go to Linkedin
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="w-14 h-14 text-white opacity-90 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIKTOK -->
            <div class="group relative overflow-hidden rounded-2xl bg-linear-to-br from-border via-[#171717] to-black border border-white/5 p-8 transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl hover:shadow-white/5">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Join the Fun</h3>
                        <p class="text-white/60 text-sm font-medium leading-relaxed">Watch interesting and fun content.</p>
                    </div>
                    <div class="mt-12 flex items-end justify-between">
                        <a href="{{ $profile->tiktok ?? '#' }}" target="_blank" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-5 py-2.5 rounded-xl text-sm font-black transition-all">
                            Go to Tiktok
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="w-14 h-14 text-white opacity-90 transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-6">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.9-.39-2.82-.12-.89.26-1.7 1.07-2.02 1.96-.22.62-.22 1.3-.01 1.92.21.6.61 1.13 1.12 1.5.54.39 1.25.56 1.91.52 1.35-.07 2.61-.9 3.12-2.16.27-.64.33-1.35.32-2.06V.02z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GITHUB -->
            <div class="group relative overflow-hidden rounded-2xl bg-linear-to-br from-[#1e1b4b] via-[#0f172a] to-black border border-white/5 p-8 transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl hover:shadow-indigo-500/10">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Explore the Code</h3>
                        <p class="text-white/70 text-sm font-medium leading-relaxed">Explore my open-source work.</p>
                    </div>
                    <div class="mt-12 flex items-end justify-between">
                        <a href="https://github.com/dedejuniarputra" target="_blank" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-5 py-2.5 rounded-xl text-sm font-black transition-all">
                            Go to Github
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="w-14 h-14 text-white opacity-90 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
