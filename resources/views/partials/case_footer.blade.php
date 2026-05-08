    <footer class="wrap" id="contact">
      <div class="footer-card reveal">
        <div class="footer-inner">
          <div class="section-head" style="margin-bottom:24px">
            <span class="chip">{{ __('site.footer.chip') }}</span>
            <h2 class="display-sm">{{ __('site.footer.h2') }}</h2>
            <p class="lead">{{ __('site.footer.lead') }}</p>
          </div>
          <form class="contact-form" action="{{ route('leads.contact') }}" method="post" data-lead-form="contact">
            @csrf
            <input type="text" name="_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0" />
            <div class="field"><input type="text" name="name" required placeholder="{{ __('site.footer.name_ph') }}" autocomplete="name" /></div>
            <div class="field"><input type="tel" name="phone" placeholder="{{ __('site.footer.phone_ph') }}" autocomplete="tel" /></div>
            <div class="field"><input type="text" name="telegram" placeholder="{{ __('site.footer.telegram_ph') }}" autocomplete="username" inputmode="text" /></div>
            <div class="field"><textarea name="message" required placeholder="{{ __('site.footer.msg_ph') }}"></textarea></div>
            <button type="submit" class="btn-primary btn-send" style="margin-top:8px;width:100%" aria-label="{{ __('site.footer.send_aria') }}">
              <span class="btn-label" aria-hidden="true">
                <span class="btn-text btn-text-default">{{ __('site.footer.send') }}</span>
                <span class="btn-text btn-text-hover">{{ __('site.footer.send_hover') }}</span>
              </span>
            </button>
          </form>
          <div class="contact-block">
            <p class="muted">{{ __('site.footer.channels') }}</p>
            <p class="phone">Telegram: <a href="https://t.me/falroman" target="_blank" rel="noopener noreferrer">@falroman</a></p>
            <p class="mail">Email: <a href="mailto:falkin95@mail.ru">falkin95@mail.ru</a></p>
            <p class="muted" style="margin-top:10px">{{ __('site.footer.meetings') }}</p>
            <div class="socials" style="justify-content:center;margin-top:20px">
              <a class="social" href="{{ $social->threads }}" @if($social->threads !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_threads') }}"><img src="{{ asset('assets/img/home/threads.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $social->instagram }}" @if($social->instagram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_ig') }}"><img src="{{ asset('assets/img/home/social-ig.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $social->telegram }}" @if($social->telegram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="{{ __('site.header.social_tg') }}"><img src="{{ asset('assets/img/home/social-tg.svg') }}" alt="" width="24" height="24" /></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom wrap">
        <span class="footer-bottom__copy">{{ __('site.footer.copy') }}</span>
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
      <a class="bottom-dock__cta" href="{{ route('home') }}#pricing" aria-label="{{ __('site.dock.pricing_cta') }}" data-tooltip="{{ __('site.dock.pricing_cta') }}">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">{{ __('site.dock.pricing_cta') }}</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">{{ __('site.dock.pricing_hover') }}</span>
        </span>
      </a>
    </nav>
