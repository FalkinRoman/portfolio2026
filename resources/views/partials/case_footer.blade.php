@php
  $footer = $cms['footer'] ?? [];
  $tgHref = ($contacts->telegram ?? '#') !== '#' ? $contacts->telegram : 'https://t.me/falroman';
@endphp
    <footer class="wrap" id="contact">
      <div class="footer-card reveal">
        <div class="footer-inner">
          <div class="section-head" style="margin-bottom:24px">
            <span class="chip">{{ $footer['chip'] ?? __('site.footer.chip') }}</span>
            <h2 class="display-sm">{{ $footer['h2'] ?? __('site.footer.h2') }}</h2>
            <p class="lead">{{ $footer['lead'] ?? __('site.footer.lead') }}</p>
          </div>
          <div class="contact-block">
            <p class="muted">{{ $footer['channels'] ?? __('site.footer.channels') }}</p>
            <p class="phone">Telegram: <a href="{{ $tgHref }}" target="_blank" rel="noopener noreferrer">@falroman</a></p>
            @if(($contacts->whatsapp ?? '#') !== '#')
              <p class="phone">WhatsApp: <a href="{{ $contacts->whatsapp }}" target="_blank" rel="noopener noreferrer">написать</a></p>
            @endif
            @if(!empty($contacts->email))
              <p class="mail">Email: <a href="{{ $contacts->mailto }}">{{ $contacts->email }}</a></p>
            @endif
            @if(!empty($contacts->phone))
              <p class="phone">Телефон: <a href="{{ $contacts->tel }}">{{ $contacts->phone }}</a></p>
            @endif
            <p class="muted" style="margin-top:10px">{{ $footer['meetings'] ?? __('site.footer.meetings') }}</p>
            <div class="socials" style="justify-content:center;margin-top:20px">
              <a class="social" href="{{ $social->threads }}" @if($social->threads !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_threads') }}"><img src="{{ asset('assets/img/home/threads.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $social->instagram }}" @if($social->instagram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_ig') }}"><img src="{{ asset('assets/img/home/social-ig.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $tgHref }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __('site.header.social_tg') }}"><img src="{{ asset('assets/img/home/social-tg.svg') }}" alt="" width="24" height="24" /></a>
              @if(($contacts->whatsapp ?? '#') !== '#')
                <a class="social" href="{{ $contacts->whatsapp }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __('site.header.social_wa') }}"><img src="{{ asset('assets/img/home/social-wa.svg') }}" alt="" width="24" height="24" /></a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom wrap">
        <div class="footer-bottom__row footer-bottom--split">
          <span class="footer-bottom__copy">{{ $footer['copy'] ?? __('site.footer.copy') }}</span>
          @include('partials.footer_legal_links')
        </div>
        @include('partials.footer_requisites')
      </div>
    </footer>

    <nav class="bottom-dock" aria-label="{{ __('site.dock.nav_aria') }}">
      <div class="bottom-dock__links">
        <a class="bottom-dock__link" href="{{ route('home') }}#top" aria-label="{{ __('site.dock.home') }}" data-tooltip="{{ __('site.dock.home') }}"><img src="{{ asset('assets/icons/bottom-bar/home.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#services" aria-label="{{ __('site.dock.services') }}" data-tooltip="{{ __('site.dock.services') }}"><img src="{{ asset('assets/icons/bottom-bar/services.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#projects" aria-label="{{ __('site.dock.projects') }}" data-tooltip="{{ __('site.dock.projects') }}"><img src="{{ asset('assets/icons/bottom-bar/projects.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#testimonials" aria-label="{{ __('site.dock.testimonials') }}" data-tooltip="{{ __('site.dock.testimonials') }}"><img src="{{ asset('assets/icons/bottom-bar/testimonials.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#toolkit" aria-label="{{ __('site.dock.toolkit') }}" data-tooltip="{{ __('site.dock.toolkit') }}"><img src="{{ asset('assets/icons/bottom-bar/toolkit.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#faq" aria-label="FAQ" data-tooltip="{{ __('site.dock.faq') }}"><img src="{{ asset('assets/icons/bottom-bar/faq.svg') }}" alt="" /></a>
      </div>
      <a class="bottom-dock__cta" href="{{ route('home') }}#projects" aria-label="{{ __('site.dock.pricing_cta') }}" data-tooltip="{{ __('site.dock.pricing_cta') }}">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">{{ __('site.dock.pricing_cta') }}</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">{{ __('site.dock.pricing_hover') }}</span>
        </span>
      </a>
    </nav>
