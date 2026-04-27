<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accrivo Case Study — edits by DEVIXX</title>
    <meta name="description" content="How we built a faceless content machine for Accrivo — 100K+ views, zero founder on camera, lead magnet running 24/7.">
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
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 pt-4 pointer-events-none">
        <div class="navbar-pill pointer-events-auto max-w-5xl mx-auto mx-4 md:mx-auto flex items-center justify-between px-8 py-1 rounded-full border border-white/[0.06] transition-all duration-500" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <a href="/" class="block shrink-0">
                <img src="{{ asset('images/logomain.png') }}" alt="edits by DEVIXX" class="h-9 md:h-10 w-auto">
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

    {{-- ========== BACK LINK ========== --}}
    <a href="/#case-studies" onclick="event.preventDefault(); window.location.assign('/#case-studies');" class="fixed top-10 left-6 md:left-10 z-[60] inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Back to case studies
    </a>

    {{-- ========== HERO ========== --}}
    <section class="relative flex flex-col items-center overflow-hidden pt-[130px] md:pt-[150px] pb-20">
        <div id="hero-glow"></div>

        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <div data-hero-anim class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-primary/30 bg-primary/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-light"></span>
                <span class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em]">Faceless Content System</span>
            </div>

            <h1 data-hero-anim class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 tracking-tight">
                100K+ views.
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">Zero face on camera.</span>
                <br class="hidden md:block">
                All system.
            </h1>

            <p data-hero-anim class="text-base md:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed mb-12">
                How we built a faceless Instagram lead-gen machine for a small-business bookkeeping firm — no founder content, no talking-head reels, no personal brand required. Just b-roll, hooks, and a funnel that runs itself.
            </p>

            <div data-hero-anim class="flex flex-wrap items-center justify-center gap-3 md:gap-4">
                @foreach ([
                    ['v' => '100K+', 'l' => 'Views'],
                    ['v' => '0',     'l' => 'Face on camera'],
                    ['v' => '30',    'l' => 'Days'],
                    ['v' => '$0',    'l' => 'Ad spend'],
                ] as $stat)
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/[0.03]">
                        <span class="text-white font-bold text-sm">{{ $stat['v'] }}</span>
                        <span class="text-gray-500 text-xs uppercase tracking-wider">{{ $stat['l'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== THE CLIENT ========== --}}
    <section class="relative pb-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-8 md:p-10 grid md:grid-cols-[1.4fr_1fr] gap-10 md:gap-14" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    {{-- About --}}
                    <div>
                        <div class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em] mb-4">The Client</div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight">Accrivo — bookkeeping built for small business owners.</h2>
                        <p class="text-gray-400 leading-relaxed mb-5">
                            Real bookkeeping and accounting — understanding the business, handling the books, sorting taxes, and delivering CFO-level thinking without CFO-level fees. Good service. Real results.
                        </p>
                        <p class="text-gray-300 leading-relaxed italic border-l-2 border-primary/60 pl-4">
                            Accrivo's founder didn't want to be on camera. Didn't have time for talking-head content. Didn't want to build a personal brand. So we built a system that didn't need any of it.
                        </p>
                    </div>
                    {{-- Meta --}}
                    <div class="md:border-l md:border-white/10 md:pl-10">
                        <div class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em] mb-4">Snapshot</div>
                        <dl class="space-y-3.5">
                            @foreach ([
                                ['k' => 'Industry', 'v' => 'Bookkeeping & Accounting'],
                                ['k' => 'ICP', 'v' => 'Small Business Owners'],
                                ['k' => 'Channels', 'v' => 'Instagram'],
                                ['k' => 'Content Format', 'v' => 'Faceless b-roll + text hooks'],
                                ['k' => 'Timeline', 'v' => 'February – Present'],
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
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">Great service. Zero online presence. Founder wouldn't go on camera.</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Referrals were working — until they weren't. But every "solution" demanded what Accrivo didn't have: time, a camera-ready founder, or a personal brand.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 max-w-3xl mx-auto">
                @foreach ([
                    ['t' => 'Referrals capped growth.',                           'b' => "Couldn't predict, couldn't scale, couldn't control."],
                    ['t' => "Founder wasn't going on camera.",                    'b' => 'Full stop. No talking-head reels, no face-driven content.'],
                    ['t' => 'No time for a personal brand.',                      'b' => 'Every hour on content was an hour not serving clients.'],
                    ['t' => 'Every agency pitched the same thing: "become a creator."', 'b' => 'Wrong answer for a bookkeeping firm.'],
                ] as $pain)
                    <div class="flex items-start gap-3 px-5 py-4 rounded-xl border border-white/10 bg-white/[0.02]">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary-light shrink-0"></span>
                        <div>
                            <div class="text-white text-[15px] font-semibold leading-snug mb-1">{{ $pain['t'] }}</div>
                            <div class="text-gray-400 text-sm leading-relaxed">{{ $pain['b'] }}</div>
                        </div>
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
                    Hooks. B-roll.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Funnel.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    We built a faceless content machine. Templated production, reused hooks, a lead magnet doing the selling. The founder kept doing what he does best — bookkeeping.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $pillars = [
                        [
                            'num' => '01',
                            'title' => 'Hook Library',
                            'body' => 'We built a library of [X] proven hooks targeting small-business accounting pain — tax surprises, messy QuickBooks, missed deductions, 1099 panic. Every reel starts here. No guessing, no blank page.',
                            'proof' => 'Repeatable virality',
                        ],
                        [
                            'num' => '02',
                            'title' => 'Faceless Production System',
                            'body' => 'B-roll + bold text + pattern-interrupt editing. One reel produced in under [X] minutes. No studio, no scripts, no founder time. Fully delegatable.',
                            'proof' => '[X] reels/week, scalable',
                        ],
                        [
                            'num' => '03',
                            'title' => 'Lead Magnet Funnel',
                            'body' => 'Every reel points to the Business Accounting Health Audit — a free 34-point self-assessment that qualifies leads before they hit a sales call. Viewers become subscribers automatically.',
                            'proof' => '[X] opt-ins and counting',
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

    {{-- ========== THE MACHINE (NEW) ========== --}}
    <section class="relative py-24">
        <div class="absolute top-1/3 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">The Machine</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    This is the system,
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">not a one-off win.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Most agencies show results. We show the machine that produced them — because that's the actual product.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $machine = [
                        [
                            'tag'     => '01 · Hook Library',
                            'title'   => 'Battle-tested hooks, cycled and remixed.',
                            'caption' => '[X] battle-tested hooks, cycled and remixed.',
                            'icon'    => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>',
                        ],
                        [
                            'tag'     => '02 · Reel Template',
                            'title'   => 'One template. Swap footage, swap hook, ship.',
                            'caption' => 'B-roll + text overlay. Built once, reused forever.',
                            'icon'    => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>',
                        ],
                        [
                            'tag'     => '03 · Workflow',
                            'title'   => '[X] minutes from idea to live.',
                            'caption' => 'Pick Hook → Grab B-roll → Drop Text → Post.',
                            'icon'    => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>',
                        ],
                    ];
                @endphp
                @foreach ($machine as $m)
                    <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl overflow-hidden flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            {{-- Visual placeholder --}}
                            <div class="relative aspect-[4/3] flex items-center justify-center border-b border-white/10" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.12) 0%, transparent 60%);">
                                <div class="text-gray-500 flex flex-col items-center gap-3">
                                    {!! $m['icon'] !!}
                                    <span class="text-[11px] uppercase tracking-[0.2em]">Screenshot</span>
                                </div>
                            </div>
                            {{-- Copy --}}
                            <div class="p-6 md:p-7 flex flex-col flex-grow">
                                <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-3">{{ $m['tag'] }}</div>
                                <h3 class="text-lg md:text-xl font-bold text-white mb-2 leading-snug">{{ $m['title'] }}</h3>
                                <p class="text-gray-400 text-sm leading-relaxed">{{ $m['caption'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== THE PROOF (NEW) ========== --}}
    <section class="relative py-24">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[700px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">The Proof</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    The reels that
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">did the work.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Per-reel breakdown. No averaging, no rounding. Exactly what hit.
                </p>
            </div>

            {{-- Reel grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-12">
                @php
                    $reels = [
                        ['n' => 'Reel 01', 'hook' => '[Hook text]', 'views' => '[X]K', 'saves' => '[X]', 'shares' => '[X]', 'comments' => '[X]'],
                        ['n' => 'Reel 02', 'hook' => '[Hook text]', 'views' => '[X]K', 'saves' => '[X]', 'shares' => '[X]', 'comments' => '[X]'],
                        ['n' => 'Reel 03', 'hook' => '[Hook text]', 'views' => '[X]K', 'saves' => '[X]', 'shares' => '[X]', 'comments' => '[X]'],
                        ['n' => 'Reel 04', 'hook' => '[Hook text]', 'views' => '[X]K', 'saves' => '[X]', 'shares' => '[X]', 'comments' => '[X]'],
                    ];
                @endphp
                @foreach ($reels as $r)
                    <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl overflow-hidden flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            {{-- Thumbnail (9:16) --}}
                            <div class="relative aspect-[9/16] flex items-center justify-center" style="background: radial-gradient(circle at 50% 40%, rgba(147,51,234,0.18) 0%, transparent 65%);">
                                <div class="text-center px-4">
                                    <div class="w-14 h-14 rounded-full border border-white/20 bg-white/5 backdrop-blur-sm mx-auto mb-4 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                    <div class="text-[11px] uppercase tracking-[0.2em] text-gray-500">Reel thumbnail</div>
                                </div>
                                <span class="absolute top-3 left-3 inline-block px-2.5 py-1 rounded-full border border-white/15 bg-black/40 backdrop-blur-sm text-white text-[10px] font-semibold uppercase tracking-wider">{{ $r['n'] }}</span>
                            </div>
                            {{-- Metrics --}}
                            <div class="p-5">
                                <p class="text-gray-300 text-sm leading-snug mb-4 line-clamp-2">{{ $r['hook'] }}</p>
                                <div class="grid grid-cols-4 gap-2 pt-3 border-t border-white/10">
                                    @foreach ([['l' => 'Views', 'v' => $r['views']], ['l' => 'Saves', 'v' => $r['saves']], ['l' => 'Shares', 'v' => $r['shares']], ['l' => 'Comm.', 'v' => $r['comments']]] as $met)
                                        <div class="text-center">
                                            <div class="text-white text-sm font-bold tabular-nums leading-none mb-1">{{ $met['v'] }}</div>
                                            <div class="text-gray-500 text-[10px] uppercase tracking-wider">{{ $met['l'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Comments block --}}
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-7 md:p-9" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    <div class="mb-6">
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-1">The comments told us it was working.</h3>
                        <p class="text-gray-500 text-sm">This is what inbound interest looks like in a faceless funnel — it starts in the comments, not the DMs.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach ([
                            '"Where do I sign up?"',
                            '"Is this for US small businesses?"',
                            '"Send the audit link 🙏"',
                            '"Literally describing my books rn"',
                        ] as $comment)
                            <div class="flex items-start gap-3 p-4 rounded-xl border border-white/10 bg-white/[0.02]">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/60 to-accent/60 shrink-0 flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">@</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-gray-400 text-xs font-medium blur-[3px] select-none">username_hidden</span>
                                        <span class="text-gray-600 text-[10px]">· 2d</span>
                                    </div>
                                    <p class="text-gray-300 text-sm leading-snug">{{ $comment }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
                    30 days. Faceless.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Measured.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto mt-4">
                    Every number here is from Instagram Insights or our lead magnet backend. Nothing averaged. Nothing rounded up.
                </p>
            </div>

            {{-- 8-stat grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ([
                    ['big' => '100K+', 'label' => 'Views (first month)', 'delta' => 'Across [X] reels'],
                    ['big' => '[X]K+', 'label' => 'Total reach',          'delta' => 'Unique accounts'],
                    ['big' => '[X]',   'label' => 'Saves',                'delta' => 'Intent signal'],
                    ['big' => '[X]',   'label' => 'Shares',               'delta' => 'Organic distribution'],
                    ['big' => '[X]',   'label' => 'Lead magnet opt-ins',  'delta' => 'The actual pipeline'],
                    ['big' => '$0',    'label' => 'Ad spend',             'delta' => '100% organic'],
                    ['big' => '+[X]',  'label' => 'Follower growth',      'delta' => 'From ~0'],
                    ['big' => '0 min', 'label' => 'Founder time on camera', 'delta' => 'Faceless'],
                ] as $r)
                    <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] rounded-2xl p-6 md:p-7 h-full flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="text-3xl md:text-4xl font-bold text-white mb-2 tabular-nums leading-none">{{ $r['big'] }}</div>
                            <div class="flex items-center justify-between mt-auto pt-3 gap-2">
                                <span class="text-gray-400 text-sm">{{ $r['label'] }}</span>
                                <span class="text-primary text-[10px] font-semibold px-2 py-0.5 rounded-full bg-primary/10 border border-primary/20 whitespace-nowrap">{{ $r['delta'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== CLIENT QUOTE ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(147,51,234,0.10) 0%, transparent 60%); filter: blur(40px);"></div>
        <div class="max-w-4xl mx-auto px-6 relative">
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-8 md:p-12 text-center" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    <svg class="w-10 h-10 text-primary/60 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"/></svg>
                    <p class="text-lg md:text-2xl text-white leading-relaxed font-medium mb-8">
                        [His quote here]
                    </p>
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center text-white text-sm font-bold">A</div>
                        <div class="text-left">
                            <div class="text-white text-sm font-semibold">[Name]</div>
                            <div class="text-gray-500 text-xs">Founder, Accrivo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== WHY FACELESS WORKS FOR YOU (NEW) ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-5xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">Why Faceless Works</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    If you don't want to be on camera,
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">this is built for you.</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ([
                    ['t' => 'You run a real business.',           'b' => "You don't have time to become an influencer."],
                    ['t' => "Your founder shouldn't be the brand.", 'b' => 'The business should be.'],
                    ['t' => 'Content should sell while you work.',  'b' => 'Not the other way around.'],
                ] as $why)
                    <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-7" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="w-10 h-10 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center mb-4">
                                <svg class="w-4 h-4 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2 leading-snug">{{ $why['t'] }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $why['b'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== CLOSING + CTA ========== --}}
    <section class="relative py-32 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(147,51,234,0.14) 0%, transparent 60%); filter: blur(40px);"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] mb-6 tracking-tight">
                From zero presence to a
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">faceless system that runs itself.</span>
            </h2>
            <p class="text-gray-400 text-base md:text-lg max-w-xl mx-auto leading-relaxed mb-10">
                No camera. No personal brand. No scripts. Just a machine that pulls inbound while you run your business.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/#contact" class="btn-primary magnetic text-base px-8 py-4 animate-pulse-glow">
                    Book a Call
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#" class="inline-flex items-center gap-2 px-7 py-3.5 border border-white/15 text-white font-semibold rounded-full transition-all duration-300 hover:bg-white/5 hover:border-white/30 text-base">
                    See the Audit Tool
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ========== FOOTER ========== --}}
    <footer class="relative border-t border-surface-border">
        <div class="border-t border-surface-border py-8" style="background: rgba(0,0,0,0.5);">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="/"><img src="{{ asset('images/logomain.png') }}" alt="edits by DEVIXX" class="h-8 w-auto"></a>
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
                    <p class="text-sm text-gray-600">&copy; {{ date('Y') }} edits by DEVIXX. All Rights Reserved.</p>
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
