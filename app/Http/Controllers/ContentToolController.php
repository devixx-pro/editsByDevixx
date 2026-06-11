<?php

namespace App\Http\Controllers;

use App\Services\ContentGateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Internal Content Tool (multi-company).
 *
 *   /content-tool            -> login, then a company picker
 *   /content-tool/{company}  -> the gate tool scoped to one company (e.g. fuelcfo)
 *
 * Password-gated, noindex, never linked publicly and never added to the sitemap.
 * Adding a new company is just a new entry in ContentGateService::$brands.
 */
class ContentToolController extends Controller
{
    private const SESSION_KEY = 'content_tool_authed';

    public function __construct(private readonly ContentGateService $gate)
    {
    }

    /** Login screen (not authed) or the company picker (authed). */
    public function index(Request $request)
    {
        $view = $this->authed($request)
            ? view('content-tool.index', ['companies' => $this->gate->brands])
            : view('content-tool.login', ['error' => null]);

        return $this->noindex(response($view));
    }

    /** Handle the password form. */
    public function login(Request $request)
    {
        $expected = (string) config('services.content_gate.password');
        $given = (string) $request->input('password', '');

        if ($expected !== '' && hash_equals($expected, $given)) {
            $request->session()->put(self::SESSION_KEY, true);

            return redirect()->route('content-tool');
        }

        return $this->noindex(response(
            view('content-tool.login', ['error' => 'Wrong password.'])
        ));
    }

    /** Log out and clear the session flag. */
    public function logout(Request $request)
    {
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('content-tool');
    }

    /** The tool, scoped to one company. */
    public function company(Request $request, string $company)
    {
        if (! $this->authed($request)) {
            return redirect()->route('content-tool');
        }

        $brand = $this->gate->brands[$company] ?? abort(404);

        return $this->noindex(response(view('content-tool.company', [
            'company' => $company,
            'brand' => $brand,
        ])));
    }

    /** JSON API for a company. Brand is taken from the URL, not the request body. */
    public function api(Request $request, string $company): JsonResponse
    {
        if (! $this->authed($request)) {
            return response()->json(['ok' => false, 'error' => 'Not logged in.'], 401);
        }
        if (! isset($this->gate->brands[$company])) {
            return response()->json(['ok' => false, 'error' => 'Unknown company.'], 404);
        }

        $input = $request->all();
        $input['brand'] = $company; // URL is authoritative

        try {
            return response()->json($this->gate->process($input));
        } catch (Throwable $e) {
            // Surface the message with a 200 so the UI renders it inline.
            return response()->json(['ok' => false, 'error' => $e->getMessage()], 200);
        }
    }

    private function authed(Request $request): bool
    {
        return (bool) $request->session()->get(self::SESSION_KEY, false);
    }

    private function noindex($response)
    {
        return $response->header('X-Robots-Tag', 'noindex, nofollow');
    }
}
