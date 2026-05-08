@php
  $H = asset('assets/img/home');
  $carouselBase = app()->isLocale('ru') ? asset('assets/img/home/carousel-ru') : $H;
@endphp
    <canvas class="mouse-trace-canvas" aria-hidden="true"></canvas>
    <div class="hero-bg" aria-hidden="true">
      <img src="{{ $H }}/hero-bg.png" alt="" width="1440" height="900" />
    </div>

    <header class="site-header wrap">
      <div class="header-inner">
        <div class="brand">
          <div class="avatar">
            <img src="{{ asset('assets/img/main.png') }}" alt="" width="60" height="60" />
          </div>
          <div class="brand-text">
            <h1>{{ __('site.brand.name') }}</h1>
            <p class="brand-subline">
              <span class="brand-sub-wrap" aria-hidden="true">
                <span class="brand-sub-default">{{ __('site.brand.role_default') }}</span>
                <span class="brand-sub-hover brand-sub-hover--desktop">{{ __('site.brand.role_hover') }}</span>
                <span class="brand-sub-hover brand-sub-hover--mobile">{{ __('site.brand.role_hover_mobile') }}</span>
              </span>
            </p>
          </div>
        </div>
        <div class="header-aside">
          <div class="status">
            <div class="status-dot-wrap">
              <span class="status-dot-glow" aria-hidden="true"></span>
              <span class="status-dot" aria-hidden="true"></span>
            </div>
            <span>{{ __('site.header.slots') }}</span>
          </div>
          <span class="header-divider" aria-hidden="true"></span>
          <div class="lang-dropdown" data-lang-dropdown>
            <button type="button" class="lang-dropdown__trigger" id="langDropdownBtn" aria-expanded="false" aria-haspopup="menu" aria-controls="langDropdownMenu" title="{{ __('site.header.lang_title') }}">
              <span class="visually-hidden">{{ __('site.header.lang_choose') }}</span>
              <svg class="lang-dropdown__icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
              </svg>
            </button>
            <div class="lang-dropdown__menu" id="langDropdownMenu" role="menu" aria-labelledby="langDropdownBtn" aria-hidden="true">
              <a href="{{ route('locale.switch', 'ru') }}" class="lang-dropdown__item {{ app()->isLocale('ru') ? 'is-active' : '' }}" role="menuitem" lang="ru">Русский</a>
              <a href="{{ route('locale.switch', 'en') }}" class="lang-dropdown__item {{ app()->isLocale('en') ? 'is-active' : '' }}" role="menuitem" lang="en">English</a>
            </div>
          </div>
          <div class="socials">
            <a class="social" href="{{ $social->threads }}" @if($social->threads !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_threads') }}"><img src="{{ asset('assets/img/home/threads.svg') }}" alt="" width="24" height="24" /></a>
            <a class="social" href="{{ $social->instagram }}" @if($social->instagram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_ig') }}"><img src="{{ asset('assets/img/home/social-ig.svg') }}" alt="" width="24" height="24" /></a>
            <a class="social" href="{{ $social->linkedin }}" @if($social->linkedin !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_li') }}"><img src="{{ asset('assets/img/home/social-li.svg') }}" alt="" width="24" height="24" /></a>
          </div>
        </div>
      </div>
    </header>

    <main>
      <section class="hero wrap hero-intro">
        <div class="review-pill">
          <div class="stars" aria-hidden="true">
            @for ($i = 0; $i < 5; $i++)
            <img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
            @endfor
          </div>
          <span>{{ __('site.hero.review') }}</span>
        </div>
        <h2 class="hero-title">
          <span class="hero-title-line hero-title-line-1"><span class="hero-title-line__inner">{{ __('site.hero.title_l1') }}</span></span
          ><br class="br-desktop" /><br class="br-mobile" /><span class="hero-title-line hero-title-line-2"><span class="hero-title-line__inner">{{ __('site.hero.title_l2') }}</span></span
          ><br /><span class="hero-title-line hero-title-line-3"><span class="hero-title-line__inner">{{ __('site.hero.title_l3') }}</span></span>
        </h2>
        <p class="lead hero-sub">
          <span class="hero-sub-line hero-sub-line-1">
            <span class="hero-sub-line__inner">{!! __('site.hero.sub_l1_html') !!}</span>
          </span><br class="br-desktop" /><span class="hero-sub-line hero-sub-line-2">
            <span class="hero-sub-line__inner">{{ __('site.hero.sub_l2') }}</span>
          </span>
        </p>
        <button type="button" class="btn-primary hero-cta" aria-label="{{ __('site.hero.cta_aria') }}">
          <span class="btn-label" aria-hidden="true">
            <span class="btn-text btn-text-default">{{ __('site.hero.cta_default') }}</span>
            <span class="btn-text btn-text-hover">{{ __('site.hero.cta_hover') }}</span>
          </span>
        </button>

        <div class="carousel-strip{{ app()->isLocale('ru') ? ' carousel-strip--ratio-5-4' : '' }}">
          <div class="carousel-track" data-carousel>
            <div class="carousel-card"><img src="{{ $carouselBase }}/carousel-1.png" alt="Tamber" /></div>
            <div class="carousel-card"><img src="{{ $carouselBase }}/carousel-2.png" alt="Mobile UI" /></div>
            <div class="carousel-card"><img src="{{ $carouselBase }}/carousel-3.png" alt="LensRef" /></div>
            <div class="carousel-card"><img src="{{ $carouselBase }}/carousel-4.png" alt="Realione" /></div>
            <div class="carousel-card"><img src="{{ $carouselBase }}/carousel-5.png" alt="Solomaze" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $carouselBase }}/carousel-1.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $carouselBase }}/carousel-2.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $carouselBase }}/carousel-3.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $carouselBase }}/carousel-4.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $carouselBase }}/carousel-5.png" alt="" /></div>
          </div>
        </div>
      </section>
