@php
  $title = $seoTitle ?? __('site.seo.home_title');
  $desc = $seoDescription ?? __('site.seo.home_description');
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
<meta property="og:locale" content="{{ app()->isLocale('en') ? __('site.seo.og_locale_en') : __('site.seo.og_locale_ru') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 200) }}">
