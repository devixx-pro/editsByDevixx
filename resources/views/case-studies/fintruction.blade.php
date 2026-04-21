<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FinTruction Case Study — Edits by Devixx</title>
    <meta name="description" content="How we built a content system and lead generation engine for FinTruction — 500K+ views and 100+ inbound leads in 60 days.">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.14/dist/lenis.min.js"></script>
</head>
<body class="antialiased overflow-x-hidden">

    {{-- Custom Cursor --}}
    <div id="cursor" class="fixed top-0 left-0 pointer-events-none z-[9999] mix-blend-difference hidden md:block">
        <div id="cursor-dot" class="w-2 h-2 bg-white rounded-full absolute -translate-x-1/2 -translate-y-1/2"></div>
        <div id="cursor-ring" class="w-10 h-10 border border-white/50 rounded-full absolute -translate-x-1/2 -translate-y-1/2 transition-[width,height] duration-300"></div>
    </div>

    {{-- Page Loader --}}
    <div id="page-loader" class="fixed inset-0 z-[9998] bg-black flex items-center justify-center">
        <div class="text-center">
            <div class="w-12 h-12 border-2 border-primary/20 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
            <span class="text-primary font-medium text-sm tracking-widest uppercase">Loading</span>
        </div>
    </div>
    <script>
        setTimeout(function() {
            var l = document.getElementById('page-loader');
            if (l) { l.style.opacity = '0'; l.style.transition = 'opacity 0.5s'; setTimeout(function() { l.style.display = 'none'; }, 500); }
        }, 3000);
    </script>

    {{-- Noise Texture Overlay --}}
    <div class="fixed inset-0 pointer-events-none z-[100] opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>

    {{-- Background Grid Overlay --}}
    <div id="bg-grid"></div>

    {{-- ========== NAVBAR ========== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 pt-4">
        <div class="navbar-pill max-w-5xl mx-auto mx-4 md:mx-auto flex items-center justify-between px-8 py-1 rounded-full border border-white/[0.06] transition-all duration-500" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <a href="/" class="block shrink-0">
                <img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-9 md:h-10 w-auto">
            </a>

            <div class="hidden md:flex items-center gap-9">
                <a href="/#services" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Services</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#projects" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Projects</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#testimonials" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Testimonials</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#contact" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Contact</a>
            </div>

            <a href="/#contact" class="hidden md:inline-flex items-center px-4 py-[10px] rounded-full text-white text-[14px] font-medium transition-all duration-300 hover:opacity-90 hover:shadow-[0_0_20px_rgba(147,51,234,0.3)] magnetic shrink-0" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
                Get in Touch
            </a>

            <button id="mobile-toggle" class="md:hidden text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mx-4 mt-2 rounded-2xl border border-white/[0.06] overflow-hidden transition-all duration-300" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <div class="px-6 py-5 flex flex-col gap-4">
                <a href="/#services" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Services</a>
                <a href="/#projects" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Projects</a>
                <a href="/#testimonials" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Testimonials</a>
                <a href="/#contact" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Contact</a>
                <a href="/#contact" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full border border-[#9333EA]/60 text-white text-sm font-medium transition-all duration-300 hover:bg-[#9333EA]/10">Get in Touch</a>
            </div>
        </div>
    </nav>

    {{-- ========== BACK LINK (absolute, navbar-level, far-left of page) ========== --}}
    <a href="/#case-studies" class="absolute top-10 left-6 md:left-10 z-40 inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Back to case studies
    </a>

    {{-- ========== HERO ========== --}}
    <section class="relative flex flex-col items-center overflow-hidden pt-[130px] md:pt-[150px] pb-20">
        <div id="hero-glow"></div>

        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <div class="h-[32px] mb-6" aria-hidden="true"></div>

            <h1 data-hero-anim class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 tracking-tight">
                100+ inbound leads.
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">60 days.</span>
                <br class="hidden md:block">
                Zero ad spend.
            </h1>

            <p data-hero-anim class="text-base md:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed mb-12">
                How we built a content system for a contractor-focused bookkeeping firm — from two followers to a full inbound pipeline in nine weeks.
            </p>

            <div data-hero-anim class="flex flex-wrap items-center justify-center gap-3 md:gap-4">
                @foreach ([
                    ['v' => '505K+', 'l' => 'Views'],
                    ['v' => '100+',  'l' => 'Leads'],
                    ['v' => '80x',   'l' => 'Reach growth'],
                    ['v' => '60',    'l' => 'Days'],
                ] as $stat)
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/[0.03]">
                        <span class="text-white font-bold text-sm">{{ $stat['v'] }}</span>
                        <span class="text-gray-500 text-xs uppercase tracking-wider">{{ $stat['l'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== PROJECT SNAPSHOT ========== --}}
    <section class="relative pb-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-8 md:p-10 grid md:grid-cols-[1.4fr_1fr] gap-10 md:gap-14" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    {{-- About --}}
                    <div>
                        <div class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em] mb-4">The Client</div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight">FinTruction — bookkeeping built for contractors.</h2>
                        <p class="text-gray-400 leading-relaxed">
                            Job costing, WIP, cash flow, payroll, and profit-focused reporting for construction businesses. Sharp service. Credible operators. But outside of word of mouth, effectively invisible online.
                        </p>
                    </div>
                    {{-- Meta --}}
                    <div class="md:border-l md:border-white/10 md:pl-10">
                        <div class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em] mb-4">Snapshot</div>
                        <dl class="space-y-3.5">
                            @foreach ([
                                ['k' => 'Industry', 'v' => 'Construction Bookkeeping'],
                                ['k' => 'Engagement', 'v' => 'Content System Build'],
                                ['k' => 'Channels', 'v' => 'Instagram · Facebook · YouTube'],
                                ['k' => 'Timeline', 'v' => 'January – Present'],
                            ] as $row)
                                <div class="flex items-baseline justify-between gap-4">
                                    <dt class="text-xs uppercase tracking-wider text-gray-500">{{ $row['k'] }}</dt>
                                    <dd class="text-sm text-white font-medium text-right">{{ $row['v'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== THE CHALLENGE ========== --}}
    <section class="relative py-20">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-5xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">The Challenge</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">A great service nobody could find.</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    FinTruction came to us with two followers, zero posts, and a growing sense that word of mouth wasn't going to scale them.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 max-w-3xl mx-auto">
                @foreach ([
                    'No online presence and no brand voice',
                    'No content strategy or playbook to build one',
                    'No reliable way to reach the contractor ICP',
                    'No system for converting attention into leads',
                ] as $pain)
                    <div class="flex items-start gap-3 px-5 py-4 rounded-xl border border-white/10 bg-white/[0.02]">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary-light shrink-0"></span>
                        <span class="text-gray-300 text-[15px] leading-relaxed">{{ $pain }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== THE APPROACH ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">The Approach</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    Strategy. Funnel.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Automation.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    One system, three layers. Each layer fed the next. Skip one and the whole thing breaks.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $pillars = [
                        [
                            'num' => '01',
                            'title' => 'Strategy & Lead Magnet',
                            'body' => "We mapped the contractor ICP — what they watch, what they trust, what they buy. Then we built a free self-scoring diagnostic, the Construction Accounting Checklist, designed to surface blind spots that only FinTruction's service could fix.",
                            'proof' => '100+ checklist requests',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Full-Funnel Content',
                            'body' => 'TOFU virality reels for ICP-targeted reach. MOFU carousels and breakdowns for trust and education. BOFU stories and long-form YouTube to close the loop. Every piece routed back to the lead magnet.',
                            'proof' => '505,757 views',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Automation & Handoff',
                            'body' => 'Instant lead magnet delivery. Follow-up sequences. Clean handoff to the sales team. Manual delivery at scale would have killed conversions — automation kept every lead warm and accountable.',
                            'proof' => 'Zero leads cold',
                        ],
                    ];
                @endphp
                @foreach ($pillars as $p)
                    <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-7 md:p-8 flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="text-4xl md:text-5xl font-bold bg-gradient-to-br from-primary to-accent bg-clip-text text-transparent mb-5 tabular-nums leading-none">{{ $p['num'] }}</div>
                            <h3 class="text-xl font-bold text-white mb-3 leading-snug">{{ $p['title'] }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-grow">{{ $p['body'] }}</p>
                            <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                                <span class="text-xs text-gray-500 uppercase tracking-wider">Outcome</span>
                                <span class="text-primary-light text-sm font-semibold">{{ $p['proof'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== THE RESULTS ========== --}}
    <section class="relative py-24">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[700px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">The Results</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    60 days. One system.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Real pipeline.</span>
                </h2>
            </div>

            {{-- Headline stats --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-10">
                @foreach ([
                    ['big' => '505,757', 'label' => 'Total views',     'delta' => '↑ 80x'],
                    ['big' => '2,778',   'label' => 'Engagements',     'delta' => '↑ 42x'],
                    ['big' => '213',     'label' => 'New followers',   'delta' => '↑ 106x'],
                    ['big' => '100+',    'label' => 'Inbound leads',   'delta' => 'Organic'],
                    ['big' => '261,482', 'label' => 'Top reel views',  'delta' => 'Single post'],
                    ['big' => '$0',      'label' => 'Paid ad spend',   'delta' => 'All organic'],
                ] as $r)
                    <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] rounded-2xl p-6 md:p-7" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="text-3xl md:text-4xl font-bold text-white mb-2 tabular-nums leading-none">{{ $r['big'] }}</div>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-gray-400 text-sm">{{ $r['label'] }}</span>
                                <span class="text-primary text-[11px] font-semibold px-2 py-0.5 rounded-full bg-primary/10 border border-primary/20">{{ $r['delta'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Audience breakdown --}}
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-7 md:p-9" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-7">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-1">Reach landed inside the ICP.</h3>
                            <p class="text-gray-500 text-sm">Top countries by share of total views — weighted to English-speaking construction markets.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach ([
                            ['name' => 'United States',  'pct' => 47.6],
                            ['name' => 'Canada',          'pct' => 11.3],
                            ['name' => 'Australia',       'pct' => 11.3],
                            ['name' => 'United Kingdom',  'pct' => 8.7],
                            ['name' => 'Other',           'pct' => 21.1],
                        ] as $c)
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-gray-300 text-sm font-medium">{{ $c['name'] }}</span>
                                    <span class="text-white text-sm tabular-nums font-semibold">{{ $c['pct'] }}%</span>
                                </div>
                                <div class="h-1.5 rounded-full bg-white/5 overflow-hidden">
                                    <div class="h-full rounded-full" style="width: {{ $c['pct'] * 2 }}%; background: linear-gradient(90deg, #9333EA 0%, #D946EF 100%);"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== CLOSING + CTA ========== --}}
    <section class="relative py-32 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(147,51,234,0.14) 0%, transparent 60%); filter: blur(40px);"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] mb-6 tracking-tight">
                The difference between
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">posting content</span>
                and building a system.
            </h2>
            <p class="text-gray-400 text-base md:text-lg max-w-xl mx-auto leading-relaxed mb-10">
                One gets likes. The other gets clients. If you'd rather have the second thing — let's talk.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/#contact" class="btn-primary magnetic text-base px-8 py-4 animate-pulse-glow">
                    Book a Call
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="/#case-studies" class="inline-flex items-center gap-2 px-7 py-3.5 border border-white/15 text-white font-semibold rounded-full transition-all duration-300 hover:bg-white/5 hover:border-white/30 text-base">
                    See More Work
                </a>
            </div>
        </div>
    </section>

    {{-- ========== FOOTER ========== --}}
    <footer class="relative border-t border-surface-border">
        <div class="border-t border-surface-border py-8" style="background: rgba(0,0,0,0.5);">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="/"><img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-8 w-auto"></a>
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6">
                        <a href="/#services" class="text-sm text-gray-500 hover:text-white transition-colors">Services</a>
                        <a href="/#testimonials" class="text-sm text-gray-500 hover:text-white transition-colors">Testimonials</a>
                        <a href="/#case-studies" class="text-sm text-gray-500 hover:text-white transition-colors">Case Studies</a>
                        <a href="/#contact" class="text-sm text-gray-500 hover:text-white transition-colors">Contact Us</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="text-center mt-6 pt-6 border-t border-surface-border">
                    <p class="text-sm text-gray-600">&copy; {{ date('Y') }} Edits by Devixx. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
    gsap.registerPlugin(ScrollTrigger);

    // Lenis smooth scroll
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smooth: true,
    });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);

    // Hide loader + hero reveal
    function hideLoader() {
        const loader = document.getElementById('page-loader');
        if (!loader || loader.style.display === 'none') return;
        const tl = gsap.timeline();
        tl.to(loader, {
            opacity: 0, duration: 0.6, ease: 'power2.inOut',
            onComplete: () => { loader.style.display = 'none'; }
        })
        .from('[data-hero-anim]', {
            y: 60, opacity: 0, duration: 1, stagger: 0.15, ease: 'power3.out',
        }, '-=0.2')
        .call(() => { ScrollTrigger.refresh(); });
    }
    window.addEventListener('load', hideLoader);
    setTimeout(hideLoader, 4000);

    // Custom cursor
    const cursorDot = document.getElementById('cursor-dot');
    const cursorRing = document.getElementById('cursor-ring');
    let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX; mouseY = e.clientY;
        gsap.to(cursorDot, { x: mouseX, y: mouseY, duration: 0.1 });
    });
    (function animateRing() {
        ringX += (mouseX - ringX) * 0.15;
        ringY += (mouseY - ringY) * 0.15;
        gsap.set(cursorRing, { x: ringX, y: ringY });
        requestAnimationFrame(animateRing);
    })();
    document.querySelectorAll('a, button, .glow-border-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(cursorRing, { width: 60, height: 60, borderColor: 'rgba(147,51,234,0.6)', duration: 0.3 });
            gsap.to(cursorDot, { scale: 0.5, duration: 0.3 });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(cursorRing, { width: 40, height: 40, borderColor: 'rgba(255,255,255,0.5)', duration: 0.3 });
            gsap.to(cursorDot, { scale: 1, duration: 0.3 });
        });
    });

    // Navbar scroll behavior
    const navbar = document.getElementById('navbar');
    const navbarPill = navbar.querySelector('.navbar-pill');
    var lastScrollY = 0, navHidden = false, hideThreshold = 700;
    ScrollTrigger.create({
        onUpdate: (self) => {
            var s = self.scroll();
            var direction = self.direction;
            if (s > 50) {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.3)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.08)';
            } else {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.25)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.06)';
            }
            if (s > hideThreshold && direction === 1 && !navHidden) {
                navHidden = true;
                gsap.to(navbar, { y: -120, duration: 0.4, ease: 'power2.inOut' });
            } else if (direction === -1 && navHidden) {
                navHidden = false;
                gsap.to(navbar, { y: 0, duration: 0.24, ease: 'power2.inOut' });
            }
            if (s <= hideThreshold && navHidden) {
                navHidden = false;
                gsap.to(navbar, { y: 0, duration: 0.4, ease: 'power2.inOut' });
            }
        }
    });

    // Mobile menu
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    mobileMenu.querySelectorAll('a').forEach(l => l.addEventListener('click', () => mobileMenu.classList.add('hidden')));

    // Section reveal animations
    function reveal(selector, fromVars) {
        const els = gsap.utils.toArray(selector);
        if (!els.length) return;
        els.forEach((el) => {
            gsap.fromTo(el,
                { ...fromVars, opacity: 0 },
                {
                    ...Object.fromEntries(Object.keys(fromVars).map(k => [k, 0])),
                    opacity: 1,
                    duration: fromVars.duration || 0.8,
                    ease: fromVars.ease || 'power3.out',
                    scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' }
                }
            );
        });
    }
    reveal('.section-label', { y: 20, duration: 0.6 });
    reveal('section h2', { y: 50, duration: 0.8 });
    reveal('section p.text-lg, section p.text-gray-400, section p.text-gray-500', { y: 30, duration: 0.7 });

    // Grid card stagger
    gsap.utils.toArray('.grid').forEach(grid => {
        const items = grid.querySelectorAll('.glow-border-card');
        if (!items.length) return;
        items.forEach((item, i) => {
            gsap.fromTo(item,
                { y: 50, opacity: 0 },
                {
                    y: 0, opacity: 1,
                    duration: 0.7, ease: 'power3.out', delay: i * 0.1,
                    scrollTrigger: { trigger: grid, start: 'top 85%', toggleActions: 'play none none none' }
                }
            );
        });
    });

    // Activate glow border on hover for cards
    document.querySelectorAll('.glow-border-card').forEach(card => {
        card.addEventListener('mouseenter', () => card.classList.add('active'));
        card.addEventListener('mouseleave', () => card.classList.remove('active'));
    });

    // Animated bar fills (comparison charts)
    document.querySelectorAll('.bar-fill').forEach(bar => {
        const target = parseFloat(bar.dataset.target) || 0;
        ScrollTrigger.create({
            trigger: bar,
            start: 'top 90%',
            once: true,
            onEnter: () => {
                gsap.to(bar, { width: target + '%', duration: 1.4, ease: 'power3.out' });
            }
        });
    });

    // Animated line chart (Part 02)
    const growthLine = document.getElementById('growth-line');
    const growthArea = document.getElementById('growth-area');
    if (growthLine) {
        const length = growthLine.getTotalLength();
        growthLine.style.strokeDasharray = length;
        growthLine.style.strokeDashoffset = length;
        ScrollTrigger.create({
            trigger: '#growth-chart',
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to(growthLine, { strokeDashoffset: 0, duration: 2, ease: 'power2.out' });
                gsap.to(growthArea, { opacity: 1, duration: 1.6, delay: 0.3, ease: 'power2.out' });
            }
        });
    }

    // Scroll progress bar
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    progressBar.style.cssText = 'position:fixed;top:0;left:0;height:2px;background:linear-gradient(90deg,#9333EA,#D946EF);z-index:9999;transform-origin:left;transform:scaleX(0);width:100%;';
    document.body.prepend(progressBar);
    ScrollTrigger.create({
        trigger: document.body, start: 'top top', end: 'bottom bottom',
        onUpdate: (self) => { gsap.set(progressBar, { scaleX: self.progress }); }
    });

    // Smooth anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) { e.preventDefault(); lenis.scrollTo(target, { offset: window.innerWidth < 768 ? -60 : -80 }); }
        });
    });
    </script>
</body>
</html>
