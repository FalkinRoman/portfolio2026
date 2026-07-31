@extends('admin.layout')

@section('title', 'Контакты / студия')

@section('body')
<div class="admin-card">
  <h1>Контакты и студия Noi</h1>
  <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.9rem">Форм сбора ПДн на сайте нет (152‑ФЗ). Только исходящие ссылки: Telegram, WhatsApp, email, телефон.</p>
  <form method="post" action="{{ route('admin.social.update') }}" enctype="multipart/form-data">
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
      <input id="social_telegram_url" type="url" name="social_telegram_url" value="{{ old('social_telegram_url', $settings->social_telegram_url) }}" placeholder="https://t.me/falroman" />
      @error('social_telegram_url')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="social_whatsapp_url">WhatsApp</label>
      <input id="social_whatsapp_url" type="url" name="social_whatsapp_url" value="{{ old('social_whatsapp_url', $settings->social_whatsapp_url) }}" placeholder="https://wa.me/79..." />
      @error('social_whatsapp_url')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="contact_email">Email (mailto)</label>
      <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" placeholder="falkin95@mail.ru" />
      @error('contact_email')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="contact_phone">Телефон (опционально, tel:)</label>
      <input id="contact_phone" type="text" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" placeholder="+7 ..." />
      @error('contact_phone')<div class="error">{{ $message }}</div>@enderror
    </div>

    <h2 style="margin:2rem 0 0.75rem;font-size:1.1rem">Лого и презентация Noi</h2>
    <div class="admin-field">
      <label for="studio_logo">Лого (круг на сайте)</label>
      <input id="studio_logo" type="file" name="studio_logo" accept="image/*" />
      <div class="admin-upload-preview" style="border-radius:999px;margin-top:0.6rem">
        <img src="{{ $settings->logoUrl() }}" alt="" style="border-radius:999px;object-fit:cover;width:100%;height:100%" />
      </div>
    </div>
    <div class="admin-field">
      <label for="studio_presentation">PDF презентация</label>
      <input id="studio_presentation" type="file" name="studio_presentation" accept="application/pdf" />
      <p class="admin-field__hint"><a href="{{ $settings->presentationUrl() }}" target="_blank" rel="noopener" style="color:#a5b4fc">Текущий файл →</a></p>
    </div>

    <h2 style="margin:2rem 0 0.75rem;font-size:1.1rem">Telegram-бот (необязательно)</h2>
    <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.9rem">Публичных форм заявок больше нет. Поля можно оставить пустыми.</p>
    <div class="admin-field">
      <label for="telegram_bot_token">Токен бота</label>
      <input id="telegram_bot_token" type="password" name="telegram_bot_token" value="" autocomplete="new-password" placeholder="{{ $settings->telegram_bot_token ? '•••• оставьте пустым, чтобы не менять' : '123456789:AA...' }}" />
    </div>
    <div class="admin-field">
      <label for="telegram_chat_id">Chat ID</label>
      <input id="telegram_chat_id" type="text" name="telegram_chat_id" value="{{ old('telegram_chat_id', $settings->telegram_chat_id) }}" />
    </div>

    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
    </div>
  </form>
</div>
@endsection
