@php
    // ---------------------------------------------------------------
    // Meta Ads Workbook — interactive lead magnet.
    // Answers persist to localStorage under `devixx_maw_answers`.
    // ---------------------------------------------------------------

    $sections = [
        ['id' => 's1',  'label' => "The 3 C's",        'part' => 'PART ONE: STRATEGY'],
        ['id' => 's2',  'label' => 'Forecasting',      'part' => 'PART ONE: STRATEGY'],
        ['id' => 's3',  'label' => '10 Principles',    'part' => 'PART ONE: STRATEGY'],
        ['id' => 's4',  'label' => 'Customer Avatar',  'part' => 'PART ONE: STRATEGY'],
        ['id' => 's5',  'label' => 'Messaging',        'part' => 'PART ONE: STRATEGY'],
        ['id' => 's6',  'label' => 'Landing Page',     'part' => 'PART TWO: BUILD'],
        ['id' => 's7',  'label' => 'Build Funnel',     'part' => 'PART TWO: BUILD'],
        ['id' => 's8',  'label' => 'Ad Principles',    'part' => 'PART THREE: CREATE'],
        ['id' => 's9',  'label' => 'Filming Ads',      'part' => 'PART THREE: CREATE'],
        ['id' => 's10', 'label' => 'VSL',              'part' => 'PART THREE: CREATE'],
        ['id' => 's11', 'label' => 'Meta Campaign',    'part' => 'PART FOUR: LAUNCH'],
        ['id' => 's12', 'label' => 'Audiences',        'part' => 'PART FOUR: LAUNCH'],
        ['id' => 's13', 'label' => 'Sales',            'part' => 'PART FIVE: CLOSE'],
        ['id' => 's14', 'label' => 'Optimising',       'part' => 'PART SIX: OPTIMISE'],
    ];

    $threeCs = [
        ['k' => 'CLICKS',      'd' => 'People clicking your ad and landing on your page. You want clicks from the right people — not everyone.', 'm' => 'Link CTR + Cost per click'],
        ['k' => 'CONVERSIONS', 'd' => 'The right person completing your form and booking a call. This is where curious becomes interested.',   'm' => 'Opt-in rate + Booking rate + Show rate'],
        ['k' => 'CLOSE',       'd' => 'Getting them to say yes on the sales call. Marketing that supports sales makes closing dramatically easier.', 'm' => 'Close rate + Cost per acquisition'],
    ];

    $awareness = [
        [
            'opt'     => 'They know they have the problem and are actively searching for a solution',
            'eg'      => "e.g. 'electrician near me', 'divorce lawyer Perth', 'accountant for small business'",
            'start'   => 'Google Ads',
            'why'     => "Search intent is already there. Your job is to show up when they search. Google captures demand — it doesn't create it.",
            'applies' => "Problem-aware AND solution-aware. They're already looking.",
        ],
        [
            'opt'     => "They have the problem but aren't searching — they don't know a solution like yours exists",
            'eg'      => "e.g. business owners who rely on word of mouth but haven't thought to search for 'lead gen workshop'",
            'start'   => 'Meta Ads',
            'why'     => "No one is searching for you because they don't know you exist yet. Meta lets you interrupt the right person and introduce the problem and solution together.",
            'applies' => 'Problem-aware but not solution-aware. Or not even problem-aware yet.',
        ],
        [
            'opt'     => 'They have the problem but don\'t fully recognise it yet — they need to be shown it',
            'eg'      => "e.g. business owners who think their slow growth is normal, or don't realise their marketing is the issue",
            'start'   => 'Meta Ads',
            'why'     => "You need to create awareness before you can capture it. Meta lets you surface the problem for them, then present your solution. Google won't work — no one is searching.",
            'applies' => 'Not yet problem-aware. Classic for coaching, workshops, B2B services.',
        ],
    ];

    $forecastInputs = [
        ['k' => 'budget',  'label' => 'Daily Ad Budget', 'prefix' => '$', 'suffix' => '',  'note' => 'Start $30-50/day',      'lo' => null, 'hi' => null, 'step' => '1',   'def' => 50],
        ['k' => 'price',   'label' => 'Offer Price',     'prefix' => '$', 'suffix' => '',  'note' => '',                      'lo' => null, 'hi' => null, 'step' => '1',   'def' => 2500],
        ['k' => 'cpm',     'label' => 'CPM',             'prefix' => '$', 'suffix' => '',  'note' => 'B2C ~$40 / B2B ~$70',   'lo' => 20,   'hi' => 80,   'step' => '1',   'def' => 40],
        ['k' => 'ctr',     'label' => 'Link CTR',        'prefix' => '',  'suffix' => '%', 'note' => '1-2% is good',          'lo' => 1,    'hi' => 2,    'step' => '0.1', 'def' => 1],
        ['k' => 'optin',   'label' => 'Opt-in Rate',     'prefix' => '',  'suffix' => '%', 'note' => '5-20% typical',         'lo' => 5,    'hi' => 20,   'step' => '0.5', 'def' => 7],
        ['k' => 'booking', 'label' => 'Booking Rate',    'prefix' => '',  'suffix' => '%', 'note' => '30-50% target',         'lo' => 30,   'hi' => 50,   'step' => '1',   'def' => 30],
        ['k' => 'show',    'label' => 'Show Rate',       'prefix' => '',  'suffix' => '%', 'note' => '~70% target',           'lo' => 65,   'hi' => 80,   'step' => '1',   'def' => 70],
        ['k' => 'close',   'label' => 'Close Rate',      'prefix' => '',  'suffix' => '%', 'note' => '30-45% target',         'lo' => 25,   'hi' => 45,   'step' => '1',   'def' => 30],
    ];

    $principles = [
        ['t' => 'Art vs Science',                     'd' => 'Everything can be measured with a % or $. But advertising is also art — you can do or say whatever you want. Run experiments. Let the numbers decide what works.'],
        ['t' => 'Dials not Switches',                 'd' => 'Nothing is working or not working. Everything works to some degree. Find the dials and turn them — CTR, opt-in rate, show rate. Never binary.'],
        ['t' => "Meet Them Where They're At",         'd' => "Your ad should speak to where your customer is right now — not where you want them to be. If they've never heard of you, don't talk about your offer. Talk about their problem. Match their current awareness level."],
        ['t' => 'Set Expectations',                   'd' => "People are only disappointed when reality doesn't match expectations. Set them clearly at every step. The ad sets expectations the landing page must meet."],
        ['t' => 'Winning Hearts &amp; Minds',         'd' => 'Humans buy emotionally and justify logically — and their logic is already screwed up if emotions got there first. Balance both.'],
        ['t' => 'Constructing Your Argument',         'd' => 'Marketing is debating at scale. Your market has objections. You need multiple reasons (premises) why someone should work with you — not just one.'],
        ['t' => 'Only Selling the Next Step',         'd' => 'The ad just gets the click. The landing page just gets the opt-in. The booking page just gets the booking. Never sell the end product in the ad.'],
        ['t' => 'Curious vs Committed',               'd' => "All your messaging sits on a spectrum. Curious language gets clicks but tanks quality. Committed language filters — and that's a good thing."],
        ['t' => 'Physical &amp; Psychological Resistance', 'd' => 'Every click, keystroke, and scroll reduces conversions. Every moment of confusion or doubt does too. Reduce both at every step.'],
        ['t' => 'Chasing Problems Upstream',          'd' => 'A low close rate might be a discovery problem. A low show rate might be a landing page problem. Always trace issues back to their source.'],
    ];

    $physicalChecklist = [
        'Form embedded on page — not behind a button click',
        'Form uses multi-choice questions, not open text fields where possible',
        'VSL auto-plays with captions burnt in — no click needed',
        'Form appears at or just below the fold — not buried at bottom',
        'First form question is low-commitment (not contact details)',
        'Contact details are the LAST questions in the form',
        'No menu, no external links, no about page — one action only',
    ];

    $psychologicalChecklist = [
        'Headline communicates a clear RESULT — not just what the service is',
        'Images used instead of text blocks wherever possible (images unlock emotional brain faster)',
        'Background image includes real human faces (not stock, not solid colour)',
        'Testimonials are screenshots or embedded video — not rich text',
        'Google reviews are embedded (not copy-pasted)',
        "CTA above form feels like starting a process: 'Answer a few questions to...'",
        'FAQs placed higher on the page — not buried at the bottom',
        'FAQs cover: initial questions, follow-ups, expectations, AND objections',
        'Page includes PR/credibility (podcasts, awards, press mentions)',
    ];

    $funnelChecklist = [
        'Application page created — headline, sub-headline, VSL embedded',
        'Application form created with questions in order (low-commitment first, contact details last)',
        'Booking page created with clear confirmation language',
        'Booking page shows max 5 days availability (not same day, not 3 weeks out)',
        'Thank you page created — VSL prominent, not buried',
        'Pixel / Data Set installed on ALL pages',
        'Lead event fires ONLY on qualifying form completions',
        'Schedule event fires ONLY on booking confirmation page',
        'Nurture sequence set up: confirmation SMS, VSL reminder, 24hr email, 1hr SMS',
    ];

    $nurtureChecklist = [
        'Confirmation SMS fires immediately after booking — asks them to reply YES',
        '1 min later: VSL reminder sent (positioned as helpful to them, not homework)',
        'PS in that message: ask them to reply with a thumbs up once watched',
        'Same day: email with testimonials filtered to their industry',
        'Same day: email addressing their biggest likely objection (worst reviews video / transparency loom)',
        '24 hours before: email with agenda — what to expect, bring your goals, no pushy sales',
        '24 hours before: reminder to bring any other decision makers on the call',
        "1 hour before: SMS with Zoom link — 'See you in an hour'",
        'If no reply to confirmation SMS within 24 hours: consider deleting the booking',
        'If they reply complaining about emails: red flag — consider removing them',
    ];

    $hookExamples = [
        ['tag' => 'CURIOUS (wrong)',      'q' => 'Are you struggling to get leads?', 'n' => 'Too vague — could be about anything. Cheap clicks, terrible quality.', 'tone' => 'bad'],
        ['tag' => 'COMMITTED (right)',    'q' => 'After 2 days in my workshop, business owners stop relying on word of mouth', 'n' => "Implies a service. Filters by situation. Sets expectation of what they'll find.", 'tone' => 'good'],
        ['tag' => 'FINANCIAL QUALIFIER',  'q' => 'Despite managing a team, most business owners still rely on referrals', 'n' => 'Only resonates with people who have a team = can afford you.', 'tone' => 'alt'],
    ];

    $adStructure = [
        ['t' => 'HOOK',               'd' => 'Stop the right person from scrolling. Committed language. Filter out the wrong people. This is 80% of the work.', 'eg' => '"After 2 days in my workshop, business owners stop relying on word of mouth for leads..."'],
        ['t' => 'PROVE YOUR POINT',   'd' => 'Elaborate on the idea. Tell a story. Give a case study. Speak to what they\'re experiencing — repeat back their internal monologue.', 'eg' => '"You wake up Monday, check your phone, hoping someone referred you. That\'s your entire pipeline..."'],
        ['t' => 'TELL THEM WHAT TO DO', 'd' => "One CTA. Always 'click below to learn more' — never ask for the booking in the ad. You're only selling the next step.", 'eg' => '"Click below to learn more." (or) "Click below to see if you\'re a good fit."'],
    ];

    $metaPoints = [
        ['t' => 'Creative diversity is now targeting.',        'd' => 'The algorithm reads your ad transcript, your visuals, and your landing page to find the right audience. What you SAY in the ad does more targeting than your audience settings.'],
        ['t' => 'Minimum 12 ads.',                             'd' => "Andromeda rewards creative diversity. One or two ads won't cut it. Build 12 unique ads with different ideas before you launch."],
        ['t' => 'Each ad must be completely unique.',          'd' => "You can't just change the hook on the same video anymore. Completely new creative. Different idea, different angle."],
        ['t' => 'The 90/10 spend split is normal.',            'd' => "Andromeda will put 90% of budget on 1-2 ads it thinks will win. Leave the others running — they'll often find small niche audiences at very low cost per result."],
        ['t' => 'Advantage+ is your friend now.',              'd' => "It wasn't 2 years ago. It is now. Let it do the audience matching. Focus your energy on the creative."],
        ['t' => 'Turn off all AI creative enhancements.',      'd' => 'Optimised Creative Text, Relevant Comments, Related Media, AI Image Generation — turn them all off. Meta uses these to test features on your budget. Until proven, they waste spend.'],
    ];

    // Concrete Ads Manager walkthrough. Meta renames things regularly — the
    // labels below are what the settings are called at time of writing.
    $campaignSetup = [
        ['group' => 'CAMPAIGN LEVEL', 'items' => [
            'Objective set to <strong class="text-gray-200">Leads</strong> — not Traffic, not Engagement',
            'Campaign named so you can find it later (offer + month)',
            'Special ad categories: none — unless you\'re in credit, employment, housing, social issues',
            'A/B test: off',
            'Advantage campaign budget: on if running one ad set, off if you\'re splitting cold and warm',
        ]],
        ['group' => 'AD SET LEVEL', 'items' => [
            'Conversion location: <strong class="text-gray-200">Website</strong>',
            'Performance goal: <strong class="text-gray-200">Maximise number of conversions</strong>',
            'Conversion event: <strong class="text-gray-200">Lead</strong> — the event that fires only on qualifying form completions',
            'Dataset / Pixel selected, and showing as Active',
            'Daily budget matches the number you modelled in the Forecasting section',
            'Start date set — schedule it rather than launching mid-afternoon',
            'Advantage+ audience: on. Cold, no detailed targeting stacked on top',
            'Location and age pulled from your Customer Avatar section',
            'Placements: Advantage+ placements (leave the default)',
        ]],
        ['group' => 'AD LEVEL', 'items' => [
            'All 12 ads uploaded — each one a genuinely different creative, not a re-hooked cut of the same video',
            'Captions burnt into every video',
            'Primary text and headline written per ad, following the Rule of One',
            'Website URL points at your landing page (add UTMs now if you use them)',
            'Call to action button: <strong class="text-gray-200">Learn More</strong>',
            'Turn OFF — Optimised Creative Text / text improvements',
            'Turn OFF — Relevant Comments',
            'Turn OFF — Related Media and catalogue additions',
            'Turn OFF — AI image generation and image expansion',
        ]],
        ['group' => 'BEFORE YOU HIT PUBLISH', 'items' => [
            'Walk the whole funnel yourself: ad preview → landing page → form → booking → thank you page',
            'Lead event confirmed firing in Events Manager → Test Events',
            'Schedule event confirmed firing on the booking confirmation page',
            'Target cost per lead and cost per acquisition written down from your forecast',
            'Review date put in the calendar 7-14 days out — not tomorrow',
        ]],
    ];

    $audiences = [
        ['a' => 'All website visitors (180 days)',        'b' => "Retargeting anyone who's hit your funnel", 'n' => 'Broadest warm audience. Use for social proof and skepticism-addressing ads.'],
        ['a' => 'IG profile engagers (365 days)',         'b' => "People who've seen your organic content",  'n' => 'Higher trust already. Works well with direct offers.'],
        ['a' => 'Facebook page engagers (365 days)',      'b' => 'Same as above for FB',                     'n' => 'Combine with IG into one warm ad set.'],
        ['a' => 'Video viewers 10+ seconds (180 days)',   'b' => 'People who actually watched your ads',     'n' => 'Niche but high quality. Good for building out your warm pool early on.'],
        ['a' => 'Customer list (email upload)',           'b' => 'Lookalike source or re-engagement',        'n' => 'Match rate is often low. Need 5k+ for a useful lookalike.'],
    ];

    $mindset = [
        ['t' => "Think about where they'd be if you didn't close them.", 'd' => "If your service genuinely helps people, failing to close is a disservice to them. It's not about the transaction."],
        ['t' => 'Therapist, not consultant.',                            'd' => "Ask questions. Let them talk. The more they say out loud, the more they commit to the identity of someone who needs to fix this. Don't give answers — ask why."],
        ['t' => 'Process goals, not outcome goals.',                     'd' => 'Focus on: given what they just said, what is the best next question to ask?'],
        ['t' => "Don't win the argument and lose the sale.",             'd' => 'You can be logically right and still not close. Emotions make the decision. Logic justifies it after.'],
    ];

    $callStages = [
        ['t' => 'OPEN',     'time' => '30 sec',     'd' => 'Set the agenda before anything else. Tell them exactly what will happen in the call — questions, walkthrough, numbers, decision. Gets them out of fight-or-flight and into listening mode.'],
        ['t' => 'DISCOVER', 'time' => '10-15 min',  'd' => "Ask one question, then shut up. 'Give me some context — what's been happening and what made you book this?' You're a therapist here, not a consultant."],
        ['t' => 'RECAP',    'time' => '30-60 sec',  'd' => "Mirror back the most painful things they said, word for word. Don't add to it. Don't soften it. This is when the emotion peaks — you're giving them permission to feel the full weight of the problem."],
        ['t' => 'PITCH',    'time' => '10-15 min',  'd' => "Walk through your two pillars. For each one: what it is, why other solutions failed, why yours is different. After each section, ask a tie-down: 'Does that make sense? Could you see yourself using that?'"],
        ['t' => 'CLOSE',    'time' => '2-5 min',    'd' => "Always two options, both a yes. 'We can do this as one payment at \$X, or split over 3 months at \$Y/month. Of the two, which suits you better?' Never open-ended. Never ask if they want to proceed."],
    ];

    $bottlenecks = [
        ['t' => 'Link CTR &lt; 1%',              'd' => "Your messaging isn't landing. Change the first line of your ads. Try different ideas from your avatar. Wrong person or wrong message."],
        ['t' => 'CTR &gt; 2% but poor opt-in',   'd' => 'Too curious. Your ad is attracting people who aren\'t expecting a service. Make the language more committed by implying what your service is in the hook.'],
        ['t' => 'Opt-in &lt; 5%',                'd' => 'Check headline (result + feeling formula), add a CTA above form, fix form structure (low to high psychological resistance), and physical resistance (is the form above the fold?).'],
        ['t' => 'Booking &lt; 30%',              'd' => 'Check calendar availability (too many gaps?). Check booking page language (add text like: last step). Chase the problem upstream — does the form CTA set the expectation that a booking comes next?'],
        ['t' => 'Show rate &lt; 65%',            'd' => 'Check thank you page message. Check that SMS reminders are set up. Are you getting replies to confirmation messages? Are you sending the VSL reminder? Are testimonials relevant to their industry?'],
        ['t' => 'Close rate &lt; 25%',           'd' => 'First check the sales process — are you consulting instead of asking questions? Are you doing tie-down questions in the pitch? ONLY THEN look at lead quality (language, ad messaging).'],
    ];

    $optimising = [
        ['t' => 'Use Performance + Clicks view.',             'd' => 'Shows Link CTR and cost per result together — the only metrics that matter at ad level.'],
        ['t' => 'Sort by amount spent high to low.',          'd' => 'Look at your biggest spenders first. These are eating your budget and need to earn it.'],
        ['t' => 'Kill the outliers — high spend, no results.', 'd' => 'If an ad has spent 2-3x your target cost per result with no conversions, pause it.'],
        ['t' => 'Low spend + low cost per result = leave it.', 'd' => "These small pocket audiences are finding niche segments. They'll spend slowly but efficiently. Don't touch them."],
        ['t' => 'Find your winners, then find adjacent ideas.', 'd' => 'Take the ideas from your winning ads, and find adjacent ideas to create more ads.'],
        ['t' => 'Watch frequency on cold audiences.',         'd' => "Frequency above 2 on cold = they've seen it too many times. Dial the budget back. Make new ads."],
        ['t' => 'Review every 7-14 days.',                    'd' => 'Not daily. Not hourly. Daily checking just creates anxiety and bad decisions.'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Meta Ads Workbook — Build a Lead System That Actually Converts | edits by DEVIXX</title>
    <meta name="description" content="An interactive workbook for service businesses running Meta ads: forecasting, customer avatar, messaging, landing pages, ad creative, VSLs, campaign setup, sales calls and optimisation. Your answers save as you type.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* This page is a form-heavy tool — the site-wide custom cursor is
           disabled here so text fields behave normally. */
        body, * { cursor: auto !important; }

        /* Fixed backdrop. Full strength behind the intro, dimmed once the
           workbook opens so the form content stays readable. */
        #wb-bg {
            position: fixed;
            inset: 0;
            z-index: -2;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url('{{ asset('images/site-bg.jpg') }}');
            background-image: -webkit-image-set(url('{{ asset('images/site-bg.webp') }}') type('image/webp'), url('{{ asset('images/site-bg.jpg') }}') type('image/jpeg'));
            background-image: image-set(url('{{ asset('images/site-bg.webp') }}') type('image/webp'), url('{{ asset('images/site-bg.jpg') }}') type('image/jpeg'));
            transition: opacity .8s ease;
        }

        #wb-veil {
            position: fixed;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(115% 75% at 50% 8%, rgba(0,0,0,0) 0%, rgba(0,0,0,.35) 52%, rgba(0,0,0,.78) 100%),
                linear-gradient(180deg, rgba(0,0,0,.15) 0%, rgba(0,0,0,.5) 100%);
            transition: opacity .8s ease;
        }

        body.wb-active #wb-bg   { opacity: .20; }
        body.wb-active #wb-veil { opacity: .85; }

        .wb-mono { font-family: ui-monospace, SFMono-Regular, Menlo, monospace; }

        .wb-field {
            width: 100%;
            background: #0a0a0a;
            border: 1px solid #1e1e1e;
            border-radius: 7px;
            color: #e8e8e8;
            padding: 10px 12px;
            font-size: 13px;
            font-family: inherit;
            resize: vertical;
            box-sizing: border-box;
            outline: none;
            transition: border-color .15s;
        }
        .wb-field:focus { border-color: #9333EA; }
        .wb-field::placeholder { color: #4b4b4b; }

        .wb-num {
            width: 68px;
            background: transparent;
            border: none;
            outline: none;
            font-weight: 600;
            font-size: 13px;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            padding: 6px 8px;
        }
        .wb-num::-webkit-outer-spin-button,
        .wb-num::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .wb-num { -moz-appearance: textfield; }

        .wb-panel { display: none; }
        .wb-panel.is-active { display: block; }

        .wb-navitem.is-active {
            background: rgba(147,51,234,.12);
            border-left-color: #9333EA;
            color: #fff;
        }

        /* Sidebar scroll on desktop */
        @media (min-width: 1024px) {
            .wb-sidebar { position: sticky; top: 96px; max-height: calc(100vh - 120px); overflow-y: auto; }
            .wb-sidebar::-webkit-scrollbar { width: 6px; }
            .wb-sidebar::-webkit-scrollbar-thumb { background: #222; border-radius: 3px; }
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden bg-black">

    <div id="wb-bg" aria-hidden="true"></div>
    <div id="wb-veil" aria-hidden="true"></div>

    {{-- ========== NAVBAR ========== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 pt-4">
        <div class="max-w-5xl mx-4 md:mx-auto flex items-center justify-between px-6 md:px-8 py-1 rounded-full border border-white/[0.06]" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <a href="/" class="block shrink-0">
                <img src="{{ asset('images/logomain.png') }}" alt="edits by DEVIXX" class="h-9 md:h-10 w-auto">
            </a>

            <div class="hidden md:flex items-center gap-9">
                <a href="/#services" class="text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Services</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#projects" class="text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Projects</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#testimonials" class="text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Testimonials</a>
                <span class="w-px h-4 bg-white/15"></span>
                <a href="/#contact" class="text-[15px] text-gray-300 hover:text-white transition-colors duration-200 font-medium">Contact</a>
            </div>

            <a href="/#contact" class="hidden md:inline-flex items-center px-4 py-[10px] rounded-full text-white text-[14px] font-medium transition-all duration-300 hover:opacity-90 shrink-0" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
                Get in Touch
            </a>

            <button id="mobile-toggle" class="md:hidden text-white" aria-label="Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mx-4 mt-2 rounded-2xl border border-white/[0.06] overflow-hidden" style="background: rgba(100, 100, 120, 0.25); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
            <div class="px-6 py-5 flex flex-col gap-4">
                <a href="/#services" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Services</a>
                <a href="/#projects" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Projects</a>
                <a href="/#testimonials" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Testimonials</a>
                <a href="/#contact" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Contact</a>
            </div>
        </div>
    </nav>

    {{-- ========== INTRO ========== --}}
    <section id="wb-intro" class="min-h-screen flex items-center justify-center px-6 pt-32 pb-20">
        <div class="max-w-2xl w-full text-center">
            <span class="wb-mono text-[11px] tracking-[0.2em] text-primary">EDITS BY DEVIXX</span>
            <h1 class="mt-4 text-4xl md:text-6xl font-bold text-white leading-[1.05]" style="font-family: Georgia, serif;">
                The Meta Ads Workbook
            </h1>
            <p class="mt-6 text-gray-400 text-[15px] leading-relaxed">
                A complete build-along for service businesses running Meta ads — strategy, funnel, creative,
                campaign setup, sales and optimisation. Work through each part in order: fill in your answers,
                tick the checklists, and build your system as you go.
            </p>

            <div class="mt-8 rounded-2xl border border-surface-border p-5 text-left" style="background:#0a0a0a;">
                <div class="text-white text-sm font-semibold">Your answers save to this browser</div>
                <p class="mt-2 text-gray-500 text-[13px] leading-relaxed">
                    Everything you type is automatically saved to this device. If you clear your browser data,
                    switch browsers, or open this on a different device, your answers won't carry over. For now,
                    this browser is your save file — so stick to it.
                </p>
            </div>

            <button id="wb-start" class="mt-8 inline-flex items-center justify-center px-8 py-4 rounded-full text-white text-[15px] font-semibold transition-all duration-300 hover:opacity-90" style="background: linear-gradient(90deg, #9333EA 0%, #9333EA 30%, #4C1D95 100%);">
                <span id="wb-start-label">Start Workbook</span>
            </button>

            <p id="wb-resume-note" class="mt-4 text-[13px] hidden" style="color:#00B89C;">
                ✓ Saved progress found — picking up where you left off
            </p>
        </div>
    </section>

    {{-- ========== WORKBOOK ========== --}}
    <div id="wb-app" class="hidden pt-28 pb-24 px-4 md:px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-6">

            {{-- Sidebar --}}
            <aside class="wb-sidebar rounded-2xl border border-surface-border py-3" style="background:#0a0a0a;">
                <div class="px-4 pb-3 mb-2 border-b border-surface-border">
                    <div class="wb-mono text-[10px] tracking-[0.18em] text-primary">WORKBOOK</div>
                    <div class="text-gray-600 text-[11px] mt-1">14 sections</div>
                </div>
                <nav class="flex lg:flex-col gap-1 overflow-x-auto lg:overflow-visible px-2">
                    @foreach ($sections as $i => $s)
                        <button type="button"
                                class="wb-navitem shrink-0 text-left px-3 py-2 rounded-md text-[13px] text-gray-400 hover:text-white hover:bg-white/[0.04] transition-colors border-l-2 border-transparent {{ $i === 0 ? 'is-active' : '' }}"
                                data-nav="{{ $s['id'] }}">
                            <span class="wb-mono text-[10px] text-gray-600 mr-2">{{ sprintf('%02d', $i + 1) }}</span>{{ $s['label'] }}
                        </button>
                    @endforeach
                </nav>
                <div class="px-4 pt-3 mt-2 border-t border-surface-border flex flex-col gap-2">
                    <a href="/#contact" class="text-center text-[12px] py-2 rounded-md border border-primary/40 text-primary hover:bg-primary/10 transition-colors">Need more help? →</a>
                    <a href="/" class="text-center text-[12px] py-2 text-gray-600 hover:text-gray-300 transition-colors">← Back to home</a>
                </div>
            </aside>

            {{-- Panels --}}
            <main class="min-w-0">
                @include('lead-magnets.partials.meta-ads-workbook-body')
            </main>
        </div>
    </div>

    {{-- ========== FOOTER ========== --}}
    <footer class="relative border-t border-surface-border">
        <div class="py-8" style="background: rgba(0,0,0,0.5);">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="/"><img src="{{ asset('images/logomain.png') }}" alt="edits by DEVIXX" class="h-8 w-auto"></a>
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6">
                        <a href="/#services" class="text-sm text-gray-500 hover:text-white transition-colors">Services</a>
                        <a href="/#testimonials" class="text-sm text-gray-500 hover:text-white transition-colors">Testimonials</a>
                        <a href="/#case-studies" class="text-sm text-gray-500 hover:text-white transition-colors">Case Studies</a>
                        <a href="/#contact" class="text-sm text-gray-500 hover:text-white transition-colors">Contact Us</a>
                    </div>
                </div>
                <div class="text-center mt-6 pt-6 border-t border-surface-border">
                    <p class="text-sm text-gray-600">&copy; {{ date('Y') }} edits by DEVIXX. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
    (function () {
        'use strict';

        var KEY = 'devixx_maw_answers';
        var answers = {};
        try { answers = JSON.parse(localStorage.getItem(KEY) || '{}'); } catch (e) { answers = {}; }

        var hasProgress = Object.keys(answers).length > 0;

        function save() {
            try { localStorage.setItem(KEY, JSON.stringify(answers)); } catch (e) {}
        }

        // ---- Intro ----
        if (hasProgress) {
            document.getElementById('wb-start-label').textContent = 'Continue Workbook';
            document.getElementById('wb-resume-note').classList.remove('hidden');
        }
        document.getElementById('wb-start').addEventListener('click', function () {
            document.getElementById('wb-intro').classList.add('hidden');
            document.getElementById('wb-app').classList.remove('hidden');
            document.body.classList.add('wb-active');
            window.scrollTo(0, 0);
        });

        // ---- Section nav ----
        var navItems = document.querySelectorAll('[data-nav]');
        var panels = document.querySelectorAll('[data-panel]');
        function show(id) {
            panels.forEach(function (p) { p.classList.toggle('is-active', p.dataset.panel === id); });
            navItems.forEach(function (n) { n.classList.toggle('is-active', n.dataset.nav === id); });
            answers.__section = id;
            save();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        navItems.forEach(function (n) {
            n.addEventListener('click', function () { show(n.dataset.nav); });
        });
        document.querySelectorAll('[data-goto]').forEach(function (b) {
            b.addEventListener('click', function () { show(b.dataset.goto); });
        });

        // ---- Text fields ----
        document.querySelectorAll('[data-wb]').forEach(function (el) {
            var id = el.dataset.wb;
            if (answers[id] !== undefined) el.value = answers[id];
            el.addEventListener('input', function () { answers[id] = el.value; save(); });
        });

        // ---- Checkboxes ----
        document.querySelectorAll('[data-wb-check]').forEach(function (el) {
            var id = el.dataset.wbCheck;
            var box = el.querySelector('[data-box]');
            function paint() {
                var on = !!answers[id];
                box.style.borderColor = on ? '#00B89C' : '#555';
                box.style.background = on ? '#00B89C' : 'transparent';
                box.querySelector('svg').style.opacity = on ? '1' : '0';
            }
            paint();
            el.addEventListener('click', function () { answers[id] = !answers[id]; save(); paint(); });
        });

        // ---- Choice cards (awareness, funnel mode, VSL type) ----
        document.querySelectorAll('[data-wb-choice]').forEach(function (group) {
            var id = group.dataset.wbChoice;
            var opts = group.querySelectorAll('[data-val]');
            var accent = group.dataset.accent || '#00B89C';
            function paint() {
                var cur = answers[id];
                opts.forEach(function (o) {
                    var on = o.dataset.val === cur;
                    o.style.borderColor = on ? accent : '#333';
                    o.style.background = on ? 'rgba(0,184,156,.07)' : '#0d0d0d';
                });
                group.querySelectorAll('[data-reveal]').forEach(function (r) {
                    r.classList.toggle('hidden', r.dataset.reveal !== cur);
                });
            }
            opts.forEach(function (o) {
                o.addEventListener('click', function () {
                    answers[id] = o.dataset.val; save(); paint();
                    if (id === 'fc_mode') calc();
                });
            });
            paint();
        });

        // ---- Forecaster ----
        var DEFAULTS = { budget: 50, price: 2500, cpm: 40, ctr: 1, optin: 7, booking: 30, show: 70, close: 30 };
        var BANDS = { cpm: [20, 80], ctr: [1, 2], optin: [5, 20], booking: [30, 50], show: [65, 80], close: [25, 45] };

        function val(k) {
            var v = parseFloat(answers['fc_' + k]);
            return isNaN(v) ? DEFAULTS[k] : v;
        }
        function band(k, v) {
            if (!BANDS[k]) return '#ccc';
            if (v < BANDS[k][0]) return '#ef4444';
            if (v > BANDS[k][1]) return '#D4A843';
            return '#00B89C';
        }
        function num(n, d) {
            d = d || 0;
            return n.toLocaleString(undefined, { maximumFractionDigits: d, minimumFractionDigits: d });
        }
        var money0 = function (n) { return '$' + num(n, 0); };
        var money2 = function (n) { return '$' + num(n, 2); };

        function calc() {
            var mode = answers.fc_mode || '2step';

            var budget = val('budget'), price = val('price'), cpm = val('cpm');
            var ctr = val('ctr') / 100, optin = val('optin') / 100;
            var booking = val('booking') / 100, show_ = val('show') / 100, close = val('close') / 100;

            var spendM = budget * 30.4;
            var spendA = budget * 365;
            var impM   = cpm > 0 ? spendM / cpm * 1000 : 0;
            var clickM = impM * ctr;
            var leadM  = clickM * optin;
            var bookM  = mode === '2step' ? leadM * booking : leadM;
            var convM  = bookM * show_;
            var dealM  = convM * close;
            var revM   = dealM * price;

            var out = {
                spend:  [money0(spendM), money0(spendA), ''],
                imp:    [num(impM), num(impM * 12), ''],
                clicks: [num(clickM, 1), num(clickM * 12), clickM > 0 ? money2(spendM / clickM) : '—'],
                leads:  [num(leadM, 1), num(leadM * 12), leadM > 0 ? money2(spendM / leadM) : '—'],
                books:  [num(bookM, 1), num(bookM * 12), bookM > 0 ? money2(spendM / bookM) : '—'],
                convos: [num(convM, 1), num(convM * 12), ''],
                deals:  [num(dealM, 1), num(dealM * 12), dealM > 0 ? money2(spendM / dealM) : '—'],
                rev:    [money0(revM), money0(revM * 12), ''],
            };

            Object.keys(out).forEach(function (k) {
                ['m', 'a', 'c'].forEach(function (col, i) {
                    var cell = document.querySelector('[data-out="' + k + '-' + col + '"]');
                    if (cell) cell.textContent = out[k][i];
                });
            });

            var roas = spendM > 0 ? revM / spendM : 0;
            var roasEl = document.querySelector('[data-out="roas"]');
            if (roasEl) roasEl.textContent = 'ROAS ' + roas.toFixed(1) + 'x';

            // Bookings row is meaningless in a 1-step funnel (lead == booking)
            var bookRow = document.querySelector('[data-row="books"]');
            if (bookRow) bookRow.style.opacity = mode === '2step' ? '1' : '0.45';
        }

        document.querySelectorAll('[data-fc]').forEach(function (el) {
            var k = el.dataset.fc;
            el.value = answers['fc_' + k] !== undefined ? answers['fc_' + k] : DEFAULTS[k];
            function apply() {
                var v = parseFloat(el.value);
                answers['fc_' + k] = isNaN(v) ? 0 : v;
                save();
                var c = band(k, val(k));
                el.style.color = c;
                el.closest('[data-fc-wrap]').style.borderColor = c + '55';
                el.closest('[data-fc-wrap]').querySelectorAll('[data-affix]').forEach(function (a) { a.style.color = c; });
                calc();
            }
            el.addEventListener('input', apply);
            apply();
        });

        if (!answers.fc_mode) { answers.fc_mode = '2step'; }
        calc();

        // ---- Restore last section ----
        if (answers.__section) show(answers.__section);

        // ---- Mobile menu ----
        var mt = document.getElementById('mobile-toggle');
        if (mt) mt.addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // ---- Navbar shrink ----
        window.addEventListener('scroll', function () {
            var nav = document.getElementById('navbar');
            if (window.scrollY > 20) nav.classList.add('pt-2');
            else nav.classList.remove('pt-2');
        });
    })();
    </script>
</body>
</html>
