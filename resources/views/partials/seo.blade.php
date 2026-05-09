@php
  $title = $seoTitle ?? __('site.seo.home_title');
  $desc = $seoDescription ?? __('site.seo.home_description');
  $canonical = url()->current();
  $ogPath = config('portfolio.seo.default_og_image');
  $og = $seoOgImage ?? asset($ogPath);
  $og = \Illuminate\Support\Str::of($og)->before('?')->toString();
  $ogLower = strtolower($ogPath);
  $ogMime = str_ends_with($ogLower, '.png')
      ? 'image/png'
      : (str_ends_with($ogLower, '.webp') ? 'image/webp' : 'image/jpeg');
  $ogW = (int) config('portfolio.seo.og_image_width', 1200);
  $ogH = (int) config('portfolio.seo.og_image_height', 630);
  $siteName = config('portfolio.seo.og_site_name', config('portfolio.seo.brand_name'));
  $localeMain = app()->isLocale('en') ? __('site.seo.og_locale_en') : __('site.seo.og_locale_ru');
  $localeAlt = app()->isLocale('en') ? __('site.seo.og_locale_ru') : __('site.seo.og_locale_en');
@endphp
<title>{{ $title }}</title>
<meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 320) }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ $canonical }}">
<meta name="author" content="{{ config('portfolio.seo.brand_name') }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 300) }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:locale" content="{{ $localeMain }}">
<meta property="og:locale:alternate" content="{{ $localeAlt }}">
<meta property="og:image" content="{{ $og }}">
<meta property="og:image:secure_url" content="{{ $og }}">
<meta property="og:image:type" content="{{ $ogMime }}">
<meta property="og:image:width" content="{{ $ogW }}">
<meta property="og:image:height" content="{{ $ogH }}">
<meta property="og:image:alt" content="{{ $title }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($desc), 200) }}">
<meta name="twitter:image" content="{{ $og }}">
