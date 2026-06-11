<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Content Tool</title>
<style>
  :root{--bg:#0f1115;--panel:#181b22;--line:#2a2f3a;--ink:#e8eaed;--mut:#9aa3b2;--acc:#4f8cff}
  *{box-sizing:border-box}
  body{margin:0;background:var(--bg);color:var(--ink);font:15px/1.55 -apple-system,Segoe UI,Roboto,sans-serif}
  header{padding:18px 24px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:12px}
  header h1{font-size:18px;margin:0}
  header .sub{color:var(--mut);font-size:13px}
  header .out{margin-left:auto;color:var(--mut);font-size:13px;text-decoration:none;cursor:pointer}
  .wrap{max-width:760px;margin:0 auto;padding:32px 24px}
  .lead{color:var(--mut);font-size:14px;margin:0 0 20px}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
  @media(max-width:640px){.grid{grid-template-columns:1fr}}
  a.card{display:block;text-decoration:none;color:var(--ink);background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:20px;transition:border-color .15s,transform .15s}
  a.card:hover{border-color:var(--acc);transform:translateY(-2px)}
  a.card h2{font-size:16px;margin:0 0 6px}
  a.card .key{color:var(--acc);font-size:13px;font-family:ui-monospace,SFMono-Regular,Menlo,monospace}
  a.card p{color:var(--mut);font-size:13px;margin:10px 0 0}
</style>
</head>
<body>
<header>
  <h1>Content Tool</h1>
  <span class="sub">pick a company to work on</span>
  <a class="out" onclick="document.getElementById('logoutForm').submit()">Log out</a>
  <form id="logoutForm" method="post" action="{{ route('content-tool.logout') }}" style="display:none">@csrf</form>
</header>
<div class="wrap">
  <p class="lead">Each company has its own brand voice, CTA, and gate. Choose one to draft and verify content.</p>
  <div class="grid">
    @foreach ($companies as $key => $company)
      <a class="card" href="{{ route('content-tool.company', $key) }}">
        <h2>{{ $company['label'] }}</h2>
        <span class="key">/content-tool/{{ $key }}</span>
        <p>{{ \Illuminate\Support\Str::limit($company['audience'], 110) }}</p>
      </a>
    @endforeach
  </div>
</div>
</body>
</html>
