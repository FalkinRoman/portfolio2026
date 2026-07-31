<x-guest-layout>
    @if (session('status'))
        <div class="auth-status" role="status">{{ session('status') }}</div>
    @endif

    <h1>Вход в админку</h1>
    <p class="lead">Портфолио Фалькин Роман</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div class="auth-field">
            <label for="password">Пароль</label>
            <div class="auth-password-wrap">
                <input id="password" class="auth-password-input" type="password" name="password" required autocomplete="current-password" />
                <button type="button" class="auth-password-toggle" id="password-toggle" aria-label="Показать пароль" aria-pressed="false" title="Показать пароль">
                    <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 3l18 18"/>
                        <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                        <path d="M9.9 5.1A10.4 10.4 0 0 1 12 5c6.5 0 10 7 10 7a18.5 18.5 0 0 1-2.2 3.1"/>
                        <path d="M6.1 6.1C3.7 7.8 2 12 2 12s3.5 7 10 7a10.3 10.3 0 0 0 4.3-.9"/>
                    </svg>
                </button>
            </div>
            @error('password')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div class="auth-remember">
            <input id="remember_me" type="checkbox" name="remember" />
            <label for="remember_me" style="cursor:pointer;margin:0">Запомнить</label>
        </div>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Забыли пароль?</a>
            @else
                <span></span>
            @endif
            <button type="submit" class="auth-submit">Войти</button>
        </div>
    </form>

    <script>
        (() => {
            const input = document.getElementById('password');
            const btn = document.getElementById('password-toggle');
            if (!input || !btn) return;
            btn.addEventListener('click', () => {
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.classList.toggle('is-visible', show);
                btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                btn.setAttribute('aria-label', show ? 'Скрыть пароль' : 'Показать пароль');
                btn.title = show ? 'Скрыть пароль' : 'Показать пароль';
            });
        })();
    </script>
</x-guest-layout>
