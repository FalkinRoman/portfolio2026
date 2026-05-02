<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light dark">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('partials.seo')
  <link rel="preconnect" href="https://api.fontshare.com" crossorigin />
  <link href="https://api.fontshare.com/v2/css?f[]=geist-sans@400,500,600,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-round.png') }}" sizes="any" />
  <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon-round.png') }}" />
  @stack('head')
</head>
<body>
<div class="page page--case" id="top">
  @yield('content')
</div>
@include('partials.i18n_portfolio')
<script src="{{ asset('js/portfolio.js') }}" defer></script>
@stack('scripts')
</body>
</html>
