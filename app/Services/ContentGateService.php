<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * FuelCFO Content Gate.
 *
 * Paste a hook -> AI draft -> deterministic gate -> 9-level AI verify -> auto-revise -> clean copy.
 * Internal staff tool. Ported from the single-file PHP handoff into a Laravel service.
 */
class ContentGateService
{
    public const CAPTION_LIMIT = 2200;   // hook excluded
    public const MAX_ITERATIONS = 3;     // draft -> gate -> revise loop cap

    /** @var array<string, array<string, string>> */
    public array $brands = [
        'fuelcfo' => [
            'label' => 'FuelCFO (gas station / c-store)',
            'audience' => 'US gas station and c-store owner-operators, 1-15 stores, $1M-$50M revenue per store. Experienced operators. Do not talk down.',
            'voice' => 'Direct, numbers-driven, operator-speak. Use fuel/c-store vocabulary in the first lines (jobber statement, wet stock variance, rack, OPIS/DTN, fleet card, COMDATA, MUDFLAP, interchange, EBT, lottery commission). Sound like an advisor who has read their P&L, not a textbook.',
            'cta' => "We built a 40-item Financial Audit Checklist we run on every gas station before we take them on. Comment 'AUDIT' and I'll send it to you.",
            'disclaimer' => 'This content is for educational purposes only. Every business is different. Before making any changes to your books, reach out to us for guidance specific to your situation.',
        ],
        'construction' => [
            'label' => 'Construction / service business (Fintruction)',
            'audience' => 'US construction and service business owners: GCs, specialty subcontractors, service/subscription firms, $500K-$15M revenue. Experienced operators who know their trade. Do not talk down.',
            'voice' => 'Trusted advisor who has seen their books. Knows pay apps, WIP schedules, retainage, liens, change orders. Short sentences for sharp points, longer for context. No padding, no diplomatic softening.',
            'cta' => '[SET CONSTRUCTION CTA - none provided yet]',
            'disclaimer' => 'This content is for educational purposes only. Every business is different. Before making any changes to your books, reach out to us for guidance specific to your situation.',
        ],
    ];

    /** @var string[] */
    public array $bannedTransitions = [
        "here's how it actually works",
        "here's where it breaks",
        "here's what most",
    ];

    /** @var string[] */
    public array $bannedClosers = [
        "that's the difference between running a business and reacting to one",
        'that number is the only one worth celebrating',
        'work smarter not harder',
        'work smarter, not harder',
    ];

    public function apiKeyReady(): bool
    {
        $key = trim((string) config('services.anthropic.key'));

        // Empty, the old sentinel, or a leftover placeholder (e.g. "sk-ant-...your-key...")
        // all count as "no key" so the tool degrades to mechanical-only instead of erroring.
        if ($key === '' || $key === 'PASTE-ANTHROPIC-KEY-HERE' || str_contains($key, '...')) {
            return false;
        }

        return str_starts_with($key, 'sk-ant-');
    }

    // ============================================================
    // PROMPT BUILDERS
    // ============================================================

    private function formatBrief(array $brand, string $cta, string $disclaimer): string
    {
        return "AUDIENCE: {$brand['audience']}\n\nVOICE: {$brand['voice']}\n\n"
            . "FORMAT: Hook (already written, do not change it) -> Description (body) -> THE FIX (3-5 lines of specific Monday-morning action) -> CTA -> Disclaimer.\n\n"
            . "CTA (use verbatim): {$cta}\n\nDISCLAIMER (use verbatim): {$disclaimer}";
    }

    public function generationPrompt(array $brand, string $hook, string $cta, string $disclaimer): string
    {
        $limit = self::CAPTION_LIMIT;

        return $this->formatBrief($brand, $cta, $disclaimer) . "\n\n"
            . "HARD RULES:\n"
            . "- NO em dashes anywhere. Use commas, periods, or parentheses.\n"
            . "- The Description plus THE FIX plus the CTA plus the Disclaimer, joined together, MUST be under {$limit} characters. The hook is NOT counted. Aim for ~150 characters of headroom.\n"
            . "- Every number in the hook must reappear and reconcile in the description. Show the arithmetic transparently (state the assumption, e.g. percent of volume on credit, so an operator running napkin math lands on your number).\n"
            . "- Do not state an annually-adjusted tax threshold without the current-year figure and an 'adjusts annually' note. If unsure of a figure or an IRC section, write [VERIFY: ...] instead of guessing.\n"
            . "- Any state-specific rule needs a 'rules vary by state, get professional guidance' caveat routed to the right professional (CPA, attorney, merchant-services advisor).\n"
            . "- The fix must name exactly what to do, in sequence, and who does it. If it needs a CPA or attorney, say so.\n\n"
            . "THE HOOK (write content that pays this off, do not alter it):\n\"\"\"\n{$hook}\n\"\"\"\n\n"
            . "Return ONLY valid JSON, no markdown fences:\n"
            . '{"description": "<the body, plain text, blank lines between paragraphs>", "fix": "<THE FIX lines, newline separated, NOT including the heading>"}';
    }

    public function revisionPrompt(array $brand, string $hook, string $description, string $fix, string $cta, string $disclaimer, array $fixes): string
    {
        $limit = self::CAPTION_LIMIT;
        $list = '';
        foreach ($fixes as $f) {
            $list .= '- ' . $f . "\n";
        }

        return $this->formatBrief($brand, $cta, $disclaimer) . "\n\n"
            . "You wrote this draft. A verifier flagged the problems below. Rewrite the Description and THE FIX to fix EVERY one of them. Keep everything that already passed. Same hard rules as before (no em dashes, caption under {$limit} chars with headroom, numbers reconcile and show arithmetic, no banned transitions/closers).\n\n"
            . "HOOK (unchanged):\n\"\"\"\n{$hook}\n\"\"\"\n\n"
            . "CURRENT DESCRIPTION:\n\"\"\"\n{$description}\n\"\"\"\n\nCURRENT FIX:\n\"\"\"\n{$fix}\n\"\"\"\n\n"
            . "PROBLEMS TO FIX:\n{$list}\n"
            . "Return ONLY valid JSON, no markdown fences:\n"
            . '{"description": "<rewritten body>", "fix": "<rewritten fix lines>"}';
    }

    public function verificationPrompt(string $hook, string $caption, string $codeFindings): string
    {
        $limit = self::CAPTION_LIMIT;

        return "You are a verification-only gate for educational finance content. Be brutally precise, catch what a CPA or attorney catches on first read. Do NOT rewrite; judge and explain.\n\n"
            . "A code layer already ran the mechanical checks. These results are AUTHORITATIVE, trust them over your own counting:\n"
            . $codeFindings . "\n\n"
            . "HOOK (lives on the visual overlay, excluded from the character count):\n\"\"\"\n{$hook}\n\"\"\"\n\n"
            . "CAPTION (description + fix + cta + disclaimer):\n\"\"\"\n{$caption}\n\"\"\"\n\n"
            . "Grade these 9 levels. Status is one of: pass, flag, fail, na.\n"
            . "1 Regulatory accuracy (IRC sections, rules correct; flag any [VERIFY] tags and anything you cannot confirm).\n"
            . "2 Adjusting thresholds (annually-adjusted dollar figures need current-year value + 'adjusts annually' note).\n"
            . "3 Defensibility (every benchmark/percentage sourced or labeled illustrative; single-case scenarios are fine if framed as one example).\n"
            . "4 Math (check every arithmetic claim, show the calculation; hook and body numbers must reconcile; respect the code's hook-number check).\n"
            . "5 State/jurisdictional (state-specific rules need a 'varies by state, get professional guidance' caveat with correct professional).\n"
            . "6 Hook respect (stands alone; names a hidden cost / unspoken problem / challenged assumption; discovery not lecture; not basics; respect the code's double-question result).\n"
            . "7 Fix actionability (specific enough to act Monday; sequence and owner named; names the professional if one is required).\n"
            . "8 AI voice (respect the code's em-dash and banned-phrase results; you judge stacked fragments and generic AI phrasing).\n"
            . "9 Length (use the code's character count; pass if under {$limit}).\n\n"
            . "For arithmetic and live tax figures, if you cannot be certain, use status 'flag' with a note to verify. Never assert a number you are not sure of.\n\n"
            . "Return ONLY valid JSON, no markdown fences:\n"
            . '{"levels":[{"n":1,"title":"Regulatory accuracy","status":"pass|flag|fail|na","note":"one line"} ... all 9 ...],'
            . '"required_fixes":["specific instruction for the writer", "..."],'
            . '"verdict":"clean|iterate|drop","summary":"one or two sentences"}';
    }

    // ============================================================
    // DETERMINISTIC GATE (pure code, 100% reliable)
    // ============================================================

    public function assembleCaption(string $description, string $fix, string $cta, string $disclaimer): string
    {
        $parts = [trim($description)];
        $f = trim($fix);
        if ($f !== '') {
            $parts[] = "THE FIX\n" . $f;
        }
        if (trim($cta) !== '') {
            $parts[] = trim($cta);
        }
        if (trim($disclaimer) !== '') {
            $parts[] = trim($disclaimer);
        }

        return implode("\n\n", $parts);
    }

    private function checkLength(string $caption): array
    {
        $n = mb_strlen($caption);

        return ['chars' => $n, 'limit' => self::CAPTION_LIMIT, 'headroom' => self::CAPTION_LIMIT - $n, 'pass' => $n <= self::CAPTION_LIMIT];
    }

    private function checkEmDash(string $text): array
    {
        $em = mb_strpos($text, "\u{2014}") !== false;
        $en = mb_strpos($text, "\u{2013}") !== false;

        return ['em_dash' => $em, 'en_dash' => $en, 'pass' => ! $em];
    }

    private function checkBanned(string $text): array
    {
        $hits = [];
        $lc = mb_strtolower($text);
        foreach (array_merge($this->bannedTransitions, $this->bannedClosers) as $phrase) {
            if (mb_strpos($lc, mb_strtolower($phrase)) !== false) {
                $hits[] = $phrase;
            }
        }
        if (preg_match('/the difference between .{1,60}? is /iu', $text)) {
            $hits[] = 'the difference between X and Y is Z (pattern)';
        }
        if (preg_match("/that('|’)s not a .{1,40}? problem\.?\s+that('|’)s a .{1,40}? problem/iu", $text)) {
            $hits[] = "that's not a X problem, that's a Y problem (pattern)";
        }

        return ['hits' => $hits, 'pass' => count($hits) === 0];
    }

    private function checkDoubleQuestion(string $hook): array
    {
        $q = mb_substr_count($hook, '?');
        $sentences = preg_split('/(?<=[.?!])\s+/u', trim($hook), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $opensQ = $sentences && mb_substr(rtrim($sentences[0]), -1) === '?';
        $closesQ = $sentences && mb_substr(rtrim((string) end($sentences)), -1) === '?';
        $bracket = $opensQ && $closesQ && $q >= 2;

        return ['question_marks' => $q, 'double_question_bracket' => $bracket, 'pass' => ! $bracket];
    }

    private function extractNumbers(string $text): array
    {
        $out = [];
        if (preg_match_all('/\$?\d[\d,]*(?:\.\d+)?\s?(?:%|¢|cents?|gallons?|\/yr|\/gal)?/iu', $text, $m)) {
            foreach ($m[0] as $tok) {
                $t = trim($tok);
                if (preg_match('/\d/', $t)) {
                    $out[mb_strtolower(preg_replace('/\s+/', ' ', $t))] = true;
                }
            }
        }

        return array_keys($out);
    }

    private function checkHookNumbers(string $hook, string $caption): array
    {
        $hookNums = $this->extractNumbers($hook);
        $body = mb_strtolower($caption);
        $missing = [];
        foreach ($hookNums as $num) {
            $core = trim($num);
            if ($core === '') {
                continue;
            }
            if (mb_strpos($body, $core) === false) {
                $missing[] = $num;
            }
        }

        return ['hook_numbers' => $hookNums, 'missing_in_body' => $missing, 'pass' => count($missing) === 0];
    }

    public function runCodeGate(string $hook, string $caption): array
    {
        return [
            'length' => $this->checkLength($caption),
            'em_dash' => $this->checkEmDash($caption),
            'banned' => $this->checkBanned($caption),
            'double_question' => $this->checkDoubleQuestion($hook),
            'hook_numbers' => $this->checkHookNumbers($hook, $caption),
        ];
    }

    public function codeFindingsText(array $g): string
    {
        $l = $g['length'];
        $lines = [];
        $lines[] = "LENGTH: {$l['chars']} chars (limit {$l['limit']}, headroom {$l['headroom']}) -> " . ($l['pass'] ? 'PASS' : 'FAIL, over limit');
        $lines[] = 'EM DASH present: ' . ($g['em_dash']['em_dash'] ? 'YES -> FAIL' : 'no -> pass');
        $lines[] = 'BANNED phrases: ' . (count($g['banned']['hits']) ? ('FAIL -> ' . implode('; ', $g['banned']['hits'])) : 'none -> pass');
        $lines[] = 'DOUBLE-QUESTION hook bracket: ' . ($g['double_question']['double_question_bracket'] ? 'YES -> flag' : 'no -> pass') . " ({$g['double_question']['question_marks']} question marks)";
        $lines[] = 'HOOK NUMBERS missing from body: ' . (count($g['hook_numbers']['missing_in_body']) ? ('FAIL -> ' . implode('; ', $g['hook_numbers']['missing_in_body'])) : 'none, all reconcile -> pass');

        return implode("\n", $lines);
    }

    public function codeBlockers(array $g): array
    {
        $b = [];
        if (! $g['length']['pass']) {
            $b[] = "Caption is {$g['length']['chars']} chars, " . (-$g['length']['headroom']) . ' over the ' . self::CAPTION_LIMIT . ' limit. Trim it.';
        }
        if (! $g['em_dash']['pass']) {
            $b[] = 'Remove the em dash(es). Use commas, periods, or parentheses.';
        }
        foreach ($g['banned']['hits'] as $h) {
            $b[] = "Remove banned phrase: \"$h\".";
        }
        foreach ($g['hook_numbers']['missing_in_body'] as $m) {
            $b[] = "Hook number \"$m\" does not appear/reconcile in the body. Make it reconcile.";
        }

        return $b;
    }

    // ============================================================
    // ANTHROPIC API CLIENT
    // ============================================================

    public function claudeCall(string $model, string $system, string $userMsg, int $maxTokens = 2500): string
    {
        if (! $this->apiKeyReady()) {
            throw new RuntimeException('No API key set. Set ANTHROPIC_API_KEY.');
        }

        $response = Http::timeout(180)
            ->withHeaders([
                'x-api-key' => (string) config('services.anthropic.key'),
                'anthropic-version' => (string) config('services.anthropic.version'),
                'content-type' => 'application/json',
            ])
            ->post('https://api.anthropic.com/v1/messages', [
                'model' => $model,
                'max_tokens' => $maxTokens,
                'system' => $system,
                'messages' => [['role' => 'user', 'content' => $userMsg]],
            ]);

        if ($response->failed()) {
            $msg = $response->json('error.message') ?? $response->body();
            throw new RuntimeException('Anthropic API error (HTTP ' . $response->status() . "): $msg");
        }

        return (string) ($response->json('content.0.text') ?? '');
    }

    public function parseJsonLoose(string $text): array
    {
        $t = trim($text);
        $t = preg_replace('/^```(?:json)?\s*/i', '', $t);
        $t = preg_replace('/\s*```$/', '', $t);
        $decoded = json_decode($t, true);
        if ($decoded !== null) {
            return $decoded;
        }
        $start = strpos($t, '{');
        $end = strrpos($t, '}');
        if ($start !== false && $end !== false && $end > $start) {
            $decoded = json_decode(substr($t, $start, $end - $start + 1), true);
            if ($decoded !== null) {
                return $decoded;
            }
        }
        throw new RuntimeException('Could not parse model JSON. Raw start: ' . mb_substr($t, 0, 180));
    }

    // ============================================================
    // ORCHESTRATOR
    // ============================================================

    /**
     * Run the draft -> gate -> verify -> revise loop. Returns the full payload
     * the front end expects (iterations + final).
     *
     * @param  array<string, mixed>  $input
     */
    public function process(array $input): array
    {
        $brandKey = $input['brand'] ?? 'fuelcfo';
        $mode = $input['mode'] ?? 'generate';
        $hook = trim((string) ($input['hook'] ?? ''));
        $brand = $this->brands[$brandKey] ?? null;

        if (! $brand) {
            throw new RuntimeException('Unknown brand.');
        }
        if ($hook === '') {
            throw new RuntimeException('Paste a hook first.');
        }

        $cta = trim((string) ($input['cta'] ?? '')) ?: $brand['cta'];
        $disclaimer = trim((string) ($input['disclaimer'] ?? '')) ?: $brand['disclaimer'];
        $description = trim((string) ($input['description'] ?? ''));
        $fix = trim((string) ($input['fix'] ?? ''));
        $iterations = [];

        if ($mode === 'generate') {
            if (! $this->apiKeyReady()) {
                throw new RuntimeException('Generate mode needs an API key.');
            }
            $gen = $this->parseJsonLoose($this->claudeCall(
                (string) config('services.anthropic.draft_model'),
                'You are an expert finance content writer for this brand.',
                $this->generationPrompt($brand, $hook, $cta, $disclaimer)
            ));
            $description = trim((string) ($gen['description'] ?? ''));
            $fix = trim((string) ($gen['fix'] ?? ''));
        }

        if ($description === '') {
            throw new RuntimeException('No description to verify.');
        }

        $final = null;
        for ($i = 1; $i <= self::MAX_ITERATIONS; $i++) {
            $caption = $this->assembleCaption($description, $fix, $cta, $disclaimer);
            $code = $this->runCodeGate($hook, $caption);
            $blockers = $this->codeBlockers($code);

            $aiGate = null;
            $aiFixes = [];
            $verdict = 'iterate';
            if ($this->apiKeyReady()) {
                $aiGate = $this->parseJsonLoose($this->claudeCall(
                    (string) config('services.anthropic.verify_model'),
                    'You are a precise verification gate. Output only JSON.',
                    $this->verificationPrompt($hook, $caption, $this->codeFindingsText($code)),
                    2000
                ));
                $aiFixes = $aiGate['required_fixes'] ?? [];
                $verdict = $aiGate['verdict'] ?? 'iterate';
            }
            $allFixes = array_values(array_unique(array_merge($blockers, $aiFixes)));
            $clean = (count($blockers) === 0) && ($verdict === 'clean');
            $iterations[] = [
                'round' => $i,
                'description' => $description,
                'fix' => $fix,
                'caption_chars' => $code['length']['chars'],
                'code' => $code,
                'ai_gate' => $aiGate,
                'blockers' => $blockers,
                'required_fixes' => $allFixes,
                'clean' => $clean,
            ];
            if ($clean || $i === self::MAX_ITERATIONS || ! $this->apiKeyReady()) {
                $final = end($iterations);
                break;
            }
            $rev = $this->parseJsonLoose($this->claudeCall(
                (string) config('services.anthropic.draft_model'),
                'You are an expert finance content writer revising your own draft to pass a strict gate.',
                $this->revisionPrompt($brand, $hook, $description, $fix, $cta, $disclaimer, $allFixes)
            ));
            $description = trim((string) ($rev['description'] ?? $description));
            $fix = trim((string) ($rev['fix'] ?? $fix));
        }

        return [
            'ok' => true,
            'brand' => $brandKey,
            'hook' => $hook,
            'cta' => $cta,
            'disclaimer' => $disclaimer,
            'iterations' => $iterations,
            'final' => $final,
            'api_used' => $this->apiKeyReady(),
        ];
    }
}
