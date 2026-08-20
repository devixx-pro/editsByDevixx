{{-- ===================== S1 — THE 3 C'S ===================== --}}
<div data-panel="s1" class="wb-panel is-active">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART ONE: STRATEGY</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">The 3 C's</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
        @foreach ($threeCs as $c)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="wb-mono text-[11px] tracking-[0.14em] text-primary mb-3">{{ $c['k'] }}</div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $c['d'] }}</p>
                <div class="mt-4 pt-3 border-t border-surface-border wb-mono text-[11px]" style="color:#00B89C;">{{ $c['m'] }}</div>
            </div>
        @endforeach
    </div>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">GOOGLE OR META?</h3>
    <p class="text-[13px] text-gray-500 mb-5">Think about your ideal customer right now. Which best describes them?</p>

    <div data-wb-choice="awareness" data-accent="#00B89C" class="space-y-3">
        @foreach ($awareness as $i => $a)
            <button type="button" data-val="a{{ $i }}" class="w-full text-left rounded-xl border p-4 transition-colors" style="border-color:#333;background:#0d0d0d;">
                <div class="text-[13px] text-gray-200 leading-relaxed">{{ $a['opt'] }}</div>
                <div class="text-[12px] text-gray-600 mt-2">{{ $a['eg'] }}</div>
            </button>
        @endforeach

        @foreach ($awareness as $i => $a)
            <div data-reveal="a{{ $i }}" class="hidden rounded-xl border p-5" style="border-color:rgba(0,184,156,.25);background:rgba(0,184,156,.05);">
                <div class="wb-mono text-[10px] tracking-[0.16em] text-gray-500 mb-1">START WITH</div>
                <div class="text-xl font-bold text-white mb-3">{{ $a['start'] }}</div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $a['why'] }}</p>
                <div class="mt-4 pt-3 border-t border-white/10 text-[12px] text-gray-500">
                    <span class="wb-mono" style="color:#D4A843;">APPLIES WHEN:</span> {{ $a['applies'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s2" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Forecasting →</button>
    </div>
</div>

{{-- ===================== S2 — FORECASTING ===================== --}}
<div data-panel="s2" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART ONE: STRATEGY</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-3" style="font-family: Georgia, serif;">Forecasting</h2>
    <p class="text-[14px] text-gray-400 mb-8 max-w-2xl leading-relaxed">
        Type your numbers into each field. <span style="color:#ef4444;">Red</span> = below benchmark,
        <span style="color:#00B89C;">green</span> = on target, <span style="color:#D4A843;">gold</span> = above.
        Watch how small changes compound into big revenue differences.
    </p>

    <div data-wb-choice="fc_mode" data-accent="#00B89C" class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-8">
        <button type="button" data-val="2step" class="text-left rounded-xl border p-4 transition-colors" style="border-color:#333;background:#0d0d0d;">
            <div class="text-white text-[14px] font-semibold mb-1">2-Step Funnel</div>
            <div class="text-[12px] text-gray-500 leading-relaxed">Ad → opt-in → booking page → call. Standard for consultative service businesses.</div>
        </button>
        <button type="button" data-val="1step" class="text-left rounded-xl border p-4 transition-colors" style="border-color:#333;background:#0d0d0d;">
            <div class="text-white text-[14px] font-semibold mb-1">1-Step Funnel</div>
            <div class="text-[12px] text-gray-500 leading-relaxed">Ad → opt-in directly. Better for trades, quick quote calls (5-10 min).</div>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        {{-- Inputs --}}
        <div class="rounded-xl border border-surface-border overflow-hidden" style="background:#0a0a0a;">
            <div class="px-4 py-3 border-b border-surface-border wb-mono text-[11px] tracking-[0.14em] text-white">YOUR INPUTS</div>
            <table class="w-full">
                <tbody>
                @foreach ($forecastInputs as $f)
                    <tr>
                        <td class="px-3 py-2 text-[13px] text-gray-300 border-b border-[#1e1e1e] w-[42%]">
                            {{ $f['label'] }}
                            @if ($f['note'])
                                <div class="text-[11px] text-gray-600 mt-[2px]">{{ $f['note'] }}</div>
                            @endif
                        </td>
                        <td class="px-3 py-2 border-b border-[#1e1e1e]">
                            <div data-fc-wrap class="inline-flex items-center rounded-md border w-fit" style="background:#050505;border-color:#333;">
                                @if ($f['prefix'])
                                    <span data-affix class="wb-mono text-[13px] pl-2">{{ $f['prefix'] }}</span>
                                @endif
                                <input type="number" class="wb-num" data-fc="{{ $f['k'] }}" step="{{ $f['step'] }}" value="{{ $f['def'] }}">
                                @if ($f['suffix'])
                                    <span data-affix class="wb-mono text-[13px] pr-2">{{ $f['suffix'] }}</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Outputs --}}
        <div class="rounded-xl border border-surface-border overflow-hidden" style="background:#0a0a0a;">
            <div class="px-4 py-3 border-b border-surface-border wb-mono text-[11px] tracking-[0.14em] text-white">CALCULATED OUTPUTS</div>
            <table class="w-full">
                <thead>
                    <tr class="wb-mono text-[10px] text-gray-600">
                        <th class="text-left px-3 py-2 font-normal"></th>
                        <th class="text-right px-3 py-2 font-normal">MONTHLY</th>
                        <th class="text-right px-3 py-2 font-normal">ANNUAL</th>
                        <th class="text-right px-3 py-2 font-normal">COST EA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $outRows = [
                            ['k' => 'spend',  'label' => 'Ad Spend',      'section' => true],
                            ['k' => 'imp',    'label' => 'Impressions',   'section' => false],
                            ['k' => 'clicks', 'label' => 'Clicks',        'section' => false],
                            ['k' => 'leads',  'label' => 'Leads',         'section' => true],
                            ['k' => 'books',  'label' => 'Bookings',      'section' => false],
                            ['k' => 'convos', 'label' => 'Conversations', 'section' => true],
                            ['k' => 'deals',  'label' => 'Deals',         'section' => false],
                        ];
                    @endphp
                    @foreach ($outRows as $r)
                        <tr data-row="{{ $r['k'] }}" class="border-b border-[#1e1e1e] {{ $r['section'] ? 'border-t border-t-[#333]' : '' }}">
                            <td class="px-3 py-2 text-[13px] text-gray-400">{{ $r['label'] }}</td>
                            <td class="px-3 py-2 text-right wb-mono text-[13px] text-white" data-out="{{ $r['k'] }}-m">—</td>
                            <td class="px-3 py-2 text-right wb-mono text-[13px] text-gray-500" data-out="{{ $r['k'] }}-a">—</td>
                            <td class="px-3 py-2 text-right wb-mono text-[12px] text-gray-600" data-out="{{ $r['k'] }}-c">—</td>
                        </tr>
                    @endforeach
                    <tr class="border-t border-[#333]" style="background:rgba(147,51,234,.08);">
                        <td class="px-3 py-3 text-[13px] font-semibold text-white">Revenue</td>
                        <td class="px-3 py-3 text-right wb-mono text-[14px] font-bold" style="color:#00B89C;" data-out="rev-m">—</td>
                        <td class="px-3 py-3 text-right wb-mono text-[13px] text-gray-400" data-out="rev-a">—</td>
                        <td class="px-3 py-3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="px-3 py-2 wb-mono text-[12px] text-right" style="color:#D4A843;" data-out="roas">ROAS —</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 rounded-xl border border-surface-border p-4" style="background:#0a0a0a;">
        <p class="text-[13px] text-gray-400 leading-relaxed">
            <span class="wb-mono text-[11px]" style="color:#D4A843;">NOTE</span> —
            ROAS is a vanity metric. A 3x ROAS at $20k/day beats a 20x at $50/day. Net profit is what matters.
        </p>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s3" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: 10 Principles →</button>
    </div>
</div>

{{-- ===================== S3 — 10 PRINCIPLES ===================== --}}
<div data-panel="s3" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART ONE: STRATEGY</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">10 Principles of Advertising</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($principles as $i => $p)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="wb-mono text-[11px]" style="color:#9333EA;">{{ sprintf('%02d', $i + 1) }}</span>
                    <div class="text-white text-[15px] font-semibold">{!! $p['t'] !!}</div>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $p['d'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-surface-border p-4" style="background:#0a0a0a;">
        <p class="text-[13px] text-gray-400 leading-relaxed">
            Use these as a diagnostic lens. When something isn't working, run through the 10 principles and ask which one you're violating.
        </p>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s4" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Customer Avatar →</button>
    </div>
</div>

{{-- ===================== S4 — CUSTOMER AVATAR ===================== --}}
<div data-panel="s4" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART ONE: STRATEGY</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Customer Avatar</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-4">WHO ARE THEY?</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
        @include('lead-magnets.partials.wb-field', ['id' => 'avatar_age',      'label' => 'Age range',              'placeholder' => 'e.g. 35-55', 'rows' => 2])
        @include('lead-magnets.partials.wb-field', ['id' => 'avatar_location', 'label' => 'Location / service area', 'placeholder' => 'e.g. Perth', 'rows' => 2])
        @include('lead-magnets.partials.wb-field', ['id' => 'avatar_industry', 'label' => 'Industry',                'placeholder' => 'e.g. service businesses', 'rows' => 2])
    </div>
    @include('lead-magnets.partials.wb-field', [
        'id' => 'avatar_descriptor',
        'label' => '2-3 descriptors (what defines them)',
        'placeholder' => 'e.g. Established business owner, 5+ years, has a team, revenue $500k+',
        'rows' => 2,
    ])

    {{-- Towards motivators --}}
    <div class="mt-10 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] mb-2" style="color:#00B89C;">TOWARDS MOTIVATORS</h3>
        <p class="text-[13px] text-gray-500 mb-5 leading-relaxed">
            For each one, ask yourself: <strong class="text-gray-300">Why do they want this? Then what happens when they get it?</strong>
            Go at least 2 levels deep — that's where the real emotion lives.
        </p>
        @for ($i = 1; $i <= 3; $i++)
            @include('lead-magnets.partials.wb-field', [
                'id' => 'towards_' . $i,
                'label' => 'Motivator ' . $i,
                'placeholder' => $i === 1 ? 'e.g. consistent inbound leads' : ($i === 2 ? 'e.g. confidence on camera' : ''),
                'rows' => 2,
            ])
        @endfor
    </div>

    {{-- Away from --}}
    <div class="mt-4 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] mb-2" style="color:#9333EA;">AWAY FROM MOTIVATORS</h3>
        <p class="text-[13px] text-gray-500 mb-5 leading-relaxed">
            For each pain: <strong class="text-gray-300">What's the real cost if it's never fixed?</strong>
            Think financial, emotional, identity. The deeper the pain, the stronger the hook.
        </p>
        @for ($i = 1; $i <= 3; $i++)
            @include('lead-magnets.partials.wb-field', [
                'id' => 'away_' . $i,
                'label' => 'Pain point ' . $i,
                'placeholder' => $i === 1 ? 'e.g. burnt $15k on agency, nothing' : ($i === 2 ? 'e.g. word of mouth plateauing' : ''),
                'rows' => 2,
            ])
        @endfor
    </div>

    {{-- Previous attempts --}}
    <div class="mt-4 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] mb-2" style="color:#D4A843;">PREVIOUS ATTEMPTS</h3>
        <p class="text-[13px] text-gray-500 mb-5 leading-relaxed">
            These become your best ad hooks — "this is different from X because..." Each one is an objection your marketing needs to pre-empt.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
            @for ($i = 1; $i <= 4; $i++)
                @include('lead-magnets.partials.wb-field', [
                    'id' => 'prev_' . $i,
                    'label' => 'Attempt ' . $i,
                    'placeholder' => $i === 1 ? 'e.g. Hired an agency' : ($i === 2 ? 'e.g. DIY YouTube tutorials' : ($i === 3 ? 'e.g. Tried UGC creators' : '')),
                    'rows' => 2,
                ])
            @endfor
        </div>
    </div>

    <div class="mt-4 rounded-xl border p-4" style="background:rgba(212,168,67,.06);border-color:rgba(212,168,67,.25);">
        <p class="text-[13px] text-gray-400 leading-relaxed">
            <strong style="color:#D4A843;">Language tip:</strong>
            As you write these motivators and pains, note the exact words and phrases your customer uses to describe them —
            not your words, theirs. Wrong lingo = instant credibility loss. Use their language verbatim in your ads and landing page.
        </p>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s5" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Messaging →</button>
    </div>
</div>

{{-- ===================== S5 — MESSAGING ===================== --}}
<div data-panel="s5" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART ONE: STRATEGY</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-3" style="font-family: Georgia, serif;">Messaging</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mt-8 mb-2">THING → RESULT → FEELING</h3>
    <p class="text-[13px] text-gray-500 mb-5">Most businesses only talk about the thing. Great advertisers talk about the feeling. Work through all three.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @include('lead-magnets.partials.wb-field', ['id' => 'msg_thing',   'label' => 'THE THING',   'hint' => 'What your service actually is',        'placeholder' => 'Features, delivery, curriculum, format...', 'rows' => 5])
        @include('lead-magnets.partials.wb-field', ['id' => 'msg_result',  'label' => 'THE RESULT',  'hint' => 'Tangible outcomes clients get',        'placeholder' => 'What they walk away with, what changes, what they can now do...', 'rows' => 5])
        @include('lead-magnets.partials.wb-field', ['id' => 'msg_feeling', 'label' => 'THE FEELING', 'hint' => 'How they feel when they achieve it',   'placeholder' => 'Overwhelmed with leads? Confident? In control? Addicted to posting?...', 'rows' => 5])
    </div>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mt-10 mb-2">HEADLINE DRAFTS</h3>
    <p class="text-[13px] text-gray-500 mb-5">
        <strong class="text-gray-300">Result + Feeling</strong>. Write 3 attempts, pick the most specific one.
    </p>

    @for ($i = 1; $i <= 3; $i++)
        @include('lead-magnets.partials.wb-field', [
            'id' => 'headline_' . $i,
            'label' => 'Draft ' . $i,
            'placeholder' => $i === 1
                ? 'e.g. Go from invisible to booked out without relying on word of mouth'
                : ($i === 2 ? 'e.g. The system Perth business owners use to get consistent leads without an agency' : 'Your attempt...'),
            'rows' => 2,
        ])
    @endfor

    <div class="mt-6 rounded-xl border p-5" style="background:rgba(0,184,156,.05);border-color:rgba(0,184,156,.25);">
        @include('lead-magnets.partials.wb-field', ['id' => 'headline_final', 'label' => '✓ YOUR CHOSEN HEADLINE', 'placeholder' => 'Copy your best draft here', 'rows' => 2])
        @include('lead-magnets.partials.wb-field', ['id' => 'sub_headline',   'label' => 'Sub-headline (HOW you achieve the result)', 'placeholder' => 'e.g. In a 2-day online workshop, we build your content system and film your first 10 videos together', 'rows' => 2])
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s6" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Landing Page →</button>
    </div>
</div>

{{-- ===================== S6 — LANDING PAGE ===================== --}}
<div data-panel="s6" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART TWO: BUILD</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Landing Page Theory</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
            <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">PHYSICAL RESISTANCE CHECKLIST</h3>
            <p class="text-[13px] text-gray-500 mb-5">Clicks, keystrokes, scrolls. Reduce all three.</p>
            @foreach ($physicalChecklist as $i => $item)
                @include('lead-magnets.partials.wb-check', ['id' => 'lp_phys_' . $i, 'text' => $item])
            @endforeach
        </div>

        <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
            <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">PSYCHOLOGICAL RESISTANCE CHECKLIST</h3>
            <p class="text-[13px] text-gray-500 mb-5">Thought, trust, curiosity vs commitment.</p>
            @foreach ($psychologicalChecklist as $i => $item)
                @include('lead-magnets.partials.wb-check', ['id' => 'lp_psych_' . $i, 'text' => $item])
            @endforeach
        </div>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s7" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Build Funnel →</button>
    </div>
</div>

{{-- ===================== S7 — BUILD FUNNEL ===================== --}}
<div data-panel="s7" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART TWO: BUILD</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Building the Funnel</h2>

    <div class="rounded-xl border border-surface-border p-5 mb-4" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">FUNNEL BUILD CHECKLIST</h3>
        <p class="text-[13px] text-gray-500 mb-5">Tick as you build. Done beats perfect — a rough funnel live beats a perfect one still being built.</p>
        @foreach ($funnelChecklist as $i => $item)
            @include('lead-magnets.partials.wb-check', ['id' => 'fn_build_' . $i, 'text' => $item])
        @endforeach
    </div>

    <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">2-STEP FUNNEL NURTURE SEQUENCE CHECKLIST</h3>
        <p class="text-[13px] text-gray-500 mb-5">Set these up once. Goal: maintain or increase excitement between booking and call. Tick each off as you build it.</p>
        @foreach ($nurtureChecklist as $i => $item)
            @include('lead-magnets.partials.wb-check', ['id' => 'fn_nurture_' . $i, 'text' => $item])
        @endforeach
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s8" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Ad Principles →</button>
    </div>
</div>

{{-- ===================== S8 — AD PRINCIPLES ===================== --}}
<div data-panel="s8" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART THREE: CREATE</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Ad Principles</h2>

    {{-- Rule of one --}}
    <div class="rounded-xl border border-surface-border p-5 mb-4" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">THE RULE OF ONE</h3>
        <p class="text-[13px] text-gray-500 mb-5">Every ad follows ONE idea, ONE story, ONE promise, ONE emotion, ONE CTA. Frankenstein ads (multiple ideas mashed together) don't work.</p>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mb-5">
            @foreach (['IDEA', 'STORY', 'PROMISE', 'EMOTION', 'CTA'] as $one)
                <div class="rounded-lg border py-3 text-center" style="border-color:rgba(0,184,156,.25);background:rgba(0,184,156,.05);">
                    <div class="wb-mono text-[9px] tracking-widest text-gray-600">ONE</div>
                    <div class="wb-mono text-[12px] mt-1" style="color:#00B89C;">{{ $one }}</div>
                </div>
            @endforeach
        </div>
        <p class="text-[13px] text-gray-400 leading-relaxed">
            When an ad works, look at it through the Rule of One:
            <strong class="text-gray-200">What was the idea? What was the emotion?</strong>
            Then find adjacent ideas in the same direction to build more ads.
        </p>
    </div>

    {{-- Hook formula --}}
    <div class="rounded-xl border border-surface-border p-5 mb-4" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">HOOK FORMULA</h3>
        <p class="text-[13px] text-gray-500 mb-5">
            Your hook needs to do 3 things: <strong class="text-gray-300">spark curiosity</strong>,
            <strong class="text-gray-300">use committed language</strong>,
            <strong class="text-gray-300">filter out wrong people</strong>. The hook is 80% of the result.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @foreach ($hookExamples as $h)
                @php
                    $tone = $h['tone'] === 'bad' ? '#ef4444' : ($h['tone'] === 'good' ? '#00B89C' : '#D4A843');
                @endphp
                <div class="rounded-lg border p-4" style="border-color:{{ $tone }}40;background:#0d0d0d;">
                    <div class="wb-mono text-[10px] tracking-wider mb-2" style="color:{{ $tone }};">{{ $h['tag'] }}</div>
                    <div class="text-[13px] text-gray-200 leading-relaxed italic">"{{ $h['q'] }}"</div>
                    <div class="text-[12px] text-gray-500 mt-3 leading-relaxed">{{ $h['n'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 12 ad ideas --}}
    <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">YOUR 12 AD IDEAS</h3>
        <p class="text-[13px] text-gray-500 mb-4">Pull ideas from your customer avatar. Each one follows the Rule of One. You need minimum 12 for Andromeda to work properly.</p>

        <div class="rounded-lg border p-4 mb-5" style="border-color:rgba(0,184,156,.25);background:rgba(0,184,156,.04);">
            <p class="text-[13px] text-gray-400 leading-relaxed">
                Each idea = one problem, pain, or previous attempt from your avatar. Hook formula:
                <strong class="text-gray-200">state the problem → hint at a better way → use committed language.</strong>
                e.g. "After 2 days in my workshop, business owners stop relying on word of mouth" — not "Are you struggling to get leads?"
            </p>
        </div>

        <div class="rounded-lg border border-surface-border overflow-hidden">
            <div class="grid grid-cols-[36px_1fr] wb-mono text-[10px] text-gray-600" style="background:#0d0d0d;">
                <div class="px-2 py-2 text-center">#</div>
                <div class="px-3 py-2">AD IDEA — one problem, pain, or previous attempt per row</div>
            </div>
            @for ($i = 1; $i <= 12; $i++)
                <div class="grid grid-cols-[36px_1fr] border-t border-surface-border">
                    <div class="px-2 py-2 text-center wb-mono text-[12px] text-gray-600 flex items-center justify-center">{{ $i }}</div>
                    <input type="text"
                           class="w-full bg-transparent border-0 outline-none text-[13px] text-gray-200 px-3 py-2 placeholder:text-[#3d3d3d]"
                           data-wb="adidea_{{ $i }}"
                           placeholder="{{ $i === 1 ? 'e.g. Relying on word of mouth to get new clients' : ($i === 2 ? "e.g. Burnt money on an agency that didn't understand the business" : ($i === 3 ? 'e.g. Know they need content but freeze on camera' : '')) }}">
                </div>
            @endfor
        </div>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s9" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Filming Ads →</button>
    </div>
</div>

{{-- ===================== S9 — FILMING ADS ===================== --}}
<div data-panel="s9" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART THREE: CREATE</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Filming Ads</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">AD STRUCTURE — FOR EVERY AD</h3>
    <p class="text-[13px] text-gray-500 mb-5">Simple 3-part framework. Know this cold before filming.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($adStructure as $i => $a)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="flex items-baseline gap-2 mb-3">
                    <span class="wb-mono text-[11px] text-gray-600">{{ sprintf('%02d', $i + 1) }}</span>
                    <div class="wb-mono text-[12px] tracking-wider" style="color:#9333EA;">{{ $a['t'] }}</div>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $a['d'] }}</p>
                <div class="mt-4 pt-3 border-t border-surface-border text-[12px] text-gray-500 italic leading-relaxed">{{ $a['eg'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
        <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-4">SCRIPT YOUR FIRST AD</h3>
        @include('lead-magnets.partials.wb-field', ['id' => 'film_hook',  'label' => 'HOOK',               'placeholder' => 'Your opening line — committed language, filters the wrong people', 'rows' => 2])
        @include('lead-magnets.partials.wb-field', ['id' => 'film_prove', 'label' => 'PROVE YOUR POINT',   'placeholder' => 'The story, case study, or internal monologue you repeat back to them', 'rows' => 4])
        @include('lead-magnets.partials.wb-field', ['id' => 'film_cta',   'label' => 'TELL THEM WHAT TO DO', 'placeholder' => 'One CTA — selling the next step only', 'rows' => 2])
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s10" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: VSL →</button>
    </div>
</div>

{{-- ===================== S10 — VSL ===================== --}}
<div data-panel="s10" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART THREE: CREATE</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">VSL</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">WHICH VSL TYPE SUITS YOU?</h3>
    <p class="text-[13px] text-gray-500 mb-5">Two options. Pick one and build it.</p>

    <div data-wb-choice="vsl_type" data-accent="#00B89C" class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-8">
        <button type="button" data-val="feedback" class="text-left rounded-xl border p-4 transition-colors" style="border-color:#333;background:#0d0d0d;">
            <div class="text-white text-[14px] font-semibold mb-1">Feedback Story Arc VSL</div>
            <div class="text-[12px] text-gray-500">5-15 mins — established offer, existing testimonials, clear pillars</div>
        </button>
        <button type="button" data-val="google" class="text-left rounded-xl border p-4 transition-colors" style="border-color:#333;background:#0d0d0d;">
            <div class="text-white text-[14px] font-semibold mb-1">Google Review VSL</div>
            <div class="text-[12px] text-gray-500">2-5 mins — no VSL yet, have 5+ reviews, want a quick win</div>
        </button>

        {{-- Feedback story arc planner --}}
        <div data-reveal="feedback" class="hidden md:col-span-2 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
            <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">FEEDBACK STORY ARC — PLANNER</h3>
            <p class="text-[13px] text-gray-500 mb-5">Work through each section before you film. The structure carries the VSL — talking your way through this plan is all you need to do.</p>

            @include('lead-magnets.partials.wb-field', [
                'id' => 'vsl_30s',
                'label' => 'FIRST 30 SECONDS — Meet them where they\'re at',
                'hint' => 'Pain points + proof. What are the 3-4 things going through their head right now? What proof can you flash on screen (testimonial montage, workshop clips)?',
                'placeholder' => 'e.g. You\'ve been relying on word of mouth, you know you need content but freeze on camera, your competitors are showing up online... [flash workshop montage on screen]',
                'rows' => 4,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'vsl_p1',
                'label' => 'PILLAR 1',
                'hint' => 'Your first delivery mechanism. Why other solutions failed. What makes yours different. What specifically happens in it.',
                'placeholder' => 'e.g. Most business owners tried hiring an agency — didn\'t work because the agency didn\'t understand their industry. Our 2-day workshop solves this because you build it yourself with guidance. Day 1: brand language, 100 ideas. Day 2: filming and editing. Walk away with 10 videos live.',
                'rows' => 4,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'vsl_gap',
                'label' => 'THE GOOD PROBLEM',
                'hint' => 'What problem does Pillar 1 create that makes Pillar 2 necessary?',
                'placeholder' => 'e.g. Now they have a content system and data — but they need help knowing what to do with it and staying consistent.',
                'rows' => 3,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'vsl_p2',
                'label' => 'PILLAR 2',
                'hint' => 'How you solve the good problem. What ongoing support looks like.',
                'placeholder' => 'e.g. 6 months on WhatsApp. Send content before you post — I review it. When something performs well or tanks, we debrief. The system gets better over time.',
                'rows' => 4,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'vsl_faqs',
                'label' => 'FAQ SECTION — Top questions to answer',
                'hint' => 'What are the 5 things people ask before buying? Answer them here so they don\'t have to ask on the call.',
                'placeholder' => 'e.g. Is it online? Yes. How long? 2 days. What results can I expect? Will this work for my industry? We\'ve worked with...',
                'rows' => 4,
            ])
        </div>

        {{-- Google review VSL planner --}}
        <div data-reveal="google" class="hidden md:col-span-2 rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
            <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">GOOGLE REVIEW VSL — PLANNER</h3>
            <p class="text-[13px] text-gray-500 mb-5">Open Loom or your camera. Pull up your Google reviews. Talk about 5-6 of them one by one. Cut it, add captions, embed it. Done.</p>

            <div class="rounded-lg border p-4 mb-5" style="border-color:rgba(0,184,156,.25);background:rgba(0,184,156,.04);">
                <div class="wb-mono text-[11px] tracking-wider mb-3" style="color:#00B89C;">THE FORMULA FOR EACH REVIEW</div>
                @foreach ([
                    'Read the review name and star rating — show it on screen as you talk',
                    'Say what situation they were in before they came to you',
                    'Say what changed — specifically',
                    'Quote or paraphrase what they said in the review',
                    'Move straight to the next review — no filler',
                ] as $n => $step)
                    <div class="flex gap-3 text-[13px] text-gray-400 mb-2">
                        <span class="wb-mono text-[11px] text-gray-600">{{ $n + 1 }}</span>
                        <span>{{ $step }}</span>
                    </div>
                @endforeach
            </div>

            @include('lead-magnets.partials.wb-field', [
                'id' => 'gr_reviews',
                'label' => 'WHICH REVIEWS WILL YOU USE?',
                'hint' => 'Pick 5-6 of your best Google reviews. Ideally ones from different industries or situations. Paste the key phrases here.',
                'placeholder' => 'e.g. Review 1: Sarah T. — \'We went from relying on referrals to having 3 leads a week within a month...\' Review 2: ...',
                'rows' => 4,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'gr_open',
                'label' => 'YOUR OPENING LINE',
                'hint' => 'Don\'t introduce yourself first. Open with social proof — get into a review within 10 seconds.',
                'placeholder' => 'e.g. \'I want to share some results from business owners who\'ve been through our program — starting with Sarah, who runs a cleaning company in Perth...\'',
                'rows' => 3,
            ])
            @include('lead-magnets.partials.wb-field', [
                'id' => 'gr_close',
                'label' => 'YOUR CLOSE',
                'hint' => 'After the last review, one CTA. Don\'t oversell. Just tell them what to do next.',
                'placeholder' => 'e.g. \'If any of this resonates with where you\'re at right now, click below and answer a few questions to see if we\'re a good fit.\'',
                'rows' => 3,
            ])
        </div>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s11" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Meta Campaign →</button>
    </div>
</div>

{{-- ===================== S11 — META CAMPAIGN ===================== --}}
<div data-panel="s11" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART FOUR: LAUNCH</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Building Your Meta Campaign</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-5">META CAMPAIGNS — WHAT YOU NEED TO KNOW</h3>

    <div class="space-y-3">
        @foreach ($metaPoints as $i => $p)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="wb-mono text-[11px]" style="color:#9333EA;">{{ sprintf('%02d', $i + 1) }}</span>
                    <div class="text-white text-[14px] font-semibold">{{ $p['t'] }}</div>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-400 pl-7">{{ $p['d'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Concrete Ads Manager walkthrough --}}
    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mt-12 mb-2">CAMPAIGN SETUP — TICK AS YOU GO</h3>
    <p class="text-[13px] text-gray-500 mb-5 max-w-2xl leading-relaxed">
        The principles above tell you why. This is the actual build. Work top to bottom inside Ads Manager —
        by the end of it you have a live campaign, not notes about one.
    </p>

    <div class="space-y-4">
        @foreach ($campaignSetup as $gi => $g)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="flex items-center gap-3 mb-4">
                    <span class="wb-mono text-[11px]" style="color:#00B89C;">{{ sprintf('%02d', $gi + 1) }}</span>
                    <div class="wb-mono text-[12px] tracking-[0.14em] text-white">{{ $g['group'] }}</div>
                </div>
                @foreach ($g['items'] as $ii => $item)
                    @include('lead-magnets.partials.wb-check', ['id' => 'mc_setup_' . $gi . '_' . $ii, 'text' => $item])
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="mt-4 rounded-xl border p-4" style="background:rgba(212,168,67,.06);border-color:rgba(212,168,67,.25);">
        <p class="text-[13px] text-gray-400 leading-relaxed">
            <strong style="color:#D4A843;">Heads up:</strong>
            Meta renames these settings fairly often. If a label above doesn't match what you're seeing on screen,
            the setting almost always still exists — look for the nearest equivalent rather than skipping it.
        </p>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s12" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Audiences →</button>
    </div>
</div>

{{-- ===================== S12 — AUDIENCES ===================== --}}
<div data-panel="s12" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART FOUR: LAUNCH</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Creating Audiences</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-5">CUSTOM AUDIENCE REFERENCE</h3>

    <div class="rounded-xl border border-surface-border overflow-hidden overflow-x-auto" style="background:#0a0a0a;">
        <table class="w-full min-w-[640px]">
            <thead>
                <tr class="wb-mono text-[10px] text-gray-600" style="background:#0d0d0d;">
                    <th class="text-left px-4 py-3 font-normal w-[28%]">AUDIENCE</th>
                    <th class="text-left px-4 py-3 font-normal w-[28%]">BEST FOR</th>
                    <th class="text-left px-4 py-3 font-normal">NOTES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audiences as $a)
                    <tr class="border-t border-surface-border align-top">
                        <td class="px-4 py-3 text-[13px] text-gray-200">{{ $a['a'] }}</td>
                        <td class="px-4 py-3 text-[13px] text-gray-400">{{ $a['b'] }}</td>
                        <td class="px-4 py-3 text-[13px] text-gray-500">{{ $a['n'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 rounded-xl border p-4" style="background:rgba(212,168,67,.06);border-color:rgba(212,168,67,.25);">
        <p class="text-[13px] text-gray-400 leading-relaxed">
            <strong style="color:#D4A843;">Start with cold only.</strong>
            Add warm audiences once your pixel has 500+ events. Before that, your warm audience is too small to matter.
        </p>
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s13" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Sales →</button>
    </div>
</div>

{{-- ===================== S13 — SALES ===================== --}}
<div data-panel="s13" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART FIVE: CLOSE</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Sales</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-5">MINDSET TIPS</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
        @foreach ($mindset as $m)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="text-white text-[14px] font-semibold mb-2">{{ $m['t'] }}</div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $m['d'] }}</p>
            </div>
        @endforeach
    </div>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">SALES CALL STRUCTURE — OVERVIEW</h3>
    <p class="text-[13px] text-gray-500 mb-5">Five stages, always in this order. The biggest mistake is skipping straight to pitch.</p>

    <div class="space-y-3">
        @foreach ($callStages as $i => $s)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;border-left:3px solid #9333EA;">
                <div class="flex items-center gap-3 mb-2">
                    <span class="wb-mono text-[11px] text-gray-600">{{ sprintf('%02d', $i + 1) }}</span>
                    <div class="wb-mono text-[13px] tracking-wider text-white">{{ $s['t'] }}</div>
                    <span class="wb-mono text-[11px] px-2 py-[2px] rounded" style="background:rgba(147,51,234,.15);color:#A855F7;">{{ $s['time'] }}</span>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $s['d'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 flex justify-end">
        <button type="button" data-goto="s14" class="text-[13px] text-primary hover:text-primary-light transition-colors">Next: Optimising →</button>
    </div>
</div>

{{-- ===================== S14 — OPTIMISING ===================== --}}
<div data-panel="s14" class="wb-panel">
    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary mb-2">PART SIX: OPTIMISE</div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8" style="font-family: Georgia, serif;">Optimising</h2>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-2">BOTTLENECK CHECKLIST — WORK THROUGH IN ORDER</h3>
    <p class="text-[13px] text-gray-500 mb-5">Always start at the top of the funnel. A low close rate is often a show rate problem. A low show rate is often a landing page problem.</p>

    <div class="space-y-3 mb-10">
        @foreach ($bottlenecks as $i => $b)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="wb-mono text-[12px] mb-2 px-2 py-1 rounded w-fit" style="background:rgba(239,68,68,.12);color:#ef4444;">{!! $b['t'] !!}</div>
                <p class="text-[13px] leading-relaxed text-gray-400">{{ $b['d'] }}</p>
            </div>
        @endforeach
    </div>

    <h3 class="wb-mono text-[12px] tracking-[0.16em] text-white mb-5">OPTIMISING CAMPAIGNS — PLAYBOOK</h3>
    <div class="space-y-3">
        @foreach ($optimising as $i => $o)
            <div class="rounded-xl border border-surface-border p-5" style="background:#0a0a0a;">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="wb-mono text-[11px]" style="color:#00B89C;">{{ sprintf('%02d', $i + 1) }}</span>
                    <div class="text-white text-[14px] font-semibold">{{ $o['t'] }}</div>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-400 pl-7">{{ $o['d'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Closing CTA --}}
    <div class="mt-12 rounded-2xl border border-surface-border p-8 text-center" style="background:linear-gradient(180deg,rgba(147,51,234,.10),rgba(0,0,0,0));">
        <div class="wb-mono text-[10px] tracking-[0.2em] text-primary mb-3">EDITS BY DEVIXX</div>
        <h3 class="text-2xl md:text-3xl font-bold text-white mb-4" style="font-family: Georgia, serif;">Want us to build it with you?</h3>
        <p class="text-[14px] text-gray-400 max-w-xl mx-auto leading-relaxed">
            The workbook gives you the framework. If you'd rather have it built and running — creative, funnel,
            campaign setup and the content system behind it — that's what we do.
        </p>
        <a href="/#contact" class="mt-6 inline-flex items-center justify-center px-8 py-4 rounded-full text-white text-[15px] font-semibold transition-all duration-300 hover:opacity-90" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
            Let's Talk
        </a>
    </div>
</div>
