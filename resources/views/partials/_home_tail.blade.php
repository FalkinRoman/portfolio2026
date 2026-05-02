@php($T = asset('assets/img/home'))
      <section class="section wrap reveal" id="testimonials">
        <div class="section-head">
          <span class="chip">Отзывы</span>
          <h2 class="display-sm">Реальный опыт<br />в работе со мной</h2>
          <p class="lead">Отзывы тех, кто превратил идеи в продукты и измеримый результат</p>
        </div>
        <div class="clients-row">
          <div class="client-avatars">
            <div class="av"><img src="{{ $T }}/clients-1.png" alt="" /></div>
            <div class="av"><img src="{{ $T }}/clients-2.png" alt="" /></div>
            <div class="av"><img src="{{ $T }}/clients-3.png" alt="" /></div>
          </div>
          <h3>С кем уже работал</h3>
          <p>Команды выбирают прозрачный процесс и предсказуемый результат</p>
        </div>
        <div class="testimonial-shell">
          <div class="testimonial-viewport">
            <div class="testimonial-track" data-t-track>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ $T }}/t-avatar-1.png" alt="" /></div>
                  <div><h3>Ирина Соколова</h3><p>основатель, студия digital</p></div>
                </div>
                <div class="t-body">Закрывали вместе веб-платформу под заявки и личный кабинет: стек, архитектура API и сроки были проговорены до кода. Релиз прошёл без сюрпризов, после запуска доработки шли итерациями — как в нормальной продуктовой разработке, а не «как получится».</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ $T }}/t-avatar-2.png" alt="" /></div>
                  <div><h3>София Мартинес</h3><p>продакт-лид, B2B SaaS</p></div>
                </div>
                <div class="t-body">Вели фичи в React и мобильный клиент на React Native из одной кодовой базы по сути — меньше расхождений между вебом и приложением. Всегда понятно, что в спринте, что в бэклоге; баги после релиза закрывались быстро, без бесконечных «уточним позже».</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
              <article class="testimonial-slide">
                <div class="t-meta">
                  <div class="t-avatar"><img src="{{ $T }}/t-avatar-3.png" alt="" /></div>
                  <div><h3>Михаил Томпсон</h3><p>CEO, Northwind</p></div>
                </div>
                <div class="t-body">Нужны были стабильный бэкенд, интеграции и понятный деплой — Роман разложил по этапам: контракт API, окружения, мониторинг после выката. Для нас это была именно инженерная разработка, а не «нарисовать и забыть».</div>
                <div class="t-stars" aria-hidden="true">
                  <img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" /><img src="{{ asset('assets/img/home/star.svg') }}" alt="" />
                </div>
              </article>
            </div>
          </div>
          <div class="t-nav">
            <button type="button" data-t-prev aria-label="Предыдущий отзыв"><img src="{{ asset('assets/icons/bottom-bar/arrow-left.svg') }}" alt="" /></button>
            <button type="button" data-t-next aria-label="Следующий отзыв"><img src="{{ asset('assets/icons/bottom-bar/arrow-right.svg') }}" alt="" /></button>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="process">
        <div class="section-head">
          <span class="chip">Процесс</span>
          <h2 class="display-sm">Запуск ваших задач в прод стал проще</h2>
          <p class="lead">Прозрачно, быстро, без лишней бюрократии</p>
        </div>
        <div class="timeline">
          <div class="tl-origin" aria-hidden="true"><span class="tl-dot"></span></div>
          <div class="tl-row" data-side="right">
            <div class="tl-spine tl-spine--nodot"></div>
            <div class="tl-card">
              <h4>Шаг 1</h4>
              <h5>Бриф и оценка задачи</h5>
              <p>Разбираем цель, формат (веб или мобайл), ключевые экраны и интеграции. На этом этапе фиксируем ориентир по бюджету, срокам и первому релизу.</p>
            </div>
          </div>
          <div class="tl-row" data-side="left">
            <div class="tl-spine"><div class="tl-dot"></div></div>
            <div class="tl-card">
              <h4>Шаг 2</h4>
              <h5>Итерационная разработка</h5>
              <p>Двигаемся короткими спринтами: дизайн/код, демо, правки, согласование. Приоритеты и статусы ведём в одном потоке, чтобы не терять контекст.</p>
            </div>
          </div>
          <div class="tl-row" data-side="right">
            <div class="tl-spine"><div class="tl-dot"></div></div>
            <div class="tl-card">
              <h4>Шаг 3</h4>
              <h5>Релиз и сопровождение</h5>
              <p>Публикуем в прод (или сторах для мобайла), подключаем аналитику, проверяем метрики и закрываем пост-релизные доработки в согласованном окне поддержки.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="pricing">
        <div class="section-head">
          <span class="chip">Стоимость</span>
          <h2 class="display-sm">Стоимость веб- и мобильной разработки</h2>
          <p class="lead">Выберите направление и получите ориентир по бюджету, срокам и составу работ</p>
        </div>
        <div class="pricing-toggle" data-pricing-toggle>
          <span class="pill" aria-hidden="true"></span>
          <button type="button" data-plan="web">Веб-разработка</button>
          <button type="button" data-plan="mobile">Мобильная разработка</button>
        </div>
        <div class="pricing-card">
          <div class="pricing-inner">
            <div class="pricing-top">
              <h3 data-p-title>Веб-разработка</h3>
              <p data-p-sub>Лендинги, корпоративные сайты и веб-приложения под задачи бизнеса</p>
            </div>
            <div class="points" data-p-points>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />Маркетинговый лендинг</div>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />Корпоративный сайт</div>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />Личный кабинет / web app</div>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />В цену входят: адаптив, базовое SEO, формы, аналитика</div>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />Отдельно оцениваются: сложные интеграции, админ-панель, мультиязык</div>
              <div class="point"><img src="{{ asset('assets/icons/pricing/check.svg') }}" alt="" />Срок: обычно 2–8 недель в зависимости от объёма</div>
            </div>
          </div>
          <div class="pricing-foot">
            <div><span class="price-big" data-p-price>от 180 000 ₽<span>/ проект</span></span></div>
            <button type="button" class="btn-primary" style="margin-top:0">Обсудить проект</button>
          </div>
        </div>
      </section>

      <section class="section wrap reveal" id="toolkit">
        <div class="section-head">
          <span class="chip">Технологии</span>
          <h2 class="display-sm">Надёжный стек, предсказуемый результат</h2>
          <p class="lead">Инструменты и практики, чтобы идея дошла до работающего продукта</p>
        </div>
        <div class="tool-row" style="--fill: 90; --stagger: 0"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/react.svg') }}" alt="React" width="40" height="40" /></div>
          <div class="tool-meta"><h4>React</h4><p>Современные интерфейсы и масштабируемые веб-приложения</p></div>
          <span class="tool-pct" data-target="90">0%</span>
        </div>
        <div class="tool-row" style="--fill: 88; --stagger: 1"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/reactnative.svg') }}" alt="React Native" width="40" height="40" /></div>
          <div class="tool-meta"><h4>React Native</h4><p>Кроссплатформенные приложения для iOS и Android</p></div>
          <span class="tool-pct" data-target="88">0%</span>
        </div>
        <div class="tool-row" style="--fill: 85; --stagger: 2"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/docker.svg') }}" alt="Docker" width="40" height="40" /></div>
          <div class="tool-meta"><h4>Docker</h4><p>Контейнеризация и предсказуемый деплой в любой среде</p></div>
          <span class="tool-pct" data-target="85">0%</span>
        </div>
        <div class="tool-row" style="--fill: 83; --stagger: 3"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/php.svg') }}" alt="PHP" width="40" height="40" /></div>
          <div class="tool-meta"><h4>PHP</h4><p>Серверная логика, API и интеграции с базами данных</p></div>
          <span class="tool-pct" data-target="83">0%</span>
        </div>
        <div class="tool-row" style="--fill: 80; --stagger: 4"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/python.svg') }}" alt="Python" width="40" height="40" /></div>
          <div class="tool-meta"><h4>Python</h4><p>Автоматизация, бэкенд и задачи любой сложности</p></div>
          <span class="tool-pct" data-target="80">0%</span>
        </div>
        <div class="tool-row" style="--fill: 78; --stagger: 5"><span class="tool-overlay" aria-hidden="true"></span>
          <div class="tool-icon"><img src="{{ asset('assets/icons/stack/postgresql.svg') }}" alt="PostgreSQL" width="40" height="40" /></div>
          <div class="tool-meta"><h4>PostgreSQL</h4><p>Проектирование и оптимизация реляционных баз данных</p></div>
          <span class="tool-pct" data-target="78">0%</span>
        </div>
      </section>

      <section class="section wrap reveal" id="newsletter">
        <div class="newsletter-card">
          <div class="news-inner">
            <div class="section-head" style="margin-bottom:0">
              <span class="chip">Обновления</span>
              <h2 class="display-sm">100+ разборов по веб- и мобильной разработке продуктов</h2>
              <p class="lead">Практика, решения и опыт из продакшн-проектов</p>
            </div>
            <form class="news-form" onsubmit="return false;">
              <input type="email" name="email" placeholder="Введите ваш email" autocomplete="email" />
              <button type="submit" class="btn-primary" style="margin-top:0">Подписаться</button>
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
          <span class="chip">FAQ</span>
          <h2 class="display-sm">Частые вопросы перед стартом разработки</h2>
          <p class="lead">Коротко о процессах, сроках, оплате и формате взаимодействия</p>
        </div>
        <div class="faq-list">
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">Как проходит работа по проекту?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">Стартуем с брифа и оценки, затем фиксируем этапы и приоритеты. Дальше итерационно: показываю промежуточные результаты, собираем фидбек, доводим до продакшн-качества и релиза.</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">Что входит в стоимость «от»?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">В базовую оценку входят проектирование, разработка, адаптив, базовая аналитика и подготовка к релизу. Интеграции, сложная админка, мультиязык, офлайн-режим и нестандартные сценарии считаются отдельно.</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">Сколько обычно занимает разработка?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">Веб-проекты обычно занимают 2–8 недель, мобильные — 4–12 недель. Точный срок зависит от объёма функционала, готовности контента и скорости согласований.</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">В чём разница между веб и мобильной разработкой?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">Веб — это сайты и web-приложения в браузере. Мобайл — приложения для iOS/Android с публикацией в сторах и мобильными сценариями (push, permissions, нативные особенности).</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">Как мы общаемся во время проекта?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">Основная коммуникация — Telegram / WhatsApp / MAX, плюс почта для формализации договорённостей. Для синхронизаций проводим видео-встречи и созвоны по этапам.</div></div>
          </div>
          <div class="faq-item" data-faq>
            <button type="button" class="faq-q">Работаете по договору и этапной оплате?<span class="faq-switch"></span></button>
            <div class="faq-a"><div class="faq-a-inner">Да, можем работать по договору с поэтапной оплатой: фиксируем объём, сроки, стоимость этапов и критерии приёмки, чтобы обеим сторонам было прозрачно.</div></div>
          </div>
        </div>
        <div class="faq-cta">
          <p style="margin:0 0 16px;font-weight:500">Не нашли ответ?</p>
          <button type="button" class="btn-primary" style="margin-top:0">Напишите в мессенджер</button>
        </div>
      </section>
    </main>

    <footer class="wrap" id="contact">
      <div class="footer-card reveal">
        <div class="footer-inner">
          <div class="section-head" style="margin-bottom:24px">
            <span class="chip">Контакты</span>
            <h2 class="display-sm">На связи 24/7</h2>
            <p class="lead">Есть задача? Напишите в удобный канал — обычно отвечаю в течение 3–6 часов.</p>
          </div>
          <form class="contact-form" onsubmit="return false;">
            <div class="field"><input type="text" name="name" placeholder="Введите ваше имя" autocomplete="name" /></div>
            <div class="field"><input type="email" name="email" placeholder="Введите ваш email" autocomplete="email" /></div>
            <div class="field"><textarea name="message" placeholder="Ваше сообщение"></textarea></div>
            <button type="submit" class="btn-primary btn-send" style="margin-top:8px;width:100%" aria-label="Отправить">
              <span class="btn-label" aria-hidden="true">
                <span class="btn-text btn-text-default">Отправить</span>
                <span class="btn-text btn-text-hover">Отправляем</span>
              </span>
            </button>
          </form>
          <div class="contact-block">
            <p class="muted">Каналы связи</p>
            <p class="phone">Telegram: <a href="https://t.me/falroman" target="_blank" rel="noopener noreferrer">@falroman</a></p>
            <p class="mail">Email: <a href="mailto:falkin95@mail.ru">falkin95@mail.ru</a></p>
            <p class="muted" style="margin-top:10px">По согласованию провожу видео-встречи и созвоны по этапам проекта.</p>
            <div class="socials" style="justify-content:center;margin-top:20px">
              <a class="social" href="{{ $social->threads }}" @if($social->threads !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="Threads"><img src="{{ asset('assets/img/home/threads.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $social->instagram }}" @if($social->instagram !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="Инстаграм"><img src="{{ asset('assets/img/home/social-ig.svg') }}" alt="" width="24" height="24" /></a>
              <a class="social" href="{{ $social->linkedin }}" @if($social->linkedin !== '#') target="_blank" rel="noopener noreferrer" @endif aria-label="ЛинкедИн"><img src="{{ asset('assets/img/home/social-li.svg') }}" alt="" width="24" height="24" /></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">© 2024–2026 Фалькин Роман. Все права защищены.</div>
    </footer>

    <!-- About modal -->
    <div class="about-overlay" id="aboutOverlay" aria-modal="true" role="dialog" aria-label="О себе" hidden>
      <div class="about-backdrop"></div>
      <div class="about-card">
        <button class="about-close" id="aboutClose" aria-label="Закрыть">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
        </button>
        <div class="about-card-header">
          <div class="about-avatar">
            <img src="{{ asset('assets/img/main.png') }}" alt="Фалькин Роман" />
          </div>
          <div>
            <p class="about-name">Фалькин Роман</p>
            <p class="about-role">Web &amp; Mobile Developer</p>
          </div>
        </div>
        <div class="about-body-panel">
          <div class="about-body">
            <p class="about-greeting">👋 Привет, я Фалькин Роман.</p>
            <p class="about-desc">Я разработчик, который создаёт функциональные и визуально сильные цифровые продукты. Специализируюсь на веб и мобильной разработке — от идеи до продакшена, с фокусом на UX и измеримый бизнес-результат.</p>
            <div class="about-section">
              <h4 class="about-section-title">Опыт работы</h4>
              <ul class="about-list">
                <li><span class="about-emoji" aria-hidden="true">🔷</span>Fullstack Web Developer (2019 — наст. время)</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>React Native разработчик (2021 — наст. время)</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>Frontend Developer, Next.js (2022 — наст. время)</li>
                <li><span class="about-emoji" aria-hidden="true">🔷</span>MVP и прототипы для стартапов (2020 — наст. время)</li>
              </ul>
            </div>
            <div class="about-section">
              <h4 class="about-section-title">Образование</h4>
              <ul class="about-list">
                <li><span class="about-emoji about-emoji--edu" aria-hidden="true">🎓</span>МГУ — магистр «Руководитель проектов»</li>
                <li><span class="about-emoji about-emoji--edu" aria-hidden="true">🎓</span>Курсы: React, React Native, Node.js, Laravel, Docker, PostgreSQL</li>
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

    <nav class="bottom-dock" aria-label="Быстрая навигация">
      <div class="bottom-dock__links">
        <a class="bottom-dock__link" href="#top" aria-label="Главная" data-tooltip="Главная"><img src="{{ asset('assets/icons/bottom-bar/home.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#services" aria-label="Услуги" data-tooltip="Услуги"><img src="{{ asset('assets/icons/bottom-bar/services.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#projects" aria-label="Проекты" data-tooltip="Проекты"><img src="{{ asset('assets/icons/bottom-bar/projects.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#testimonials" aria-label="Отзывы" data-tooltip="Отзывы"><img src="{{ asset('assets/icons/bottom-bar/testimonials.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#toolkit" aria-label="Технологии" data-tooltip="Технологии"><img src="{{ asset('assets/icons/bottom-bar/toolkit.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="#faq" aria-label="FAQ" data-tooltip="Вопросы"><img src="{{ asset('assets/icons/bottom-bar/faq.svg') }}" alt="" /></a>
      </div>
      <a class="bottom-dock__cta" href="#pricing" aria-label="Смотреть стоимость" data-tooltip="Смотреть стоимость">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">Смотреть стоимость</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">К оценке</span>
        </span>
      </a>
    </nav>