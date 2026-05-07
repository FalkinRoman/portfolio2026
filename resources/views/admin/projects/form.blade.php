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
      @if($project->publicUrl($project->card_image))
        <div class="admin-upload-preview">
          <img src="{{ $project->publicUrl($project->card_image) }}" alt="" width="88" height="88" loading="lazy" decoding="async" />
        </div>
        <p class="admin-field__hint">Текущий файл: {{ $project->card_image }}</p>
      @endif
    </div>
    <div class="admin-field">
      <label for="logo_image">Логотип в шапке кейса</label>
      <input id="logo_image" type="file" name="logo_image" accept="image/*,.svg" />
      <p class="admin-field__hint">После выбора откроется круговой кроппер: перетаскивай и масштабируй область логотипа.</p>
      @if($project->publicUrl($project->logo_image))
        <div class="admin-upload-preview">
          <img id="logoPreviewImage" src="{{ $project->publicUrl($project->logo_image) }}" alt="" width="88" height="88" loading="lazy" decoding="async" />
        </div>
        <p class="admin-field__hint">Текущий файл: {{ $project->logo_image }}</p>
      @endif
    </div>
    <div class="admin-field">
      <label for="banner_image">Баннер под заголовком</label>
      <input id="banner_image" type="file" name="banner_image" accept="image/*" />
      @if($project->publicUrl($project->banner_image))
        <div class="admin-upload-preview">
          <img src="{{ $project->publicUrl($project->banner_image) }}" alt="" width="88" height="88" loading="lazy" decoding="async" />
        </div>
        <p class="admin-field__hint">Текущий файл: {{ $project->banner_image }}</p>
      @endif
    </div>
    <div class="admin-field">
      <label for="gallery_images">Галерея (несколько файлов)</label>
      <input id="gallery_images" type="file" name="gallery_images[]" accept="image/*" multiple />
      @if($project->gallery_images && count($project->gallery_images))
        <div class="admin-gallery-sort" data-gallery-sort>
          @foreach($project->gallery_images as $gPath)
            @if($project->publicUrl($gPath))
              <div class="admin-gallery-item" draggable="true" data-gallery-item>
                <input type="hidden" name="gallery_existing_order[]" value="{{ $gPath }}" data-gallery-order />
                <input type="hidden" name="gallery_remove[]" value="{{ $gPath }}" disabled data-gallery-remove />
                <img src="{{ $project->publicUrl($gPath) }}" alt="" loading="lazy" decoding="async" />
                <button class="admin-gallery-item__remove" type="button" data-gallery-remove-toggle aria-label="Убрать фото">✕</button>
                <span class="admin-gallery-item__drag" aria-hidden="true">↕</span>
              </div>
            @endif
          @endforeach
        </div>
        <p class="admin-field__hint">Перетаскивай карточки, чтобы менять очередь показа. Кнопка ✕ помечает фото на удаление. Новые фото добавляются в конец.</p>
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

<div class="admin-modal" id="logoCropModal" aria-hidden="true">
  <div class="admin-modal__card" role="dialog" aria-modal="true" aria-labelledby="logoCropTitle">
    <h3 class="admin-modal__title" id="logoCropTitle">Обрезка логотипа</h3>
    <p class="admin-modal__sub">Выбери область внутри круга. На сайте логотип будет показан в круглой маске.</p>
    <div class="admin-cropper">
      <canvas id="logoCropCanvas" width="420" height="420"></canvas>
    </div>
    <div class="admin-cropper__controls">
      <label for="logoCropZoom">Масштаб</label>
      <input id="logoCropZoom" type="range" min="100" max="300" step="1" value="100" />
    </div>
    <div class="admin-modal__actions">
      <button type="button" class="btn-admin btn-admin--ghost" id="logoCropCancel">Отмена</button>
      <button type="button" class="btn-admin" id="logoCropApply">Применить</button>
    </div>
  </div>
</div>

<script>
  (function () {
    var input = document.getElementById('logo_image');
    var modal = document.getElementById('logoCropModal');
    var canvas = document.getElementById('logoCropCanvas');
    var zoom = document.getElementById('logoCropZoom');
    var applyBtn = document.getElementById('logoCropApply');
    var cancelBtn = document.getElementById('logoCropCancel');
    if (!input || !modal || !canvas || !zoom || !applyBtn || !cancelBtn || !window.FileReader) return;

    var ctx = canvas.getContext('2d');
    var preview = document.getElementById('logoPreviewImage');
    var img = null;
    var objectUrl = null;
    var cropR = 146;
    var cropCx = canvas.width / 2;
    var cropCy = canvas.height / 2;
    var baseScale = 1;
    var scale = 1;
    var offsetX = 0;
    var offsetY = 0;
    var drag = { active: false, x: 0, y: 0 };
    var lastFileName = 'logo.png';

    function openModal() {
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      canvas.classList.remove('is-dragging');
    }

    function clamp(v, min, max) {
      return Math.min(max, Math.max(min, v));
    }

    function normalizeOffset() {
      if (!img) return;
      var drawW = img.width * scale;
      var drawH = img.height * scale;
      var minX = cropCx + cropR - drawW;
      var maxX = cropCx - cropR;
      var minY = cropCy + cropR - drawH;
      var maxY = cropCy - cropR;
      if (drawW < cropR * 2) {
        offsetX = cropCx - drawW / 2;
      } else {
        offsetX = clamp(offsetX, minX, maxX);
      }
      if (drawH < cropR * 2) {
        offsetY = cropCy - drawH / 2;
      } else {
        offsetY = clamp(offsetY, minY, maxY);
      }
    }

    function render() {
      if (!ctx) return;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.fillStyle = '#080b11';
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      if (img) {
        ctx.save();
        ctx.translate(offsetX, offsetY);
        ctx.scale(scale, scale);
        ctx.drawImage(img, 0, 0);
        ctx.restore();
      }

      ctx.fillStyle = 'rgba(0, 0, 0, 0.56)';
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      ctx.globalCompositeOperation = 'destination-out';
      ctx.beginPath();
      ctx.arc(cropCx, cropCy, cropR, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalCompositeOperation = 'source-over';

      ctx.strokeStyle = 'rgba(255,255,255,0.94)';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(cropCx, cropCy, cropR, 0, Math.PI * 2);
      ctx.stroke();
    }

    function initFromImage() {
      if (!img) return;
      baseScale = Math.max((cropR * 2) / img.width, (cropR * 2) / img.height);
      scale = baseScale;
      zoom.value = 100;
      offsetX = cropCx - (img.width * scale) / 2;
      offsetY = cropCy - (img.height * scale) / 2;
      normalizeOffset();
      render();
    }

    function applyCrop() {
      if (!img) return;
      var outSize = 512;
      var out = document.createElement('canvas');
      out.width = outSize;
      out.height = outSize;
      var outCtx = out.getContext('2d');
      var srcSize = (cropR * 2) / scale;
      var srcX = (cropCx - cropR - offsetX) / scale;
      var srcY = (cropCy - cropR - offsetY) / scale;
      outCtx.drawImage(img, srcX, srcY, srcSize, srcSize, 0, 0, outSize, outSize);

      out.toBlob(function (blob) {
        if (!blob) return;
        var dt = new DataTransfer();
        var safe = (lastFileName || 'logo').replace(/\.[a-z0-9]+$/i, '');
        var file = new File([blob], safe + '-crop.png', { type: 'image/png' });
        dt.items.add(file);
        input.files = dt.files;
        if (preview) {
          preview.src = URL.createObjectURL(blob);
        }
        closeModal();
      }, 'image/png', 0.96);
    }

    input.addEventListener('change', function () {
      var file = input.files && input.files[0] ? input.files[0] : null;
      if (!file) return;
      if (!/^image\//.test(file.type)) return;
      lastFileName = file.name || 'logo.png';
      if (objectUrl) URL.revokeObjectURL(objectUrl);
      objectUrl = URL.createObjectURL(file);
      img = new Image();
      img.onload = function () {
        initFromImage();
        openModal();
      };
      img.src = objectUrl;
    });

    zoom.addEventListener('input', function () {
      if (!img) return;
      var prevScale = scale;
      scale = baseScale * (Number(zoom.value) / 100);
      var centerX = cropCx;
      var centerY = cropCy;
      offsetX = centerX - ((centerX - offsetX) / prevScale) * scale;
      offsetY = centerY - ((centerY - offsetY) / prevScale) * scale;
      normalizeOffset();
      render();
    });

    canvas.addEventListener('pointerdown', function (e) {
      if (!img) return;
      drag.active = true;
      drag.x = e.clientX;
      drag.y = e.clientY;
      canvas.classList.add('is-dragging');
      canvas.setPointerCapture(e.pointerId);
    });

    canvas.addEventListener('pointermove', function (e) {
      if (!drag.active || !img) return;
      var dx = e.clientX - drag.x;
      var dy = e.clientY - drag.y;
      drag.x = e.clientX;
      drag.y = e.clientY;
      offsetX += dx;
      offsetY += dy;
      normalizeOffset();
      render();
    });

    function endDrag(e) {
      drag.active = false;
      canvas.classList.remove('is-dragging');
      if (e && e.pointerId !== undefined && canvas.hasPointerCapture(e.pointerId)) {
        canvas.releasePointerCapture(e.pointerId);
      }
    }

    canvas.addEventListener('pointerup', endDrag);
    canvas.addEventListener('pointercancel', endDrag);
    canvas.addEventListener('wheel', function (e) {
      if (!img) return;
      e.preventDefault();
      var z = Number(zoom.value) + (e.deltaY < 0 ? 4 : -4);
      zoom.value = String(clamp(z, 100, 300));
      zoom.dispatchEvent(new Event('input'));
    }, { passive: false });

    applyBtn.addEventListener('click', applyCrop);
    cancelBtn.addEventListener('click', function () {
      input.value = '';
      closeModal();
    });
  })();

  (function () {
    var gallery = document.querySelector('[data-gallery-sort]');
    if (!gallery) return;

    var dragItem = null;

    function updateOrderInputs() {
      gallery.querySelectorAll('[data-gallery-item]').forEach(function (item) {
        var orderInput = item.querySelector('[data-gallery-order]');
        if (!orderInput) return;
        orderInput.disabled = item.classList.contains('is-removed');
      });
    }

    gallery.querySelectorAll('[data-gallery-remove-toggle]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var item = btn.closest('[data-gallery-item]');
        if (!item) return;
        var removeInput = item.querySelector('[data-gallery-remove]');
        var removed = !item.classList.contains('is-removed');
        item.classList.toggle('is-removed', removed);
        if (removeInput) removeInput.disabled = !removed;
        btn.textContent = removed ? '↺' : '✕';
        btn.setAttribute('aria-label', removed ? 'Вернуть фото' : 'Убрать фото');
        updateOrderInputs();
      });
    });

    gallery.querySelectorAll('[data-gallery-item]').forEach(function (item) {
      item.addEventListener('dragstart', function () {
        if (item.classList.contains('is-removed')) return;
        dragItem = item;
        item.classList.add('is-dragging');
      });

      item.addEventListener('dragend', function () {
        item.classList.remove('is-dragging');
        dragItem = null;
      });

      item.addEventListener('dragover', function (e) {
        if (!dragItem || dragItem === item || item.classList.contains('is-removed')) return;
        e.preventDefault();
        var rect = item.getBoundingClientRect();
        var before = e.clientX < rect.left + rect.width / 2;
        if (before) {
          gallery.insertBefore(dragItem, item);
        } else {
          gallery.insertBefore(dragItem, item.nextSibling);
        }
      });
    });
  })();
</script>
@endsection
