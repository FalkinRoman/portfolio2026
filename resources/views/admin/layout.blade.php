<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Админка') — {{ config('app.name') }}</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-round.png') }}" sizes="any" />
  <link rel="preconnect" href="https://api.fontshare.com" crossorigin />
  <link href="https://api.fontshare.com/v2/css?f[]=geist-sans@400,500,600,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
  <style>
    .admin-wrap { max-width: 960px; margin: 0 auto; padding: 2rem 1.25rem 4rem; font-family: "Geist Sans", system-ui, sans-serif; }
    .admin-nav { display: flex; flex-wrap: wrap; gap: 0.75rem 1.25rem; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,.12); }
    .admin-nav a { color: rgba(255,255,255,.85); text-decoration: none; font-weight: 500; }
    .admin-nav a:hover { color: #fff; }
    .admin-nav form { margin-left: auto; }
    .admin-nav button { background: transparent; border: 1px solid rgba(255,255,255,.25); color: rgba(255,255,255,.85); padding: 0.4rem 0.85rem; border-radius: 10px; cursor: pointer; font: inherit; }
    .admin-nav button:hover { border-color: rgba(255,255,255,.45); color: #fff; }
    .admin-flash { background: rgba(34,197,94,.15); border: 1px solid rgba(34,197,94,.35); color: #bbf7d0; padding: 0.65rem 1rem; border-radius: 10px; margin-bottom: 1.25rem; }
    .admin-card { background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
    .admin-card h1, .admin-card h2 { margin: 0 0 1rem; font-size: 1.25rem; font-weight: 600; color: #fff; }
    .admin-field { margin-bottom: 1rem; }
    .admin-field label { display: block; font-size: 0.8rem; color: rgba(255,255,255,.55); margin-bottom: 0.35rem; }
    .admin-field input[type=text], .admin-field input[type=email], .admin-field input[type=url], .admin-field input[type=number], .admin-field textarea, .admin-field input[type=file], .admin-field input[type=password] {
      width: 100%; max-width: 100%; box-sizing: border-box; background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.15); border-radius: 10px; padding: 0.55rem 0.75rem; color: #fff; font: inherit;
    }
    .admin-field textarea { min-height: 100px; resize: vertical; }
    .admin-field .error { color: #fca5a5; font-size: 0.8rem; margin-top: 0.25rem; }
    .admin-field__hint {
      font-size: 0.8125rem;
      line-height: 1.45;
      color: rgba(210, 218, 238, 0.95);
      margin: 0.5rem 0 0;
      word-break: break-all;
    }
    /* Один размер превью, компактно */
    .admin-upload-preview {
      margin-top: 0.6rem;
      width: 88px;
      height: 88px;
      flex: 0 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,.2);
      background: rgba(0,0,0,.35);
      box-sizing: border-box;
      overflow: hidden;
    }
    .admin-upload-preview img {
      display: block;
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
      object-fit: contain;
      border: none;
      border-radius: 4px;
      background: transparent;
    }
    .admin-upload-preview--row {
      display: flex;
      flex-wrap: wrap;
      gap: 0.45rem;
      margin-top: 0.6rem;
      width: auto;
      height: auto;
      border: none;
      background: transparent;
      padding: 0;
      align-items: stretch;
    }
    .admin-upload-preview--row > img {
      width: 88px;
      height: 88px;
      max-width: 88px;
      max-height: 88px;
      object-fit: contain;
      margin: 0;
      border: 1px solid rgba(255,255,255,.2);
      border-radius: 8px;
      background: rgba(0,0,0,.35);
      box-sizing: border-box;
    }
    .admin-gallery-sort {
      margin-top: 0.6rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.55rem;
    }
    .admin-gallery-item {
      position: relative;
      width: 88px;
      height: 88px;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,.2);
      overflow: hidden;
      background: rgba(0,0,0,.35);
      cursor: grab;
    }
    .admin-gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .admin-gallery-item.is-dragging { opacity: .5; }
    .admin-gallery-item.is-removed {
      opacity: .45;
      outline: 2px solid rgba(239,68,68,.55);
      filter: grayscale(1);
    }
    .admin-gallery-item__remove {
      position: absolute;
      top: 4px;
      right: 4px;
      width: 20px;
      height: 20px;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,.35);
      background: rgba(8,10,16,.7);
      color: #fff;
      font-size: 12px;
      line-height: 1;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }
    .admin-gallery-item__drag {
      position: absolute;
      left: 4px;
      bottom: 4px;
      min-width: 20px;
      height: 20px;
      border-radius: 6px;
      background: rgba(8,10,16,.6);
      color: rgba(255,255,255,.92);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      pointer-events: none;
    }
    .admin-modal {
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      background: rgba(3, 5, 10, 0.72);
      z-index: 2000;
      padding: 1rem;
    }
    .admin-modal.is-open { display: flex; }
    .admin-modal__card {
      width: min(560px, calc(100vw - 2rem));
      background: #10131b;
      border: 1px solid rgba(255,255,255,.18);
      border-radius: 14px;
      padding: 1rem;
      box-shadow: 0 20px 50px rgba(0,0,0,.45);
    }
    .admin-modal__title {
      margin: 0 0 0.35rem;
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
    }
    .admin-modal__sub {
      margin: 0 0 0.75rem;
      color: rgba(220, 228, 245, .86);
      font-size: 0.84rem;
    }
    .admin-cropper {
      width: min(420px, 100%);
      margin: 0 auto;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,.16);
      background: #06070b;
    }
    .admin-cropper canvas {
      display: block;
      width: 100%;
      height: auto;
      touch-action: none;
      cursor: grab;
    }
    .admin-cropper canvas.is-dragging { cursor: grabbing; }
    .admin-cropper__controls {
      margin-top: 0.8rem;
      display: grid;
      gap: 0.45rem;
    }
    .admin-cropper__controls label {
      font-size: 0.78rem;
      color: rgba(210, 218, 238, 0.9);
    }
    .admin-cropper__controls input[type=range] { width: 100%; }
    .admin-modal__actions {
      margin-top: 0.9rem;
      display: flex;
      justify-content: flex-end;
      gap: 0.55rem;
      flex-wrap: wrap;
    }
    .admin-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1.25rem; }
    .btn-admin { display: inline-block; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; padding: 0.55rem 1.1rem; border-radius: 10px; font-weight: 600; cursor: pointer; font: inherit; text-decoration: none; }
    .btn-admin--ghost { background: transparent; border: 1px solid rgba(255,255,255,.25); color: rgba(255,255,255,.9); }
    .btn-admin--danger { background: rgba(239,68,68,.25); border: 1px solid rgba(239,68,68,.45); }
    .admin-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
    .admin-table th, .admin-table td { text-align: left; padding: 0.6rem 0.5rem; border-bottom: 1px solid rgba(255,255,255,.08); color: rgba(255,255,255,.88); }
    .admin-table th { color: rgba(255,255,255,.5); font-weight: 500; font-size: 0.75rem; text-transform: uppercase; letter-spacing: .04em; }
  </style>
</head>
<body class="page" style="min-height:100vh;background:#0a0a0c;">
  <div class="admin-wrap">
    <nav class="admin-nav" aria-label="Админка">
      <a href="{{ route('admin.projects.index') }}">Проекты</a>
      <a href="{{ route('admin.social.edit') }}">Соцсети / бот</a>
      <a href="{{ route('home') }}" target="_blank" rel="noopener">Сайт →</a>
      <form method="post" action="{{ route('logout') }}">@csrf<button type="submit">Выйти</button></form>
    </nav>
    @if(session('ok'))
      <div class="admin-flash" role="status">{{ session('ok') }}</div>
    @endif
    @yield('body')
  </div>
</body>
</html>
