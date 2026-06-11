<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Content Tool - Login</title>
<style>
  body{margin:0;background:#0f1115;color:#e8eaed;font:15px/1.55 -apple-system,Segoe UI,Roboto,sans-serif;display:grid;place-items:center;height:100vh}
  .card{background:#181b22;border:1px solid #2a2f3a;border-radius:12px;padding:28px;width:320px}
  h1{font-size:18px;margin:0 0 4px}.sub{color:#9aa3b2;font-size:13px;margin:0 0 18px}
  input{width:100%;background:#0d0f14;border:1px solid #2a2f3a;color:#e8eaed;border-radius:8px;padding:11px;font:14px inherit;box-sizing:border-box}
  button{width:100%;background:#4f8cff;color:#fff;border:0;border-radius:8px;padding:12px;font-weight:600;cursor:pointer;margin-top:12px}
  .err{color:#ff9b9b;font-size:13px;margin-top:10px}
</style>
</head>
<body>
<form class="card" method="post" action="{{ route('content-tool.login') }}">
  @csrf
  <h1>Content Tool</h1>
  <p class="sub">Internal tool. Staff only.</p>
  <input type="password" name="password" placeholder="Password" autofocus>
  <button type="submit">Enter</button>
  @if (!empty($error))
    <div class="err">{{ $error }}</div>
  @endif
</form>
</body>
</html>
