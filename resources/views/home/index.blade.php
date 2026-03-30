@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', $profile->bio ?? 'Personal portfolio website')

@section('content')
    <div id="home-content">
        <!-- Hero -->
        <section class="mb-12 animate-fade-in-up stagger-1">
            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-white mb-4">
                    Hi, I'm {{ $profile->name ?? 'Dede Juniar Putra' }} 👋
                </h1>
                <div class="flex items-center gap-4 mb-4 text-[15px] font-semibold text-gray-200">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $profile->location ?? 'Indonesia' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#10b981]"></span>
                        {{ $profile->status ?? 'Onsite' }}
                    </span>
                </div>
                <div class="space-y-3 text-[15px] font-medium leading-relaxed text-gray-300 text-justify">
                    <p>{{ $profile->bio ?? 'A passionate developer dedicated to building impactful digital solutions.' }}
                    </p>
                </div>
            </div>
            <!-- Interactive Code Snippet Component -->
            <div x-data="codeSnippet()" class="mt-8 animate-fade-in-up stagger-2">
                <!-- Tabs Above (Pill Layout) -->
                <div class="flex justify-center mb-6">
                    <div class="code-tab-container" x-ref="tabContainer">
                        <div x-ref="highlight" class="code-tab-highlight"></div>
                        <button @click="activeTab = 'javascript'; updateHighlight($el)"
                            :class="activeTab === 'javascript' ? 'active' : ''" class="code-tab"
                            x-init="if(activeTab === 'javascript') setTimeout(() => updateHighlight($el), 100)">Javascript</button>
                        <button @click="activeTab = 'python'; updateHighlight($el)"
                            :class="activeTab === 'python' ? 'active' : ''" class="code-tab">Python</button>
                        <button @click="activeTab = 'dart'; updateHighlight($el)"
                            :class="activeTab === 'dart' ? 'active' : ''" class="code-tab">Dart</button>
                    </div>
                </div>

                <!-- Code Window -->
                <div class="code-window">
                    <!-- Inline Copy Button -->
                    <button @click="copyCode()" class="btn-copy-inline group">
                        <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                        <svg x-show="copied" class="w-3.5 h-3.5 text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span x-text="copied ? 'Copied!' : 'Copy'"></span>
                    </button>

                    <div class="code-body">
                        <!-- Javascript View -->
                        <template x-if="activeTab === 'javascript'">
                            <div class="animate-fade-in">
                                <div class="code-line"><span class="line-number">1</span><span class="code-content"><span
                                            class="code-comment">// Javascript</span></span></div>
                                <div class="code-line"><span class="line-number">2</span><span class="code-content"><span class="code-keyword">const</span> <span class="code-variable">arr</span> =
                                        [<span class="code-string">"Dede"</span>, <span class="code-string">"Juniar"</span>,
                                        <span class="code-string">"Putra"</span>];</span></div>
                                <div class="code-line"><span class="line-number">3</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">4</span><span class="code-content"><span class="code-keyword">function</span> <span
                                            class="code-function">greeting</span>() {</span></div>
                                <div class="code-line active-line active-cursor"><span class="line-number">5</span><span
                                        class="code-content"> <span class="code-keyword">const</span> <span
                                            class="code-variable">name</span> = <span class="code-variable">arr</span>.<span
                                            class="code-method">find</span>((<span class="code-variable">item</span>) <span
                                            class="code-keyword-ctrl">=&gt;</span> <span class="code-variable">item</span>
                                        === <span class="code-string">"Dede"</span>);</span></div>
                                <div class="code-line active-line"><span class="line-number">6</span><span
                                        class="code-content"> <span class="code-keyword-ctrl">return</span> <span
                                            class="code-string">`Hello, I Am <span class="code-keyword-ctrl">${</span><span
                                                class="code-variable">name</span><span
                                                class="code-keyword-ctrl">}</span>!`</span>;</span></div>
                                <div class="code-line"><span class="line-number">7</span><span class="code-content">}</span>
                                </div>
                                <div class="code-line"><span class="line-number">8</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">9</span><span class="code-content"><span
                                            class="code-property">console</span>.<span class="code-method">log</span>(<span
                                            class="code-function">greeting</span>()); <span class="code-comment">// Hello, I
                                            Am Dede!</span></span></div>
                            </div>
                        </template>

                        <!-- Python View -->
                        <template x-if="activeTab === 'python'">
                            <div class="animate-fade-in">
                                <div class="code-line"><span class="line-number">1</span><span class="code-content"><span
                                            class="code-comment"># Python</span></span></div>
                                <div class="code-line"><span class="line-number">2</span><span class="code-content"><span
                                            class="code-variable">arr</span> = [<span class="code-string">"Dede"</span>,
                                        <span class="code-string">"Juniar"</span>, <span
                                            class="code-string">"Putra"</span>]</span></div>
                                <div class="code-line"><span class="line-number">3</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">4</span><span class="code-content"><span
                                            class="code-keyword">def</span> <span
                                            class="code-function">greeting</span>():</span></div>
                                <div class="code-line active-line active-cursor"><span class="line-number">5</span><span
                                        class="code-content"> <span class="code-variable">name</span> = <span
                                            class="code-function">next</span>((<span class="code-variable">item</span> <span
                                            class="code-keyword-ctrl">for</span> <span class="code-variable">item</span>
                                        <span class="code-keyword-ctrl">in</span> <span class="code-variable">arr</span>
                                        <span class="code-keyword-ctrl">if</span> <span class="code-variable">item</span> ==
                                        <span class="code-string">"Dede"</span>), <span
                                            class="code-keyword">None</span>)</span></div>
                                <div class="code-line active-line"><span class="line-number">6</span><span
                                        class="code-content"> <span class="code-keyword-ctrl">return</span> f<span
                                            class="code-string">"Hello, I Am <span class="code-keyword-ctrl">{</span><span
                                                class="code-variable">name</span><span
                                                class="code-keyword-ctrl">}</span>!"</span></span></div>
                                <div class="code-line"><span class="line-number">7</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">8</span><span class="code-content"><span
                                            class="code-function">print</span>(<span
                                            class="code-function">greeting</span>()) <span class="code-comment"># Hello, I
                                            Am Dede!</span></span></div>
                            </div>
                        </template>

                        <!-- Dart View -->
                        <template x-if="activeTab === 'dart'">
                            <div class="animate-fade-in">
                                <div class="code-line"><span class="line-number">1</span><span class="code-content"><span
                                            class="code-comment">// Dart</span></span></div>
                                <div class="code-line"><span class="line-number">2</span><span class="code-content"><span
                                            class="code-keyword">var</span> <span class="code-variable">arr</span> = [<span
                                            class="code-string">"Dede"</span>, <span class="code-string">"Juniar"</span>,
                                        <span class="code-string">"Putra"</span>];</span></div>
                                <div class="code-line"><span class="line-number">3</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">4</span><span class="code-content"><span
                                            class="code-type">String</span> <span class="code-function">greeting</span>()
                                        {</span></div>
                                <div class="code-line active-line active-cursor"><span class="line-number">5</span><span
                                        class="code-content"> <span class="code-keyword">var</span> <span
                                            class="code-variable">name</span> = <span class="code-variable">arr</span>.<span
                                            class="code-method">where</span>((<span class="code-variable">item</span>) <span
                                            class="code-keyword-ctrl">=&gt;</span> <span class="code-variable">item</span>
                                        == <span class="code-string">"Dede"</span>).<span
                                            class="code-property">firstOrNull</span>;</span></div>
                                <div class="code-line active-line"><span class="line-number">6</span><span
                                        class="code-content"> <span class="code-keyword-ctrl">return</span> <span
                                            class="code-string">"Hello, I Am <span class="code-keyword-ctrl">$</span><span
                                                class="code-variable">name</span>!"</span>;</span></div>
                                <div class="code-line"><span class="line-number">7</span><span class="code-content">}</span>
                                </div>
                                <div class="code-line"><span class="line-number">8</span><span class="code-content"></span>
                                </div>
                                <div class="code-line"><span class="line-number">9</span><span class="code-content"><span
                                            class="code-keyword">void</span> <span class="code-function">main</span>()
                                        {</span></div>
                                <div class="code-line"><span class="line-number">10</span><span class="code-content"> <span
                                            class="code-function">print</span>(<span
                                            class="code-function">greeting</span>()); <span class="code-comment">// Hello, I
                                            Am Dede!</span></span></div>
                                <div class="code-line"><span class="line-number">11</span><span
                                        class="code-content">}</span></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section class="animate-fade-in-up stagger-2">
            <div class="section-title text-gray-200 font-bold mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/><path d="m14.5 4-5 16"/></svg>
                Skills
            </div>
            <p class="text-[15px] font-medium mb-6 text-gray-400">My professional skills.</p>

            <!-- Category Filter (Alpine.js) -->
            <div x-data="{ 
                activeFilter: 'all', 
                showAll: false, 
                limit: 10,
                updateLimit() {
                    const width = window.innerWidth;
                    if (width >= 1024) this.limit = 10;
                    else if (width >= 768) this.limit = 8;
                    else this.limit = 6;
                }
            }" 
            x-init="updateLimit(); window.addEventListener('resize', () => updateLimit())">
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2.5 mb-8">
                    <!-- All Filter -->
                    <button @click="activeFilter = 'all'; showAll = false"
                        :class="activeFilter === 'all' ? 'bg-[#facc15] text-black border-[#facc15]' : 'bg-[#1a1a1a] text-gray-400 border-border hover:border-[#444]'"
                        class="flex items-center gap-1.5 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-[11px] sm:text-[13px] font-bold border transition-all cursor-pointer whitespace-nowrap">
                        All
                        <span :class="activeFilter === 'all' ? 'bg-black/10 text-black' : 'bg-border text-gray-500'"
                            class="px-1.5 sm:px-2 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold min-w-[18px] text-center">
                            {{ count($skills) }}
                        </span>
                    </button>

                    @foreach($categories as $cat)
                        @php
                            $catCount = collect($skills)->where('skill_category_id', $cat->id)->count();
                        @endphp
                        @if($catCount > 0)
                            <button @click="activeFilter = '{{ $cat->slug }}'; showAll = false"
                                :class="activeFilter === '{{ $cat->slug }}' ? 'bg-[#facc15] text-black border-[#facc15]' : 'bg-[#1a1a1a] text-gray-400 border-border hover:border-[#444]'"
                                class="flex items-center gap-1.5 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-[11px] sm:text-[13px] font-bold border transition-all cursor-pointer whitespace-nowrap">
                                {{ $cat->name }}
                                <span :class="activeFilter === '{{ $cat->slug }}' ? 'bg-black/10 text-black' : 'bg-border text-gray-500'"
                                    class="px-1.5 sm:px-2 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold min-w-[18px] text-center">
                                    {{ $catCount }}
                                </span>
                            </button>
                        @endif
                    @endforeach
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    @php $allIndex = 0; @endphp
                    @foreach($skills as $skill)
                        <div x-show="(activeFilter === 'all' || activeFilter === '{{ $skill->category->slug ?? '' }}') && (showAll || (activeFilter !== 'all' || {{ $allIndex }} < limit))"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="flex items-center gap-2 px-2 py-1.5 rounded-xl border border-border bg-[#1a1a1a] transition-all duration-300 hover:scale-[1.03] cursor-default group h-full">
                            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center transition-transform group-hover:scale-105" 
                                 style="background: {{ $skill->color }}15;">
                                @if($skill->icon && str_starts_with($skill->icon, 'devicon'))
                                    <i class="{{ $skill->icon }} text-[18px]" style="color: {{ $skill->color ?? '#ffffff' }}"></i>
                                @else
                                    <span class="w-2 h-2 rounded-full" style="background: {{ $skill->color ?? '#facc15' }}"></span>
                                @endif
                            </div>
                            <span class="text-[13px] font-bold text-gray-200 pr-1 whitespace-nowrap overflow-hidden" title="{{ $skill->name }}">{{ $skill->name }}</span>
                        </div>
                        @php $allIndex++; @endphp
                    @endforeach
                </div>

                <!-- Load More / Show Less Button -->
                <div x-show="activeFilter === 'all' && {{ count($skills) }} > limit" class="mt-8 flex justify-center">
                    <button @click="showAll = !showAll" 
                            class="relative px-6 py-2 rounded-full border border-white/5 bg-[#1a1a1a] text-gray-400 text-xs font-bold hover:bg-[#222] hover:text-white hover:border-primary-dark/50 transition-all duration-300 flex items-center gap-2 hover:shadow-[0_0_20px_rgba(13,226,130,0.2)] group">
                        <span x-text="showAll ? 'Show Less' : 'Load More'" class="relative z-10"></span>
                        <svg class="relative z-10 w-3.5 h-3.5 transition-transform duration-300" :class="showAll ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        <!-- Inner Glow (Green) -->
                        <div class="absolute inset-0 rounded-full bg-primary-dark/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    </button>
                </div>
            </div>
        </section>

        <!-- GitHub Activity Section -->
        <section class="mt-14 animate-fade-in-up stagger-3" x-data="githubActivity()">
            <div class="flex items-center justify-between mb-8">
                <div class="section-title text-gray-200 font-bold mb-0 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                    </svg>
                    GitHub Activity
                </div>
                <a href="https://github.com/dedejuniarputra" target="_blank"
                   class="text-sm font-bold text-gray-500 hover:text-white transition-colors">@dedejuniarputra</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Followers -->
                <div class="bg-[#0d1117] border border-[#30363d] rounded-2xl p-6 text-center hover:border-[#facc15]/30 transition-all group">
                    <div class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-1 group-hover:text-gray-400 transition-colors">Followers</div>
                    <div class="text-3xl font-black text-[#facc15]" x-text="userData ? userData.followers : '...'">0</div>
                </div>
                <!-- Following -->
                <div class="bg-[#0d1117] border border-[#30363d] rounded-2xl p-6 text-center hover:border-[#facc15]/30 transition-all group">
                    <div class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-1 group-hover:text-gray-400 transition-colors">Following</div>
                    <div class="text-3xl font-black text-[#facc15]" x-text="userData ? userData.following : '...'">0</div>
                </div>
                <!-- Repos -->
                <div class="bg-[#0d1117] border border-[#30363d] rounded-2xl p-6 text-center hover:border-[#facc15]/30 transition-all group">
                    <div class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-1 group-hover:text-gray-400 transition-colors">Repositories</div>
                    <div class="text-3xl font-black text-[#facc15]" x-text="userData ? userData.public_repos : '...'">0</div>
                </div>
            </div>

            <!-- Heatmap -->
            <div class="bg-[#0d1117] border border-[#30363d] rounded-2xl p-4 mb-8 overflow-hidden hover:border-primary/20 transition-all max-w-[700px] mx-auto">
                <div class="w-full flex justify-center">
                    <img src="https://raw.githubusercontent.com/platane/platane/output/github-contribution-grid-snake-dark.svg" 
                         alt="GitHub Snake Animation" 
                         class="w-full opacity-90 hover:opacity-100 transition-opacity min-h-[120px] sm:min-h-[140px] object-contain"
                         loading="lazy" decoding="async">
                </div>
                <div class="flex items-center justify-end gap-2 mt-2 text-[10px] text-gray-500">
                    <span>Less</span>
                    <div class="flex gap-1">
                        <div class="w-2.5 h-2.5 rounded-sm bg-[#161b22]"></div>
                        <div class="w-2.5 h-2.5 rounded-sm bg-[#0e4429]"></div>
                        <div class="w-2.5 h-2.5 rounded-sm bg-[#006d32]"></div>
                        <div class="w-2.5 h-2.5 rounded-sm bg-[#26a641]"></div>
                        <div class="w-2.5 h-2.5 rounded-sm bg-[#39d353]"></div>
                    </div>
                    <span>More</span>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            function codeSnippet() {
                return {
                    activeTab: 'javascript',
                    copied: false,
                    snippets: {
                        javascript: `// Javascript\nconst arr = ["Dede", "Juniar", "Putra"];\n\nfunction greeting() {\n  const name = arr.find((item) => item === "Dede");\n  return "Hello, I Am " + name + "!";\n}\n\nconsole.log(greeting()); // Hello, I Am Dede!`,
                        python: `# Python\narr = ["Dede", "Juniar", "Putra"]\n\ndef greeting():\n    name = next((item for item in arr if item == "Dede"), None)\n    return f"Hello, I Am {name}!"\n\nprint(greeting())  # Hello, I Am Dede!`,
                        dart: `// Dart\nvar arr = ["Dede", "Juniar", "Putra"];\n\nString greeting() {\n  var name = arr.where((item) => item == "Dede").firstOrNull;\n  return "Hello, I Am $name!";\n}\n\nvoid main() {\n  print(greeting()); // Hello, I Am Dede!\n}`
                    },
                    copyCode() {
                        navigator.clipboard.writeText(this.snippets[this.activeTab]);
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    },
                    updateHighlight(el) {
                        if (!el || !this.$refs.highlight || !this.$refs.tabContainer) return;

                        const containerRect = this.$refs.tabContainer.getBoundingClientRect();
                        const elRect = el.getBoundingClientRect();

                        const left = elRect.left - containerRect.left;
                        const top = elRect.top - containerRect.top;
                        const width = elRect.width;
                        const height = elRect.height;

                        if (window.motion && typeof window.motion.animate === 'function') {
                            window.motion.animate(
                                this.$refs.highlight,
                                { left: left + "px", top: top + "px", width: width + "px", height: height + "px" },
                                { duration: 0.4, ease: [0.23, 1, 0.32, 1] }
                            );
                        } else {
                            this.$refs.highlight.style.left = left + 'px';
                            this.$refs.highlight.style.top = top + 'px';
                            this.$refs.highlight.style.width = width + 'px';
                            this.$refs.highlight.style.height = height + 'px';
                        }
                    }
                }
            }

            // GitHub Activity Logic
            function githubActivity() {
                return {
                    userData: null,
                    async init() {
                        try {
                            const userRes = await fetch('https://api.github.com/users/dedejuniarputra');
                            this.userData = await userRes.json();
                        } catch (e) {
                            console.error('Failed to fetch GitHub data', e);
                        }
                    }
                }
            }

            // Framer Motion-like stagger animation on scroll
            document.querySelectorAll('[class*="stagger-"]').forEach((el, i) => {
                el.style.opacity = '0';
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, i * 150);
            });
        </script>

        <script type="module">
            import { animate } from 'https://cdn.jsdelivr.net/npm/framer-motion@12.38.0/dist/es/index.mjs';
            window.motion = { animate };
        </script>
    @endpush
@endsection