<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edits by Devixx — Content That Gets You Chosen</title>
    <meta name="description" content="We turn your expertise into a content system that makes sure you're not just visible. You're chosen.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- GSAP + ScrollTrigger + Lenis Smooth Scroll --}}
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
    <div id="page-loader" class="fixed inset-0 z-[9998] bg-surface flex items-center justify-center">
        <div class="text-center">
            <div class="w-12 h-12 border-2 border-primary/20 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
            <span class="text-primary font-medium text-sm tracking-widest uppercase">Loading</span>
        </div>
    </div>

    {{-- Noise Texture Overlay --}}
    <div class="fixed inset-0 pointer-events-none z-[100] opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>

    {{-- ========== NAVBAR ========== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="block">
                <img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-8 md:h-10 w-auto">
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#services" class="text-sm text-gray-400 hover:text-white transition-colors">Services</a>
                <a href="#projects" class="text-sm text-gray-400 hover:text-white transition-colors">Projects</a>
                <a href="#testimonials" class="text-sm text-gray-400 hover:text-white transition-colors">Testimonials</a>
                <a href="#contact" class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a>
                <a href="#contact" class="btn-primary magnetic text-sm !px-5 !py-2.5">Get for Free</a>
            </div>
            <button id="mobile-toggle" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-surface-light/95 backdrop-blur-xl border-t border-surface-border">
            <div class="px-6 py-4 flex flex-col gap-4">
                <a href="#services" class="text-gray-400 hover:text-white transition-colors">Services</a>
                <a href="#projects" class="text-gray-400 hover:text-white transition-colors">Projects</a>
                <a href="#testimonials" class="text-gray-400 hover:text-white transition-colors">Testimonials</a>
                <a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a>
                <a href="#contact" class="btn-primary text-sm text-center">Get for Free</a>
            </div>
        </div>
    </nav>

    {{-- ========== HERO SECTION ========== --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <div class="absolute inset-0">
            <div data-parallax data-speed="0.3" class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-primary/8 rounded-full blur-[120px]"></div>
            <div data-parallax data-speed="0.5" class="absolute bottom-1/4 left-1/4 w-[400px] h-[400px] bg-accent/5 rounded-full blur-[100px]"></div>
            <div class="absolute top-0 left-0 right-0 h-px glow-line opacity-30"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <div data-hero-anim class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-8">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-sm text-primary-light font-medium">Now Accepting New Clients</span>
            </div>

            <h1 data-hero-anim data-split class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] mb-6 tracking-tight">
                Helping Service Businesses Build the
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">Content System</span>
                That Brings High-Ticket Clients to You
            </h1>

            <p data-hero-anim class="text-lg md:text-xl text-gray-400 max-w-3xl mx-auto mb-4 leading-relaxed">
                We turn your expertise into a content system that makes sure you're not just visible. You're chosen.
            </p>
            <p data-hero-anim class="text-base text-gray-500 max-w-2xl mx-auto mb-10">
                Because the right content doesn't just get you seen. It gets you chosen.
            </p>

            <div data-hero-anim class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-6">
                <a href="#contact" class="btn-primary magnetic text-lg px-10 py-4 animate-pulse-glow group">
                    Let's Talk
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <span class="text-sm text-gray-500 italic relative">
                    (It's Free)
                    <svg class="absolute -top-4 -right-8 w-8 h-8 text-yellow-400" viewBox="0 0 40 40" fill="none">
                        <path d="M8 30C12 20 20 12 35 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
                        <path d="M30 6L35 8L32 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </span>
            </div>
        </div>
    </section>

    {{-- ========== STATS BAR ========== --}}
    <section class="relative py-6">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative overflow-hidden rounded-2xl border border-surface-border bg-gradient-to-r from-surface-card via-surface-light to-surface-card p-1">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/5 via-accent/5 to-primary/5"></div>
                <div class="relative grid grid-cols-2 md:grid-cols-4 gap-0" data-stats>
                    <div class="flex flex-col items-center py-5 px-4 border-r border-surface-border stat-item">
                        <span class="text-2xl md:text-3xl font-bold text-white" data-count="180" data-prefix="0 to " data-suffix="K">0 to 0K</span>
                        <span class="text-xs md:text-sm text-gray-500 mt-1">Views</span>
                    </div>
                    <div class="flex flex-col items-center py-5 px-4 md:border-r border-surface-border stat-item">
                        <span class="text-2xl md:text-3xl font-bold text-white" data-count="3" data-suffix="x">0x</span>
                        <span class="text-xs md:text-sm text-gray-500 mt-1">Revenue</span>
                    </div>
                    <div class="flex flex-col items-center py-5 px-4 border-r border-surface-border border-t md:border-t-0 stat-item">
                        <span class="text-2xl md:text-3xl font-bold text-white" data-count="50" data-suffix="+">0+</span>
                        <span class="text-xs md:text-sm text-gray-500 mt-1">Inbound DMs</span>
                    </div>
                    <div class="flex flex-col items-center py-5 px-4 border-t md:border-t-0 stat-item">
                        <span class="text-2xl md:text-3xl font-bold text-white" data-count="10" data-suffix="x">0x</span>
                        <span class="text-xs md:text-sm text-gray-500 mt-1">Engagement</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== WHY CHOOSE US ========== --}}
    <section id="why-us" class="py-24 relative">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Content</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    What Makes Us the Last Agency You'll Need.
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    We obsess over one thing. Making sure the right people find you, trust you, and reach out.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card group hover:bg-primary/5">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
                        <span class="text-primary font-bold text-lg">01</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Fully Done For You.</h3>
                    <p class="text-gray-400 leading-relaxed">From the first script to the last post, we run the entire operation.</p>
                </div>

                <div class="card group hover:bg-primary/5">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
                        <span class="text-primary font-bold text-lg">02</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Built Around You.</h3>
                    <p class="text-gray-400 leading-relaxed">Nothing generic. Nothing copy pasted. Everything starts with you.</p>
                </div>

                <div class="card group hover:bg-primary/5">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
                        <span class="text-primary font-bold text-lg">03</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Quality Over Everything.</h3>
                    <p class="text-gray-400 leading-relaxed">Every piece we make is crafted with intention.</p>
                </div>

                <div class="card group hover:bg-primary/5">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
                        <span class="text-primary font-bold text-lg">04</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">One Goal. More Clients.</h3>
                    <p class="text-gray-400 leading-relaxed">Every step points to one outcome. You getting clients.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== SERVICES - FULL SYSTEM ========== --}}
    <section id="services" class="py-24 relative">
        <div class="absolute bottom-0 left-0 w-[600px] h-[400px] bg-accent/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Our Services</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    The Full Client Acquisition System.
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Everything you need to attract, nurture, and convert high-ticket clients. Built and run for you.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-16">
                @php
                $serviceIcons = [
                    ['Complete Funnel', 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z'],
                    ['Top-Notch Quality', 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z'],
                    ['Custom Strategy', 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z'],
                    ['High Conversion', 'M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941'],
                    ['Curated for Results', 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
                @endphp
                @foreach($serviceIcons as $service)
                <div class="card text-center group hover:bg-primary/5">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center mx-auto mb-3 group-hover:bg-primary/20 transition-colors">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $service[1] }}"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold">{{ $service[0] }}</h4>
                </div>
                @endforeach
            </div>

            <div class="mb-8">
                <span class="text-sm text-gray-500 uppercase tracking-wider font-medium">What's Included</span>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="card relative overflow-hidden group hover:border-primary/40">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Visibility</h3>
                    <p class="text-gray-400 leading-relaxed">Short-form content that puts you in front of the right people consistently. Every week, every platform consistently.</p>
                </div>

                <div class="card relative overflow-hidden group hover:border-primary/40">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.997 6.997 0 01-4.27 1.522 6.997 6.997 0 01-4.27-1.522"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Authority</h3>
                    <p class="text-gray-400 leading-relaxed">Long-form content that builds the kind of trust that makes clients choose you before the call even starts.</p>
                </div>

                <div class="card relative overflow-hidden group hover:border-primary/40">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Conversion</h3>
                    <p class="text-gray-400 leading-relaxed">Organic content brings the right clients to you. Paid ads scale it when you're ready to grow faster.</p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#contact" class="btn-primary">
                    Get Started
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ========== INDIVIDUAL SERVICES ========== --}}
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Not Ready for the Full System?</span>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto mt-4">
                    We also offer individual services. Pick the one that fits where you are right now and we'll handle the rest.
                </p>
            </div>

            <div class="space-y-6">
                @php
                $checkSvg = '<svg class="w-4 h-4 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>';

                $individualServices = [
                    [
                        'title' => 'Short-Form Content',
                        'desc' => 'Consistent presence across every platform. Every week.',
                        'items' => ['Scripts written by our team', 'High-quality editing and motion captions', 'Brand-consistent visuals', 'Posted across Instagram, TikTok, and LinkedIn', 'Consistent weekly schedule']
                    ],
                    [
                        'title' => 'Long-Form Youtube Videos',
                        'desc' => 'The content that makes people trust you before they ever reach out.',
                        'items' => ['Full script or guided outline', 'Professional editing and polished visuals', 'Thumbnail creation and title optimization', 'Published on a consistent weekly schedule']
                    ],
                    [
                        'title' => 'Podcast Editing and Distribution',
                        'desc' => 'One recording. Edited, polished, and distributed everywhere.',
                        'items' => ['Full episode edited and polished', 'Dead air and filler removed', 'Distributed across podcast platforms', 'Repurposed into short-form clips', 'Consistent publishing schedule']
                    ],
                    [
                        'title' => 'Meta Paid Ads',
                        'desc' => 'Full ad management. You pay Meta directly. We bring the results.',
                        'items' => ['Full ad strategy and campaign structure', 'Ad creative and copywriting', 'Audience targeting and retargeting', 'Ongoing optimization', 'Weekly performance reporting']
                    ],
                    [
                        'title' => 'Video Editing Only',
                        'desc' => 'Every frame is treated with the same precision we bring to everything else.',
                        'items' => ['Clean cuts and pacing', 'Motion captions', 'Brand-consistent formatting', '48 hour turnaround', '2 rounds of free revisions']
                    ],
                ];
                @endphp

                @foreach($individualServices as $service)
                <div class="card p-8">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $service['title'] }}</h3>
                            <p class="text-gray-400 mb-4">{{ $service['desc'] }}</p>
                            <ul class="space-y-2">
                                @foreach($service['items'] as $item)
                                <li class="flex items-center gap-3 text-gray-300">
                                    {!! $checkSvg !!}
                                    {{ $item }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 lg:mt-2">
                            <a href="#contact" class="btn-primary text-sm">Get Started</a>
                            <a href="#" class="btn-outline text-sm">Connect on WhatsApp</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== A NOTE FROM US ========== --}}
    <section class="py-16 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="card p-8 md:p-12 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-accent/5"></div>
                <div class="relative">
                    <span class="section-label mb-6 inline-block">A Note From Us</span>
                    <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mt-6 leading-relaxed">
                        We always recommend showing up in your own content. But if your schedule doesn't allow it, we have a way to keep your content running without you needing to record.
                    </p>
                    <a href="#contact" class="inline-flex items-center gap-2 mt-6 text-primary hover:text-primary-light transition-colors font-medium">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== SETUP CTA BANNER ========== --}}
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-primary/20 via-primary/10 to-accent/20 border border-primary/20 p-6 md:p-8">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-accent/5"></div>
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-white text-lg md:text-xl font-semibold">
                        Setup So Simple, It Just Works — Let's Set Things Up!
                    </p>
                    <a href="#contact" class="btn-primary whitespace-nowrap">
                        Get Started
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== SHORT-FORM VIDEOS ========== --}}
    <section id="projects" class="py-24 relative">
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">
                    Short-Form Videos That Actually
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Get Watched</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-3xl mx-auto">
                    We script and produce from scratch, edit your footage, or clip from your existing content. All crafted with the same level of intention and quality.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @for($i = 0; $i < 4; $i++)
                <div class="group relative aspect-[9/16] rounded-2xl overflow-hidden bg-surface-card border border-surface-border hover:border-primary/30 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-14 h-14 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs text-primary font-medium bg-primary/10 px-2 py-1 rounded-full">Enable sound</span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- ========== LONG FORM & TRAILERS ========== --}}
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">
                    Long Form and
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Trailers</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-3xl mx-auto">
                    Long-form videos, podcast episodes, and trailers. A look at what we've produced and edited across formats.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                @for($i = 0; $i < 2; $i++)
                <div class="group relative aspect-video rounded-2xl overflow-hidden bg-surface-card border border-surface-border hover:border-primary/30 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="text-xs bg-primary/20 text-primary-light px-3 py-1 rounded-full backdrop-blur-sm">Trailer</span>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- ========== TESTIMONIALS ========== --}}
    <section id="testimonials" class="py-24 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Testimonials</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Don't Take Our Word for It.
                </h2>
                <p class="text-gray-400 text-lg">We let our clients do the talking.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $testimonials = [
                    ['name' => 'Luna Mars', 'role' => 'Digital Marketer', 'text' => 'Switching to Devixx completely transformed how our operations team works. We went from manually tracking data across spreadsheets to an automated system that handles everything in real time. Our onboarding time dropped by 60%, and the visibility we have now is incredible.'],
                    ['name' => 'Cody Fisher', 'role' => 'Digital Marketer', 'text' => 'The content quality and consistency has been a game-changer. Within the first month, we saw a significant increase in engagement and started getting inbound DMs from potential clients. The team truly understands what works.'],
                    ['name' => 'Darnell Mars', 'role' => 'Digital Marketer', 'text' => 'Working with Edits by Devixx was the best decision we made this year. They took our scattered content strategy and turned it into a well-oiled machine. Our brand presence has never been stronger.'],
                    ['name' => 'Leslie Alexander', 'role' => 'Digital Marketer', 'text' => 'From the scripts to the final edits, everything is handled with such attention to detail. We barely have to think about content anymore — and our audience keeps growing. Highly recommend for any service-based business.'],
                    ['name' => 'Luna Mars', 'role' => 'Digital Marketer', 'text' => 'The ROI has been undeniable. Not only did our content quality improve dramatically, but we started closing clients who specifically mentioned our videos as the reason they reached out. That speaks volumes.'],
                    ['name' => 'Cody Fisher', 'role' => 'Digital Marketer', 'text' => 'What sets Devixx apart is that they actually care about results, not just deliverables. Every piece of content is strategic, and the team communicates like true partners. This is not your typical agency.'],
                ];
                @endphp

                @foreach($testimonials as $testimonial)
                <div class="card p-6 hover:bg-surface-card/80">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">{{ substr($testimonial['name'], 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold text-sm">{{ $testimonial['name'] }}</h4>
                            <p class="text-gray-500 text-xs">{{ $testimonial['role'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-primary/30 ml-auto flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $testimonial['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== HOW IT WORKS ========== --}}
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">How It Works?</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Simple Process. Serious Results.
                </h2>
                <p class="text-gray-400 text-lg max-w-3xl mx-auto">
                    From the first conversation to a fully running system, we make the entire process simple and stress free.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 border border-primary/20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                        </svg>
                    </div>
                    <div class="absolute top-10 left-[60%] right-0 hidden md:block">
                        <div class="border-t-2 border-dashed border-primary/20 w-full"></div>
                    </div>
                    <span class="text-primary font-bold text-sm mb-2 block">Step 1</span>
                    <h3 class="text-xl font-bold text-white mb-3">Book a Call</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Tell us about your brand, your offer, and your goals. We ask the right questions and take it from there.
                    </p>
                </div>

                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 border border-primary/20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z"/>
                        </svg>
                    </div>
                    <div class="absolute top-10 left-[60%] right-0 hidden md:block">
                        <div class="border-t-2 border-dashed border-primary/20 w-full"></div>
                    </div>
                    <span class="text-primary font-bold text-sm mb-2 block">Step 2</span>
                    <h3 class="text-xl font-bold text-white mb-3">We Build Your System</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        We design your content strategy, produce everything, and set up your entire funnel tailored specifically to you.
                    </p>
                </div>

                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/10 border border-primary/20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                        </svg>
                    </div>
                    <span class="text-primary font-bold text-sm mb-2 block">Step 3</span>
                    <h3 class="text-xl font-bold text-white mb-3">Grow and Evolve</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Everything goes live, we track what works, refine what doesn't, and keep pushing further every single month.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FAQs ========== --}}
    <section class="py-24 relative">
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">FAQs</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Have Questions? We have answers.
                </h2>
            </div>

            <div class="space-y-4" id="faq-container">
                @php
                $faqs = [
                    ['Who is this for?', "We work with high-ticket service businesses, consultants, finance professionals, and agencies who are serious about building a consistent inbound pipeline. If you're selling a premium service and want the right clients coming to you, this is for you."],
                    ['Do I need to be involved in the content creation process?', 'You film your content at your own pace and approve everything before it goes live. Everything else is handled entirely by us.'],
                    ['How is pricing determined?', "Every client is different. Pricing is based on your specific needs, goals, and the services you require. Reach out and we'll put together something tailored to you."],
                    ['What is the timeline of results?', 'Typically clients start seeing results within 1 to 2 months. The ones who grow the most stick with the process for 3 to 6 months and beyond.'],
                    ['Is there any guarantee?', "We don't offer guarantees. We do offer world class content and a system that has a proven track record of impacting brands."],
                    ['How soon can we get started?', 'Once we align on strategy and onboarding is complete we typically go live within two weeks.'],
                ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="faq-item card cursor-pointer group" onclick="toggleFaq(this)">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary text-sm font-bold">{{ $index + 1 }}</span>
                            <h3 class="text-white font-semibold text-sm md:text-base">{{ $faq[0] }}</h3>
                        </div>
                        <div class="faq-icon w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 transition-transform duration-300">
                            <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-400 text-sm leading-relaxed pt-4 pl-12">{{ $faq[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== CONTACT SECTION ========== --}}
    <section id="contact" class="py-24 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary/3 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <div>
                    <span class="section-label mb-6 inline-block">Contact</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-4 mb-4">
                        Ready to Build the System That Brings Clients to You?
                    </h2>
                    <p class="text-gray-400 text-lg mb-8">
                        Let's talk about what this looks like for your business.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Email</p>
                                <p class="text-white font-medium">inquiry@devixx.pro</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 003 12c0-1.605.42-3.113 1.157-4.418"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Website</p>
                                <p class="text-white font-medium">editsbydevixx.com</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-4">
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.2a6.34 6.34 0 0010.86 4.48v-7.1a8.16 8.16 0 005.58 2.2V11.3a4.85 4.85 0 01-2-.61z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent"></div>
                    <h3 class="text-xl font-bold text-white mb-2">Want Us To Reach Out To You?</h3>
                    <p class="text-gray-500 text-sm mb-6">Fill in the form and we'll get back to you.</p>

                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 uppercase tracking-wider block mb-1.5">First Name</label>
                                <input type="text" name="first_name" class="w-full bg-surface-light border border-surface-border rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 transition-colors" placeholder="John">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 uppercase tracking-wider block mb-1.5">Last Name</label>
                                <input type="text" name="last_name" class="w-full bg-surface-light border border-surface-border rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 transition-colors" placeholder="Doe">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wider block mb-1.5">E-mail</label>
                            <input type="email" name="email" class="w-full bg-surface-light border border-surface-border rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 transition-colors" placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wider block mb-1.5">Phone</label>
                            <input type="tel" name="phone" class="w-full bg-surface-light border border-surface-border rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 transition-colors" placeholder="+1 (555) 000-0000">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wider block mb-1.5">Message</label>
                            <textarea name="message" rows="4" class="w-full bg-surface-light border border-surface-border rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 transition-colors resize-none" placeholder="Tell us about your project..."></textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center text-base py-4">
                            Get a Quote
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FOOTER ========== --}}
    <footer class="relative border-t border-surface-border">
        <div class="py-16 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">
                Your expertise deserves to be seen.
            </h2>
            <p class="text-gray-400 text-lg mb-8">
                We make the right people see it, trust it, and act on it.
            </p>
            <a href="#contact" class="btn-primary text-lg px-10 py-4">
                Let's Talk
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="border-t border-surface-border py-8">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-8 w-auto">
                    <div class="flex flex-wrap items-center justify-center gap-6">
                        <a href="#services" class="text-sm text-gray-500 hover:text-white transition-colors">Services</a>
                        <a href="#testimonials" class="text-sm text-gray-500 hover:text-white transition-colors">Testimonials</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-white transition-colors">Process</a>
                        <a href="#contact" class="text-sm text-gray-500 hover:text-white transition-colors">Contact Us</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-white transition-colors">FAQ</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.2a6.34 6.34 0 0010.86 4.48v-7.1a8.16 8.16 0 005.58 2.2V11.3a4.85 4.85 0 01-2-.61z"/></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
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
    // ============================================
    // REGISTER GSAP
    // ============================================
    gsap.registerPlugin(ScrollTrigger);

    // ============================================
    // LENIS SMOOTH SCROLL
    // ============================================
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smooth: true,
    });

    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) lenis.scrollTo(target, { offset: -80 });
        });
    });

    // ============================================
    // CUSTOM CURSOR
    // ============================================
    const cursorDot = document.getElementById('cursor-dot');
    const cursorRing = document.getElementById('cursor-ring');
    let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        gsap.to(cursorDot, { x: mouseX, y: mouseY, duration: 0.1 });
    });

    (function animateRing() {
        ringX += (mouseX - ringX) * 0.15;
        ringY += (mouseY - ringY) * 0.15;
        gsap.set(cursorRing, { x: ringX, y: ringY });
        requestAnimationFrame(animateRing);
    })();

    document.querySelectorAll('a, button, .card, .faq-item, input, textarea').forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(cursorRing, { width: 60, height: 60, borderColor: 'rgba(139,92,246,0.6)', duration: 0.3 });
            gsap.to(cursorDot, { scale: 0.5, duration: 0.3 });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(cursorRing, { width: 40, height: 40, borderColor: 'rgba(255,255,255,0.5)', duration: 0.3 });
            gsap.to(cursorDot, { scale: 1, duration: 0.3 });
        });
    });

    // ============================================
    // MAGNETIC BUTTONS
    // ============================================
    document.querySelectorAll('.magnetic').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            gsap.to(btn, { x: x * 0.3, y: y * 0.3, duration: 0.3, ease: 'power2.out' });
        });
        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
        });
    });

    // ============================================
    // PAGE LOADER + HERO ENTRANCE
    // ============================================
    window.addEventListener('load', () => {
        const loader = document.getElementById('page-loader');
        const tl = gsap.timeline();

        tl.to(loader, {
            opacity: 0, duration: 0.6, ease: 'power2.inOut',
            onComplete: () => { loader.style.display = 'none'; }
        })
        .from('[data-hero-anim]', {
            y: 60, opacity: 0, duration: 1, stagger: 0.15, ease: 'power3.out',
        }, '-=0.2')
        .call(() => {
            // Refresh ScrollTrigger after all initial animations complete
            ScrollTrigger.refresh();
        });
    });

    // ============================================
    // NAVBAR
    // ============================================
    const navbar = document.getElementById('navbar');
    ScrollTrigger.create({
        onUpdate: (self) => {
            const s = self.scroll();
            if (s > 50) {
                navbar.style.background = 'rgba(10,10,15,0.85)';
                navbar.style.backdropFilter = 'blur(20px)';
                navbar.style.borderBottom = '1px solid rgba(30,30,42,0.8)';
            } else {
                navbar.style.background = 'transparent';
                navbar.style.backdropFilter = 'none';
                navbar.style.borderBottom = 'none';
            }
            if (s > 300) {
                gsap.to(navbar, { y: self.direction === 1 ? -100 : 0, duration: 0.3, overwrite: true });
            } else {
                gsap.to(navbar, { y: 0, duration: 0.3, overwrite: true });
            }
        }
    });

    // Mobile menu
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    mobileMenu.querySelectorAll('a').forEach(l => l.addEventListener('click', () => mobileMenu.classList.add('hidden')));

    // ============================================
    // SCROLL REVEAL — Using ScrollTrigger.batch for reliability
    // All elements start visible, animate FROM off-screen
    // ============================================

    // Helper: create a reveal for a set of elements
    function reveal(selector, fromVars, staggerAmt = 0) {
        const els = gsap.utils.toArray(selector);
        if (!els.length) return;
        els.forEach((el, i) => {
            gsap.fromTo(el,
                { ...fromVars, opacity: 0 },
                {
                    ...Object.fromEntries(Object.keys(fromVars).map(k => [k, 0])),
                    opacity: 1,
                    duration: fromVars.duration || 0.8,
                    ease: fromVars.ease || 'power3.out',
                    delay: staggerAmt * i,
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        });
    }

    // Section labels
    reveal('.section-label', { y: 20, duration: 0.6 });

    // Section headings
    reveal('section h2, footer h2', { y: 50, duration: 0.8 });

    // Paragraphs in section headers
    reveal('.text-center > p.text-gray-400, .text-center > p.text-gray-500', { y: 30, duration: 0.7 });

    // Cards in grids — use batch for stagger effect
    gsap.utils.toArray('.grid').forEach(grid => {
        const items = grid.querySelectorAll('.card, .stat-item, [class*="group relative aspect-"]');
        if (!items.length) return;
        items.forEach((item, i) => {
            gsap.fromTo(item,
                { y: 50, opacity: 0 },
                {
                    y: 0, opacity: 1,
                    duration: 0.7,
                    ease: 'power3.out',
                    delay: i * 0.1,
                    scrollTrigger: {
                        trigger: grid,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        });
    });

    // Individual service cards (slide from alternating sides)
    gsap.utils.toArray('.space-y-6 > .card').forEach((card, i) => {
        gsap.fromTo(card,
            { x: i % 2 === 0 ? -50 : 50, opacity: 0 },
            {
                x: 0, opacity: 1,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: card,
                    start: 'top 88%',
                    toggleActions: 'play none none none',
                }
            }
        );
    });

    // "What's Included" label
    reveal('span.text-sm.text-gray-500.uppercase', { y: 15, duration: 0.5 });

    // CTA banner
    const ctaBanner = document.querySelector('[class*="from-primary\\/20"][class*="to-accent\\/20"]');
    if (ctaBanner) {
        gsap.fromTo(ctaBanner,
            { y: 40, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
              scrollTrigger: { trigger: ctaBanner, start: 'top 88%', toggleActions: 'play none none none' }
            }
        );
    }

    // "A Note From Us" card
    reveal('.card.p-8.md\\:p-12', { y: 40, duration: 0.8 });

    // How It Works step line draw
    gsap.utils.toArray('[class*="border-dashed"]').forEach(line => {
        gsap.fromTo(line,
            { scaleX: 0 },
            {
                scaleX: 1,
                transformOrigin: 'left center',
                duration: 1.2,
                ease: 'power2.inOut',
                scrollTrigger: { trigger: line, start: 'top 85%', toggleActions: 'play none none none' }
            }
        );
    });

    // ============================================
    // STATS COUNTER ANIMATION
    // ============================================
    const statsSection = document.querySelector('[data-stats]');
    if (statsSection) {
        const counters = statsSection.querySelectorAll('[data-count]');
        ScrollTrigger.create({
            trigger: statsSection,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                counters.forEach(counter => {
                    const target = parseInt(counter.dataset.count);
                    const prefix = counter.dataset.prefix || '';
                    const suffix = counter.dataset.suffix || '';
                    gsap.to({ val: 0 }, {
                        val: target, duration: 2, ease: 'power2.out',
                        onUpdate: function() {
                            counter.textContent = prefix + Math.round(this.targets()[0].val) + suffix;
                        }
                    });
                });
            }
        });

        // Stats bar scale-in
        gsap.fromTo(statsSection.closest('.relative.py-6'),
            { scaleX: 0.85, opacity: 0 },
            { scaleX: 1, opacity: 1, duration: 1, ease: 'power3.out',
              scrollTrigger: { trigger: statsSection, start: 'top 90%', toggleActions: 'play none none none' }
            }
        );
    }

    // ============================================
    // PARALLAX BACKGROUNDS + FLOAT
    // ============================================
    document.querySelectorAll('[data-parallax]').forEach((el, i) => {
        const speed = parseFloat(el.dataset.speed) || 0.3;
        gsap.to(el, {
            y: () => window.innerHeight * speed,
            ease: 'none',
            scrollTrigger: { trigger: el.parentElement, start: 'top bottom', end: 'bottom top', scrub: 1.5 }
        });
        gsap.to(el, {
            y: '+=20', x: '+=10',
            duration: 3 + i, repeat: -1, yoyo: true, ease: 'sine.inOut',
        });
    });

    // ============================================
    // CARD TILT ON HOVER (3D) + GLOW FOLLOW
    // ============================================
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            gsap.to(card, {
                rotateY: x * 8, rotateX: -y * 8,
                transformPerspective: 800, duration: 0.4, ease: 'power2.out',
            });
            card.style.setProperty('--glow-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--glow-y', `${e.clientY - rect.top}px`);
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.6, ease: 'elastic.out(1, 0.5)' });
        });
    });

    // ============================================
    // FAQ ACCORDION
    // ============================================
    function toggleFaq(el) {
        document.querySelectorAll('.faq-item').forEach(item => {
            if (item !== el && item.classList.contains('active')) {
                item.classList.remove('active');
                gsap.to(item.querySelector('.faq-answer'), { maxHeight: 0, paddingTop: 0, duration: 0.4, ease: 'power2.inOut' });
            }
        });
        el.classList.toggle('active');
        const answer = el.querySelector('.faq-answer');
        if (el.classList.contains('active')) {
            gsap.to(answer, { maxHeight: 300, paddingTop: 16, duration: 0.5, ease: 'power2.out' });
        } else {
            gsap.to(answer, { maxHeight: 0, paddingTop: 0, duration: 0.4, ease: 'power2.inOut' });
        }
    }

    // ============================================
    // SCROLL PROGRESS BAR
    // ============================================
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    progressBar.style.cssText = 'position:fixed;top:0;left:0;height:2px;background:linear-gradient(90deg,#8B5CF6,#C084FC);z-index:9999;transform-origin:left;transform:scaleX(0);width:100%;';
    document.body.prepend(progressBar);

    ScrollTrigger.create({
        trigger: document.body, start: 'top top', end: 'bottom bottom',
        onUpdate: (self) => { gsap.set(progressBar, { scaleX: self.progress }); }
    });
    </script>
</body>
</html>
