@php
  $inn = config('portfolio.legal.operator_inn');
  $ogrnip = config('portfolio.legal.operator_ogrnip');
@endphp
@if($ogrnip || $inn)
  <p class="footer-requisites">
    @if($ogrnip)<span>ОГРНИП {{ $ogrnip }}</span>@endif
    @if($ogrnip && $inn)<span class="footer-requisites__dot" aria-hidden="true">·</span>@endif
    @if($inn)<span>ИНН {{ $inn }}</span>@endif
  </p>
@endif
