@extends('layouts.case')

@section('content')
    <canvas class="mouse-trace-canvas" aria-hidden="true"></canvas>

    <main class="case-main wrap case-main--no-header">
      <nav class="case-back reveal" aria-label="{{ __('site.case.back_aria') }}">
        <a class="case-back__btn" href="{{ route('home') }}#projects">
          <span class="case-back__icon" aria-hidden="true">
            <img src="{{ asset('assets/img/case-growly/arrow.svg') }}" alt="" width="20" height="20" />
          </span>
          <span class="case-back__label">{{ __('site.case.back') }}</span>
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
                <h1 class="case-hero__name">{{ $project->display('name') }}</h1>
                <p class="case-hero__tag">{{ $project->display('tagline') }}</p>
              </div>
            </div>
            @if($project->live_url)
            <a class="btn-primary case-hero__cta" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">{{ __('site.case.view_live') }}</a>
            @endif
          </div>
          @if($project->publicUrl($project->banner_image))
          <div class="case-banner">
            <img src="{{ $project->publicUrl($project->banner_image) }}" alt="{{ $project->display('name') }} — {{ __('site.case.banner_alt') }}" width="680" height="486" loading="eager" />
          </div>
          @endif
        </div>
      </section>

      <section class="case-meta reveal" aria-label="{{ __('site.case.meta_aria') }}">
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-client.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">{{ __('site.case.client') }}</p>
          <p class="case-meta-card__value">{{ $project->display('meta_client') ?: '—' }}</p>
        </article>
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-service.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">{{ __('site.case.service') }}</p>
          <p class="case-meta-card__value case-meta-card__value--twoline">{!! $project->display('meta_service') ? nl2br(e($project->display('meta_service'))) : '—' !!}</p>
        </article>
        <article class="case-meta-card">
          <div class="case-meta-card__icon">
            <img src="{{ asset('assets/img/case-growly/icon-date.svg') }}" alt="" width="30" height="30" />
          </div>
          <p class="case-meta-card__label">{{ __('site.case.date') }}</p>
          <p class="case-meta-card__value">{{ $project->display('meta_date') ?: '—' }}</p>
        </article>
      </section>

      <section class="case-article reveal">
        <h2 class="case-article__title">{{ __('site.case.overview_h') }}</h2>
        <div class="case-article__panel">
          @if($project->display('overview_p1'))<p>{{ $project->display('overview_p1') }}</p>@endif
          @if($project->display('overview_p2'))<p>{{ $project->display('overview_p2') }}</p>@endif
          @php($feats = $project->displayFeatures())
          @if(count($feats))
          <h3 class="case-article__sub">{{ __('site.case.features_h') }}</h3>
          <ul class="case-features">
            @foreach($feats as $f)
            <li>{{ $f }}</li>
            @endforeach
          </ul>
          @endif
          @if($project->display('overview_p3'))<p>{{ $project->display('overview_p3') }}</p>@endif
          @if($project->display('accent_line'))
          <p class="case-article__accent">{{ $project->display('accent_line') }}</p>
          @endif
        </div>
      </section>

      @if($project->gallery_images && count($project->gallery_images))
      <section class="case-gallery" aria-label="{{ __('site.case.gallery_aria') }}">
        @foreach($project->gallery_images as $i => $path)
        <figure class="case-gallery__fig reveal">
          <img src="{{ $project->publicUrl($path) }}" alt="{{ $project->display('name') }} — {{ __('site.case.screen') }} {{ $i + 1 }}" width="680" height="486" loading="lazy" />
        </figure>
        @endforeach
      </section>
      @endif

      <p class="case-next reveal">
        <a href="{{ route('home') }}#projects">{{ __('site.case.all_projects') }}</a>
      </p>
    </main>

@include('partials.case_footer')
@endsection
