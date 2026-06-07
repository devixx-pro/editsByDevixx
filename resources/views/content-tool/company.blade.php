<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="api-url" content="{{ route('content-tool.api', $company) }}">
<title>Content Tool - {{ $brand['label'] }}</title>
@verbatim
<style>
  :root{--bg:#0f1115;--panel:#181b22;--line:#2a2f3a;--ink:#e8eaed;--mut:#9aa3b2;--acc:#4f8cff;--ok:#2ecc71;--warn:#f4b740;--bad:#ff5d5d}
  *{box-sizing:border-box}
  body{margin:0;background:var(--bg);color:var(--ink);font:15px/1.55 -apple-system,Segoe UI,Roboto,sans-serif}
  header{padding:18px 24px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:12px;flex-wrap:wrap}
  header h1{font-size:18px;margin:0}
  header .sub{color:var(--mut);font-size:13px}
  header .nav{margin-left:auto;display:flex;gap:16px;align-items:center}
  header a{color:var(--mut);font-size:13px;text-decoration:none;cursor:pointer}
  header a:hover{color:var(--ink)}
  .wrap{max-width:1100px;margin:0 auto;padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:24px}
  @media(max-width:900px){.wrap{grid-template-columns:1fr}}
  .panel{background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:18px}
  label{display:block;font-size:12px;color:var(--mut);text-transform:uppercase;letter-spacing:.04em;margin:14px 0 6px}
  textarea,select,input{width:100%;background:#0d0f14;border:1px solid var(--line);color:var(--ink);border-radius:8px;padding:10px;font:14px/1.5 inherit;resize:vertical}
  textarea{min-height:96px}
  button{background:var(--acc);color:#fff;border:0;border-radius:8px;padding:12px 18px;font-weight:600;cursor:pointer;margin-top:16px}
  button.ghost{background:transparent;border:1px solid var(--line);color:var(--ink)}
  button:disabled{opacity:.5;cursor:not-allowed}
  .seg{display:flex;gap:8px;margin-top:6px}
  .seg button{margin:0;flex:1;background:transparent;border:1px solid var(--line);color:var(--mut);font-weight:500;padding:9px}
  .seg button.on{background:var(--acc);color:#fff;border-color:var(--acc)}
  h3{font-size:13px;text-transform:uppercase;letter-spacing:.05em;color:var(--mut);margin:0 0 10px}
  table{width:100%;border-collapse:collapse;font-size:14px}
  td{padding:7px 8px;border-bottom:1px solid var(--line);vertical-align:top}
  td.s{width:34px;text-align:center;font-size:16px}
  .note{color:var(--mut);font-size:13px}
  .final{white-space:pre-wrap;background:#0d0f14;border:1px solid var(--line);border-radius:8px;padding:14px;font-size:14px}
  .hookbox{white-space:pre-wrap;background:#0d0f14;border-left:3px solid var(--acc);border-radius:6px;padding:12px;margin-bottom:12px;font-size:14px}
  .meta{display:flex;gap:16px;flex-wrap:wrap;color:var(--mut);font-size:13px;margin-top:10px}
  .pill{padding:2px 9px;border-radius:99px;font-size:12px;font-weight:600}
  .pill.ok{background:#143d27;color:#7ce6a4}.pill.it{background:#3a3416;color:#f4dd8a}.pill.drop{background:#43181a;color:#ff9b9b}
  .spin{display:inline-block;width:14px;height:14px;border:2px solid #fff5;border-top-color:#fff;border-radius:50%;animation:s .8s linear infinite;vertical-align:-2px}
  @keyframes s{to{transform:rotate(360deg)}}
  .err{background:#43181a;border:1px solid #6b2326;color:#ff9b9b;padding:12px;border-radius:8px;white-space:pre-wrap}
  .copy{font-size:12px;padding:6px 10px;margin:0 0 0 8px}
</style>
@endverbatim
</head>
<body>
<header>
  <h1>Content Tool</h1>
  <span class="sub">{{ $brand['label'] }} &middot; hook -> draft -> 9-level verify -> clean copy</span>
  <div class="nav">
    <a href="{{ route('content-tool') }}">&larr; All companies</a>
    <a onclick="document.getElementById('logoutForm').submit()">Log out</a>
  </div>
  <form id="logoutForm" method="post" action="{{ route('content-tool.logout') }}" style="display:none">@csrf</form>
</header>
<div class="wrap">
  <div class="panel">
    <label>Mode</label>
    <div class="seg" id="mode">
      <button data-m="generate" class="on">Generate from hook</button>
      <button data-m="verify">Verify what I paste</button>
    </div>
    <label>Hook (visual overlay text)</label>
    <textarea id="hook" placeholder="Paste the hook here..."></textarea>
    <div id="verifyOnly" style="display:none">
      <label>Description</label>
      <textarea id="description" placeholder="Paste the description body..."></textarea>
      <label>The Fix</label>
      <textarea id="fix" placeholder="One action per line..."></textarea>
    </div>
    <label>CTA <span class="note">(blank = brand default)</span></label>
    <textarea id="cta" style="min-height:60px"></textarea>
    <label>Disclaimer <span class="note">(blank = brand default)</span></label>
    <textarea id="disclaimer" style="min-height:60px"></textarea>
    <button id="run">Draft + gate</button>
    <div id="status" style="margin-top:12px"></div>
  </div>
  <div class="panel" id="out">
    <h3>Output</h3>
    <p class="note">Results appear here. The mechanical gate is exact; regulatory, math, and live tax figures are flagged for you to confirm, never faked.</p>
  </div>
</div>
@verbatim
<script>
const $ = s => document.querySelector(s);
const API_URL = document.querySelector('meta[name="api-url"]').content;
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
let mode = 'generate';
$('#mode').addEventListener('click', e => {
  if (e.target.tagName !== 'BUTTON') return;
  mode = e.target.dataset.m;
  [...$('#mode').children].forEach(b => b.classList.toggle('on', b===e.target));
  $('#verifyOnly').style.display = mode === 'verify' ? 'block' : 'none';
  $('#run').textContent = mode === 'verify' ? 'Run the gate' : 'Draft + gate';
});
const EMO = {pass:'✅', flag:'⚠️', fail:'❌', na:'➖'};
async function run(){
  $('#status').innerHTML = '<span class="spin"></span> running' + (mode==='generate'?' draft + verify loop':' checks') + '…';
  $('#run').disabled = true; $('#out').innerHTML = '<h3>Output</h3><p class="note">Working…</p>';
  try{
    const r = await fetch(API_URL, {method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'},
      body: JSON.stringify({mode, hook:$('#hook').value, description:$('#description').value, fix:$('#fix').value, cta:$('#cta').value, disclaimer:$('#disclaimer').value})});
    const d = await r.json();
    if(!d.ok){ render_err(d.error); return; }
    render(d);
  }catch(e){ render_err(e.message); }
  finally{ $('#status').innerHTML=''; $('#run').disabled=false; }
}
$('#run').addEventListener('click', run);
function render_err(m){ $('#out').innerHTML = '<h3>Output</h3><div class="err">'+esc(m)+'</div>'; }
function esc(s){ return (s||'').replace(/[&<>]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;'}[c])); }
function render(d){
  const f = d.final; const ai = f.ai_gate;
  const verdict = ai ? ai.verdict : (f.clean ? 'clean':'iterate');
  const vpill = {clean:'ok', iterate:'it', drop:'drop'}[verdict] || 'it';
  const caption = [f.description, f.fix?('THE FIX\n'+f.fix):'', d.cta, d.disclaimer].filter(Boolean).join('\n\n');
  let h = '<h3>Final piece <span class="pill '+vpill+'">'+verdict+'</span></h3>';
  h += '<div class="hookbox"><b>HOOK</b>\n'+esc(d.hook)+'</div>';
  h += '<div class="final" id="cap">'+esc(caption)+'</div>';
  h += '<button class="ghost copy" onclick="navigator.clipboard.writeText(document.getElementById(\'cap\').innerText)">Copy caption</button>';
  h += '<div class="meta"><span>Caption: <b>'+f.caption_chars+'</b> / '+f.code.length.limit+' chars (headroom '+f.code.length.headroom+')</span>'
     + '<span>Rounds: <b>'+d.iterations.length+'</b></span>'
     + '<span>'+(d.api_used?'AI verify on':'mechanical-only (no key)')+'</span></div>';
  h += '<h3 style="margin-top:22px">9-level gate</h3>';
  if(ai && ai.levels){
    h += '<table>';
    ai.levels.sort((a,b)=>a.n-b.n).forEach(L=>{ h += '<tr><td class="s">'+(EMO[L.status]||'•')+'</td><td><b>'+L.n+'. '+esc(L.title)+'</b><div class="note">'+esc(L.note||'')+'</div></td></tr>'; });
    h += '</table>';
    if(ai.summary) h += '<p class="note" style="margin-top:10px"><b>Net:</b> '+esc(ai.summary)+'</p>';
  } else {
    const c = f.code;
    const row=(s,t,n)=>'<tr><td class="s">'+(s?'✅':'❌')+'</td><td><b>'+t+'</b><div class="note">'+esc(n)+'</div></td></tr>';
    h += '<table>'
      + row(c.length.pass,'Length', c.length.chars+' / '+c.length.limit+' chars')
      + row(c.em_dash.pass,'No em dash', c.em_dash.em_dash?'em dash present':'clean')
      + row(c.banned.pass,'No banned phrases', c.banned.hits.length?c.banned.hits.join('; '):'clean')
      + row(c.double_question.pass,'Hook not double-question', c.double_question.double_question_bracket?'opens and closes on a question':'clean')
      + row(c.hook_numbers.pass,'Hook numbers reconcile', c.hook_numbers.missing_in_body.length?('missing in body: '+c.hook_numbers.missing_in_body.join(', ')):'all hook numbers appear in body')
      + '</table><p class="note">Set ANTHROPIC_API_KEY for the regulatory, defensibility, math, hook-respect and fix-actionability levels.</p>';
  }
  if(f.required_fixes && f.required_fixes.length && verdict!=='clean'){
    h += '<h3 style="margin-top:20px">Still to address</h3><table>';
    f.required_fixes.forEach(x=> h+='<tr><td class="s">→</td><td>'+esc(x)+'</td></tr>');
    h += '</table>';
  }
  $('#out').innerHTML = h;
}
</script>
@endverbatim
</body>
</html>
