@extends('admin.layout')

@section('title', $mode === 'create' ? 'Новый отзыв' : 'Редактировать отзыв')

@section('body')
<div class="admin-card">
  <h1>{{ $mode === 'create' ? 'Новый отзыв' : 'Редактировать: '.$review->name }}</h1>
  <form method="post" action="{{ $mode === 'create' ? route('admin.reviews.store') : route('admin.reviews.update', $review) }}" enctype="multipart/form-data">
    @csrf
    @if($mode === 'edit') @method('put') @endif

    <div class="admin-field">
      <label for="name">Имя</label>
      <input id="name" type="text" name="name" value="{{ old('name', $review->name) }}" required />
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="admin-field">
      <label for="role">Должность / компания</label>
      <input id="role" type="text" name="role" value="{{ old('role', $review->role) }}" placeholder="Генеральный директор, Медиа Ленд" />
    </div>

    <div class="admin-field">
      <label for="role_mobile">Должность (мобильная короткая)</label>
      <input id="role_mobile" type="text" name="role_mobile" value="{{ old('role_mobile', $review->role_mobile) }}" placeholder="Ген.директор МедиаЛэнд" />
    </div>

    <div class="admin-field">
      <label for="body">Текст отзыва</label>
      <textarea id="body" name="body" rows="6">{{ old('body', $review->body) }}</textarea>
    </div>

    <div class="admin-field">
      <label for="stars">Звёзды (1–5)</label>
      <input id="stars" type="number" name="stars" min="1" max="5" value="{{ old('stars', $review->stars ?? 5) }}" />
      @error('stars')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="admin-field">
      <label for="sort_order">Порядок сортировки</label>
      <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $review->sort_order ?? 0) }}" />
    </div>

    <label class="admin-field" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer">
      <input type="hidden" name="is_published" value="0" />
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $review->is_published ?? true) ? 'checked' : '' }} />
      <span style="color:rgba(255,255,255,.85)">Опубликован (в слайдере)</span>
    </label>

    <label class="admin-field" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer">
      <input type="hidden" name="show_in_avatars" value="0" />
      <input type="checkbox" name="show_in_avatars" value="1" {{ old('show_in_avatars', $review->show_in_avatars ?? true) ? 'checked' : '' }} />
      <span style="color:rgba(255,255,255,.85)">В стеке аватарок сверху («С кем уже работал»)</span>
    </label>

    <div class="admin-field">
      <label for="avatar_image">Фото / аватар</label>
      <input id="avatar_image" type="file" name="avatar_image" accept="image/*" />
      @error('avatar_image')<div class="error">{{ $message }}</div>@enderror
      @if($review->avatarUrl())
        <div class="admin-upload-preview" style="border-radius:999px">
          <img src="{{ $review->avatarUrl() }}" alt="" style="border-radius:999px;object-fit:cover;width:100%;height:100%" />
        </div>
      @endif
      <p class="admin-field__hint">Одна картинка идёт и в слайдер отзыва, и (если включено) в стек сверху.</p>
    </div>

    <h2 style="margin:1.5rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">English</h2>
    <div class="admin-field">
      <label for="name_en">Name (EN)</label>
      <input id="name_en" type="text" name="name_en" value="{{ old('name_en', $review->name_en) }}" />
    </div>
    <div class="admin-field">
      <label for="role_en">Role (EN)</label>
      <input id="role_en" type="text" name="role_en" value="{{ old('role_en', $review->role_en) }}" />
    </div>
    <div class="admin-field">
      <label for="role_mobile_en">Role mobile (EN)</label>
      <input id="role_mobile_en" type="text" name="role_mobile_en" value="{{ old('role_mobile_en', $review->role_mobile_en) }}" />
    </div>
    <div class="admin-field">
      <label for="body_en">Review text (EN)</label>
      <textarea id="body_en" name="body_en" rows="6">{{ old('body_en', $review->body_en) }}</textarea>
    </div>

    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
      <a class="btn-admin btn-admin--ghost" href="{{ route('admin.reviews.index') }}">Отмена</a>
    </div>
  </form>
</div>
@endsection
