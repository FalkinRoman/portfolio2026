      @if(($reviews ?? collect())->isNotEmpty() || ($reviewAvatars ?? collect())->isNotEmpty())
      <section class="section wrap reveal" id="testimonials">
        <div class="section-head">
          <span class="chip">{{ __('site.testimonials.chip') }}</span>
          <h2 class="display-sm">{!! nl2br(e(__('site.testimonials.h2'))) !!}</h2>
          <p class="lead">{{ __('site.testimonials.lead') }}</p>
        </div>
        <div class="clients-row">
          @if(($reviewAvatars ?? collect())->isNotEmpty())
          <div class="client-avatars">
            @foreach($reviewAvatars as $av)
              <div class="av"><img src="{{ $av->avatarUrl() }}" alt="{{ $av->display('name') }}" /></div>
            @endforeach
          </div>
          @endif
          <h3>{{ __('site.testimonials.clients_h') }}</h3>
          <p>{{ __('site.testimonials.clients_p') }}</p>
        </div>
        @if(($reviews ?? collect())->isNotEmpty())
        <div class="testimonial-shell">
          <div class="testimonial-viewport">
            <div class="testimonial-track" data-t-track>
              @foreach($reviews as $review)
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar">
                    @if($review->avatarUrl())
                      <img src="{{ $review->avatarUrl() }}" alt="" />
                    @endif
                  </div>
                  <div>
                    <h3>{{ $review->display('name') }}</h3>
                    <p>
                      <span class="t-role-desktop">{{ $review->display('role') }}</span>
                      <span class="t-role-mobile">{{ $review->display('role_mobile') ?: $review->display('role') }}</span>
                    </p>
                  </div>
                </div>
                <div class="t-body">{{ $review->display('body') }}</div>
                <div class="t-stars" aria-hidden="true">
                  @for($i = 0; $i < max(1, min(5, (int) ($review->stars ?? 5))); $i++)
                    <img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                  @endfor
                </div>
              </article>
              @endforeach
            </div>
          </div>
          @if($reviews->count() > 1)
          <div class="t-nav">
            <button type="button" data-t-prev aria-label="{{ __('site.testimonials.prev') }}"><img src="{{ asset('assets/icons/bottom-bar/arrow-left.svg') }}" alt="" /></button>
            <button type="button" data-t-next aria-label="{{ __('site.testimonials.next') }}"><img src="{{ asset('assets/icons/bottom-bar/arrow-right.svg') }}" alt="" /></button>
          </div>
          @endif
        </div>
        @endif
      </section>
      @endif

@php
  $process = $cms['process'] ?? [];
  $pricing = $cms['pricing'] ?? [];
  $pricingPlans = array_values($pricing['plans'] ?? []);
  $firstPlan = $pricingPlans[0] ?? null;
  $toolkit = $cms['toolkit'] ?? [];
  $studio = $cms['studio'] ?? [];
  $faq = $cms['faq'] ?? [];
  $footer = $cms['footer'] ?? [];
  $about = $cms['about'] ?? [];
  $logoUrl = isset($siteSettings) && $siteSettings ? $siteSettings->logoUrl() : asset('assets/studio/noi-logo.png');
  $presentationUrl = isset($siteSettings) && $siteSettings ? $siteSettings->presentationUrl() : asset('assets/studio/noi-presentation.pdf');
  $tgHref = ($contacts->telegram ?? '#') !== '#' ? $contacts->telegram : 'https://t.me/falroman';
@endphp
      <section class="section wrap reveal" id="process">
        <div class="section-head">
          <span class="chip">{{ $process['chip'] ?? '' }}</span>
          <h2 class="display-sm">{{ $process['h2'] ?? '' }}</h2>
          <p class="lead">{{ $process['lead'] ?? '' }}</p>
        </div>
        <div class="timeline">
          <div class="tl-origin" aria-hidden="true"><span class="tl-dot"></span></div>
          @foreach(($process['steps'] ?? []) as $si => $step)
          <div class="tl-row" data-side="{{ $si % 2 === 0 ? 'right' : 'left' }}">
            <div class="tl-spine {{ $si === 0 ? 'tl-spine--nodot' : '' }}">@if($si > 0)<div class="tl-dot"></div>@endif</div>
            <div class="tl-card">
              <h4>{{ $step['h'] ?? '' }}</h4>
              <h5>{{ $step['t'] ?? '' }}</h5>
              <p>{{ $step['p'] ?? '' }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </section>

      <section class="section wrap reveal" id="pricing">
        <div class="section-head">
          <span class="chip">{{ $pricing['chip'] ?? '' }}</span>
          <h2 class="display-sm">{{ $pricing['h2'] ?? '' }}</h2>
          <p class="lead">{{ $pricing['lead'] ?? '' }}</p>
        </div>
        @if(count($pricingPlans) > 0)
        <div class="pricing-toggle" data-pricing-toggle style="--plan-count: {{ max(1, count($pricingPlans)) }}; --plan-index: 0; width: min(100%, {{ min(640, 160 * max(2, count($pricingPlans))) }}px)">
          <span class="pill" aria-hidden="true"></span>
          @foreach($pricingPlans as $plan)
            <button type="button" data-plan="{{ $plan['key'] ?? $loop->index }}">{{ $plan['tab'] ?? $plan['title'] ?? 'Plan' }}</button>
          @endforeach
        </div>
        <div class="pricing-card">
          <div class="pricing-inner">
            <div class="pricing-top">
              <h3 data-p-title>{{ $firstPlan['title'] ?? '' }}</h3>
              <p data-p-sub>{{ $firstPlan['sub'] ?? '' }}</p>
            </div>
            <div class="points" data-p-points>
              @foreach(($firstPlan['points'] ?? []) as $line)
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />{{ $line }}</div>
              @endforeach
            </div>
          </div>
          <div class="pricing-foot">
            <div><span class="price-big" data-p-price>{!! $firstPlan['price_html'] ?? '' !!}</span></div>
            <a href="#contact" class="btn-primary" style="margin-top:0;text-decoration:none">{{ $pricing['discuss'] ?? 'Обсудить проект' }}</a>
          </div>
        </div>
        @endif
      </section>

      <section class="section wrap reveal" id="toolkit">
        <div class="section-head">
          <span class="chip">{{ $toolkit['chip'] ?? '' }}</span>
          <h2 class="display-sm">{{ $toolkit['h2'] ?? '' }}</h2>
          <p class="lead">{{ $toolkit['lead'] ?? '' }}</p>
        </div>
        @foreach(($toolkit['items'] ?? []) as $ti => $tool)
        @php
          $pct = (int) ($tool['pct'] ?? 0);
          $icon = \App\Support\Cms::mediaUrl($tool['icon'] ?? null);
        @endphp
        <div class="tool-row" style="--fill: {{ $pct }}; --stagger: {{ $ti }}"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon">@if($icon)<img src="{{ $icon }}" alt="{{ $tool['name'] ?? '' }}" width="40" height="40" />@endif</div>
          <div class="tool-meta"><h4>{{ $tool['name'] ?? '' }}</h4><p>{{ $tool['desc'] ?? '' }}</p></div>
          <span class="tool-pct" data-target="{{ $pct }}">0%</span>
        </div>
        @endforeach
      </section>

      <section class="section wrap reveal" id="studio">
        <div class="newsletter-card studio-card">
          <div class="news-inner" style="display:grid;gap:clamp(16px,3vw,28px);justify-items:center;text-align:center">
            <div class="studio-logo-wrap" style="width:96px;height:96px;border-radius:999px;overflow:hidden;border:1px solid rgba(0,0,0,.08);background:#fff;display:flex;align-items:center;justify-content:center">
              <img src="{{ $logoUrl }}" alt="Noi Studio" width="96" height="96" style="width:100%;height:100%;object-fit:cover" />
            </div>
            <div class="section-head" style="margin-bottom:0">
              <span class="chip">{{ $studio['chip'] ?? 'Noi Studio' }}</span>
              <h2 class="display-sm">{{ $studio['h2'] ?? '' }}</h2>
              <p class="lead">{{ $studio['lead'] ?? '' }}</p>
            </div>
            <p style="margin:0;max-width:36rem;font-weight:600">{{ $studio['role_line'] ?? '' }}</p>
            <p style="margin:0;max-width:40rem;opacity:.85;line-height:1.55">{{ $studio['body'] ?? '' }}</p>
            <a class="btn-primary btn-download-deck" href="{{ $presentationUrl }}" style="text-decoration:none;margin-top:4px;display:inline-flex;align-items:center;gap:10px" target="_blank" rel="noopener noreferrer">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M14 4h6v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 14L20 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>{{ $studio['cta_label'] ?? 'Смотреть презентацию студии' }}</span>
            </a>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="faq">
        <div class="section-head">
          <span class="chip">{{ $faq['chip'] ?? 'FAQ' }}</span>
          <h2 class="display-sm">{{ $faq['h2'] ?? '' }}</h2>
          <p class="lead">{{ $faq['lead'] ?? '' }}</p>
        </div>
        <div class="faq-list">
          @foreach(($faq['items'] ?? []) as $faqItem)
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ $faqItem['q'] ?? '' }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ $faqItem['a'] ?? '' }}</div></div>
          </div>
          @endforeach
        </div>
        <div class="faq-cta">
          <p style="margin:0 0 16px;font-weight:500">{{ $faq['more_q'] ?? '' }}</p>
          <a href="{{ $tgHref }}" class="btn-primary" style="margin-top:0;text-decoration:none" target="_blank" rel="noopener noreferrer">{{ $faq['write'] ?? '' }}</a>
        </div>
      </section>
    </main>

    <footer class="wrap" id="contact">
      <div class="footer-card reveal">
        <div class="footer-inner">
          <div class="section-head" style="margin-bottom:24px">
            <span class="chip">{{ $footer['chip'] ?? '' }}</span>
            <h2 class="display-sm">{{ $footer['h2'] ?? '' }}</h2>
            <p class="lead">{{ $footer['lead'] ?? '' }}</p>
          </div>
          <div class="contact-block">
            <p class="muted">{{ $footer['channels'] ?? '' }}</p>
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
            <p class="muted" style="margin-top:10px">{{ $footer['meetings'] ?? '' }}</p>
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
      <div class="footer-bottom wrap footer-bottom--split">
        @php($copyParts = explode('. ', $footer['copy'] ?? '', 2))
        <span class="footer-bottom__copy">
          {{ $copyParts[0] }}@if(isset($copyParts[1])).
          <span class="footer-bottom__copy-tail"> {{ $copyParts[1] }}</span>
          @endif
        </span>
        @include('partials.footer_legal_links')
      </div>
    </footer>

    <div class="about-overlay" id="aboutOverlay" aria-modal="true" role="dialog" aria-label="{{ __('site.about.aria_dialog') }}" hidden>
      <div class="about-backdrop"></div>
      <div class="about-card">
        <button class="about-close" id="aboutClose" aria-label="{{ __('site.about.close') }}">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </button>
        <div class="about-card-header">
          <div class="about-avatar">
            <img src="{{ asset('assets/img/main.webp') }}" alt="{{ __('site.brand.name') }}" />
          </div>
          <div>
            <p class="about-name">{{ __('site.brand.name') }}</p>
            <p class="about-role">{{ $about['role'] ?? '' }}</p>
          </div>
        </div>
        <div class="about-body-panel">
          <div class="about-body">
            <p class="about-greeting">{{ $about['hi'] ?? '' }}</p>
            <p class="about-desc">{{ $about['desc'] ?? '' }}</p>
            <div class="about-section">
              <h4 class="about-section-title">{{ $about['exp_h'] ?? '' }}</h4>
              <ul class="about-list">
                @foreach(($about['exp'] ?? []) as $line)
                  <li><span class="about-emoji" aria-hidden="true">🔷</span>{{ $line }}</li>
                @endforeach
              </ul>
            </div>
            <div class="about-section">
              <h4 class="about-section-title">{{ $about['edu_h'] ?? '' }}</h4>
              <ul class="about-list">
                @foreach(($about['edu'] ?? []) as $line)
                  <li><span class="about-emoji about-emoji--edu" aria-hidden="true">🎓</span>{{ $line }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="about-contacts">
          <a href="{{ $tgHref }}" target="_blank" rel="noopener" class="about-link">Telegram</a>
          @if(($contacts->whatsapp ?? '#') !== '#')
            <a href="{{ $contacts->whatsapp }}" target="_blank" rel="noopener" class="about-link">WhatsApp</a>
          @endif
          @if(!empty($contacts->email))
            <a href="{{ $contacts->mailto }}" class="about-link">Email</a>
          @endif
        </div>
      </div>
    </div>

    <nav class="bottom-dock" aria-label="{{ __('site.dock.nav_aria') }}">
      <div class="bottom-dock__links">
        <a class="bottom-dock__link" href="#top" aria-label="{{ __('site.dock.home') }}" data-tooltip="{{ __('site.dock.home') }}"><img src="{{ asset('assets/icons/bottom-bar/home.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#services" aria-label="{{ __('site.dock.services') }}" data-tooltip="{{ __('site.dock.services') }}"><img src="{{ asset('assets/icons/bottom-bar/services.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#projects" aria-label="{{ __('site.dock.projects') }}" data-tooltip="{{ __('site.dock.projects') }}"><img src="{{ asset('assets/icons/bottom-bar/projects.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#testimonials" aria-label="{{ __('site.dock.testimonials') }}" data-tooltip="{{ __('site.dock.testimonials') }}"><img src="{{ asset('assets/icons/bottom-bar/testimonials.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#toolkit" aria-label="{{ __('site.dock.toolkit') }}" data-tooltip="{{ __('site.dock.toolkit') }}"><img src="{{ asset('assets/icons/bottom-bar/toolkit.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#faq" aria-label="FAQ" data-tooltip="{{ __('site.dock.faq') }}"><img src="{{ asset('assets/icons/bottom-bar/faq.svg') }}" alt="" /></a>
      </div>
      <a class="bottom-dock__cta" href="#projects" aria-label="{{ __('site.dock.pricing_cta') }}" data-tooltip="{{ __('site.dock.pricing_cta') }}">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">{{ __('site.dock.pricing_cta') }}</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">{{ __('site.dock.pricing_hover') }}</span>
        </span>
      </a>
    </nav>
