@extends('admin.layout')

@section('title', 'Соцсети и бот')

@section('body')
<div class="admin-card">
  <h1>Ссылки на соцсети</h1>
  <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.9rem">Пустое поле — ссылка ведёт на «#». Threads и Instagram — разные URL (как в приложении Meta).</p>
  <form method="post" action="{{ route('admin.social.update') }}">
    @csrf
    @method('put')
    <div class="admin-field">
      <label for="social_threads_url">Threads</label>
      <input id="social_threads_url" type="url" name="social_threads_url" value="{{ old('social_threads_url', $settings->social_threads_url) }}" placeholder="https://www.threads.net/@..." />
      @error('social_threads_url')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="social_instagram_url">Instagram</label>
      <input id="social_instagram_url" type="url" name="social_instagram_url" value="{{ old('social_instagram_url', $settings->social_instagram_url) }}" placeholder="https://www.instagram.com/..." />
      @error('social_instagram_url')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="social_telegram_url">Telegram</label>
      <input id="social_telegram_url" type="url" name="social_telegram_url" value="{{ old('social_telegram_url', $settings->social_telegram_url) }}" placeholder="https://t.me/..." />
      @error('social_telegram_url')<div class="error">{{ $message }}</div>@enderror
    </div>

    <h2 style="margin:2rem 0 0.75rem;font-size:1.1rem">Уведомления о заявках (Telegram)</h2>
    <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.9rem">Формы «Контакты» и рассылки на сайте шлют сообщение в бот. Токен — у <a href="https://t.me/BotFather" target="_blank" rel="noopener noreferrer" style="color:#8ab4ff">@BotFather</a>. Chat ID — свой (например через <code style="opacity:.9">@userinfobot</code>) или ID группы/канала.</p>
    <div class="admin-field">
      <label for="telegram_bot_token">Токен бота</label>
      <input id="telegram_bot_token" type="password" name="telegram_bot_token" value="" autocomplete="new-password" placeholder="{{ $settings->telegram_bot_token ? '•••• оставьте пустым, чтобы не менять' : '123456789:AA...' }}" />
      @error('telegram_bot_token')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="telegram_chat_id">Chat ID</label>
      <input id="telegram_chat_id" type="text" name="telegram_chat_id" value="{{ old('telegram_chat_id', $settings->telegram_chat_id) }}" placeholder="-1001234567890 или @channel" />
      @error('telegram_chat_id')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
    </div>
  </form>
</div>
@endsection
