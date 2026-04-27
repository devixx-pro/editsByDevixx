<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Zero Playbook — Build Your Instagram From Absolute Zero | edits by DEVIXX</title>
    <meta name="description" content="The exact playbook we use to grow Instagram accounts from zero — niche, profile setup, faceless content, hooks, captions, scripting, and the system that turns viewers into clients.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

            <a href="#get-it" class="hidden md:inline-flex items-center px-4 py-[10px] rounded-full text-white text-[14px] font-medium transition-all duration-300 hover:opacity-90 hover:shadow-[0_0_20px_rgba(147,51,234,0.3)] magnetic shrink-0" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
                Get the Playbook
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
                <a href="#get-it" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full border border-[#9333EA]/60 text-white text-sm font-medium transition-all duration-300 hover:bg-[#9333EA]/10">Get the Playbook</a>
            </div>
        </div>
    </nav>

    {{-- ========== HERO ========== --}}
    <section class="relative flex flex-col items-center overflow-hidden pt-[130px] md:pt-[150px] pb-20">
        <div id="hero-glow"></div>

        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <div data-hero-anim class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-primary/30 bg-primary/10 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-light"></span>
                <span class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em]">Free Playbook · Lead Magnet</span>
            </div>

            <h1 data-hero-anim class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 tracking-tight">
                The Zero
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">Playbook.</span>
                <br class="hidden md:block">
                Build your Instagram from absolute zero.
            </h1>

            <p data-hero-anim class="text-base md:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed mb-10">
                Not a generic guide. Every step is what we actually run for clients — niche, profile, faceless content, hooks, captions, scripts, and the system that turns viewers into clients. The right way.
            </p>

            {{-- Email opt-in form --}}
            <div data-hero-anim id="get-it" class="max-w-xl mx-auto mb-10">
                @if (session('success'))
                    <div class="mb-4 px-5 py-4 rounded-xl border border-primary/40 bg-primary/10 text-white text-sm">
                        {{ session('success') }} Check your inbox shortly — we'll send The Zero Playbook over.
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 px-5 py-4 rounded-xl border border-red-500/40 bg-red-500/10 text-red-200 text-sm text-left">
                        @foreach ($errors->all() as $error)
                            <div>· {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" class="relative glow-border-card rounded-2xl text-left" style="padding: 1px;">
                    @csrf
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-5 md:p-6" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="grid sm:grid-cols-2 gap-3 mb-3">
                            <input type="text" name="first_name" required maxlength="100" placeholder="First name" value="{{ old('first_name') }}"
                                class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all">
                            <input type="text" name="last_name" required maxlength="100" placeholder="Last name" value="{{ old('last_name') }}"
                                class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all">
                        </div>
                        <input type="email" name="email" required maxlength="255" placeholder="you@email.com" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all mb-3">
                        <input type="hidden" name="message" value="Send me The Zero Playbook — request from /ground-zero">

                        <button type="submit" class="btn-primary magnetic w-full text-base px-6 py-3.5 justify-center">
                            Send Me The Playbook
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                        <p class="text-center text-gray-500 text-xs mt-3">We send the playbook to your inbox. No spam, unsubscribe anytime.</p>
                    </div>
                </form>
            </div>

            <div data-hero-anim class="flex flex-wrap items-center justify-center gap-3 md:gap-4">
                @foreach ([
                    ['v' => '9',         'l' => 'Steps'],
                    ['v' => 'Faceless',  'l' => 'Friendly'],
                    ['v' => '0 → Live',  'l' => 'From scratch'],
                    ['v' => 'Free',      'l' => 'No upsell'],
                ] as $stat)
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/[0.03]">
                        <span class="text-white font-bold text-sm">{{ $stat['v'] }}</span>
                        <span class="text-gray-500 text-xs uppercase tracking-wider">{{ $stat['l'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== WHO IT'S FOR ========== --}}
    <section class="relative py-20">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-5xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">Who It's For</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    If you're starting from zero,
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">this is for you.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Built for service businesses and operators who want a real content system — not influencer advice repackaged.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 max-w-3xl mx-auto">
                @foreach ([
                    ['t' => 'Service-business founders',     'b' => 'Bookkeepers, accountants, agencies, consultants, B2B operators.'],
                    ['t' => "Don't want to be on camera",    'b' => 'The faceless format is built into Step 4. No personal brand required.'],
                    ['t' => 'Starting from 0 followers',     'b' => 'Niche, profile, and posting frequency you can actually sustain.'],
                    ['t' => 'Tired of generic creator advice', 'b' => 'Hooks, scripts, and captions designed to convert, not just go viral.'],
                ] as $who)
                    <div class="flex items-start gap-3 px-5 py-4 rounded-xl border border-white/10 bg-white/[0.02]">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary-light shrink-0"></span>
                        <div>
                            <div class="text-white text-[15px] font-semibold leading-snug mb-1">{{ $who['t'] }}</div>
                            <div class="text-gray-400 text-sm leading-relaxed">{{ $who['b'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== INSIDE THE PLAYBOOK ========== --}}
    <section class="relative py-24">
        <div class="absolute top-1/3 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">Inside The Playbook</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    9 steps. Every example.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Nothing held back.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    The exact sequence we run for clients — niche, profile, cadence, faceless reach, talking-head trust, script formula, idea engine, captions, modeling, and the consistency mindset that keeps the whole thing alive.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $steps = [
                        ['num' => '01',  'title' => 'Define Your Niche & Sub-Niche',     'body' => 'Pick a broad niche, then 5–7 sub-niches under it. Choose the one specific enough to stand out and broad enough to grow. The biggest mistake is going too broad or too narrow too fast — neither works.'],
                        ['num' => '02',  'title' => 'Set Up Your Profile Properly',      'body' => 'Username, name field (searchable), profile picture (face visible), and a 4-line bio where each line has a job. If your profile doesn\'t tell a stranger what you do in 3 seconds, they leave.'],
                        ['num' => '03',  'title' => 'Pick a Frequency You Can Keep',     'body' => 'Easy = 3x/week. Moderate = 5x/week. Hard = 7x/week. Burned-out creators post nothing. Posting frequency matters far more than posting times — the algorithm rewards consistency, not clock-watching.'],
                        ['num' => '04a', 'title' => 'Text-on-Screen — Reach Format',     'body' => 'Faceless reels. Stacked text cards over b-roll, each one readable in under 2 seconds. The first card stops the scroll. The last teases the caption. The caption carries the real value and the lead magnet.'],
                        ['num' => '04b', 'title' => 'Talking Head — Trust Format',       'body' => '45–60 seconds. Raw, direct, real. A window for lighting. Hook in 3 seconds (verbal + written), captions on, one idea per video. Where people decide if they actually like you.'],
                        ['num' => '05',  'title' => 'Script Every Video (7 Parts)',      'body' => 'Topic → Hook → Value → Script Angle → CTA → Outlier research → Video Format. Knowing exactly what you\'re going to say and why before you press record. Not reading from a page.'],
                        ['num' => '06',  'title' => 'What to Actually Post',             'body' => 'Where to find ideas (comments, Reddit, your own life). The idea hierarchy (your experience > books > podcasts > analytics > others). Why giving away your best stuff for free builds authority faster than withholding it.'],
                        ['num' => '07',  'title' => 'Caption Writing',                   'body' => 'A 3-line caption structure where each line has a job: hook, CTA, context. 3–5 niche hashtags — not generic ones. The place where viewers convert into followers and followers into leads.'],
                        ['num' => '08',  'title' => 'Learn From Someone Ahead',          'body' => 'Find a creator already where you want to be. Study what they actually post — not what they say to do. Use Sort Feed to find their outliers, model the behavior, then make it yours.'],
                        ['num' => '09',  'title' => 'Consistency — The Only Cheat Code', 'body' => 'First 90 days are reps. No views, no followers, no feedback — post anyway. Most people quit at day 30. That is your opportunity. When you get good, growth follows. Not the other way around.'],
                    ];
                @endphp
                @foreach ($steps as $s)
                    <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-6 md:p-7 flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="text-3xl md:text-4xl font-bold bg-gradient-to-br from-primary to-accent bg-clip-text text-transparent mb-4 tabular-nums leading-none">{{ $s['num'] }}</div>
                            <h3 class="text-lg font-bold text-white mb-2 leading-snug">{{ $s['title'] }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $s['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== THE BIG IDEA ========== --}}
    <section class="relative py-24">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(147,51,234,0.10) 0%, transparent 60%); filter: blur(40px);"></div>
        <div class="max-w-5xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">The Idea That Changes Everything</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    Stop posting for the buyer.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Post for the viewer.</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] h-full rounded-2xl p-7 md:p-8" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-3">ICP — Ideal Client Profile</div>
                        <h3 class="text-xl font-bold text-white mb-3 leading-snug">The buyer.</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Drowning in debt. Behind on taxes. Actively looking to hire. The exact person you sell to — but the pool is too small to power early growth.
                        </p>
                    </div>
                </div>

                <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] h-full rounded-2xl p-7 md:p-8" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-3">IVP — Ideal Viewer Profile</div>
                        <h3 class="text-xl font-bold text-white mb-3 leading-snug">The audience.</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Same niche. Broader. People curious about the topic but not ready to buy yet. Build for them. The buyers find you through the trust you build with the broader group.
                        </p>
                    </div>
                </div>
            </div>

            <p class="text-center text-gray-500 text-sm md:text-base mt-8 max-w-2xl mx-auto">
                The playbook walks you through how to map your IVP, build the audience, and convert it into ICP clients without forcing the sale.
            </p>
        </div>
    </section>

    {{-- ========== BIO STRUCTURE (4 LINES) ========== --}}
    <section class="relative py-20">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">Setting Up Your Profile</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    4 bio lines.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">4 jobs.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Your profile is your landing page. If it doesn't tell someone what you do and who you help in 3 seconds, they leave. Here's exactly how to set it up — every line earns its place.
                </p>
            </div>

            <div class="grid md:grid-cols-[1.1fr_1fr] gap-6">
                {{-- The 4 lines --}}
                <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-7 md:p-8" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-5">The Structure</div>

                        {{-- IG profile mockup --}}
                        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-8 pl-12">
                            {{-- Header: profile pic + handle + display name + stats --}}
                            <div class="flex items-start gap-5 mb-5 pb-5 border-b border-white/10">
                                <div class="w-20 h-20 md:w-[88px] md:h-[88px] rounded-full bg-gradient-to-br from-white/10 to-white/[0.02] border border-white/10 shrink-0 flex items-center justify-center">
                                    <svg class="w-9 h-9 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <span class="text-white font-semibold text-base">your.handle</span>
                                        <svg class="w-4 h-4 text-primary-light" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div class="text-gray-300 text-sm font-medium mb-2">Your Name | Niche Keyword</div>
                                    <div class="text-gray-500 text-xs">— posts &middot; — followers &middot; — following</div>
                                </div>
                            </div>

                            {{-- Bio: LINE label in avatar column, content in handle column --}}
                            <div class="space-y-2.5">
                                @foreach ([
                                    ['n' => 1, 'job' => 'What you do and who you help'],
                                    ['n' => 2, 'job' => 'How people work with you or what you offer'],
                                    ['n' => 3, 'job' => 'Credibility or proof'],
                                    ['n' => 4, 'job' => 'CTA — tell them exactly what to do next'],
                                ] as $line)
                                    <div class="flex items-start gap-5">
                                        <span class="text-[15px] uppercase tracking-[0.05em] text-primary-light font-semibold shrink-0 leading-snug w-20 md:w-[88px] tabular-nums whitespace-nowrap">Line {{ $line['n'] }}</span>
                                        <span class="text-white text-[15px] leading-snug min-w-0 flex-1">{{ $line['job'] }}</span>
                                    </div>
                                @endforeach

                                {{-- Link row --}}
                                <div class="flex items-start gap-5 pt-2">
                                    <span class="text-[15px] uppercase tracking-[0.05em] text-gray-500 font-semibold shrink-0 leading-snug w-20 md:w-[88px] whitespace-nowrap">Link</span>
                                    <span class="text-primary-light text-[15px] leading-snug font-medium inline-flex items-center gap-1.5 min-w-0 flex-1">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                                        your-link.com
                                    </span>
                                </div>
                            </div>
                        </div>

                        <p class="text-gray-500 text-sm leading-relaxed mt-6 pt-5 border-t border-white/10">
                            One link in your bio converts better than multiple. More links = more confusion, less action.
                        </p>
                    </div>
                </div>

                {{-- Worked example --}}
                <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-7 md:p-9 h-full" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-5">Finance Example</div>
                        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-8 pl-12 mb-5">
                            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-white/10">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent shrink-0"></div>
                                <div>
                                    <div class="text-white text-sm font-bold">Alex | Personal Finance</div>
                                    <div class="text-gray-500 text-xs">@alex.finance</div>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="text-gray-300">I help people stop living paycheck to paycheck</div>
                                <div class="text-gray-300">Free budgeting guide below</div>
                                <div class="text-gray-300">Helped 200+ people take control of their money</div>
                                <div class="text-primary-light font-medium">DM "START" to get my full system ↓</div>
                            </div>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            <span class="text-primary-light font-semibold">Username:</span> intent-based — your name + niche keyword.<br>
                            <span class="text-primary-light font-semibold">Name field:</span> searchable — name + keyword. Not "Founder · Coach · Speaker."<br>
                            <span class="text-primary-light font-semibold">Photo:</span> face visible, single person, no logos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== HOOK PATTERNS ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">Hooks</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    The hook decides
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">if anyone watches.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Lead with what they stand to lose or miss — not what they'll learn. Curiosity and urgency beat generic advice every time.
                </p>
            </div>

            {{-- 3 hook types --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-10">
                @foreach ([
                    ['t' => 'Verbal',  'b' => 'What you say out loud in the first second.'],
                    ['t' => 'Visual',  'b' => 'What people see — the setting, what you\'re doing, the b-roll.'],
                    ['t' => 'Written', 'b' => 'Text on screen. Use this even in talking-head videos. Most people watch on mute.'],
                ] as $type)
                    <div class="flex items-start gap-3 px-5 py-4 rounded-xl border border-white/10 bg-white/[0.02]">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary-light shrink-0"></span>
                        <div>
                            <div class="text-white text-[15px] font-semibold leading-snug mb-1">{{ $type['t'] }}</div>
                            <div class="text-gray-400 text-sm leading-relaxed">{{ $type['b'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Weak vs Strong examples --}}
            <div class="grid md:grid-cols-3 gap-5">
                @php
                    $hooks = [
                        ['weak' => 'Tax tips for small business owners',  'strong' => 'Most small business owners overpay their taxes because of this one mistake.'],
                        ['weak' => 'How to manage your payroll',          'strong' => 'Your bookkeeper might be costing you thousands and not telling you.'],
                        ['weak' => 'Why you should track your expenses',  'strong' => 'You\'re leaving thousands on the table every tax season — and you don\'t know it.'],
                    ];
                @endphp
                @foreach ($hooks as $h)
                    <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-6 md:p-7" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="mb-4">
                                <div class="inline-flex items-center gap-2 mb-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400/80"></span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-red-400/80 font-semibold">Weak</span>
                                </div>
                                <p class="text-gray-500 text-sm leading-snug line-through decoration-red-400/40">{{ $h['weak'] }}</p>
                            </div>
                            <div class="pt-4 border-t border-white/10">
                                <div class="inline-flex items-center gap-2 mb-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-light"></span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-primary-light font-semibold">Strong</span>
                                </div>
                                <p class="text-white text-[15px] leading-snug font-medium">{{ $h['strong'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== 7-PART SCRIPT FORMULA ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/3 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-12">
                <span class="section-label mb-6 inline-block">Writing Your Scripts</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    The 7-part script formula.
                    <br class="hidden md:block">
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Run it on every video.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    A script doesn't mean reading from a page — it means knowing exactly what you'll say and why before you press record. Miss one element, the video drifts.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
                @foreach ([
                    ['n' => '1', 't' => 'Topic',          'b' => 'Specific enough to be searchable. "How to invest" → "The first investment account to open with under $1000."'],
                    ['n' => '2', 't' => 'Hook',           'b' => 'Verbal, visual, written. All three working together. The first second decides the whole video.'],
                    ['n' => '3', 't' => 'Value',          'b' => 'Storytelling > Actionable > Measurable > Broad > Unclear > Fluffy. The deeper down the list, the worse it lands.'],
                    ['n' => '4', 't' => 'Script Angle',   'b' => 'Tutorial · Comparison · Myth-bust · Right-or-wrong · Education · Transformation · Challenge. Pick one per video.'],
                    ['n' => '5', 't' => 'CTA',            'b' => 'Following CTA ("follow for more") or Leads CTA ("comment X for Y"). One per video — never both.'],
                    ['n' => '6', 't' => 'Outlier Research','b' => 'Find videos in your niche with 5x the average views. Study the hook, format, angle. Make your version.'],
                    ['n' => '7', 't' => 'Video Format',   'b' => 'Talking head, b-roll voiceover, text + audio, reaction, whiteboard, multi-angle, green screen. Vary it.'],
                    ['n' => '★', 't' => 'The Output',     'b' => 'A video that doesn\'t feel improvised — because it isn\'t. Land every time, not when the algorithm feels nice.'],
                ] as $part)
                    <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-6 md:p-7" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/30 flex items-center justify-center text-primary-light text-base font-bold tabular-nums shrink-0">{{ $part['n'] }}</div>
                                <div class="text-white text-[16px] font-bold">{{ $part['t'] }}</div>
                            </div>
                            <p class="text-gray-400 text-[15px] leading-relaxed">{{ $part['b'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== VALUE HIERARCHY + CAPTION STRUCTURE ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="grid lg:grid-cols-2 gap-6">
                {{-- Value hierarchy --}}
                <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-7 md:p-9 h-full" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-3">Value · Step 05.3</div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight">Not all value is equal.</h3>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed">From weakest to strongest. Most creators stop at "broad advice" and wonder why nothing converts.</p>

                        <div class="space-y-2.5">
                            @foreach ([
                                ['t' => 'Fluffy',        's' => 'Vague tips with no specifics.',           'pct' => 12],
                                ['t' => 'Unclear',       's' => 'Educational but hard to apply.',          'pct' => 25],
                                ['t' => 'Broad advice',  's' => 'Better, but still generic.',              'pct' => 42],
                                ['t' => 'Measurable',    's' => 'Specific and trackable.',                 'pct' => 60],
                                ['t' => 'Actionable',    's' => 'Tells them exactly what to do right now.', 'pct' => 80],
                                ['t' => 'Storytelling',  's' => 'Personal experience makes it real and memorable. The strongest.', 'pct' => 100],
                            ] as $v)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-white text-sm font-medium">{{ $v['t'] }}</span>
                                        <span class="text-gray-500 text-xs">{{ $v['s'] }}</span>
                                    </div>
                                    <div class="h-1.5 rounded-full bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full" style="width: {{ $v['pct'] }}%; background: linear-gradient(90deg, #9333EA 0%, #D946EF 100%);"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 3-line caption structure --}}
                <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-7 md:p-9 h-full flex flex-col" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="text-[11px] font-semibold text-primary-light uppercase tracking-[0.2em] mb-3">Captions · Step 07</div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight">3 lines. 3 jobs.</h3>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed">Most people ignore captions. That's where viewers convert into followers and followers into leads. Each line earns its place.</p>

                        <div class="space-y-3 mb-6 flex-grow">
                            @foreach ([
                                ['n' => '01', 't' => 'Written hook',     'b' => 'Match the energy of your video hook. Pull them in.'],
                                ['n' => '02', 't' => 'CTA',              'b' => 'Tell them exactly what to do — comment, follow, click.'],
                                ['n' => '03', 't' => 'Context (optional)', 'b' => 'A story detail or secondary CTA.'],
                            ] as $c)
                                <div class="flex items-start gap-3 px-4 py-3 rounded-xl border border-white/10 bg-white/[0.02]">
                                    <span class="text-primary-light text-xs font-bold tabular-nums shrink-0 mt-0.5">{{ $c['n'] }}</span>
                                    <div>
                                        <div class="text-white text-sm font-semibold leading-snug mb-0.5">{{ $c['t'] }}</div>
                                        <div class="text-gray-400 text-xs leading-relaxed">{{ $c['b'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="rounded-xl border border-white/10 bg-white/[0.02] p-4 text-xs leading-relaxed">
                            <div class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mb-2">Worked example</div>
                            <div class="text-gray-300 mb-1.5">"Most people find out too late their savings account is losing value."</div>
                            <div class="text-gray-300 mb-1.5">"Comment <span class="text-primary-light font-semibold">GUIDE</span> and I'll send you what to do instead."</div>
                            <div class="text-gray-500 italic">"Took me 3 years to figure this out. Saving you the time."</div>
                            <div class="text-gray-600 text-[11px] mt-3 pt-3 border-t border-white/10">+ 3–5 niche hashtags. Small &amp; relevant beats big &amp; generic.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== WHAT YOU'LL WALK AWAY WITH ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/3 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-6xl mx-auto px-6 relative">
            <div class="text-center mb-14">
                <span class="section-label mb-6 inline-block">What You Walk Away With</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4 leading-tight">
                    Read once.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Build for years.</span>
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                @foreach ([
                    ['t' => 'A locked-in niche',                  'b' => 'Specific enough to stand out, broad enough to grow.'],
                    ['t' => 'A profile that converts in 3 seconds','b' => 'Username, name field, bio that does its job.'],
                    ['t' => 'A faceless content format',          'b' => 'Reels you can ship without ever being on camera.'],
                    ['t' => 'A hook framework',                   'b' => 'Verbal, visual, written — what stops the scroll.'],
                    ['t' => 'A 7-part script template',           'b' => 'Topic → Hook → Value → Angle → CTA → Outlier → Format.'],
                    ['t' => 'A caption + lead magnet system',     'b' => '3-line structure that converts viewers into leads.'],
                    ['t' => 'A weekly feedback loop',             'b' => 'How to read your data and double down on what works.'],
                    ['t' => 'A posting cadence you can keep',     'b' => 'Easy / moderate / hard. Pick what survives a busy week.'],
                    ['t' => 'A 90-day mindset',                   'b' => 'The only cheat code that actually compounds.'],
                ] as $w)
                    <div class="relative glow-border-card rounded-2xl h-full" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="relative z-[1] h-full rounded-2xl p-6 md:p-7 flex items-start gap-4" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                            <div class="w-10 h-10 rounded-full bg-primary/10 border border-primary/30 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            </div>
                            <div>
                                <div class="text-white text-[16px] font-semibold leading-snug mb-1.5">{{ $w['t'] }}</div>
                                <div class="text-gray-400 text-[15px] leading-relaxed">{{ $w['b'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== WHY THIS WORKS ========== --}}
    <section class="relative py-20">
        <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-4xl mx-auto px-6 relative">
            <div class="relative glow-border-card rounded-2xl" style="padding: 1px;">
                <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                <div class="relative z-[1] rounded-2xl p-8 md:p-12" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    <div class="text-xs font-semibold text-primary-light uppercase tracking-[0.18em] mb-4">Why Trust This Playbook</div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-5 leading-tight">
                        Same playbook we run for clients — and on our own account.
                    </h2>
                    <p class="text-gray-400 leading-relaxed mb-4">
                        Every step in here is what we are actively doing to grow Instagram accounts from scratch. We run a content marketing agency. We've built faceless funnels that pulled 100K+ views, organic inbound, and lead magnet opt-ins — the exact system the playbook walks you through.
                    </p>
                    <p class="text-gray-400 leading-relaxed">
                        Use what applies to you. Skip what doesn't. But read it properly first.
                    </p>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="/case-studies/accrivo" class="inline-flex items-center gap-2 text-sm text-primary-light hover:text-white transition-colors font-medium">
                            See the Accrivo case study
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <span class="w-px h-4 bg-white/15"></span>
                        <a href="/case-studies/fintruction" class="inline-flex items-center gap-2 text-sm text-primary-light hover:text-white transition-colors font-medium">
                            See the FinTruction case study
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FINAL CTA ========== --}}
    <section class="relative py-32 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(147,51,234,0.14) 0%, transparent 60%); filter: blur(40px);"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] mb-6 tracking-tight">
                Ready to stop guessing and
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">start posting on a system?</span>
            </h2>
            <p class="text-gray-400 text-base md:text-lg max-w-xl mx-auto leading-relaxed mb-10">
                Drop your email below. We'll send The Zero Playbook to your inbox in the next few minutes.
            </p>

            <div class="max-w-xl mx-auto mb-6">
                <form method="POST" action="{{ route('contact.send') }}" class="relative glow-border-card rounded-2xl text-left" style="padding: 1px;">
                    @csrf
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="relative z-[1] rounded-2xl p-5 md:p-6" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        <div class="grid sm:grid-cols-2 gap-3 mb-3">
                            <input type="text" name="first_name" required maxlength="100" placeholder="First name"
                                class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all">
                            <input type="text" name="last_name" required maxlength="100" placeholder="Last name"
                                class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all">
                        </div>
                        <input type="email" name="email" required maxlength="255" placeholder="you@email.com"
                            class="w-full px-4 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary/60 focus:bg-white/[0.05] transition-all mb-3">
                        <input type="hidden" name="message" value="Send me The Zero Playbook — request from /ground-zero (footer CTA)">

                        <button type="submit" class="btn-primary magnetic w-full text-base px-6 py-3.5 justify-center">
                            Get The Playbook
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-gray-500 text-sm">
                Want it done for you instead?
                <a href="/#contact" class="text-primary-light hover:text-white transition-colors font-medium underline-offset-4 hover:underline">Book a call</a>
                — we'll build the system for you.
            </p>
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
