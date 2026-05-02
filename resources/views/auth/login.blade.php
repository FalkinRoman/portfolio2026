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
            <input id="password" type="password" name="password" required autocomplete="current-password" />
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
</x-guest-layout>
