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

    {{-- Failsafe: hide loader after 3s no matter what --}}
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
            {{-- Logo --}}
            <a href="#" class="block shrink-0" onclick="event.preventDefault(); window.scrollTo({top: 0, behavior: 'smooth'});">
                <img src="{{ asset('images/logomain.png') }}" alt="Edits by Devixx" class="h-9 md:h-10 w-auto">
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-9">
                <a href="#services" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Services</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="#projects" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Projects</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="#testimonials" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Testimonials</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="#contact" class="nav-link text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Contact</a>
            </div>

            {{-- CTA Button --}}
            <a href="#contact" class="hidden md:inline-flex items-center px-4 py-[10px] rounded-full text-white text-[14px] font-medium transition-all duration-300 hover:opacity-90 hover:shadow-[0_0_20px_rgba(147,51,234,0.3)] magnetic shrink-0" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
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
                <a href="#contact" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full border border-[#9333EA]/60 text-white text-sm font-medium transition-all duration-300 hover:bg-[#9333EA]/10">Get in Touch</a>
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
    <section class="pt-0 pb-[5px] -mt-16 relative overflow-hidden">
        <div class="text-center mt-[65px] mb-6">
            <span class="section-label mb-6 inline-block">Trusted by the Best</span>
        </div>

        @php
            $brandsRow1 = [
                ['name' => 'Tax Partners', 'initials' => 'TPI', 'color' => '#2d3a3a', 'text' => '#5eead4'],
                ['name' => 'Emerald Wealth Services', 'initials' => 'EWS', 'color' => '#10b981', 'text' => '#ffffff'],
                ['name' => 'FinTruction', 'initials' => 'FT', 'color' => '#f97316', 'text' => '#ffffff'],
                ['name' => 'Accrivo', 'initials' => 'AC', 'color' => '#ef4444', 'text' => '#ffffff'],
                ['name' => 'Insured by Phoenix', 'initials' => 'IP', 'color' => '#1e1e2e', 'text' => '#ffffff'],
                ['name' => 'DEVIXX', 'initials' => 'DX', 'color' => '#f5f5f5', 'text' => '#111111'],
                ['name' => 'Block3 Finance', 'initials' => 'B3F', 'color' => '#6366f1', 'text' => '#ffffff'],
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

            {{-- Case Study Bento Cards --}}
            <div class="flex flex-col md:flex-row gap-6 md:min-h-[530px]" id="casestudy-bento" style="perspective: 1200px;">
                {{-- Card 1 --}}
                <div class="casestudy-card active rounded-2xl cursor-pointer flex-[2] min-w-0 relative glow-border-card" style="transition: flex 0.7s ease-in-out, transform 0.15s ease-out, box-shadow 0.3s ease; transform-style: preserve-3d; will-change: transform; padding: 1px;" onmouseenter="expandCard(0)" onmousemove="tiltCard(event, this)" onmouseleave="resetTilt(this)">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="h-full flex flex-col pointer-events-none rounded-2xl overflow-hidden relative z-[1]" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        {{-- Top glow line --}}
                        <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                        {{-- Purple light source bottom-left --}}
                        <div class="absolute bottom-0 left-0 w-[1300px] h-[1300px] rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(147,51,234,0.18) 0%, rgba(147,51,234,0.12) 10%, rgba(147,51,234,0.07) 25%, rgba(147,51,234,0.03) 40%, rgba(147,51,234,0.01) 55%, transparent 70%); transform: translate(-50%, 50%); filter: blur(20px);"></div>
                        {{-- Shine overlay --}}
                        <div class="card-shine absolute inset-0 z-10 rounded-2xl pointer-events-none" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.08) 0%, transparent 60%); opacity: 0; transition: opacity 0.3s;"></div>
                        <span class="absolute top-4 right-4 z-20 inline-block px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-medium">Construction Bookkeeping</span>
                        {{-- Top visual area --}}
                        <div class="relative bg-transparent flex items-center justify-center flex-1 min-h-[325px] max-w-[406.25px]">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-gray-600 text-sm">Thumbnail Coming Soon</p>
                            </div>
                        </div>
                        {{-- Bottom content --}}
                        <div class="p-6 md:p-8 pb-4 md:pb-5 relative z-[1] text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">12 Inbound Clients.<br>60 Days.</h3>
                            <div class="text-gray-400 text-sm leading-relaxed card-desc flex flex-col gap-2 items-center md:items-start">
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -1.2s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">Zero online presence</span></div>
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -2.8s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">Built content system from scratch</span></div>
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -0.5s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">Steady stream of inbound leads</span></div>
                            </div>
                            <div class="mt-3 flex justify-center md:justify-end">
                                <a href="#" class="cs-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 text-white text-sm font-medium hover:bg-white/20 transition-all duration-500 overflow-hidden pointer-events-auto">
                                    <span class="cs-btn-text whitespace-nowrap transition-all duration-500">View Casestudy</span>
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="casestudy-card rounded-2xl cursor-pointer flex-1 min-w-0 relative glow-border-card" style="transition: flex 0.7s ease-in-out, transform 0.15s ease-out, box-shadow 0.3s ease; transform-style: preserve-3d; will-change: transform; padding: 1px;" onmouseenter="expandCard(1)" onmousemove="tiltCard(event, this)" onmouseleave="resetTilt(this)">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="h-full flex flex-col pointer-events-none rounded-2xl overflow-hidden relative z-[1]" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                        {{-- Top glow line --}}
                        <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                        {{-- Purple light source bottom-right --}}
                        <div class="absolute bottom-0 right-0 w-[1300px] h-[1300px] rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(147,51,234,0.18) 0%, rgba(147,51,234,0.12) 10%, rgba(147,51,234,0.07) 25%, rgba(147,51,234,0.03) 40%, rgba(147,51,234,0.01) 55%, transparent 70%); transform: translate(50%, 50%); filter: blur(20px);"></div>
                        {{-- Shine overlay --}}
                        <div class="card-shine absolute inset-0 z-10 rounded-2xl pointer-events-none" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.08) 0%, transparent 60%); opacity: 0; transition: opacity 0.3s;"></div>
                        <span class="absolute top-4 right-4 z-20 inline-block px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-medium">Small Business Bookkeeping</span>
                        {{-- Top visual area --}}
                        <div class="relative bg-transparent flex items-center justify-center flex-1 min-h-[325px] max-w-[406.25px]">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-gray-600 text-sm">Thumbnail Coming Soon</p>
                            </div>
                        </div>
                        {{-- Bottom content --}}
                        <div class="p-6 md:p-8 pb-4 md:pb-5 relative z-[1] text-center md:text-left">
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">From Invisible<br>To Fully Booked.</h3>
                            <div class="text-gray-400 text-sm leading-relaxed card-desc flex flex-col gap-2 items-center md:items-start">
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -3.5s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">No online visibility</span></div>
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -1.7s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">Full content strategy built from scratch</span></div>
                                <div class="relative w-fit rounded-md glow-border-btn overflow-hidden" style="padding: 1px;"><div class="glow-border-btn-bg absolute inset-0 rounded-md z-0" style="animation-delay: -2.3s;"></div><span class="px-2 py-1 rounded-[5px] border border-gray-700 bg-[#000000] w-fit text-xs block relative z-[1]">Brand turned into a client magnet</span></div>
                            </div>
                            <div class="mt-3 flex justify-center md:justify-end">
                                <a href="#" class="cs-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 text-white text-sm font-medium hover:bg-white/20 transition-all duration-500 overflow-hidden pointer-events-auto">
                                    <span class="cs-btn-text whitespace-nowrap transition-all duration-500">View Casestudy</span>
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    {{-- ========== PORTFOLIO ========== --}}
    <section id="projects" class="pt-[66px] pb-24 relative">
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
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-10">Short-Form Videos That <span class="text-[#9333EA]">Actually Get Watched</span></h3>
                <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-4 overflow-x-auto sm:overflow-visible snap-x snap-mandatory scrollbar-hide pb-4 sm:pb-0 -mx-6 px-[12vw] sm:mx-0 sm:px-0">
                    @foreach($shortFormVideos as $video)
                    <div class="group relative aspect-[9/16] rounded-2xl bg-transparent transition-all duration-300 cursor-pointer short-form-video flex-shrink-0 w-[56vw] sm:w-auto snap-center" style="padding: 7px; border: 0.3px solid rgba(128, 128, 128, 0.3);" onclick="togglePlayPauseContainer(this)">
                        <div class="relative w-full h-full rounded-xl overflow-hidden">
                        <video class="absolute inset-0 w-full h-full object-cover" loop playsinline muted preload="metadata">
                            <source src="{{ asset($video['src']) }}" type="{{ $video['type'] }}">
                        </video>
                        <div class="video-overlay absolute inset-0 bg-black/30 transition-opacity duration-300"></div>
                        {{-- Sound button top-left --}}
                        <div class="play-btn absolute top-3 left-3 transition-opacity duration-300 z-10" onclick="event.stopPropagation(); toggleVideoMute(this)">
                            <div class="w-8 h-8 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4 text-white icon-unmuted hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l4.5-3.3v13l-4.5-3.3H3.5a1 1 0 01-1-1v-4.4a1 1 0 011-1h3z"/>
                                </svg>
                                <svg class="w-4 h-4 icon-muted" fill="white" viewBox="0 0 24 24">
                                    <path d="M13 2.06c-.47-.24-1.03-.15-1.41.22L7.17 6H4c-1.1 0-2 .9-2 2v4c0 1.1.9 2 2 2h3.17l4.42 3.72c.22.18.48.28.76.28.22 0 .44-.06.65-.17A1.5 1.5 0 0014 16.5v-13c0-.6-.33-1.14-.83-1.41l-.17-.03z"/>
                                    <path d="M19.5 12l2.5-2.5-.7-.7L18.8 11.3 16.3 8.8l-.7.7 2.5 2.5-2.5 2.5.7.7 2.5-2.5 2.5 2.5.7-.7z"/>
                                </svg>
                            </div>
                        </div>
                        {{-- Video controls overlay --}}
                        <div class="video-controls absolute bottom-0 left-0 right-0 opacity-0 transition-opacity duration-300" onclick="event.stopPropagation()">
                            {{-- Progress bar --}}
                            <div class="video-progress-bar w-full h-1 bg-white/20 cursor-pointer relative mx-0" onclick="seekToPosition(event, this)">
                                <div class="video-progress h-full bg-[#9333EA] relative" style="width: 0%;">
                                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            </div>
                            {{-- Controls row --}}
                            <div class="px-3 py-2 flex items-center justify-between bg-black/70">
                                {{-- Left: Duration --}}
                                <span class="video-time text-white text-[11px] font-mono min-w-[32px] leading-5">0:00</span>
                                {{-- Center controls --}}
                                <div class="flex items-center gap-3 h-5">
                                    <button class="btn-fwd10 flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="seekVideo(this, 10)">
                                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white"><path d="M464 256c0-114.69-93.31-208-208-208a210.35 210.35 0 00-105.61 28.48" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><text x="256" y="295" fill="white" font-size="200" font-weight="bold" font-family="Arial" text-anchor="middle">10</text><path d="M464 256c0 114.69-93.31 208-208 208S48 370.69 48 256" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><polygon points="95,25 195,105 85,125" fill="white"/></svg>
                                    </button>
                                    <button class="btn-playpause flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="togglePlayPause(this)">
                                        <svg class="w-5 h-5 icon-pause hidden" fill="white" viewBox="0 0 24 24"><path d="M6 4h4v16H6zM14 4h4v16h-4z"/></svg>
                                        <svg class="w-5 h-5 icon-play" fill="white" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </button>
                                    <button class="btn-back10 flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="seekVideo(this, -10)">
                                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white"><path d="M48 256c0-114.69 93.31-208 208-208a210.35 210.35 0 01105.61 28.48" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><text x="256" y="295" fill="white" font-size="200" font-weight="bold" font-family="Arial" text-anchor="middle">10</text><path d="M48 256c0 114.69 93.31 208 208 208s208-93.31 208-208" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><polygon points="417,25 317,105 427,125" fill="white"/></svg>
                                    </button>
                                </div>
                                {{-- Right: Fullscreen --}}
                                <button class="btn-fullscreen flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="toggleFullscreen(this)">
                                    <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4h4M20 8V4h-4M4 16v4h4M20 16v4h-4"/></svg>
                                </button>
                            </div>
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
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-10">Long Form and <span class="text-[#9333EA]">Trailers</span></h3>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($longFormVideos as $video)
                    <div class="group relative aspect-video rounded-2xl bg-transparent transition-all duration-300 cursor-pointer long-form-video" style="padding: 7px; border: 0.3px solid rgba(128, 128, 128, 0.3);" onclick="togglePlayPauseContainer(this)">
                        <div class="relative w-full h-full rounded-xl overflow-hidden">
                        <video class="absolute inset-0 w-full h-full object-cover" loop playsinline muted preload="metadata">
                            <source src="{{ asset($video['src']) }}" type="video/mp4">
                        </video>
                        <div class="video-overlay absolute inset-0 bg-black/30 transition-opacity duration-300"></div>
                        {{-- Sound button top-left --}}
                        <div class="play-btn absolute top-3 left-3 transition-opacity duration-300 z-10" onclick="event.stopPropagation(); toggleLongFormMute(this)">
                            <div class="w-8 h-8 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4 text-white icon-unmuted hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l4.5-3.3v13l-4.5-3.3H3.5a1 1 0 01-1-1v-4.4a1 1 0 011-1h3z"/>
                                </svg>
                                <svg class="w-4 h-4 icon-muted" fill="white" viewBox="0 0 24 24">
                                    <path d="M13 2.06c-.47-.24-1.03-.15-1.41.22L7.17 6H4c-1.1 0-2 .9-2 2v4c0 1.1.9 2 2 2h3.17l4.42 3.72c.22.18.48.28.76.28.22 0 .44-.06.65-.17A1.5 1.5 0 0014 16.5v-13c0-.6-.33-1.14-.83-1.41l-.17-.03z"/>
                                    <path d="M19.5 12l2.5-2.5-.7-.7L18.8 11.3 16.3 8.8l-.7.7 2.5 2.5-2.5 2.5.7.7 2.5-2.5 2.5 2.5.7-.7z"/>
                                </svg>
                            </div>
                        </div>
                        {{-- Video controls overlay --}}
                        <div class="video-controls absolute bottom-0 left-0 right-0 opacity-0 transition-opacity duration-300" onclick="event.stopPropagation()">
                            {{-- Progress bar --}}
                            <div class="video-progress-bar w-full h-1 bg-white/20 cursor-pointer relative mx-0" onclick="seekToPositionLong(event, this)">
                                <div class="video-progress h-full bg-[#9333EA] relative" style="width: 0%;">
                                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            </div>
                            {{-- Controls row --}}
                            <div class="px-3 py-2 flex items-center justify-between bg-black/70">
                                {{-- Left: Duration --}}
                                <span class="video-time text-white text-[11px] font-mono min-w-[32px] leading-5">0:00</span>
                                {{-- Center controls --}}
                                <div class="flex items-center gap-3 h-5">
                                    <button class="btn-fwd10 flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="seekVideoLong(this, 10)">
                                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white"><path d="M464 256c0-114.69-93.31-208-208-208a210.35 210.35 0 00-105.61 28.48" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><text x="256" y="295" fill="white" font-size="200" font-weight="bold" font-family="Arial" text-anchor="middle">10</text><path d="M464 256c0 114.69-93.31 208-208 208S48 370.69 48 256" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><polygon points="95,25 195,105 85,125" fill="white"/></svg>
                                    </button>
                                    <button class="btn-playpause flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="togglePlayPauseLong(this)">
                                        <svg class="w-5 h-5 icon-pause hidden" fill="white" viewBox="0 0 24 24"><path d="M6 4h4v16H6zM14 4h4v16h-4z"/></svg>
                                        <svg class="w-5 h-5 icon-play" fill="white" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </button>
                                    <button class="btn-back10 flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="seekVideoLong(this, -10)">
                                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white"><path d="M48 256c0-114.69 93.31-208 208-208a210.35 210.35 0 01105.61 28.48" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><text x="256" y="295" fill="white" font-size="200" font-weight="bold" font-family="Arial" text-anchor="middle">10</text><path d="M48 256c0 114.69 93.31 208 208 208s208-93.31 208-208" fill="none" stroke="white" stroke-width="40" stroke-linecap="round"/><polygon points="417,25 317,105 427,125" fill="white"/></svg>
                                    </button>
                                </div>
                                {{-- Right: Fullscreen --}}
                                <button class="btn-fullscreen flex items-center justify-center h-5 text-white hover:text-[#9333EA] transition-colors" onclick="toggleFullscreenLong(this)">
                                    <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4h4M20 8V4h-4M4 16v4h4M20 16v4h-4"/></svg>
                                </button>
                            </div>
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
        <div class="max-w-[1410px] mx-auto px-6 relative">
            <div class="text-center mb-16">
                <span class="section-label mb-6 inline-block">Our Services</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mt-4 mb-4">
                    Choose How We Work Together.
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Every business is different. So every plan we build is tailored to fit yours.
                </p>
            </div>

            {{-- Pricing Cards --}}
            <div class="flex lg:grid lg:grid-cols-3 gap-7 items-stretch overflow-x-auto lg:overflow-visible snap-x snap-mandatory scrollbar-hide pb-4 lg:pb-0 -mx-6 px-6 lg:mx-0 lg:px-0" id="service-plans" style="perspective: 1200px;">

                @php
                $plans = [
                    [
                        'name' => 'Full Takeover',
                        'number' => '/002/',
                        'highlight' => false,
                        'description' => 'For businesses ready to hand their entire marketing to one dedicated team.',
                        'features' => [
                            'Fixed monthly retainer',
                            'No commission involved',
                            'Full content strategy and planning',
                            'Consistent weekly content output',
                            'Scripting, filming guidance, and editing',
                            'Posting across all agreed platforms',
                            'Monthly strategy reviews and check ins',
                            'Performance and growth reports',
                            'Built entirely around your specific goals',
                        ],
                    ],
                    [
                        'name' => 'Results Based',
                        'number' => '/001/',
                        'highlight' => true,
                        'description' => 'For businesses in their early growth phase.<br>Low upfront cost. We earn when you do.',
                        'features' => [
                            'Small monthly retainer',
                            'Commission on every client we bring you',
                            'Custom content strategy built from scratch',
                            'Full scripting and creative direction',
                            'High quality editing and production',
                            'Posting across agreed platforms',
                            'Monthly performance reviews',
                            'Fully done for you from day one',
                            'We only earn when you earn',
                        ],
                    ],
                    [
                        'name' => 'Build Your Own',
                        'number' => '/003/',
                        'highlight' => false,
                        'description' => 'For businesses that need one specific service done to the highest standard.',
                        'features' => [
                            'World class short-form content',
                            'Professional YouTube and long-form production',
                            'Podcast editing and distribution',
                            'Meta paid ads management',
                            'Premium video editing',
                            'Captions and thumbnails',
                            'Platform specific formatting',
                            'Mix and match exactly what you need',
                            'No long term commitment required',
                        ],
                    ],
                ];
                @endphp

                @foreach($plans as $plan)
                <div class="pricing-card rounded-2xl cursor-pointer relative {{ $plan['highlight'] ? 'lg:scale-[1.07] z-10' : 'h-full' }} glow-border-card {{ $plan['highlight'] ? 'active' : '' }} flex-shrink-0 w-[75vw] lg:w-auto snap-center" style="padding: 1px; transform-style: preserve-3d; will-change: transform; transition: transform 0.15s ease-out;" onmouseenter="activatePricingCard(this)" onmousemove="tiltCard(event, this)" onmouseleave="resetTilt(this)">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="h-full flex flex-col rounded-2xl overflow-hidden relative z-[1] {{ $plan['highlight'] ? 'p-10 lg:p-12' : 'p-8 lg:p-10' }}" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);{{ $plan['highlight'] ? ' padding-bottom: 73px;' : '' }}">
                        {{-- Top glow line --}}
                        <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                        {{-- Card number --}}
                        <span class="text-xs text-[#9333EA] font-mono tracking-wider z-[2] relative" style="text-shadow: 0 0 8px rgba(147,51,234,0.6), 0 0 20px rgba(147,51,234,0.3); margin-bottom: 23px;">{{ $plan['number'] }}</span>
                        {{-- Purple light source bottom-left --}}
                        <div class="absolute bottom-0 left-0 w-[1200px] h-[1200px] rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(147,51,234,0.18) 0%, rgba(147,51,234,0.10) 20%, rgba(147,51,234,0.04) 40%, transparent 65%); transform: translate(-40%, 40%); filter: blur(30px);"></div>
                        <div class="card-shine absolute inset-0 z-10 rounded-2xl pointer-events-none" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.08) 0%, transparent 60%); opacity: 0; transition: opacity 0.3s;"></div>

                        {{-- Plan name --}}
                        <div class="flex items-center justify-between mb-3 relative z-[2]">
                            <h3 class="text-2xl font-bold text-white">{{ $plan['name'] }}</h3>
                            @if($plan['highlight'])
                            <span class="px-3 py-1 text-xs font-semibold text-white rounded-md border border-white/20" style="background: linear-gradient(90deg, #9333EA, #4C1D95);">Popular</span>
                            @endif
                        </div>

                        {{-- Description --}}
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 relative z-[2]">{!! $plan['description'] !!}</p>

                        {{-- CTA Button --}}
                        @if($plan['highlight'])
                        <div class="relative w-full mb-8 z-[2] rounded-xl glow-border-btn overflow-hidden" style="padding: 1px;">
                            <div class="glow-border-btn-bg glow-white absolute inset-0 rounded-xl z-0"></div>
                            <a href="#contact" class="w-full py-3 rounded-[11px] text-center text-sm font-semibold transition-all duration-300 block relative z-[1] text-white border border-white/30" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
                                Choose this plan
                            </a>
                        </div>
                        @else
                        <div class="relative w-full mb-8 z-[2] rounded-xl glow-border-btn overflow-hidden" style="padding: 1px;">
                            <div class="glow-border-btn-bg absolute inset-0 rounded-xl z-0"></div>
                            <a href="#contact" class="w-full py-3 rounded-[11px] text-center text-sm font-semibold transition-all duration-300 block relative z-[1] bg-[#000000] text-white border border-gray-700">
                                Choose this plan
                            </a>
                        </div>
                        @endif

                        {{-- Divider --}}
                        <div class="w-full h-px bg-gray-800 mb-6 relative z-[2]"></div>

                        {{-- Features --}}
                        <ul class="space-y-3.5 relative z-[2]">
                            @foreach($plan['features'] as $feature)
                            <li class="flex items-start gap-3 text-gray-400 text-sm">
                                <svg class="w-5 h-5 text-[#9333EA] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== HOW IT WORKS ========== --}}
    <section class="py-24 relative" style="padding-top: 116px; padding-bottom: 116px;">
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

            <div class="grid md:grid-cols-3 gap-8 relative">
                {{-- Connected line across all 3 steps --}}
                <div id="steps-line" class="absolute top-[175px] hidden md:flex items-center z-0" style="left: calc((100% - 64px) / 6); right: calc((100% - 64px) / 6);">
                    <div class="w-full h-[3px] bg-gray-700 relative">
                        {{-- Animated purple fill --}}
                        <div id="steps-line-fill" class="absolute inset-y-0 left-0 bg-purple-600 rounded-full" style="width: 0%; box-shadow: 0 0 10px rgba(147,51,234,0.6), 0 0 20px rgba(147,51,234,0.3);"></div>
                        {{-- Circle at step 1 --}}
                        <div id="step-circle-1" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-3 h-3 rounded-full border-2 border-purple-500 bg-purple-600 z-10" style="box-shadow: 0 0 10px rgba(147,51,234,0.8), 0 0 20px rgba(147,51,234,0.4);"></div>
                        {{-- Circle at step 2 --}}
                        <div id="step-circle-2" class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 w-3 h-3 rounded-full border-2 border-gray-600 bg-gray-800 z-10 transition-all duration-300"></div>
                        {{-- Circle at step 3 --}}
                        <div id="step-circle-3" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-3 h-3 rounded-full border-2 border-gray-600 bg-gray-800 z-10 transition-all duration-300"></div>
                    </div>
                </div>

                <div class="relative text-center group" data-step-box="1">
                    <div class="w-[100px] h-[100px] mx-auto mb-6 relative z-[1] rounded-2xl glow-border-card step-glow-box active overflow-hidden group-hover:scale-110 transition-transform" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="w-full h-full rounded-[15px] bg-[#111111] flex items-center justify-center relative z-[1] overflow-hidden" style="border: 1px solid rgba(255,255,255,0.08);">
                            <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                            <div class="absolute inset-0 z-0" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.15) 0%, rgba(147,51,234,0.05) 40%, transparent 70%);"></div>
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-primary font-bold text-sm mb-8 block">Step 1</span>

                    <h3 class="text-xl font-bold text-white mb-3 relative z-[1] mt-[55px]">Book a Call</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Tell us about your brand, your offer, and your goals. We ask the right questions and take it from there.
                    </p>
                </div>

                <div class="relative text-center group" data-step-box="2">
                    <div class="w-[100px] h-[100px] mx-auto mb-6 relative z-[1] rounded-2xl glow-border-card step-glow-box overflow-hidden group-hover:scale-110 transition-transform" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="w-full h-full rounded-[15px] bg-[#111111] flex items-center justify-center relative z-[1] overflow-hidden" style="border: 1px solid rgba(255,255,255,0.08);">
                            <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                            <div class="absolute inset-0 z-0" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.15) 0%, rgba(147,51,234,0.05) 40%, transparent 70%);"></div>
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-primary font-bold text-sm mb-8 block">Step 2</span>

                    <h3 class="text-xl font-bold text-white mb-3 relative z-[1] mt-[55px]">We Build Your System</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        We design your content strategy, produce everything, and set up your entire funnel tailored specifically to you.
                    </p>
                </div>

                <div class="relative text-center group" data-step-box="3">
                    <div class="w-[100px] h-[100px] mx-auto mb-6 relative z-[1] rounded-2xl glow-border-card step-glow-box overflow-hidden group-hover:scale-110 transition-transform" style="padding: 1px;">
                        <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                        <div class="w-full h-full rounded-[15px] bg-[#111111] flex items-center justify-center relative z-[1] overflow-hidden" style="border: 1px solid rgba(255,255,255,0.08);">
                            <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                            <div class="absolute inset-0 z-0" style="background: radial-gradient(circle at 50% 50%, rgba(147,51,234,0.15) 0%, rgba(147,51,234,0.05) 40%, transparent 70%);"></div>
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-primary font-bold text-sm mb-8 block">Step 3</span>

                    <h3 class="text-xl font-bold text-white mb-3 relative z-[1] mt-[55px]">Grow and Evolve</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your system goes live. We track what works, refine what doesn't, and keep pushing further monthly to ensure success.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== STATS ========== --}}
    <section class="relative mt-[50px]" id="stats-section">
        <div class="w-full h-px bg-white/[0.04]"></div>
        <div class="absolute inset-0 backdrop-blur-[1px] bg-white/[0.005] z-0" style="top: 1px; bottom: 1px;"></div>
        <div class="max-w-5xl mx-auto px-6 py-16 relative z-[1]">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 lg:gap-12" data-stats>
                <div class="text-center stat-item">
                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-white block" data-count="77000000" data-suffix="+" data-display="77M+">0</span>
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
        <div class="w-full h-px bg-white/[0.04]"></div>
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

            @php
            $testimonials = [
                ['name' => 'Mahad Mohamed', 'role' => 'Tax Partners', 'text' => 'Working with Edits by DEVIXX completely changed how we show up online. The content quality is unlike anything we had before. Highly recommend.', 'initials' => '', 'avatar' => 'images/mahad.jpg'],
                ['name' => 'Kevin Ball', 'role' => 'Block3 Finance', 'text' => 'The team just gets it. They understood our brand from day one and the content they produce consistently brings in the right people.', 'initials' => 'K', 'avatar' => ''],
                ['name' => 'Vivian Szatmari', 'role' => 'Insured by Phoenix', 'text' => 'We went from having no content strategy to having a full system running without us having to think about it. The results speak for themselves.', 'initials' => 'V', 'avatar' => ''],
                ['name' => 'Kizzy Bowen', 'role' => 'Emerald Wealth Services', 'text' => 'Professional, fast, and genuinely invested in our growth. The content they create for us has made a real difference in how clients find us.', 'initials' => 'K', 'avatar' => ''],
            ];
            @endphp

            {{-- Bento grid: 2 left cards | center video | 2 right cards --}}
            <div class="flex flex-col lg:flex-row gap-6 items-center" id="testimonial-grid" style="perspective: 1200px;">
                {{-- Left column: 2 smaller stacked cards --}}
                <div class="flex flex-col gap-5 testimonial-col-left w-full lg:flex-1">
                    @foreach([$testimonials[0], $testimonials[1]] as $t)
                    <div class="testimonial-side-card rounded-2xl p-6 flex flex-col" style="min-height: 260px; background: radial-gradient(circle at 0% 100%, rgba(147,51,234,0.15) 0%, #0a0a0a 60%); border: 1px solid rgba(147,51,234,0.15); transform-style: preserve-3d; will-change: transform; transition: transform 0.3s ease-out;">
                        <div class="flex items-center gap-0.5 mb-4">
                            @for($s = 0; $s < 5; $s++)
                            <svg class="w-4 h-4 text-[#9333EA]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-5">"{{ $t['text'] }}"</p>
                        <div class="flex items-center gap-3 mt-auto">
                            @if(!empty($t['avatar']))
                            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset($t['avatar']) }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover object-[center_26%]">
                            </div>
                            @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ $t['initials'] }}</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="text-white font-semibold text-sm">{{ $t['name'] }}</h4>
                                <p class="text-gray-500 text-xs">{{ $t['role'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Center: Large tall video card --}}
                <div class="testimonial-center-card rounded-2xl overflow-hidden flex flex-col w-full lg:flex-[1.4]" style="background: radial-gradient(circle at 0% 100%, rgba(147,51,234,0.15) 0%, #0a0a0a 60%); border: 1px solid rgba(147,51,234,0.15);">
                    <div class="relative w-full overflow-hidden flex flex-col items-center justify-center" style="min-height: 470px; background: radial-gradient(circle at 0% 100%, rgba(147,51,234,0.1) 0%, transparent 50%);">
                        {{-- Video Coming Soon placeholder --}}
                        <svg class="w-14 h-14 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 text-sm font-medium">Video Coming Soon</p>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-gray-400 text-sm leading-relaxed mb-5">Edits by DEVIXX understands what it takes to build a brand that actually converts. They handle everything and the quality is always there.</p>
                        <h4 class="text-white font-bold text-2xl mb-1">Shivajee Shedain</h4>
                        <p class="text-[#9333EA] font-semibold text-[16px] mb-0.5">Accrivo & FinTruction</p>
                        <p class="text-[#9333EA] text-sm font-medium">COO/Director</p>
                    </div>
                </div>

                {{-- Right column: 2 smaller stacked cards --}}
                <div class="flex flex-col gap-5 testimonial-col-right w-full lg:flex-1">
                    @foreach([$testimonials[2], $testimonials[3]] as $t)
                    <div class="testimonial-side-card rounded-2xl p-6 flex flex-col" style="min-height: 260px; background: radial-gradient(circle at 0% 100%, rgba(147,51,234,0.15) 0%, #0a0a0a 60%); border: 1px solid rgba(147,51,234,0.15); transform-style: preserve-3d; will-change: transform; transition: transform 0.3s ease-out;">
                        <div class="flex items-center gap-0.5 mb-4">
                            @for($s = 0; $s < 5; $s++)
                            <svg class="w-4 h-4 text-[#9333EA]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-5">"{{ $t['text'] }}"</p>
                        <div class="flex items-center gap-3 mt-auto">
                            @if(!empty($t['avatar']))
                            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset($t['avatar']) }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover object-[center_26%]">
                            </div>
                            @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ $t['initials'] }}</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="text-white font-semibold text-sm">{{ $t['name'] }}</h4>
                                <p class="text-gray-500 text-xs">{{ $t['role'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    Have Questions?<br><span class="inline-block mt-[12px]">We have <span class="px-4 relative overflow-hidden" style="border-left: 2px solid rgba(255,255,255,0.9); background: linear-gradient(90deg, rgba(147,51,234,0.30) 0%, rgba(147,51,234,0.30) 55%, rgba(147,51,234,0) 100%); padding-top: 0; padding-bottom: 4px; margin-top: 3px; line-height: 0.65;">answers.</span></span>
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
                <div class="text-center lg:text-left">
                    <span class="section-label mb-6 inline-block">Contact</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-4 mb-4">
                        Ready to Build the System That Brings Clients to You?
                    </h2>
                    <p class="text-gray-400 text-lg mb-8">
                        Let's talk about what this looks like for your business.
                    </p>

                    <div class="space-y-6 flex flex-col items-center lg:items-start">
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

                        <div class="flex items-center justify-center lg:justify-start gap-3 pt-4">
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

                <div class="relative rounded-2xl glow-border-card active overflow-hidden" style="padding: 1px;">
                    <div class="glow-border-bg absolute inset-0 rounded-2xl z-0"></div>
                    <div class="p-8 relative rounded-[15px] overflow-hidden z-[1]" style="background: #000000; border: 1px solid rgba(255,255,255,0.08);">
                    <div class="absolute top-0 left-0 right-0 h-px z-10" style="background: linear-gradient(90deg, transparent 0%, rgba(147,51,234,0.6) 30%, rgba(168,85,247,0.8) 50%, rgba(147,51,234,0.6) 70%, transparent 100%);"></div>
                    <div class="absolute bottom-0 right-0 w-[1250px] h-[1250px] rounded-full pointer-events-none z-0" style="background: radial-gradient(circle, rgba(147,51,234,0.18) 0%, rgba(147,51,234,0.12) 10%, rgba(147,51,234,0.07) 25%, rgba(147,51,234,0.03) 40%, rgba(147,51,234,0.01) 55%, transparent 70%); transform: translate(50%, 50%); filter: blur(20px);"></div>
                    <h3 class="text-xl font-bold text-white mb-2 relative z-[1]">Want Us To Reach Out To You?</h3>
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

        <div class="border-t border-surface-border py-8" style="background: rgba(0,0,0,0.5);">
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
        .call(() => {
            ScrollTrigger.refresh();
        });
    }

    window.addEventListener('load', hideLoader);
    // Safety: force hide loader after 4 seconds even if resources fail
    setTimeout(hideLoader, 4000);

    // ============================================
    // NAVBAR
    // ============================================
    const navbar = document.getElementById('navbar');
    const navbarPill = navbar.querySelector('.navbar-pill');
    var lastScrollY = 0;
    var navHidden = false;
    var hideThreshold = 700;

    ScrollTrigger.create({
        onUpdate: (self) => {
            var s = self.scroll();
            var direction = self.direction; // 1 = down, -1 = up

            if (s > 50) {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.3)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.08)';
            } else {
                navbarPill.style.background = 'rgba(100, 100, 120, 0.25)';
                navbarPill.style.borderColor = 'rgba(255,255,255,0.06)';
            }

            // Hide/show navbar based on scroll direction after threshold
            if (s > hideThreshold && direction === 1 && !navHidden) {
                navHidden = true;
                gsap.to(navbar, { y: -120, duration: 0.4, ease: 'power2.inOut' });
            } else if (direction === -1 && navHidden) {
                navHidden = false;
                gsap.to(navbar, { y: 0, duration: 0.24, ease: 'power2.inOut' });
            }

            // Always show at top
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

    // ============================================
    // MOBILE VIDEO CAROUSEL FADE/BLUR
    // ============================================
    (function() {
        var carousel = document.querySelector('.scrollbar-hide');
        if (!carousel) return;
        var videos = carousel.querySelectorAll('.short-form-video');
        if (!videos.length) return;

        function updateVideoFades() {
            if (window.innerWidth >= 640) {
                videos.forEach(function(v) {
                    v.style.opacity = '';
                    v.style.filter = '';
                    v.style.transition = '';
                });
                return;
            }
            var containerRect = carousel.getBoundingClientRect();
            var containerCenter = containerRect.left + containerRect.width / 2;

            videos.forEach(function(v) {
                var rect = v.getBoundingClientRect();
                var videoCenter = rect.left + rect.width / 2;
                var distance = Math.abs(containerCenter - videoCenter);
                var maxDist = containerRect.width * 0.5;
                var ratio = Math.min(distance / maxDist, 1);

                var opacity = 1 - ratio * 0.55;
                var blur = ratio * 3.4;

                v.style.opacity = opacity;
                v.style.filter = 'blur(' + blur + 'px)';
                v.style.transition = 'opacity 0.3s ease, filter 0.3s ease';
            });
        }

        carousel.addEventListener('scroll', updateVideoFades, { passive: true });
        window.addEventListener('resize', updateVideoFades);
        updateVideoFades();
    })();

    // ============================================
    // MOBILE PRICING CAROUSEL - CENTER ON POPULAR CARD + FADE/BLUR
    // ============================================
    (function() {
        var container = document.getElementById('service-plans');
        if (!container) return;
        var cards = container.querySelectorAll('.pricing-card');
        if (!cards.length) return;

        function scrollToPopular() {
            if (window.innerWidth >= 1024) return;
            // Find the highlighted/popular card (middle one)
            var popularCard = container.querySelector('.lg\\:scale-\\[1\\.07\\]') || cards[1];
            if (popularCard) {
                var containerRect = container.getBoundingClientRect();
                var cardRect = popularCard.getBoundingClientRect();
                var scrollLeft = container.scrollLeft + (cardRect.left - containerRect.left) - (containerRect.width / 2) + (cardRect.width / 2);
                container.scrollLeft = scrollLeft;
            }
        }

        function updateCardFades() {
            if (window.innerWidth >= 1024) {
                cards.forEach(function(c) {
                    c.style.opacity = '';
                    c.style.filter = '';
                    c.style.transition = '';
                });
                return;
            }
            var containerRect = container.getBoundingClientRect();
            var containerCenter = containerRect.left + containerRect.width / 2;

            cards.forEach(function(c) {
                var rect = c.getBoundingClientRect();
                var cardCenter = rect.left + rect.width / 2;
                var distance = Math.abs(containerCenter - cardCenter);
                var maxDist = containerRect.width * 0.5;
                var ratio = Math.min(distance / maxDist, 1);

                var opacity = 1 - ratio * 0.5;
                var blur = ratio * 3;

                c.style.opacity = opacity;
                c.style.filter = 'blur(' + blur + 'px)';
                c.style.transition = 'opacity 0.3s ease, filter 0.3s ease';
            });
        }

        container.addEventListener('scroll', updateCardFades, { passive: true });
        window.addEventListener('resize', function() { scrollToPopular(); updateCardFades(); });
        setTimeout(function() { scrollToPopular(); updateCardFades(); }, 100);
    })();

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

    // How It Works - animated step line with circle glow and box activation
    (function() {
        var lineFill = document.getElementById('steps-line-fill');
        var stepsLine = document.getElementById('steps-line');
        if (!lineFill || !stepsLine) return;

        var circle1 = document.getElementById('step-circle-1');
        var circle2 = document.getElementById('step-circle-2');
        var circle3 = document.getElementById('step-circle-3');
        var box1 = document.querySelector('[data-step-box="1"] .step-glow-box');
        var box2 = document.querySelector('[data-step-box="2"] .step-glow-box');
        var box3 = document.querySelector('[data-step-box="3"] .step-glow-box');

        var purpleGlow = '0 0 10px rgba(147,51,234,0.8), 0 0 20px rgba(147,51,234,0.4)';

        function activateCircle(circle) {
            circle.style.borderColor = '#a855f7';
            circle.style.backgroundColor = '#9333ea';
            circle.style.boxShadow = purpleGlow;
        }

        function deactivateCircle(circle) {
            circle.style.borderColor = '#4b5563';
            circle.style.backgroundColor = '#1f2937';
            circle.style.boxShadow = 'none';
        }

        function activateBox(box) {
            box.classList.add('active');
        }

        function deactivateBox(box) {
            box.classList.remove('active');
        }

        function runStepAnimation() {
            var tl = gsap.timeline({ repeat: -1 });

            // Phase 1: Start at circle 1 (already active), box 1 active, pause 3s
            tl.set(lineFill, { width: '0%' });
            tl.call(function() {
                activateCircle(circle1); deactivateCircle(circle2); deactivateCircle(circle3);
                activateBox(box1); deactivateBox(box2); deactivateBox(box3);
            });
            tl.to({}, { duration: 1.5 });

            // Phase 2: Fill line from 0% to 50% (to circle 2), activate circle 2 + box 2
            tl.to(lineFill, { width: '50%', duration: 0.8, ease: 'power2.inOut' });
            tl.call(function() {
                activateCircle(circle2);
                deactivateBox(box1); activateBox(box2);
            });
            tl.to({}, { duration: 1.5 });

            // Phase 3: Fill line from 50% to 100% (to circle 3), activate circle 3 + box 3
            tl.to(lineFill, { width: '100%', duration: 0.8, ease: 'power2.inOut' });
            tl.call(function() {
                activateCircle(circle3);
                deactivateBox(box2); activateBox(box3);
            });
            tl.to({}, { duration: 1.5 });

            // Phase 4: Reset everything for loop
            tl.call(function() {
                deactivateCircle(circle2); deactivateCircle(circle3);
                deactivateBox(box3);
            });
            tl.set(lineFill, { width: '0%' });
        }

        ScrollTrigger.create({
            trigger: stepsLine,
            start: 'top 85%',
            once: true,
            onEnter: runStepAnimation
        });
    })();

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
                        // Animate to 77M+
                        gsap.to({ val: 0 }, {
                            val: 77, duration: 2.5, ease: 'power2.out',
                            onUpdate: function() {
                                const v = this.targets()[0].val;
                                if (v < 1) {
                                    counter.textContent = Math.round(v * 1000) + 'K+';
                                } else {
                                    counter.textContent = Math.round(v) + 'M+';
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
        el.classList.toggle('active');
        var answer = el.querySelector('.faq-answer');
        if (el.classList.contains('active')) {
            var scrollBefore = window.scrollY;
            var elTopBefore = el.getBoundingClientRect().top;
            gsap.to(answer, { maxHeight: 300, paddingTop: 16, duration: 0.5, ease: 'power2.out',
                onUpdate: function() {
                    var elTopNow = el.getBoundingClientRect().top;
                    var drift = elTopNow - elTopBefore;
                    if (Math.abs(drift) > 0.5) {
                        window.scrollTo(0, window.scrollY + drift);
                        elTopBefore = el.getBoundingClientRect().top;
                    }
                }
            });
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
            // Remove all state classes first
            tab.classList.remove('active', 'bg-primary/10', 'text-primary', 'border-primary/20', 'bg-surface-card', 'text-gray-400', 'border-surface-border', 'hover:text-white');
            if (tab.dataset.tab === tabName) {
                tab.classList.add('active', 'bg-primary/10', 'text-primary', 'border-primary/20');
            } else {
                tab.classList.add('bg-surface-card', 'text-gray-400', 'border-surface-border', 'hover:text-white');
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
    // SHORT-FORM VIDEO CONTROLS
    // ============================================
    function updateVolumeIcon(container, muted) {
        const playBtn = container.querySelector('.play-btn');
        if (!playBtn) return;
        const iconMuted = playBtn.querySelector('.icon-muted');
        const iconUnmuted = playBtn.querySelector('.icon-unmuted');
        if (muted) {
            iconMuted.classList.remove('hidden');
            iconUnmuted.classList.add('hidden');
        } else {
            iconMuted.classList.add('hidden');
            iconUnmuted.classList.remove('hidden');
        }
    }

    function toggleVideoMute(btn) {
        const container = btn.closest('.short-form-video');
        const video = container.querySelector('video');
        if (video.muted) {
            // Mute all other videos first
            document.querySelectorAll('.short-form-video').forEach(c => {
                const v = c.querySelector('video');
                if (v !== video && !v.muted) {
                    v.muted = true;
                    updateVolumeIcon(c, true);
                }
            });
            video.muted = false;
            updateVolumeIcon(container, false);
        } else {
            video.muted = true;
            updateVolumeIcon(container, true);
        }
    }

    function togglePlayPauseContainer(container) {
        const video = container.querySelector('video');
        if (video.paused) {
            video.currentTime = 0;
            video.play();
        } else {
            video.pause();
        }
    }

    function seekVideo(btn, seconds) {
        const video = btn.closest('.short-form-video').querySelector('video');
        video.currentTime = Math.max(0, Math.min(video.duration, video.currentTime + seconds));
    }

    function togglePlayPause(btn) {
        const container = btn.closest('.short-form-video');
        const video = container.querySelector('video');
        const iconPlay = btn.querySelector('.icon-play');
        const iconPause = btn.querySelector('.icon-pause');
        if (video.paused) {
            video.play();
            iconPlay.classList.add('hidden');
            iconPause.classList.remove('hidden');
        } else {
            video.pause();
            iconPlay.classList.remove('hidden');
            iconPause.classList.add('hidden');
        }
    }

    function toggleFullscreen(btn) {
        const container = btn.closest('.short-form-video');
        if (document.fullscreenElement === container) {
            document.exitFullscreen();
        } else {
            container.requestFullscreen().then(() => {
                container.style.background = '#000';
                const video = container.querySelector('video');
                video.style.objectFit = 'contain';
                video.style.maxWidth = '1080px';
                video.style.maxHeight = '1920px';
                video.style.margin = '0 auto';
            });
        }
        container.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement) {
                const video = container.querySelector('video');
                video.style.objectFit = 'cover';
                video.style.maxWidth = '';
                video.style.maxHeight = '';
                video.style.margin = '';
                container.style.background = '';
            }
        }, { once: true });
    }

    function formatTime(s) {
        const m = Math.floor(s / 60);
        const sec = Math.floor(s % 60);
        return m + ':' + String(sec).padStart(2, '0');
    }

    function seekToPosition(e, bar) {
        const video = bar.closest('.short-form-video').querySelector('video');
        const rect = bar.getBoundingClientRect();
        const pct = (e.clientX - rect.left) / rect.width;
        video.currentTime = pct * video.duration;
    }

    // Update time, progress bar, play/pause icons, and hover show/hide
    document.querySelectorAll('.short-form-video').forEach(container => {
        const video = container.querySelector('video');
        const timeEl = container.querySelector('.video-time');
        const progressEl = container.querySelector('.video-progress');
        const controls = container.querySelector('.video-controls');
        const iconPlay = container.querySelector('.icon-play');
        const iconPause = container.querySelector('.icon-pause');

        video.addEventListener('timeupdate', () => {
            timeEl.textContent = formatTime(video.currentTime);
            if (video.duration) {
                progressEl.style.width = (video.currentTime / video.duration * 100) + '%';
            }
        });
        video.addEventListener('play', () => {
            iconPlay.classList.add('hidden');
            iconPause.classList.remove('hidden');
        });
        video.addEventListener('pause', () => {
            iconPlay.classList.remove('hidden');
            iconPause.classList.add('hidden');
        });

        // Show controls on hover
        container.addEventListener('mouseenter', () => {
            controls.style.opacity = '1';
        });
        container.addEventListener('mouseleave', () => {
            controls.style.opacity = '0';
        });

        // Auto-play muted on scroll into view
        const overlay = container.querySelector('.video-overlay');
        gsap.set(overlay, { opacity: 0 });

        ScrollTrigger.create({
            trigger: container,
            start: 'top 90%',
            end: 'bottom 10%',
            onEnter: () => { video.muted = true; updateVolumeIcon(container, true); video.play(); },
            onLeave: () => { video.pause(); video.currentTime = 0; },
            onEnterBack: () => { video.muted = true; updateVolumeIcon(container, true); video.play(); },
            onLeaveBack: () => { video.pause(); video.currentTime = 0; },
        });
    });

    // ============================================
    // LONG-FORM VIDEO CONTROLS
    // ============================================
    function updateLongFormVolumeIcon(container, muted) {
        const playBtn = container.querySelector('.play-btn');
        if (!playBtn) return;
        const iconMuted = playBtn.querySelector('.icon-muted');
        const iconUnmuted = playBtn.querySelector('.icon-unmuted');
        if (muted) {
            iconMuted.classList.remove('hidden');
            iconUnmuted.classList.add('hidden');
        } else {
            iconMuted.classList.add('hidden');
            iconUnmuted.classList.remove('hidden');
        }
    }

    function toggleLongFormMute(btn) {
        const container = btn.closest('.long-form-video');
        const video = container.querySelector('video');
        if (video.muted) {
            document.querySelectorAll('.long-form-video').forEach(c => {
                const v = c.querySelector('video');
                if (v !== video && !v.muted) {
                    v.muted = true;
                    updateLongFormVolumeIcon(c, true);
                }
            });
            video.muted = false;
            updateLongFormVolumeIcon(container, false);
        } else {
            video.muted = true;
            updateLongFormVolumeIcon(container, true);
        }
    }

    function seekVideoLong(btn, seconds) {
        const video = btn.closest('.long-form-video').querySelector('video');
        video.currentTime = Math.max(0, Math.min(video.duration, video.currentTime + seconds));
    }

    function togglePlayPauseLong(btn) {
        const container = btn.closest('.long-form-video');
        const video = container.querySelector('video');
        const iconPlay = btn.querySelector('.icon-play');
        const iconPause = btn.querySelector('.icon-pause');
        if (video.paused) {
            video.currentTime = 0;
            video.play();
            iconPlay.classList.add('hidden');
            iconPause.classList.remove('hidden');
        } else {
            video.pause();
            iconPlay.classList.remove('hidden');
            iconPause.classList.add('hidden');
        }
    }

    function seekToPositionLong(e, bar) {
        const video = bar.closest('.long-form-video').querySelector('video');
        const rect = bar.getBoundingClientRect();
        const pct = (e.clientX - rect.left) / rect.width;
        video.currentTime = pct * video.duration;
    }

    function toggleFullscreenLong(btn) {
        const container = btn.closest('.long-form-video');
        if (document.fullscreenElement === container) {
            document.exitFullscreen();
        } else {
            container.requestFullscreen().then(() => {
                container.style.background = '#000';
                const video = container.querySelector('video');
                video.style.objectFit = 'contain';
            });
        }
        container.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement) {
                const video = container.querySelector('video');
                video.style.objectFit = 'cover';
                container.style.background = '';
            }
        }, { once: true });
    }

    // Long-form video event listeners
    document.querySelectorAll('.long-form-video').forEach(container => {
        const video = container.querySelector('video');
        const timeEl = container.querySelector('.video-time');
        const progressEl = container.querySelector('.video-progress');
        const controls = container.querySelector('.video-controls');
        const iconPlay = container.querySelector('.btn-playpause .icon-play');
        const iconPause = container.querySelector('.btn-playpause .icon-pause');

        video.addEventListener('timeupdate', () => {
            timeEl.textContent = formatTime(video.currentTime);
            if (video.duration) {
                progressEl.style.width = (video.currentTime / video.duration * 100) + '%';
            }
        });
        video.addEventListener('play', () => {
            if (iconPlay) iconPlay.classList.add('hidden');
            if (iconPause) iconPause.classList.remove('hidden');
        });
        video.addEventListener('pause', () => {
            if (iconPlay) iconPlay.classList.remove('hidden');
            if (iconPause) iconPause.classList.add('hidden');
        });

        container.addEventListener('mouseenter', () => { controls.style.opacity = '1'; });
        container.addEventListener('mouseleave', () => { controls.style.opacity = '0'; });

        // Auto-play muted on scroll
        const overlay = container.querySelector('.video-overlay');
        gsap.set(overlay, { opacity: 0 });

        ScrollTrigger.create({
            trigger: container,
            start: 'top 90%',
            end: 'bottom 10%',
            onEnter: () => { video.muted = true; updateLongFormVolumeIcon(container, true); video.play(); },
            onLeave: () => { video.pause(); video.currentTime = 0; },
            onEnterBack: () => { video.muted = true; updateLongFormVolumeIcon(container, true); video.play(); },
            onLeaveBack: () => { video.pause(); video.currentTime = 0; },
        });
    });

    // ============================================
    // LEGACY VIDEO AUTO-PLAY (kept for other sections)
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
    // CASE STUDY BENTO CARDS
    // ============================================
    function expandCard(index) {
        const cards = document.querySelectorAll('.casestudy-card');
        cards.forEach((card, i) => {
            const btnText = card.querySelector('.cs-btn-text');
            const btn = card.querySelector('.cs-btn');
            if (i === index) {
                card.style.flex = '2';
                card.classList.add('active');
                if (btnText) { btnText.style.width = ''; btnText.style.opacity = '1'; btnText.style.marginRight = ''; }
                if (btn) { btn.style.paddingLeft = ''; btn.style.paddingRight = ''; }
            } else {
                card.style.flex = '1';
                card.classList.remove('active');
                if (btnText) { btnText.style.width = '0'; btnText.style.opacity = '0'; btnText.style.marginRight = '-8px'; }
                if (btn) { btn.style.paddingLeft = '12px'; btn.style.paddingRight = '12px'; }
            }
        });
    }

    // Initialize button states on load
    document.querySelectorAll('.casestudy-card').forEach((card) => {
        const btnText = card.querySelector('.cs-btn-text');
        const btn = card.querySelector('.cs-btn');
        if (!card.classList.contains('active')) {
            if (btnText) { btnText.style.width = '0'; btnText.style.opacity = '0'; btnText.style.marginRight = '-8px'; }
            if (btn) { btn.style.paddingLeft = '12px'; btn.style.paddingRight = '12px'; }
        }
    });

    // Pricing card glow border activation
    function activatePricingCard(hoveredCard) {
        document.querySelectorAll('#service-plans .glow-border-card').forEach(function(card) {
            if (card === hoveredCard) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }

    // Reset to highlighted card when leaving the pricing section
    const servicePlansGrid = document.getElementById('service-plans');
    if (servicePlansGrid) {
        servicePlansGrid.addEventListener('mouseleave', function() {
            document.querySelectorAll('#service-plans .glow-border-card').forEach(function(card) {
                card.classList.remove('active');
            });
            const highlighted = servicePlansGrid.querySelector('.lg\\:scale-\\[1\\.07\\]');
            if (highlighted) highlighted.classList.add('active');
        });
    }

    function tiltCard(e, card) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -4.5;
        const rotateY = ((x - centerX) / centerX) * 4.5;
        card.style.transform = 'rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) scale3d(1.02, 1.02, 1.02)';
        card.style.boxShadow = '0 25px 50px rgba(147, 51, 234, 0.15), 0 0 30px rgba(147, 51, 234, 0.05)';
        // Move shine
        const shine = card.querySelector('.card-shine');
        if (shine) {
            shine.style.opacity = '1';
            shine.style.background = 'radial-gradient(circle at ' + x + 'px ' + y + 'px, rgba(147,51,234,0.12) 0%, transparent 60%)';
        }
    }

    function resetTilt(card) {
        card.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        card.style.boxShadow = 'none';
        const shine = card.querySelector('.card-shine');
        if (shine) shine.style.opacity = '0';
    }

    // ============================================
    // TESTIMONIAL GRID ANIMATIONS
    // ============================================
    // Side cards tilt together in place on grid hover
    const tGrid = document.getElementById('testimonial-grid');
    const sideCards = document.querySelectorAll('.testimonial-side-card');
    if (tGrid && sideCards.length) {
        tGrid.addEventListener('mousemove', function(e) {
            const rect = tGrid.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            sideCards.forEach(function(card) {
                gsap.to(card, {
                    rotateX: -y * 8, rotateY: x * 8,
                    duration: 0.3, ease: 'power2.out',
                    transformPerspective: 800
                });
            });
        });
        tGrid.addEventListener('mouseleave', function() {
            sideCards.forEach(function(card) {
                gsap.to(card, {
                    rotateX: 0, rotateY: 0,
                    duration: 0.5, ease: 'power2.out',
                    transformPerspective: 800
                });
            });
        });
    }

    // Scroll-triggered Framer-style entrance
    if (typeof ScrollTrigger !== 'undefined') {
        // Initially hide all cards
        gsap.set('.testimonial-side-card, .testimonial-center-card', {
            y: 60, opacity: 0, scale: 0.95
        });

        ScrollTrigger.create({
            trigger: '#testimonial-grid',
            start: 'top 85%',
            once: true,
            onEnter: () => {
                // Center card first
                gsap.to('.testimonial-center-card', {
                    y: 0, opacity: 1, scale: 1,
                    duration: 0.9, ease: 'power3.out'
                });
                // Left cards staggered
                gsap.to('.testimonial-col-left .testimonial-side-card', {
                    y: 0, opacity: 1, scale: 1,
                    duration: 0.9, ease: 'power3.out',
                    stagger: 0.15, delay: 0.15
                });
                // Right cards staggered
                gsap.to('.testimonial-col-right .testimonial-side-card', {
                    y: 0, opacity: 1, scale: 1,
                    duration: 0.9, ease: 'power3.out',
                    stagger: 0.15, delay: 0.15
                });
            }
        });
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
