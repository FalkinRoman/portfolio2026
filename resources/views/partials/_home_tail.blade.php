      <section class="section wrap reveal" id="testimonials">
        <div class="section-head">
          <span class="chip">{{ __('site.testimonials.chip') }}</span>
          <h2 class="display-sm">{!! nl2br(e(__('site.testimonials.h2'))) !!}</h2>
          <p class="lead">{{ __('site.testimonials.lead') }}</p>
        </div>
        <div class="clients-row">
          <div class="client-avatars">
            <div class="av"><img src="{{ asset('assets/img/review/1.jpg') }}" alt="" /></div>
            <div class="av"><img src="{{ asset('assets/img/review/2.jpeg') }}" alt="" /></div>
            <div class="av"><img src="{{ asset('assets/img/review/3.jpg') }}" alt="" /></div>
          </div>
          <h3>{{ __('site.testimonials.clients_h') }}</h3>
          <p>{{ __('site.testimonials.clients_p') }}</p>
        </div>
        <div class="testimonial-shell">
          <div class="testimonial-viewport">
            <div class="testimonial-track" data-t-track>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ asset('assets/img/review/1.jpg') }}" alt="" /></div>
                  <div>
                    <h3>{{ __('site.testimonials.t1_name') }}</h3>
                    <p>
                      <span class="t-role-desktop">{{ __('site.testimonials.t1_role') }}</span>
                      <span class="t-role-mobile">{{ __('site.testimonials.t1_role_mobile') }}</span>
                    </p>
                  </div>
                </div>
                <div class="t-body">{{ __('site.testimonials.t1_body') }}</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ asset('assets/img/review/2.jpeg') }}" alt="" /></div>
                  <div>
                    <h3>{{ __('site.testimonials.t2_name') }}</h3>
                    <p>
                      <span class="t-role-desktop">{{ __('site.testimonials.t2_role') }}</span>
                      <span class="t-role-mobile">{{ __('site.testimonials.t2_role_mobile') }}</span>
                    </p>
                  </div>
                </div>
                <div class="t-body">{{ __('site.testimonials.t2_body') }}</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ asset('assets/img/review/3.jpg') }}" alt="" /></div>
                  <div>
                    <h3>{{ __('site.testimonials.t3_name') }}</h3>
                    <p>
                      <span class="t-role-desktop">{{ __('site.testimonials.t3_role') }}</span>
                      <span class="t-role-mobile">{{ __('site.testimonials.t3_role_mobile') }}</span>
                    </p>
                  </div>
                </div>
                <div class="t-body">{{ __('site.testimonials.t3_body') }}</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
            </div>
          </div>
          <div class="t-nav">
            <button type="button" data-t-prev aria-label="{{ __('site.testimonials.prev') }}"><img src="{{ asset('assets/icons/bottom-bar/arrow-left.svg') }}" alt="" /></button>
            <button type="button" data-t-next aria-label="{{ __('site.testimonials.next') }}"><img src="{{ asset('assets/icons/bottom-bar/arrow-right.svg') }}" alt="" /></button>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="process">
        <div class="section-head">
          <span class="chip">{{ __('site.process.chip') }}</span>
          <h2 class="display-sm">{{ __('site.process.h2') }}</h2>
          <p class="lead">{{ __('site.process.lead') }}</p>
        </div>
        <div class="timeline">
          <div class="tl-origin" aria-hidden="true"><span class="tl-dot"></span></div>
          <div class="tl-row" data-side="right">
            <div class="tl-spine tl-spine--nodot"></div>
            <div class="tl-card">
              <h4>{{ __('site.process.s1_h') }}</h4>
              <h5>{{ __('site.process.s1_t') }}</h5>
              <p>{{ __('site.process.s1_p') }}</p>
            </div>
          </div>
          <div class="tl-row" data-side="left">
            <div class="tl-spine"><div class="tl-dot"></div></div>
            <div class="tl-card">
              <h4>{{ __('site.process.s2_h') }}</h4>
              <h5>{{ __('site.process.s2_t') }}</h5>
              <p>{{ __('site.process.s2_p') }}</p>
            </div>
          </div>
          <div class="tl-row" data-side="right">
            <div class="tl-spine"><div class="tl-dot"></div></div>
            <div class="tl-card">
              <h4>{{ __('site.process.s3_h') }}</h4>
              <h5>{{ __('site.process.s3_t') }}</h5>
              <p>{{ __('site.process.s3_p') }}</p>
            </div>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="pricing">
        <div class="section-head">
          <span class="chip">{{ __('site.pricing.chip') }}</span>
          <h2 class="display-sm">{{ __('site.pricing.h2') }}</h2>
          <p class="lead">{{ __('site.pricing.lead') }}</p>
        </div>
        <div class="pricing-toggle" data-pricing-toggle>
          <span class="pill" aria-hidden="true"></span>
          <button type="button" data-plan="web">{{ __('site.pricing.tab_web') }}</button>
          <button type="button" data-plan="mobile">{{ __('site.pricing.tab_mobile') }}</button>
        </div>
        <div class="pricing-card">
          <div class="pricing-inner">
            <div class="pricing-top">
              <h3 data-p-title>{{ __('site.pricing.web_title') }}</h3>
              <p data-p-sub>{{ __('site.pricing.web_sub') }}</p>
            </div>
            <div class="points" data-p-points>
              @foreach(trans('site.pricing_points.web') as $line)
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />{{ $line }}</div>
              @endforeach
            </div>
          </div>
          <div class="pricing-foot">
            <div><span class="price-big" data-p-price>{!! \App\Support\PricingDisplay::priceLineHtml('web') !!}</span></div>
            <button type="button" class="btn-primary" style="margin-top:0">{{ __('site.pricing.discuss') }}</button>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="toolkit">
        <div class="section-head">
          <span class="chip">{{ __('site.toolkit.chip') }}</span>
          <h2 class="display-sm">{{ __('site.toolkit.h2') }}</h2>
          <p class="lead">{{ __('site.toolkit.lead') }}</p>
        </div>
        <div class="tool-row" style="--fill: 90; --stagger: 0"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/react.svg') }}" alt="React" width="40" height="40" /></div>
          <div class="tool-meta"><h4>React</h4><p>{{ __('site.toolkit.react_d') }}</p></div>
          <span class="tool-pct" data-target="90">0%</span>
        </div>
        <div class="tool-row" style="--fill: 88; --stagger: 1"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/reactnative.svg') }}" alt="React Native" width="40" height="40" /></div>
          <div class="tool-meta"><h4>React Native</h4><p>{{ __('site.toolkit.rn_d') }}</p></div>
          <span class="tool-pct" data-target="88">0%</span>
        </div>
        <div class="tool-row" style="--fill: 85; --stagger: 2"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/docker.svg') }}" alt="Docker" width="40" height="40" /></div>
          <div class="tool-meta"><h4>Docker</h4><p>{{ __('site.toolkit.docker_d') }}</p></div>
          <span class="tool-pct" data-target="85">0%</span>
        </div>
        <div class="tool-row" style="--fill: 83; --stagger: 3"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/php.svg') }}" alt="PHP" width="40" height="40" /></div>
          <div class="tool-meta"><h4>PHP</h4><p>{{ __('site.toolkit.php_d') }}</p></div>
          <span class="tool-pct" data-target="83">0%</span>
        </div>
        <div class="tool-row" style="--fill: 80; --stagger: 4"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/python.svg') }}" alt="Python" width="40" height="40" /></div>
          <div class="tool-meta"><h4>Python</h4><p>{{ __('site.toolkit.py_d') }}</p></div>
          <span class="tool-pct" data-target="80">0%</span>
        </div>
        <div class="tool-row" style="--fill: 78; --stagger: 5"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/postgresql.svg') }}" alt="PostgreSQL" width="40" height="40" /></div>
          <div class="tool-meta"><h4>PostgreSQL</h4><p>{{ __('site.toolkit.pg_d') }}</p></div>
          <span class="tool-pct" data-target="78">0%</span>
        </div>
      </section>

      <section class="section wrap reveal" id="newsletter">
        <div class="newsletter-card">
          <div class="news-inner">
            <div class="section-head" style="margin-bottom:0">
              <span class="chip">{{ __('site.newsletter.chip') }}</span>
              <h2 class="display-sm">{{ __('site.newsletter.h2') }}</h2>
              <p class="lead">{{ __('site.newsletter.lead') }}</p>
            </div>
            <form class="news-form" action="{{ route('leads.newsletter') }}" method="post" data-lead-form="newsletter">
              @csrf
              <input type="text" name="_hp" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0" />
              <input type="tel" name="phone" placeholder="{{ __('site.newsletter.phone_ph') }}" autocomplete="tel" />
              <input type="text" name="telegram" placeholder="{{ __('site.newsletter.telegram_ph') }}" autocomplete="username" inputmode="text" />
              <div class="news-form__consent">@include('partials.legal_consent')</div>
              <button type="submit" class="btn-primary" style="margin-top:0">{{ __('site.newsletter.submit') }}</button>
            </form>
            <div class="marquee" aria-hidden="true">
              <div class="marquee-track">
                <img src="{{ asset('assets/icons/newsletter/item-1.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-2.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-3.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-4.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-5.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-6.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-7.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-8.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-9.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-10.svg') }}" alt="" />
                <img src="{{ asset('assets/icons/newsletter/item-1.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-2.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-3.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-4.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-5.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-6.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-7.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-8.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-9.svg') }}" alt="" /><img src="{{ asset('assets/icons/newsletter/item-10.svg') }}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="faq">
        <div class="section-head">
          <span class="chip">{{ __('site.faq.chip') }}</span>
          <h2 class="display-sm">{{ __('site.faq.h2') }}</h2>
          <p class="lead">{{ __('site.faq.lead') }}</p>
        </div>
        <div class="faq-list">
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q1') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a1') }}</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q2') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a2') }}</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q3') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a3') }}</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q4') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a4') }}</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q5') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a5') }}</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">{{ __('site.faq.q6') }}<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">{{ __('site.faq.a6') }}</div></div>
          </div>
        </div>
        <div class="faq-cta">
          <p style="margin:0 0 16px;font-weight:500">{{ __('site.faq.more_q') }}</p>
          @php($faqTg = ($social->telegram ?? '#') !== '#' ? $social->telegram : (config('portfolio.seo.same_as_telegram') ?: 'https://t.me/falroman'))
          <a href="{{ $faqTg }}" class="btn-primary" style="margin-top:0;text-decoration:none" target="_blank" rel="noopener noreferrer">{{ __('site.faq.write') }}</a>
        </div>
      </section>
    </main>

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
            @include('partials.legal_consent')
            <button type="submit" class="btn-primary btn-send" style="width:100%" aria-label="{{ __('site.footer.send_aria') }}">
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
      <div class="footer-bottom wrap footer-bottom--split">
        @php($copyParts = explode('. ', __('site.footer.copy'), 2))
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
            <p class="about-role">{{ __('site.about.role') }}</p>
          </div>
        </div>
        <div class="about-body-panel">
          <div class="about-body">
            <p class="about-greeting">{{ __('site.about.hi') }}</p>
            <p class="about-desc">{{ __('site.about.desc') }}</p>
            <div class="about-section">
              <h4 class="about-section-title">{{ __('site.about.exp_h') }}</h4>
              <ul class="about-list">
                <li><span class="about-emoji" aria-hidden="true">🔷</span>{{ __('site.about.exp_1') }}</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>{{ __('site.about.exp_2') }}</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>{{ __('site.about.exp_3') }}</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>{{ __('site.about.exp_4') }}</li>
              </ul>
            </div>
            <div class="about-section">
              <h4 class="about-section-title">{{ __('site.about.edu_h') }}</h4>
              <ul class="about-list">
                <li><span class="about-emoji about-emoji--edu" aria-hidden="true">🎓</span>{{ __('site.about.edu_1') }}</li>
                <li><span class="about-emoji about-emoji--edu" aria-hidden="true">🎓</span>{{ __('site.about.edu_2') }}</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="about-contacts">
          <a href="https://t.me/falroman" target="_blank" rel="noopener" class="about-link">Telegram</a>
          <a href="mailto:falkin95@mail.ru" class="about-link">Email</a>
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
      <a class="bottom-dock__cta" href="#pricing" aria-label="{{ __('site.dock.pricing_cta') }}" data-tooltip="{{ __('site.dock.pricing_cta') }}">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">{{ __('site.dock.pricing_cta') }}</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">{{ __('site.dock.pricing_hover') }}</span>
        </span>
      </a>
    </nav>
