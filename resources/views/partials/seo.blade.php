@php
  $title = $seoTitle ?? config('portfolio.seo.site_title', config('app.name'));
  $desc = $seoDescription ?? config('portfolio.seo.meta_description', '');
  $canonical = url()->current();
  $og = $seoOgImage ?? asset(config('portfolio.seo.default_og_image'));
@endphp
<title>{{ $title }}</title>
<meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 320) }}">
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 300) }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $og }}">
<meta property="og:locale" content="ru_RU">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 200) }}">
