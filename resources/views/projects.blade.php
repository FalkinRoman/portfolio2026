@extends('layouts.site')

@section('content')
@php
  $kindLabels = [
    'all'    => app()->isLocale('en') ? 'All types'     : 'Все типы',
    'web'    => app()->isLocale('en') ? 'Web apps'      : 'Веб-приложения',
    'mobile' => app()->isLocale('en') ? 'Mobile apps'   : 'Мобильные приложения',
    'bot'    => app()->isLocale('en') ? 'Telegram bots' : 'Telegram-боты',
    'site'   => app()->isLocale('en') ? 'Websites'      : 'Сайты',
  ];
  $statusLabels = [
    'all'         => app()->isLocale('en') ? 'Any status'  : 'Любой статус',
    'in_progress' => app()->isLocale('en') ? 'In progress' : 'В разработке',
    'planned'     => app()->isLocale('en') ? 'Planned'     : 'Планирование',
    'released'    => app()->isLocale('en') ? 'Released'    : 'Релиз',
    'support'     => app()->isLocale('en') ? 'Support'     : 'Поддержка',
  ];
  $kindIcons  = ['web' => '🌐', 'mobile' => '📱', 'bot' => '🤖', 'site' => '🧩'];
  $statusTone = ['in_progress' => 'warning', 'planned' => 'muted', 'released' => 'ok', 'support' => 'accent'];

  $mainPhoto          = asset('assets/img/main.png');
  $totalProjects      = $projects->count();
  $liveProjects       = $projects->filter(fn ($p) => filled($p->live_url))->count();
  $inProgressProjects = 0;

  $projectMeta = $projects->mapWithKeys(function ($project) use ($kindIcons, $statusTone, &$inProgressProjects) {
      $service  = mb_strtolower((string) ($project->display('meta_service') ?? ''));
      $tagline  = mb_strtolower((string) ($project->display('tagline')      ?? ''));
      $name     = mb_strtolower((string) ($project->display('name')         ?? ''));
      $haystack = trim($service.' '.$tagline.' '.$name);

      $kind = 'web';
      if (str_contains($haystack, 'telegram') || str_contains($haystack, 'бот') || str_contains($haystack, 'bot')) {
          $kind = 'bot';
      } elseif (str_contains($haystack, 'mobile') || str_contains($haystack, 'ios') || str_contains($haystack, 'android') || str_contains($haystack, 'react native') || str_contains($haystack, 'моб')) {
          $kind = 'mobile';
      } elseif (str_contains($haystack, 'landing') || str_contains($haystack, 'сайт') || str_contains($haystack, 'corporate') || str_contains($haystack, 'лендинг')) {
          $kind = 'site';
      }

      $status = 'released';
      if (! filled($project->live_url)) {
          $status = (str_contains($haystack, 'mvp') || str_contains($haystack, 'prototype') || str_contains($haystack, 'прототип') || str_contains($haystack, 'концепт'))
              ? 'planned'
              : 'in_progress';
      } elseif (str_contains($haystack, 'support') || str_contains($haystack, 'поддерж')) {
          $status = 'support';
      }

      if ($status === 'in_progress') $inProgressProjects++;

      $progress = match ($status) {
          'planned'     => 22,
          'in_progress' => 68,
          'support'     => 95,
          default       => 100,
      };

      return [$project->id => [
          'kind'     => $kind,
          'status'   => $status,
          'icon'     => $kindIcons[$kind]       ?? '⚙️',
          'tone'     => $statusTone[$status]    ?? 'ok',
          'progress' => $progress,
      ]];
  });
@endphp

<canvas class="mouse-trace-canvas" aria-hidden="true"></canvas>
<div class="hero-bg" aria-hidden="true">
  <img src="{{ asset('assets/img/home/hero-bg.png') }}" alt="" width="1440" height="900" />
</div>

<main>
  <section class="section wrap reveal" id="projects-catalog">

    {{-- Section head --}}
    <div class="section-head pcat-head">
      <a class="pcat-back" href="{{ url('/') }}" aria-label="{{ app()->isLocale('en') ? 'Back to home' : 'Назад на главную' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        {{ app()->isLocale('en') ? 'Back to projects' : 'Назад к проектам' }}
      </a>
      <span class="chip">{{ __('site.projects_catalog.chip') }}</span>
      <h2 class="display-sm">{!! nl2br(e(__('site.projects_catalog.h2'))) !!}</h2>
      <p class="lead">{{ __('site.projects_catalog.lead') }}</p>
    </div>

    {{-- KPI stats --}}
    <div class="pcat-stats reveal-from-bottom">
      <div class="pcat-stat">
        <span class="pcat-stat__num">{{ $totalProjects }}</span>
        <span class="pcat-stat__label">{{ app()->isLocale('en') ? 'Projects' : 'Проектов' }}</span>
      </div>
      <span class="pcat-stat-sep" aria-hidden="true"></span>
      <div class="pcat-stat">
        <span class="pcat-stat__num">{{ $liveProjects }}</span>
        <span class="pcat-stat__label">{{ app()->isLocale('en') ? 'Live' : 'Живых' }}</span>
      </div>
      <span class="pcat-stat-sep" aria-hidden="true"></span>
      <div class="pcat-stat">
        <span class="pcat-stat__num">{{ $inProgressProjects }}</span>
        <span class="pcat-stat__label">{{ app()->isLocale('en') ? 'In dev' : 'В разработке' }}</span>
      </div>
    </div>

    {{-- Filters + search --}}
    <div class="pcat-filters reveal-from-bottom" data-projects-catalog>
      <label class="pcat-search-wrap" for="projectsSearch">
        <span class="visually-hidden">{{ __('site.projects_catalog.search_ph') }}</span>
        <svg class="pcat-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M16 16l4.5 4.5"/></svg>
        <input id="projectsSearch" class="pcat-search" type="search" placeholder="{{ __('site.projects_catalog.search_ph') }}" data-project-search />
      </label>
      <div class="pcat-filter-controls">
        <label class="pcat-filter-select-wrap">
          <span class="visually-hidden">{{ app()->isLocale('en') ? 'Device filter' : 'Фильтр по устройству' }}</span>
          <select class="pcat-filter-select" data-project-filter-select>
            @foreach($kindLabels as $kindKey => $kindLabel)
            <option value="{{ $kindKey }}">{{ $kindLabel }}</option>
            @endforeach
          </select>
        </label>
        <label class="pcat-filter-select-wrap">
          <span class="visually-hidden">{{ app()->isLocale('en') ? 'Implementation filter' : 'Фильтр по реализации' }}</span>
          <select class="pcat-filter-select" data-project-status-select>
            @foreach($statusLabels as $statusKey => $statusLabel)
            <option value="{{ $statusKey }}">{{ $statusLabel }}</option>
            @endforeach
          </select>
        </label>
      </div>
    </div>

    {{-- Project cards --}}
    <div data-project-list>
      @foreach($projects as $project)
        @php
          $meta       = $projectMeta[$project->id] ?? ['kind' => 'web', 'status' => 'released', 'icon' => '⚙️', 'tone' => 'ok', 'progress' => 100];
          $name       = (string) $project->display('name');
          $tag        = (string) ($project->display('tagline')      ?? '');
          $service    = (string) ($project->display('meta_service') ?? '');
          $searchText = mb_strtolower(trim($name.' '.$tag.' '.$service));
        @endphp
        @continue(!$project->publicUrl($project->card_image))
        <a class="project-card catalog-card reveal-from-bottom"
           href="{{ route('project.show', $project) }}"
           data-project-kind="{{ $meta['kind'] }}"
           data-project-status="{{ $meta['status'] }}"
           data-project-text="{{ $searchText }}">
          <img src="{{ $project->publicUrl($project->card_image) }}" alt="{{ $name }}" loading="lazy" />
          <div class="project-card__meta project-card__meta--{{ $meta['tone'] }}">
            <span>{{ $meta['icon'] }} {{ $kindLabels[$meta['kind']] ?? $meta['kind'] }}</span>
            <span>{{ $statusLabels[$meta['status']] ?? $meta['status'] }}</span>
          </div>
          <div class="project-chip">
            <span class="project-logo">
              @if($project->publicUrl($project->logo_image))
                <img src="{{ $project->publicUrl($project->logo_image) }}" alt="" />
              @else
                <img src="{{ $project->publicUrl($project->card_image) }}" alt="" />
              @endif
            </span>
            <span class="project-name-wrap">
              <span class="project-name">{{ $name }}</span>
              <span class="project-subline">{{ $service !== '' ? $service : $tag }}</span>
            </span>
          </div>
        </a>
      @endforeach
    </div>

    <p class="projects-catalog-empty" hidden data-project-empty>{{ __('site.projects_catalog.empty') }}</p>
  </section>
</main>

<nav class="bottom-dock" aria-label="{{ app()->isLocale('en') ? 'Page navigation' : 'Навигация' }}">
  <div class="bottom-dock__links pcat-dock-links">
    <a class="bottom-dock__link" href="{{ url('/') }}" aria-label="{{ app()->isLocale('en') ? 'Home' : 'Главная' }}" data-tooltip="{{ app()->isLocale('en') ? 'Home' : 'На главную' }}">
      <img src="{{ asset('assets/icons/bottom-bar/home.svg') }}" alt="" />
    </a>
    <a class="bottom-dock__link" href="#projects-catalog" aria-label="{{ app()->isLocale('en') ? 'Top of page' : 'Наверх' }}" data-tooltip="{{ app()->isLocale('en') ? 'Back to top' : 'Наверх' }}">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </a>
  </div>
  <a class="bottom-dock__cta" href="{{ url('/') }}" aria-label="{{ app()->isLocale('en') ? 'Back to portfolio' : 'На главную' }}" data-tooltip="{{ app()->isLocale('en') ? 'Back to portfolio' : 'Назад' }}">
    <span class="bottom-dock__cta-label" aria-hidden="true">
      <span class="bottom-dock__cta-text bottom-dock__cta-text-default">{{ app()->isLocale('en') ? '← Portfolio' : '← Главная' }}</span>
      <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">{{ app()->isLocale('en') ? 'Go back' : 'На сайт' }}</span>
    </span>
  </a>
</nav>
@endsection
