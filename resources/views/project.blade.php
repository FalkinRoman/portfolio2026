@extends('layouts.case')

@section('content')
    <canvas class="mouse-trace-canvas" aria-hidden="true"></canvas>

    <main class="case-main wrap case-main--no-header">
      <nav class="case-back reveal" aria-label="Навигация по кейсу">
        <a class="case-back__btn" href="{{ route('home') }}#projects">
          <span class="case-back__icon" aria-hidden="true">
            <img src="{{ asset('assets/img/case-growly/arrow.svg') }}" alt="" width="20" height="20" />
          </span>
          <span class="case-back__label">Назад к проектам</span>
        </a>
      </nav>

      <section class="case-hero reveal">
        <div class="case-hero__shell">
          <div class="case-hero__top">
            <div class="case-hero__ident">
              <div class="case-hero__logo">
                <img src="{{ $project->publicUrl($project->logo_image) ?? $project->publicUrl($project->card_image) }}" alt="" width="60" height="60" />
              </div>
              <div class="case-hero__titles">
                <h1 class="case-hero__name">{{ $project->name }}</h1>
                <p class="case-hero__tag">{{ $project->tagline }}</p>
              </div>
            </div>
            @if($project->live_url)
            <a class="btn-primary case-hero__cta" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">Посмотреть проект</a>
            @endif
          </div>
          @if($project->publicUrl($project->banner_image))
          <div class="case-banner">
            <img src="{{ $project->publicUrl($project->banner_image) }}" alt="{{ $project->name }} — интерфейс" width="680" height="486" loading="eager" />
          </div>
          @endif
        </div>
      </section>

      <section class="case-meta reveal" aria-label="Параметры проекта">
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-client.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">Клиент</p>
          <p class="case-meta-card__value">{{ $project->meta_client ?: '—' }}</p>
        </article>
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-service.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">Услуга</p>
          <p class="case-meta-card__value case-meta-card__value--twoline">{!! $project->meta_service ? nl2br(e($project->meta_service)) : '—' !!}</p>
        </article>
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-date.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">Дата</p>
          <p class="case-meta-card__value">{{ $project->meta_date ?: '—' }}</p>
        </article>
      </section>

      <section class="case-article reveal">
        <h2 class="case-article__title">Обзор проекта</h2>
        <div class="case-article__panel">
          @if($project->overview_p1)<p>{{ $project->overview_p1 }}</p>@endif
          @if($project->overview_p2)<p>{{ $project->overview_p2 }}</p>@endif
          @if($project->features && count($project->features))
          <h3 class="case-article__sub">Ключевые особенности</h3>
          <ul class="case-features">
            @foreach($project->features as $f)
            <li>{{ $f }}</li>
            @endforeach
          </ul>
          @endif
          @if($project->overview_p3)<p>{{ $project->overview_p3 }}</p>@endif
          @if($project->accent_line)
          <p class="case-article__accent">{{ $project->accent_line }}</p>
          @endif
        </div>
      </section>

      @if($project->gallery_images && count($project->gallery_images))
      <section class="case-gallery" aria-label="Галерея экранов">
        @foreach($project->gallery_images as $i => $path)
        <figure class="case-gallery__fig reveal">
          <img src="{{ $project->publicUrl($path) }}" alt="{{ $project->name }} — скрин {{ $i + 1 }}" width="680" height="486" loading="lazy" />
        </figure>
        @endforeach
      </section>
      @endif

      <p class="case-next reveal">
        <a href="{{ route('home') }}#projects">Все проекты →</a>
      </p>
    </main>

@include('partials.case_footer')
@endsection
