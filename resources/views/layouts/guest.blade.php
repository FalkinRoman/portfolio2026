<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Вход — {{ config('app.name', 'Портфолио') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-round.png') }}" sizes="any" />
    <link rel="preconnect" href="https://api.fontshare.com" crossorigin />
    <link href="https://api.fontshare.com/v2/css?f[]=geist-sans@400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
    <style>
        .auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; background: #0a0a0c; font-family: "Geist Sans", system-ui, sans-serif; }
        .auth-card { width: 100%; max-width: 400px; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 2rem 1.75rem; }
        .auth-card h1 { margin: 0 0 0.35rem; font-size: 1.35rem; color: #fff; font-weight: 600; }
        .auth-card p.lead { margin: 0 0 1.5rem; font-size: 0.9rem; color: rgba(255,255,255,.5); }
        .auth-field { margin-bottom: 1rem; }
        .auth-field label { display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: .06em; color: rgba(255,255,255,.45); margin-bottom: 0.4rem; }
        .auth-field input[type=email], .auth-field input[type=password] {
            width: 100%; box-sizing: border-box; background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.15); border-radius: 10px; padding: 0.65rem 0.85rem; color: #fff; font: inherit;
        }
        .auth-field input:focus { outline: none; border-color: rgba(99,102,241,.6); }
        .auth-remember { display: flex; align-items: center; gap: 0.5rem; margin: 0.5rem 0 1.25rem; font-size: 0.875rem; color: rgba(255,255,255,.65); }
        .auth-remember input { accent-color: #6366f1; }
        .auth-actions { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem; }
        .auth-actions a { color: #a5b4fc; font-size: 0.875rem; text-decoration: none; }
        .auth-actions a:hover { color: #c7d2fe; }
        .auth-submit { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; padding: 0.6rem 1.25rem; border-radius: 10px; font-weight: 600; cursor: pointer; font: inherit; }
        .auth-error { color: #fca5a5; font-size: 0.8rem; margin-top: 0.35rem; }
        .auth-status { background: rgba(34,197,94,.12); border: 1px solid rgba(34,197,94,.3); color: #bbf7d0; padding: 0.6rem 0.85rem; border-radius: 10px; margin-bottom: 1rem; font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
