@extends('layouts.site', [
  'seoTitle' => $seoTitle,
  'seoDescription' => $seoDescription,
])

@section('content')
<main class="wrap legal-page">
  <nav class="legal-page__nav" aria-label="{{ __('legal.common.back_home') }}">
    <a class="legal-page__back" href="{{ route('home') }}">
      <span class="legal-page__back-icon" aria-hidden="true">←</span>
      <span>{{ __('legal.common.back_home') }}</span>
    </a>
  </nav>
  <article class="legal-doc">
    @if(app()->isLocale('en'))
      @include('legal._privacy_en')
    @else
      @include('legal._privacy_ru')
    @endif
  </article>
</main>
@endsection
