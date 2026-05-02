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

    <nav class="bottom-dock" aria-label="Быстрая навигация">
      <div class="bottom-dock__links">
        <a class="bottom-dock__link" href="{{ route('home') }}#top" aria-label="Главная" data-tooltip="Главная"><img src="{{ asset('assets/icons/bottom-bar/home.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#services" aria-label="Услуги" data-tooltip="Услуги"><img src="{{ asset('assets/icons/bottom-bar/services.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#projects" aria-label="Проекты" data-tooltip="Проекты"><img src="{{ asset('assets/icons/bottom-bar/projects.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#testimonials" aria-label="Отзывы" data-tooltip="Отзывы"><img src="{{ asset('assets/icons/bottom-bar/testimonials.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#toolkit" aria-label="Технологии" data-tooltip="Технологии"><img src="{{ asset('assets/icons/bottom-bar/toolkit.svg') }}" alt="" /></a>
        <a class="bottom-dock__link" href="{{ route('home') }}#faq" aria-label="FAQ" data-tooltip="Вопросы"><img src="{{ asset('assets/icons/bottom-bar/faq.svg') }}" alt="" /></a>
      </div>
      <a class="bottom-dock__cta" href="{{ route('home') }}#pricing" aria-label="Смотреть стоимость" data-tooltip="Смотреть стоимость">
        <span class="bottom-dock__cta-label" aria-hidden="true">
          <span class="bottom-dock__cta-text bottom-dock__cta-text-default">Смотреть стоимость</span>
          <span class="bottom-dock__cta-text bottom-dock__cta-text-hover">К оценке</span>
        </span>
      </a>
    </nav>
