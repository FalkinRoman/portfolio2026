@extends('admin.layout')

@section('title', $mode === 'create' ? 'Новый проект' : 'Редактировать проект')

@section('body')
@php
  $featuresText = old('features_text', ($project->exists && $project->features) ? implode("\n", $project->features) : '');
  $featuresTextEn = old('features_text_en', ($project->exists && $project->features_en) ? implode("\n", $project->features_en) : '');
@endphp
<div class="admin-card">
  <h1>{{ $mode === 'create' ? 'Новый проект' : 'Редактировать: '.$project->name }}</h1>
  <form id="project-save" method="post" action="{{ $mode === 'create' ? route('admin.projects.store') : route('admin.projects.update', $project) }}" enctype="multipart/form-data">
    @csrf
    @if($mode === 'edit') @method('put') @endif

    <div class="admin-field">
      <label for="name">Название</label>
      <input id="name" type="text" name="name" value="{{ old('name', $project->name) }}" required />
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="slug">Slug (URL)</label>
      <input id="slug" type="text" name="slug" value="{{ old('slug', $project->slug) }}" placeholder="growly" />
      @error('slug')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="admin-field">
      <label for="tagline">Подзаголовок (hero)</label>
      <textarea id="tagline" name="tagline" rows="2">{{ old('tagline', $project->tagline) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="sort_order">Порядок сортировки</label>
      <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" />
    </div>
    <label class="admin-field" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer">
      <input type="hidden" name="is_published" value="0" />
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }} />
      <span style="color:rgba(255,255,255,.85)">Опубликован</span>
    </label>

    <h2 style="margin:1.5rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Мета (карточки кейса)</h2>
    <div class="admin-field">
      <label for="meta_client">Клиент</label>
      <input id="meta_client" type="text" name="meta_client" value="{{ old('meta_client', $project->meta_client) }}" />
    </div>
    <div class="admin-field">
      <label for="meta_service">Услуга (можно с переносом строки)</label>
      <textarea id="meta_service" name="meta_service" rows="2">{{ old('meta_service', $project->meta_service) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="meta_date">Дата</label>
      <input id="meta_date" type="text" name="meta_date" value="{{ old('meta_date', $project->meta_date) }}" />
    </div>

    <h2 style="margin:1.5rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Тексты обзора</h2>
    <div class="admin-field">
      <label for="overview_p1">Абзац 1</label>
      <textarea id="overview_p1" name="overview_p1" rows="4">{{ old('overview_p1', $project->overview_p1) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="overview_p2">Абзац 2</label>
      <textarea id="overview_p2" name="overview_p2" rows="4">{{ old('overview_p2', $project->overview_p2) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="features_text">Ключевые особенности (каждая строка — пункт списка)</label>
      <textarea id="features_text" name="features_text" rows="6">{{ $featuresText }}</textarea>
    </div>
    <div class="admin-field">
      <label for="overview_p3">Абзац после списка</label>
      <textarea id="overview_p3" name="overview_p3" rows="3">{{ old('overview_p3', $project->overview_p3) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="accent_line">Акцент (последняя строка)</label>
      <textarea id="accent_line" name="accent_line" rows="2">{{ old('accent_line', $project->accent_line) }}</textarea>
    </div>

    <h2 style="margin:1.5rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">English (на сайте при locale=en)</h2>
    <div class="admin-field">
      <label for="name_en">Title (EN)</label>
      <input id="name_en" type="text" name="name_en" value="{{ old('name_en', $project->name_en) }}" />
    </div>
    <div class="admin-field">
      <label for="tagline_en">Подзаголовок (EN)</label>
      <textarea id="tagline_en" name="tagline_en" rows="2">{{ old('tagline_en', $project->tagline_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="meta_client_en">Клиент (EN)</label>
      <input id="meta_client_en" type="text" name="meta_client_en" value="{{ old('meta_client_en', $project->meta_client_en) }}" />
    </div>
    <div class="admin-field">
      <label for="meta_service_en">Услуга (EN)</label>
      <textarea id="meta_service_en" name="meta_service_en" rows="2">{{ old('meta_service_en', $project->meta_service_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="meta_date_en">Дата (EN)</label>
      <input id="meta_date_en" type="text" name="meta_date_en" value="{{ old('meta_date_en', $project->meta_date_en) }}" />
    </div>
    <div class="admin-field">
      <label for="overview_p1_en">Абзац 1 (EN)</label>
      <textarea id="overview_p1_en" name="overview_p1_en" rows="4">{{ old('overview_p1_en', $project->overview_p1_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="overview_p2_en">Абзац 2 (EN)</label>
      <textarea id="overview_p2_en" name="overview_p2_en" rows="4">{{ old('overview_p2_en', $project->overview_p2_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="features_text_en">Ключевые особенности (EN), строка = пункт</label>
      <textarea id="features_text_en" name="features_text_en" rows="6">{{ $featuresTextEn }}</textarea>
    </div>
    <div class="admin-field">
      <label for="overview_p3_en">Абзац после списка (EN)</label>
      <textarea id="overview_p3_en" name="overview_p3_en" rows="3">{{ old('overview_p3_en', $project->overview_p3_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="accent_line_en">Акцент (EN)</label>
      <textarea id="accent_line_en" name="accent_line_en" rows="2">{{ old('accent_line_en', $project->accent_line_en) }}</textarea>
    </div>
    <div class="admin-field">
      <label for="seo_title_en">SEO title (EN), опционально</label>
      <input id="seo_title_en" type="text" name="seo_title_en" value="{{ old('seo_title_en', $project->seo_title_en) }}" />
    </div>
    <div class="admin-field">
      <label for="seo_description_en">SEO description (EN)</label>
      <textarea id="seo_description_en" name="seo_description_en" rows="2">{{ old('seo_description_en', $project->seo_description_en) }}</textarea>
    </div>

    <div class="admin-field">
      <label for="live_url">Ссылка «Посмотреть проект»</label>
      <input id="live_url" type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}" placeholder="https://..." />
    </div>

    <h2 style="margin:1.5rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Изображения</h2>
    <div class="admin-field">
      <label for="card_image">Превью в блоке «Проекты»</label>
      <input id="card_image" type="file" name="card_image" accept="image/*" />
      @if($project->card_image)<p style="font-size:0.8rem;opacity:.6;margin:0.25rem 0 0">Текущий файл: {{ $project->card_image }}</p>@endif
    </div>
    <div class="admin-field">
      <label for="logo_image">Логотип в шапке кейса</label>
      <input id="logo_image" type="file" name="logo_image" accept="image/*,.svg" />
      @if($project->logo_image)<p style="font-size:0.8rem;opacity:.6;margin:0.25rem 0 0">Текущий: {{ $project->logo_image }}</p>@endif
    </div>
    <div class="admin-field">
      <label for="banner_image">Баннер под заголовком</label>
      <input id="banner_image" type="file" name="banner_image" accept="image/*" />
      @if($project->banner_image)<p style="font-size:0.8rem;opacity:.6;margin:0.25rem 0 0">Текущий: {{ $project->banner_image }}</p>@endif
    </div>
    <div class="admin-field">
      <label for="gallery_images">Галерея (несколько файлов)</label>
      <input id="gallery_images" type="file" name="gallery_images[]" accept="image/*" multiple />
      @if($project->gallery_images && count($project->gallery_images))
        <p style="font-size:0.8rem;opacity:.6;margin:0.5rem 0 0">При загрузке новых файлы галереи заменяются целиком.</p>
      @endif
    </div>

    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
      <a class="btn-admin btn-admin--ghost" href="{{ route('admin.projects.index') }}">Назад</a>
    </div>
  </form>

  @if($mode === 'edit')
  <form method="post" action="{{ route('admin.projects.destroy', $project) }}" style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.1)" onsubmit="return confirm('Удалить проект безвозвратно?');">
    @csrf
    @method('delete')
    <button type="submit" class="btn-admin btn-admin--danger">Удалить проект</button>
  </form>
  @endif
</div>
@endsection
