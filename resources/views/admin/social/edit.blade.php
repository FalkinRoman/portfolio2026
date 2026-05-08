@extends('admin.layout')

@section('title', 'Соцсети')

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
    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
    </div>
  </form>
</div>
@endsection
