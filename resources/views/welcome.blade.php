<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edits by Devixx — Content That Gets You Chosen</title>
    <meta name="description" content="Built around one goal. Getting you clients.">
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
    <div id="page-loader" class="fixed inset-0 z-[9998] bg-black flex items-center justify-center">
        <div class="text-center">
            <div class="w-12 h-12 border-2 border-primary/20 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
            <span class="text-primary font-medium text-sm tracking-widest uppercase">Loading</span>
        </div>
    </div>

    {{-- Noise Texture Overlay --}}
    <div class="fixed inset-0 pointer-events-none z-[100] opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>

    {{-- Background Grid Overlay --}}
    <div id="bg-grid"></div>

    {{-- ========== NAVBAR ========== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 pt-4">
        <div class="navbar-pill max-w-5xl mx-auto mx-4 md:mx-auto flex items-center justify-between px-8 py-4 rounded-full border border-white/[0.06] transition-all duration-500" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            {{-- Logo --}}
            <a href="#" class="block shrink-0">
                <img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-9 md:h-10 w-auto">
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-9">
                <a href="#services" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Services</a>
                <a href="#projects" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Projects</a>
                <a href="#testimonials" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Testimonials</a>
                <a href="#contact" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Contact</a>
            </div>

            {{-- CTA Button --}}
            <a href="#contact" class="hidden md:inline-flex items-center px-6 py-2.5 rounded-full border border-[#c8ff00]/60 text-[#c8ff00] text-[15px] font-medium transition-all duration-300 hover:bg-[#c8ff00]/10 hover:border-[#c8ff00] hover:shadow-[0_0_20px_rgba(200,255,0,0.15)] magnetic shrink-0">
                Get in Touch
            </a>

            {{-- Mobile Toggle --}}
            <button id="mobile-toggle" class="md:hidden text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden mx-4 mt-2 rounded-2xl border border-white/[0.06] overflow-hidden transition-all duration-300" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <div class="px-6 py-5 flex flex-col gap-4">
                <a href="#services" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Services</a>
                <a href="#projects" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Projects</a>
                <a href="#testimonials" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Testimonials</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Contact</a>
                <a href="#contact" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full border border-[#c8ff00]/60 text-[#c8ff00] text-sm font-medium transition-all duration-300 hover:bg-[#c8ff00]/10">Get in Touch</a>
            </div>
        </div>
    </nav>

    {{-- ========== HERO SECTION ========== --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        {{-- Junox-style ambient glow --}}
        <div id="hero-glow"></div>

        <div class="relative max-w-6xl mx-auto px-6 text-center">
            <div data-hero-anim class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-8">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-sm text-primary-light font-medium">Now Accepting New Clients</span>
            </div>

            <h1 data-hero-anim data-split class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-[1.1] mb-6 tracking-tight">
                Helping Service Businesses Build the
                <span class="bg-gradient-to-r from-primary via-accent to-primary-light bg-clip-text text-transparent animate-gradient">Content System</span>
                That Brings High-Ticket Clients to You
            </h1>

            <p data-hero-anim class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                Built around one goal. Getting you clients.
            </p>

            <div data-hero-anim class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-6">
                <a href="#contact" class="btn-primary magnetic text-base sm:text-lg px-8 sm:px-10 py-3.5 sm:py-4 animate-pulse-glow">
                    Let's Talk
                </a>
            </div>
        </div>
    </section>

    {{-- ========== TRUSTED BY ========== --}}
    <section class="pt-0 pb-20 -mt-16 relative overflow-hidden">
        <p class="text-center text-gray-500 italic text-base mb-12 tracking-wide">Trusted by the best</p>

        @php
            $brandsRow1 = [
                ['name' => 'Starter Studio', 'initials' => 'SS', 'color' => '#2d3a3a', 'text' => '#5eead4'],
                ['name' => 'Acquired', 'initials' => 'ACQ', 'color' => '#10b981', 'text' => '#ffffff'],
                ['name' => 'MediaForge', 'initials' => 'MF', 'color' => '#f97316', 'text' => '#ffffff'],
                ['name' => 'BrandPulse', 'initials' => 'BP', 'color' => '#ef4444', 'text' => '#ffffff'],
                ['name' => 'VisionCraft', 'initials' => 'VC', 'color' => '#1e1e2e', 'text' => '#ffffff'],
                ['name' => 'ContentHQ', 'initials' => 'CH', 'color' => '#f5f5f5', 'text' => '#111111'],
                ['name' => 'ScaleUp', 'initials' => 'SU', 'color' => '#6366f1', 'text' => '#ffffff'],
            ];
            $brandsRow2 = [
                ['name' => 'Greylock', 'initials' => 'G', 'color' => '#1a1a2e', 'text' => '#9ca3af'],
                ['name' => 'No Priors', 'initials' => 'NP', 'color' => '#7c3aed', 'text' => '#ffffff'],
                ['name' => 'Tessl', 'initials' => 'T', 'color' => '#1e293b', 'text' => '#38bdf8'],
                ['name' => 'GrowthLab', 'initials' => 'GL', 'color' => '#1a1a2e', 'text' => '#a78bfa'],
                ['name' => 'Darknet', 'initials' => 'DN', 'color' => '#7c3aed', 'text' => '#ffffff'],
                ['name' => 'Primary VC', 'initials' => 'PV', 'color' => '#1e293b', 'text' => '#38bdf8'],
            ];
        @endphp

        {{-- Row 1 — scrolls left --}}
        <div class="marquee-wrapper mb-8">
            <div class="marquee-track">
                @for ($i = 0; $i < 4; $i++)
                    @foreach ($brandsRow1 as $brand)
                        <div class="marquee-item">
                            <div class="w-24 h-24 rounded-2xl flex items-center justify-center font-bold text-2xl" style="background: {{ $brand['color'] }}; color: {{ $brand['text'] }};">
                                {{ $brand['initials'] }}
                            </div>
                            <span class="text-gray-500 text-xs mt-3 block text-center">{{ $brand['name'] }}</span>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>

        {{-- Row 2 — scrolls right (reverse) --}}
        <div class="marquee-wrapper">
            <div class="marquee-track marquee-reverse">
                @for ($i = 0; $i < 4; $i++)
                    @foreach ($brandsRow2 as $brand)
                        <div class="marquee-item">
                            <div class="w-24 h-24 rounded-2xl flex items-center justify-center font-bold text-2xl" style="background: {{ $brand['color'] }}; color: {{ $brand['text'] }};">
                                {{ $brand['initials'] }}
                            </div>
                            <span class="text-gray-500 text-xs mt-3 block text-center">{{ $brand['name'] }}</span>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    {{-- ========== CASE STUDIES ========== --}}
    <section id="case-studies" class="py-24 relative">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Case Studies</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Results We're Proud Of.
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Real businesses. Real problems. Real results.
                </p>
            </div>

            {{-- Case Study Slider --}}
            <div class="relative overflow-hidden rounded-2xl">
                <div id="casestudy-track" class="flex transition-transform duration-500">

                    {{-- Slide 1 --}}
                    <div class="casestudy-slide w-full flex-shrink-0">
                        <div class="grid md:grid-cols-2 bg-surface-card border border-surface-border rounded-2xl overflow-hidden min-h-[420px]">
                            {{-- Image --}}
                            <div class="relative bg-gradient-to-br from-surface-light to-surface-card flex items-center justify-center min-h-[280px] md:min-h-full">
                                <div class="text-center p-8">
                                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-gray-600 text-sm">Thumbnail Coming Soon</p>
                                </div>
                                <span class="absolute top-4 left-4 bg-[#c8ff00] text-black text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-md">Featured</span>
                            </div>
                            {{-- Content --}}
                            <div class="flex flex-col justify-center p-8 md:p-12">
                                <span class="text-primary text-xs font-semibold uppercase tracking-[0.15em] mb-4">Construction Bookkeeping</span>
                                <h3 class="text-2xl md:text-3xl font-bold text-white mb-5 leading-snug">
                                    How a Bookkeeper With Zero Online Presence Started Getting Inbound Clients in 60 Days.
                                </h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                    We partnered with a construction bookkeeper to build a content engine from scratch — going from zero social presence to a steady stream of qualified inbound leads in just two months.
                                </p>
                                <div class="flex items-end justify-between mt-auto">
                                    <div>
                                        <p class="text-white text-xl md:text-2xl font-bold">12 Inbound Clients</p>
                                        <p class="text-gray-500 text-sm">In the First 60 Days</p>
                                    </div>
                                    <a href="#" class="inline-flex items-center gap-2 text-white hover:text-primary-light transition-colors font-medium text-sm whitespace-nowrap">
                                        View case study
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 2 --}}
                    <div class="casestudy-slide w-full flex-shrink-0">
                        <div class="grid md:grid-cols-2 bg-surface-card border border-surface-border rounded-2xl overflow-hidden min-h-[420px]">
                            {{-- Image --}}
                            <div class="relative bg-gradient-to-br from-surface-light to-surface-card flex items-center justify-center min-h-[280px] md:min-h-full">
                                <div class="text-center p-8">
                                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-gray-600 text-sm">Thumbnail Coming Soon</p>
                                </div>
                                <span class="absolute top-4 left-4 bg-[#c8ff00] text-black text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-md">Featured</span>
                            </div>
                            {{-- Content --}}
                            <div class="flex flex-col justify-center p-8 md:p-12">
                                <span class="text-primary text-xs font-semibold uppercase tracking-[0.15em] mb-4">Small Business Bookkeeping</span>
                                <h3 class="text-2xl md:text-3xl font-bold text-white mb-5 leading-snug">
                                    How We Took a Small Business Bookkeeper From Invisible to Fully Booked Through Content.
                                </h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                    A small business bookkeeper came to us with no online visibility. We built a full content strategy that transformed their brand into a client magnet — fully booked within months.
                                </p>
                                <div class="flex items-end justify-between mt-auto">
                                    <div>
                                        <p class="text-white text-xl md:text-2xl font-bold">Fully Booked</p>
                                        <p class="text-gray-500 text-sm">Through Content Alone</p>
                                    </div>
                                    <a href="#" class="inline-flex items-center gap-2 text-white hover:text-primary-light transition-colors font-medium text-sm whitespace-nowrap">
                                        View case study
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Navigation Arrows --}}
                <button onclick="slideCaseStudy(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideCaseStudy(1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Dot Indicators --}}
            <div class="flex items-center justify-center gap-2 mt-8">
                <button onclick="goToCaseStudy(0)" class="casestudy-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all duration-300" data-index="0"></button>
                <button onclick="goToCaseStudy(1)" class="casestudy-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all duration-300" data-index="1"></button>
            </div>
        </div>
    </section>

    {{-- ========== PORTFOLIO ========== --}}
    <section id="projects" class="py-24 relative">
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px] -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Portfolio</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Content That Brings Clients In.
                    <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Not Just Views.</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-3xl mx-auto">
                    Every video we make is built to attract the right person and make them reach out. Here's some of our work.
                </p>
            </div>

            {{-- Short-Form Videos --}}
            @php
            $shortFormVideos = [
                ['src' => 'videos/short-form/video-01.mp4', 'type' => 'video/mp4'],
                ['src' => 'videos/short-form/video-02.mp4', 'type' => 'video/mp4'],
                ['src' => 'videos/short-form/video-03.mp4', 'type' => 'video/mp4'],
                ['src' => 'videos/short-form/video-04.mp4', 'type' => 'video/mp4'],
            ];
            @endphp
            <div class="mb-16">
                <h3 class="text-xl font-semibold text-white mb-6">Short-Form Videos</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($shortFormVideos as $video)
                    <div class="group relative aspect-[9/16] rounded-2xl overflow-hidden bg-surface-card border border-surface-border hover:border-primary/30 transition-all duration-300 cursor-pointer" onclick="toggleVideo(this)">
                        <video class="absolute inset-0 w-full h-full object-cover" loop playsinline muted preload="metadata">
                            <source src="{{ asset($video['src']) }}" type="{{ $video['type'] }}">
                        </video>
                        <div class="video-overlay absolute inset-0 bg-black/30 transition-opacity duration-300"></div>
                        <div class="play-btn absolute inset-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="w-14 h-14 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l4.5-3.3v13l-4.5-3.3H3.5a1 1 0 01-1-1v-4.4a1 1 0 011-1h3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Long Form & Trailers --}}
            @php
            $longFormVideos = [
                ['src' => 'videos/long-form/video-01.mp4'],
                ['src' => 'videos/long-form/video-02.mp4'],
            ];
            @endphp
            <div>
                <h3 class="text-xl font-semibold text-white mb-6">Long Form and Trailers</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($longFormVideos as $video)
                    <div class="group relative aspect-video rounded-2xl overflow-hidden bg-surface-card border border-surface-border hover:border-primary/30 transition-all duration-300 cursor-pointer" onclick="toggleVideo(this)">
                        <video class="absolute inset-0 w-full h-full object-cover" loop playsinline muted preload="metadata">
                            <source src="{{ asset($video['src']) }}" type="video/mp4">
                        </video>
                        <div class="video-overlay absolute inset-0 bg-black/30 transition-opacity duration-300"></div>
                        <div class="play-btn absolute inset-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l4.5-3.3v13l-4.5-3.3H3.5a1 1 0 01-1-1v-4.4a1 1 0 011-1h3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ========== SERVICES ========== --}}
    <section id="services" class="py-24 relative">
        <div class="absolute bottom-0 left-0 w-[600px] h-[400px] bg-accent/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Our Services</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Choose How We Work Together.
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Every business is different. So every plan we build is tailored to fit yours.
                </p>
            </div>

            {{-- Service Plans with slider-style layout --}}
            <div class="grid lg:grid-cols-3 gap-6 items-start" id="service-plans">
                {{-- CORE Plan (Highlighted) --}}
                <div class="card service-plan active relative overflow-hidden p-8 lg:p-10 border-primary/40 lg:scale-105 lg:-my-4 z-10" data-plan="core">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-accent/5 pointer-events-none"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-primary bg-primary/10 px-3 py-1 rounded-full">Most Popular</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Core</h3>
                        <p class="text-gray-400 leading-relaxed mb-6">
                            For businesses in their early growth phase. We work on a small retainer plus a commission on every client we bring you. If we don't deliver, we don't earn. Simple as that.
                        </p>
                        @php
                        $coreFeatures = [
                            'Small monthly retainer',
                            'Commission on every client we bring',
                            'Custom strategy built around your offer',
                            'Fully done for you',
                            'Monthly performance reviews',
                        ];
                        @endphp
                        <ul class="space-y-3 mb-8">
                            @foreach($coreFeatures as $feature)
                            <li class="flex items-center gap-3 text-gray-300">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="#contact" class="btn-primary w-full justify-center">
                            Get Started
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- SCALE Plan --}}
                <div class="card service-plan relative overflow-hidden p-8" data-plan="scale">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <h3 class="text-2xl font-bold text-white mb-3">Scale</h3>
                        <p class="text-gray-400 leading-relaxed mb-6">
                            For businesses ready to hand their entire marketing to one team and focus on what they do best. Fixed monthly retainer. No commission. Just results.
                        </p>
                        @php
                        $scaleFeatures = [
                            'Fixed monthly retainer',
                            'Consistent weekly content output',
                            'Produced and edited to the highest standard',
                            'Built around your specific goals',
                            'Monthly strategy reviews',
                        ];
                        @endphp
                        <ul class="space-y-3 mb-8">
                            @foreach($scaleFeatures as $feature)
                            <li class="flex items-center gap-3 text-gray-300">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="#contact" class="btn-outline w-full justify-center">
                            Get Started
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- CUSTOM Plan --}}
                <div class="card service-plan relative overflow-hidden p-8" data-plan="custom">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <h3 class="text-2xl font-bold text-white mb-3">Custom</h3>
                        <p class="text-gray-400 leading-relaxed mb-6">
                            For businesses that need one specific thing done right. Tell us what you need and we'll build exactly that.
                        </p>
                        @php
                        $customFeatures = [
                            'World class short-form content',
                            'Professional YouTube and long-form production',
                            'Podcast editing and distribution',
                            'Meta paid ads management',
                            'Premium video editing',
                            'Mix and match what you need',
                        ];
                        @endphp
                        <ul class="space-y-3 mb-8">
                            @foreach($customFeatures as $feature)
                            <li class="flex items-center gap-3 text-gray-300">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="#contact" class="btn-outline w-full justify-center">
                            Get Started
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
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
                        Your system goes live. We track what works, refine what doesn't, and keep pushing further monthly to ensure success.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== STATS ========== --}}
    <section class="py-24 relative" id="stats-section">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 lg:gap-12" data-stats>
                <div class="text-center stat-item">
                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white block" data-count="1000000" data-suffix="+" data-display="1M+">0</span>
                    <span class="text-sm md:text-base text-gray-500 mt-2 block">Views Generated</span>
                </div>
                <div class="text-center stat-item">
                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white block" data-count="300" data-suffix="%+" data-display="300%+">0</span>
                    <span class="text-sm md:text-base text-gray-500 mt-2 block">Average ROI</span>
                </div>
                <div class="text-center stat-item">
                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white block" data-count="500" data-suffix="+" data-display="500+">0</span>
                    <span class="text-sm md:text-base text-gray-500 mt-2 block">Content Produced</span>
                </div>
                <div class="text-center stat-item">
                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white block" data-count="10" data-suffix="+" data-display="10+">0</span>
                    <span class="text-sm md:text-base text-gray-500 mt-2 block">Clients Served</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== TESTIMONIALS ========== --}}
    <section id="testimonials" class="py-24 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-16 gap-6">
                <div>
                    <span class="section-label mb-6 inline-block">Testimonials</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                        Don't Take Our Word for It.
                    </h2>
                    <p class="text-gray-400 text-lg">We let our clients do the talking.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-gray-500 text-sm font-medium mr-2" id="testimonial-counter">01 / 06</span>
                    <button onclick="slideTestimonial(-1)" class="w-11 h-11 rounded-full border border-surface-border bg-surface-card flex items-center justify-center text-gray-400 hover:text-white hover:border-primary/40 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button onclick="slideTestimonial(1)" class="w-11 h-11 rounded-full border border-surface-border bg-surface-card flex items-center justify-center text-gray-400 hover:text-white hover:border-primary/40 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

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

            <div class="relative" id="testimonial-slider">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" id="testimonial-track" style="transform: translateX(0)">
                        @foreach($testimonials as $index => $testimonial)
                        <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-3">
                            <div class="card p-8 h-full flex flex-col hover:bg-surface-card/80 group">
                                <div class="flex items-center gap-1 mb-5">
                                    @for($s = 0; $s < 5; $s++)
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <div class="relative flex-1">
                                    <svg class="w-8 h-8 text-primary/20 mb-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                    </svg>
                                    <p class="text-gray-400 leading-relaxed">{{ $testimonial['text'] }}</p>
                                </div>
                                <div class="flex items-center gap-4 mt-6 pt-6 border-t border-surface-border">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold">{{ substr($testimonial['name'], 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">{{ $testimonial['name'] }}</h4>
                                        <p class="text-gray-500 text-sm">{{ $testimonial['role'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FAQs (Tabbed) ========== --}}
    <section class="py-24 relative">
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>
        <div class="max-w-3xl mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">FAQs</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Have Questions? We have answers.
                </h2>
            </div>

            {{-- FAQ Tabs --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <button class="faq-tab active px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 bg-primary/10 text-primary border border-primary/20" data-tab="general" onclick="switchFaqTab('general')">General</button>
                <button class="faq-tab px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 bg-surface-card text-gray-400 border border-surface-border hover:text-white" data-tab="how-we-work" onclick="switchFaqTab('how-we-work')">How We Work</button>
                <button class="faq-tab px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 bg-surface-card text-gray-400 border border-surface-border hover:text-white" data-tab="our-services" onclick="switchFaqTab('our-services')">Services</button>
            </div>

            {{-- General FAQs --}}
            <div class="faq-tab-content space-y-3 md:space-y-4" id="faq-general" data-tab-content="general">
                @php
                $generalFaqs = [
                    ['Who is behind DEVIXX?', "We're a small team that got tired of agencies charging big retainers with nothing to show for it. So we built ours differently. We take on a select few clients, stay fully invested in each one, and built a model where our income depends on your results. No results, no justification for our fee. That's the standard we hold ourselves to."],
                    ['Who is this for?', "We work with high-ticket service businesses, consultants, finance professionals, and agencies who are serious about building a consistent inbound pipeline. If you're selling a premium service and want the right clients coming to you, this is for you."],
                    ['What is the timeline of results?', 'Typically clients start seeing results within 1 to 2 months. The ones who grow the most stick with the process for 3 to 6 months and beyond.'],
                    ['Is there any guarantee?', "We don't offer guarantees. We do offer world class content and a system that has a proven track record of impacting brands."],
                    ['How soon can we get started?', 'Once we align on strategy and onboarding is complete we typically go live within two weeks.'],
                ];
                @endphp
                @foreach($generalFaqs as $index => $faq)
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
                        <p class="text-gray-400 text-sm leading-relaxed pt-4 pl-8 md:pl-12">{{ $faq[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- How We Work FAQs --}}
            <div class="faq-tab-content space-y-3 md:space-y-4 hidden" id="faq-how-we-work" data-tab-content="how-we-work">
                @php
                $howWeWorkFaqs = [
                    ['How does the commission model work?', "We've seen too many businesses hesitate to invest in an agency because of the upfront cost. So we removed that barrier. You pay a small monthly retainer and we take a commission on every client we bring you. The better we perform the more we earn. If we don't deliver you barely paid anything."],
                    ['How do you track where leads come from?', 'Since we build and run your entire funnel we have full visibility into where every lead comes from. Every inbound conversation is tracked and attributed accurately.'],
                    ['Do I need to be involved in the content creation process?', "You film your content at your own pace and approve everything before it goes live. Everything else is handled entirely by us. We recommend setting aside one dedicated day per month to batch record your content. It keeps things consistent without eating into your schedule. If filming isn't an option at all we have a separate offer for that. Contact us to learn more."],
                    ['How is pricing determined?', "Every client is different. Pricing is based on your specific needs, goals, and the services you require. Reach out and we'll put together something tailored to you."],
                    ['What if I want a straight retainer without the commission model?', "No problem. We also work on a straight retainer basis for businesses who want the full system built and run without the commission structure. Reach out and we'll figure out what fits."],
                ];
                @endphp
                @foreach($howWeWorkFaqs as $index => $faq)
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
                        <p class="text-gray-400 text-sm leading-relaxed pt-4 pl-8 md:pl-12">{{ $faq[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Our Services FAQs --}}
            <div class="faq-tab-content space-y-3 md:space-y-4 hidden" id="faq-our-services" data-tab-content="our-services">
                @php
                $servicesFaqs = [
                    ['What services do you offer?', 'We offer short-form content, long-form YouTube videos, podcast editing and distribution, Meta paid ads management, and video editing only. You can take on the full system or pick the individual service you need.'],
                    ['Can I start with one service and scale up later?', "Absolutely. A lot of clients start with one service to see how we work and add more as they grow. There's no pressure to commit to everything upfront."],
                    ['What platforms do you post on?', 'We primarily work with Instagram, TikTok, LinkedIn, and YouTube. Additional platforms can be discussed during onboarding.'],
                    ['How does the video editing only service work?', 'You send us your raw footage and we handle the editing, motion captions, and formatting. 48 hour turnaround with 2 rounds of free revisions included.'],
                ];
                @endphp
                @foreach($servicesFaqs as $index => $faq)
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
                        <p class="text-gray-400 text-sm leading-relaxed pt-4 pl-8 md:pl-12">{{ $faq[1] }}</p>
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
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start">
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
                                <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">WhatsApp</p>
                                <p class="text-white font-medium">+1 (555) 000-0000</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-4">
                            {{-- Instagram --}}
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            {{-- X (Twitter) --}}
                            <a href="#" class="w-10 h-10 rounded-xl bg-surface-card border border-surface-border flex items-center justify-center text-gray-400 hover:text-primary hover:border-primary/30 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-accent"></div>
                    <h3 class="text-xl font-bold text-white mb-2">Want Us To Reach Out To You?</h3>
                    <p class="text-gray-500 text-sm mb-6">Fill in the form and we'll get back to you.</p>

                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
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
                You deserve to win. We make sure you do.
            </h2>
            <p class="text-gray-400 text-lg mb-8">
                We build the system. You close the deals. That's the whole thing.
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
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6">
                        <a href="#services" class="text-sm text-gray-500 hover:text-white transition-colors">Services</a>
                        <a href="#testimonials" class="text-sm text-gray-500 hover:text-white transition-colors">Testimonials</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-white transition-colors">Process</a>
                        <a href="#contact" class="text-sm text-gray-500 hover:text-white transition-colors">Contact Us</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-white transition-colors">FAQ</a>
                    </div>
                    <div class="flex items-center gap-3">
                        {{-- Instagram --}}
                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        {{-- X (Twitter) --}}
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
            if (target) lenis.scrollTo(target, { offset: window.innerWidth < 768 ? -60 : -80 });
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

    document.querySelectorAll('a, button, .card, .faq-item, .faq-tab, input, textarea').forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(cursorRing, { width: 60, height: 60, borderColor: 'rgba(147,51,234,0.6)', duration: 0.3 });
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
            ScrollTrigger.refresh();
        });
    });

    // ============================================
    // NAVBAR
    // ============================================
    const navbar = document.getElementById('navbar');
    const navbarPill = navbar.querySelector('.navbar-pill');
    ScrollTrigger.create({
        onUpdate: (self) => {
            const s = self.scroll();
            if (s > 50) {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.3)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.08)';
            } else {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.25)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.06)';
            }
            gsap.set(navbar, { y: 0 });
        }
    });

    // Mobile menu
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    mobileMenu.querySelectorAll('a').forEach(l => l.addEventListener('click', () => mobileMenu.classList.add('hidden')));

    // ============================================
    // SCROLL REVEAL
    // ============================================
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

    // Cards in grids
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

    // Service plan cards - blur/focus effect on hover
    const servicePlans = document.querySelectorAll('.service-plan');
    servicePlans.forEach(plan => {
        plan.addEventListener('mouseenter', () => {
            servicePlans.forEach(p => {
                if (p !== plan) {
                    gsap.to(p, { opacity: 0.5, filter: 'blur(2px)', duration: 0.3 });
                }
            });
        });
        plan.addEventListener('mouseleave', () => {
            servicePlans.forEach(p => {
                gsap.to(p, { opacity: 1, filter: 'blur(0px)', duration: 0.3 });
            });
        });
    });

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
                    const display = counter.dataset.display;
                    const suffix = counter.dataset.suffix || '';

                    if (target >= 1000000) {
                        // Animate to 1M+
                        gsap.to({ val: 0 }, {
                            val: 1, duration: 2.5, ease: 'power2.out',
                            onUpdate: function() {
                                const v = this.targets()[0].val;
                                if (v < 1) {
                                    counter.textContent = Math.round(v * 1000) + 'K+';
                                } else {
                                    counter.textContent = '1M+';
                                }
                            }
                        });
                    } else {
                        gsap.to({ val: 0 }, {
                            val: target, duration: 2, ease: 'power2.out',
                            onUpdate: function() {
                                counter.textContent = Math.round(this.targets()[0].val) + suffix;
                            }
                        });
                    }
                });
            }
        });
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
        const container = el.closest('.faq-tab-content');
        container.querySelectorAll('.faq-item').forEach(item => {
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
    // FAQ TABS
    // ============================================
    function switchFaqTab(tabName) {
        // Close all open FAQs first
        document.querySelectorAll('.faq-item.active').forEach(item => {
            item.classList.remove('active');
            gsap.set(item.querySelector('.faq-answer'), { maxHeight: 0, paddingTop: 0 });
        });

        // Update tab buttons
        document.querySelectorAll('.faq-tab').forEach(tab => {
            if (tab.dataset.tab === tabName) {
                tab.classList.add('active');
                tab.className = tab.className.replace('bg-surface-card text-gray-400 border-surface-border', 'bg-primary/10 text-primary border-primary/20');
            } else {
                tab.classList.remove('active');
                tab.className = tab.className.replace('bg-primary/10 text-primary border-primary/20', 'bg-surface-card text-gray-400 border-surface-border');
            }
        });

        // Show/hide content
        document.querySelectorAll('.faq-tab-content').forEach(content => {
            if (content.dataset.tabContent === tabName) {
                content.classList.remove('hidden');
                // Animate in
                gsap.fromTo(content.querySelectorAll('.faq-item'),
                    { y: 20, opacity: 0 },
                    { y: 0, opacity: 1, duration: 0.4, stagger: 0.05, ease: 'power2.out' }
                );
            } else {
                content.classList.add('hidden');
            }
        });
    }

    // ============================================
    // VIDEO AUTO-PLAY ON SCROLL + CLICK TO UNMUTE
    // ============================================
    function pauseAllVideos(except) {
        document.querySelectorAll('[onclick="toggleVideo(this)"] video').forEach(v => {
            if (v !== except && !v.muted) {
                v.muted = true;
                const c = v.closest('[onclick="toggleVideo(this)"]');
                gsap.to(c.querySelector('.play-btn'), { opacity: 1, duration: 0.3 });
            }
        });
    }

    function toggleVideo(container) {
        const video = container.querySelector('video');
        const playBtn = container.querySelector('.play-btn');
        if (video.muted) {
            pauseAllVideos(video);
            video.muted = false;
            gsap.to(playBtn, { opacity: 0, duration: 0.3 });
        } else {
            video.muted = true;
            gsap.to(playBtn, { opacity: 1, duration: 0.3 });
        }
    }

    // Auto-play videos muted when scrolled into view
    document.querySelectorAll('[onclick="toggleVideo(this)"] video').forEach(video => {
        video.muted = true;
        const overlay = video.closest('[onclick="toggleVideo(this)"]').querySelector('.video-overlay');
        gsap.set(overlay, { opacity: 0 });

        ScrollTrigger.create({
            trigger: video,
            start: 'top 90%',
            end: 'bottom 10%',
            onEnter: () => video.play(),
            onLeave: () => { video.pause(); video.currentTime = 0; },
            onEnterBack: () => video.play(),
            onLeaveBack: () => { video.pause(); video.currentTime = 0; },
        });
    });

    // ============================================
    // CASE STUDY SLIDER
    // ============================================
    let csIndex = 0;
    const csTrack = document.getElementById('casestudy-track');
    const csDots = document.querySelectorAll('.casestudy-dot');
    const csTotalSlides = 2;

    function updateCsDots() {
        csDots.forEach((dot, i) => {
            dot.style.background = i === csIndex ? '#9333EA' : 'rgba(255,255,255,0.25)';
            dot.style.width = i === csIndex ? '24px' : '10px';
            dot.style.borderRadius = '9999px';
        });
    }

    function slideCaseStudy(dir) {
        csIndex = Math.max(0, Math.min(csIndex + dir, csTotalSlides - 1));
        gsap.to(csTrack, { x: -(csIndex * 100) + '%', duration: 0.6, ease: 'power2.out' });
        updateCsDots();
    }

    function goToCaseStudy(i) {
        csIndex = i;
        gsap.to(csTrack, { x: -(csIndex * 100) + '%', duration: 0.6, ease: 'power2.out' });
        updateCsDots();
    }

    updateCsDots();

    // Auto-advance every 6 seconds
    setInterval(() => {
        csIndex = (csIndex + 1) % csTotalSlides;
        gsap.to(csTrack, { x: -(csIndex * 100) + '%', duration: 0.6, ease: 'power2.out' });
        updateCsDots();
    }, 6000);

    // ============================================
    // TESTIMONIAL SLIDER
    // ============================================
    let testimonialIndex = 0;
    const testimonialTrack = document.getElementById('testimonial-track');
    const testimonialCounter = document.getElementById('testimonial-counter');
    const totalTestimonials = {{ count($testimonials) }};

    function getVisibleCount() {
        if (window.innerWidth >= 1024) return 3;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }

    function slideTestimonial(dir) {
        const visible = getVisibleCount();
        const maxIndex = totalTestimonials - visible;
        testimonialIndex = Math.max(0, Math.min(testimonialIndex + dir, maxIndex));
        const pct = -(testimonialIndex * (100 / visible));
        gsap.to(testimonialTrack, { x: pct + '%', duration: 0.5, ease: 'power2.out' });
        testimonialCounter.textContent = String(testimonialIndex + 1).padStart(2, '0') + ' / ' + String(totalTestimonials).padStart(2, '0');
    }

    // ============================================
    // SCROLL PROGRESS BAR
    // ============================================
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    progressBar.style.cssText = 'position:fixed;top:0;left:0;height:2px;background:linear-gradient(90deg,#9333EA,#D946EF);z-index:9999;transform-origin:left;transform:scaleX(0);width:100%;';
    document.body.prepend(progressBar);

    ScrollTrigger.create({
        trigger: document.body, start: 'top top', end: 'bottom bottom',
        onUpdate: (self) => { gsap.set(progressBar, { scaleX: self.progress }); }
    });
    </script>
</body>
</html>
