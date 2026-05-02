@php
  $H = asset('assets/img/home');
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
            <h1>Фалькин Роман</h1>
            <p class="brand-subline">
              <span class="brand-sub-wrap" aria-hidden="true">
                <span class="brand-sub-default">Web&Mobile Developer</span>
                <span class="brand-sub-hover">Нажми для инфо обо мне</span>
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
            <span>2 свободных слота</span>
          </div>
          <span class="header-divider" aria-hidden="true"></span>
          <div class="lang-dropdown" data-lang-dropdown>
            <button type="button" class="lang-dropdown__trigger" id="langDropdownBtn" aria-expanded="false" aria-haspopup="menu" aria-controls="langDropdownMenu" title="Язык">
              <span class="visually-hidden">Выбор языка</span>
              <svg class="lang-dropdown__icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10" />
                <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
              </svg>
            </button>
            <div class="lang-dropdown__menu" id="langDropdownMenu" role="menu" aria-labelledby="langDropdownBtn" aria-hidden="true">
              <button type="button" class="lang-dropdown__item is-active" role="menuitem" data-lang="ru" lang="ru">Русский</button>
              <button type="button" class="lang-dropdown__item" role="menuitem" data-lang="en" lang="en">English</button>
            </div>
          </div>
          <div class="socials">
            <a class="social" href="{{ $social->threads }}" @if($social->threads !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="Threads"><img src="{{ asset('assets/img/home/threads.svg') }}" alt="" width="24" height="24" /></a>
            <a class="social" href="{{ $social->instagram }}" @if($social->instagram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="Инстаграм"><img src="{{ asset('assets/img/home/social-ig.svg') }}" alt="" width="24" height="24" /></a>
            <a class="social" href="{{ $social->linkedin }}" @if($social->linkedin !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="ЛинкедИн"><img src="{{ asset('assets/img/home/social-li.svg') }}" alt="" width="24" height="24" /></a>
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
          <span>100+ довольных клиентов</span>
        </div>
        <h2 class="hero-title">
          <span class="hero-title-line hero-title-line-1"><span class="hero-title-line__inner">Я создаю продукты</span></span
          ><br class="br-desktop" /><br class="br-mobile" /><span class="hero-title-line hero-title-line-2"><span class="hero-title-line__inner">что работают так же</span></span
          ><br /><span class="hero-title-line hero-title-line-3"><span class="hero-title-line__inner">так как вы</span></span>
        </h2>
        <p class="lead hero-sub">
          <span class="hero-sub-line hero-sub-line-1">
            <span class="hero-sub-line__inner">Создаю цифровые решения, которые вовлекают<br class="br-mobile" /> пользователей,</span>
          </span><br class="br-desktop" /><span class="hero-sub-line hero-sub-line-2">
            <span class="hero-sub-line__inner">и каждый экран решает задачу</span>
          </span>
        </p>
        <button type="button" class="btn-primary hero-cta" aria-label="Смотреть стоимость">
          <span class="btn-label" aria-hidden="true">
            <span class="btn-text btn-text-default">Смотреть стоимость</span>
            <span class="btn-text btn-text-hover">К оценке</span>
          </span>
        </button>

        <div class="carousel-strip">
          <div class="carousel-track" data-carousel">
            <div class="carousel-card"><img src="{{ $H }}/carousel-1.png" alt="Tamber" /></div>
            <div class="carousel-card"><img src="{{ $H }}/carousel-2.png" alt="Mobile UI" /></div>
            <div class="carousel-card"><img src="{{ $H }}/carousel-3.png" alt="LensRef" /></div>
            <div class="carousel-card"><img src="{{ $H }}/carousel-4.png" alt="Realione" /></div>
            <div class="carousel-card"><img src="{{ $H }}/carousel-5.png" alt="Solomaze" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $H }}/carousel-1.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $H }}/carousel-2.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $H }}/carousel-3.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $H }}/carousel-4.png" alt="" /></div>
            <div class="carousel-card" aria-hidden="true"><img src="{{ $H }}/carousel-5.png" alt="" /></div>
          </div>
        </div>
      </section>
