@extends('admin.layout')

@section('title', 'Контент сайта')

@section('body')
@php
  $tabLabels = [
    'services' => 'Услуги',
    'process' => 'Процесс',
    'pricing' => 'Стоимость',
    'toolkit' => 'Стек',
    'studio' => 'Студия / Noi',
    'faq' => 'FAQ',
    'footer' => 'Контакты (тексты)',
    'about' => 'О себе',
    'projects_chrome' => 'Проекты (заголовки)',
  ];
@endphp
<div class="admin-card">
  <h1>Контент главной</h1>
  <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.875rem">Редактируй секции без правки кода. Локаль: RU / EN отдельно.</p>

  <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:1rem">
    <a class="btn-admin {{ $locale === 'ru' ? '' : 'btn-admin--ghost' }}" href="{{ route('admin.content.edit', ['tab' => $tab, 'locale' => 'ru']) }}">RU</a>
    <a class="btn-admin {{ $locale === 'en' ? '' : 'btn-admin--ghost' }}" href="{{ route('admin.content.edit', ['tab' => $tab, 'locale' => 'en']) }}">EN</a>
  </div>

  <div style="display:flex;flex-wrap:wrap;gap:0.45rem;margin-bottom:1.25rem">
    @foreach($tabs as $t)
      <a href="{{ route('admin.content.edit', ['tab' => $t, 'locale' => $locale]) }}"
         style="padding:0.35rem 0.7rem;border-radius:8px;text-decoration:none;font-size:0.82rem;border:1px solid rgba(255,255,255,.15);color:{{ $tab === $t ? '#fff' : 'rgba(255,255,255,.65)' }};background:{{ $tab === $t ? 'rgba(99,102,241,.35)' : 'transparent' }}">
        {{ $tabLabels[$t] ?? $t }}
      </a>
    @endforeach
  </div>

  <form method="post" action="{{ route('admin.content.update') }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="hidden" name="tab" value="{{ $tab }}" />
    <input type="hidden" name="locale" value="{{ $locale }}" />

    @if(in_array($tab, ['services','process','pricing','toolkit','studio','faq','footer','projects_chrome'], true))
      <div class="admin-field">
        <label>Chip</label>
        <input type="text" name="chip" value="{{ old('chip', $section['chip'] ?? '') }}" />
      </div>
      <div class="admin-field">
        <label>Заголовок (можно с переносом строки)</label>
        <textarea name="h2" rows="2">{{ old('h2', $section['h2'] ?? '') }}</textarea>
      </div>
      <div class="admin-field">
        <label>Подзаголовок / lead</label>
        <textarea name="lead" rows="2">{{ old('lead', $section['lead'] ?? '') }}</textarea>
      </div>
    @endif

    @if($tab === 'services')
      <h2 style="margin:1.25rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Карточки услуг (3 картинки = папка)</h2>
      @foreach(($section['items'] ?? []) as $i => $item)
        <div class="admin-card" style="background:rgba(0,0,0,.25);margin-bottom:1rem">
          <div class="admin-field">
            <label>Название #{{ $i + 1 }}</label>
            <input type="text" name="items[{{ $i }}][title]" value="{{ $item['title'] ?? '' }}" />
          </div>
          @for($n = 0; $n < 3; $n++)
            <div class="admin-field">
              <label>Картинка {{ $n + 1 }}</label>
              <input type="file" name="items[{{ $i }}][image_{{ $n }}]" accept="image/*" />
              @php($img = \App\Support\Cms::mediaUrl($item['images'][$n] ?? null))
              @if($img)
                <div class="admin-upload-preview"><img src="{{ $img }}" alt="" /></div>
              @endif
            </div>
          @endfor
        </div>
      @endforeach
      @php($next = count($section['items'] ?? []))
      <div class="admin-card" style="background:rgba(0,0,0,.25)">
        <p style="color:rgba(255,255,255,.55);margin:0 0 0.75rem">Добавить карточку</p>
        <div class="admin-field">
          <label>Название</label>
          <input type="text" name="items[{{ $next }}][title]" value="" placeholder="Новая услуга" />
        </div>
        @for($n = 0; $n < 3; $n++)
          <div class="admin-field">
            <label>Картинка {{ $n + 1 }}</label>
            <input type="file" name="items[{{ $next }}][image_{{ $n }}]" accept="image/*" />
          </div>
        @endfor
      </div>
    @endif

    @if($tab === 'process')
      <h2 style="margin:1.25rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Шаги</h2>
      @foreach(($section['steps'] ?? []) as $i => $step)
        <div class="admin-card" style="background:rgba(0,0,0,.25);margin-bottom:0.75rem">
          <div class="admin-field"><label>Метка</label><input type="text" name="steps[{{ $i }}][h]" value="{{ $step['h'] ?? '' }}" /></div>
          <div class="admin-field"><label>Заголовок</label><input type="text" name="steps[{{ $i }}][t]" value="{{ $step['t'] ?? '' }}" /></div>
          <div class="admin-field"><label>Текст</label><textarea name="steps[{{ $i }}][p]" rows="3">{{ $step['p'] ?? '' }}</textarea></div>
        </div>
      @endforeach
      @php($ni = count($section['steps'] ?? []))
      <div class="admin-card" style="background:rgba(0,0,0,.25)">
        <p style="color:rgba(255,255,255,.55)">Новый шаг</p>
        <div class="admin-field"><label>Метка</label><input type="text" name="steps[{{ $ni }}][h]" /></div>
        <div class="admin-field"><label>Заголовок</label><input type="text" name="steps[{{ $ni }}][t]" /></div>
        <div class="admin-field"><label>Текст</label><textarea name="steps[{{ $ni }}][p]" rows="3"></textarea></div>
      </div>
    @endif

    @if($tab === 'pricing')
      <div class="admin-field">
        <label>Текст кнопки «Обсудить»</label>
        <input type="text" name="discuss" value="{{ old('discuss', $section['discuss'] ?? '') }}" />
      </div>
      <h2 style="margin:1.25rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Планы (2–4 вкладки)</h2>
      @foreach(($section['plans'] ?? []) as $i => $plan)
        <div class="admin-card" style="background:rgba(0,0,0,.25);margin-bottom:0.75rem">
          <div class="admin-field"><label>Key (web/mobile/…)</label><input type="text" name="plans[{{ $i }}][key]" value="{{ $plan['key'] ?? '' }}" /></div>
          <div class="admin-field"><label>Вкладка</label><input type="text" name="plans[{{ $i }}][tab]" value="{{ $plan['tab'] ?? '' }}" /></div>
          <div class="admin-field"><label>Title</label><input type="text" name="plans[{{ $i }}][title]" value="{{ $plan['title'] ?? '' }}" /></div>
          <div class="admin-field"><label>Sub</label><textarea name="plans[{{ $i }}][sub]" rows="2">{{ $plan['sub'] ?? '' }}</textarea></div>
          <div class="admin-field"><label>Highlight</label><textarea name="plans[{{ $i }}][hi]" rows="2">{{ $plan['hi'] ?? '' }}</textarea></div>
          <div class="admin-field"><label>Цена HTML</label><input type="text" name="plans[{{ $i }}][price_html]" value="{{ $plan['price_html'] ?? '' }}" /></div>
          <div class="admin-field"><label>Пункты (по строке)</label><textarea name="plans[{{ $i }}][points_text]" rows="6">{{ implode("\n", $plan['points'] ?? []) }}</textarea></div>
        </div>
      @endforeach
      @php($pi = count($section['plans'] ?? []))
      @if($pi < 4)
      <div class="admin-card" style="background:rgba(0,0,0,.25)">
        <p style="color:rgba(255,255,255,.55)">Добавить план</p>
        <div class="admin-field"><label>Key</label><input type="text" name="plans[{{ $pi }}][key]" /></div>
        <div class="admin-field"><label>Вкладка</label><input type="text" name="plans[{{ $pi }}][tab]" /></div>
        <div class="admin-field"><label>Title</label><input type="text" name="plans[{{ $pi }}][title]" /></div>
        <div class="admin-field"><label>Sub</label><textarea name="plans[{{ $pi }}][sub]" rows="2"></textarea></div>
        <div class="admin-field"><label>Highlight</label><textarea name="plans[{{ $pi }}][hi]" rows="2"></textarea></div>
        <div class="admin-field"><label>Цена HTML</label><input type="text" name="plans[{{ $pi }}][price_html]" /></div>
        <div class="admin-field"><label>Пункты</label><textarea name="plans[{{ $pi }}][points_text]" rows="4"></textarea></div>
      </div>
      @endif
    @endif

    @if($tab === 'toolkit')
      <h2 style="margin:1.25rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Технологии</h2>
      @foreach(($section['items'] ?? []) as $i => $item)
        <div class="admin-card" style="background:rgba(0,0,0,.25);margin-bottom:0.75rem">
          <div class="admin-field"><label>Название</label><input type="text" name="items[{{ $i }}][name]" value="{{ $item['name'] ?? '' }}" /></div>
          <div class="admin-field"><label>Описание</label><input type="text" name="items[{{ $i }}][desc]" value="{{ $item['desc'] ?? '' }}" /></div>
          <div class="admin-field"><label>%</label><input type="number" name="items[{{ $i }}][pct]" min="0" max="100" value="{{ $item['pct'] ?? 0 }}" /></div>
          <div class="admin-field"><label>Icon path (или файл ниже)</label><input type="text" name="items[{{ $i }}][icon]" value="{{ $item['icon'] ?? '' }}" /></div>
          <div class="admin-field"><label>Загрузить иконку</label><input type="file" name="items[{{ $i }}][icon_file]" accept="image/*,.svg" /></div>
          @php($ic = \App\Support\Cms::mediaUrl($item['icon'] ?? null))
          @if($ic)<div class="admin-upload-preview"><img src="{{ $ic }}" alt="" /></div>@endif
        </div>
      @endforeach
      @php($ti = count($section['items'] ?? []))
      <div class="admin-card" style="background:rgba(0,0,0,.25)">
        <p style="color:rgba(255,255,255,.55)">Новый блок</p>
        <div class="admin-field"><label>Название</label><input type="text" name="items[{{ $ti }}][name]" /></div>
        <div class="admin-field"><label>Описание</label><input type="text" name="items[{{ $ti }}][desc]" /></div>
        <div class="admin-field"><label>%</label><input type="number" name="items[{{ $ti }}][pct]" value="80" /></div>
        <div class="admin-field"><label>Icon path</label><input type="text" name="items[{{ $ti }}][icon]" value="assets/icons/stack/react.svg" /></div>
        <div class="admin-field"><label>Файл</label><input type="file" name="items[{{ $ti }}][icon_file]" accept="image/*,.svg" /></div>
      </div>
    @endif

    @if($tab === 'studio')
      <div class="admin-field"><label>Role line</label><input type="text" name="role_line" value="{{ old('role_line', $section['role_line'] ?? '') }}" /></div>
      <div class="admin-field"><label>Текст</label><textarea name="body" rows="5">{{ old('body', $section['body'] ?? '') }}</textarea></div>
      <div class="admin-field"><label>Кнопка PDF (открыть во вкладке)</label><input type="text" name="cta_label" value="{{ old('cta_label', $section['cta_label'] ?? '') }}" /></div>
      <p style="color:rgba(255,255,255,.55);font-size:0.85rem">Лого и PDF загружаются в <a href="{{ route('admin.social.edit') }}" style="color:#a5b4fc">Контакты / студия</a>.</p>
    @endif

    @if($tab === 'faq')
      <div class="admin-field"><label>Текст под аккордеоном</label><input type="text" name="more_q" value="{{ old('more_q', $section['more_q'] ?? '') }}" /></div>
      <div class="admin-field"><label>Кнопка мессенджера</label><input type="text" name="write" value="{{ old('write', $section['write'] ?? '') }}" /></div>
      <h2 style="margin:1.25rem 0 0.75rem;font-size:1rem;color:rgba(255,255,255,.7)">Вопросы</h2>
      @foreach(($section['items'] ?? []) as $i => $item)
        <div class="admin-card" style="background:rgba(0,0,0,.25);margin-bottom:0.75rem">
          <div class="admin-field"><label>Q</label><input type="text" name="items[{{ $i }}][q]" value="{{ $item['q'] ?? '' }}" /></div>
          <div class="admin-field"><label>A</label><textarea name="items[{{ $i }}][a]" rows="3">{{ $item['a'] ?? '' }}</textarea></div>
        </div>
      @endforeach
      @php($fi = count($section['items'] ?? []))
      <div class="admin-card" style="background:rgba(0,0,0,.25)">
        <p style="color:rgba(255,255,255,.55)">Новый вопрос</p>
        <div class="admin-field"><label>Q</label><input type="text" name="items[{{ $fi }}][q]" /></div>
        <div class="admin-field"><label>A</label><textarea name="items[{{ $fi }}][a]" rows="3"></textarea></div>
      </div>
    @endif

    @if($tab === 'footer')
      <div class="admin-field"><label>Channels label</label><input type="text" name="channels" value="{{ old('channels', $section['channels'] ?? '') }}" /></div>
      <div class="admin-field"><label>Meetings</label><textarea name="meetings" rows="2">{{ old('meetings', $section['meetings'] ?? '') }}</textarea></div>
      <div class="admin-field"><label>Copyright</label><input type="text" name="copy" value="{{ old('copy', $section['copy'] ?? '') }}" /></div>
    @endif

    @if($tab === 'about')
      <div class="admin-field"><label>Role</label><input type="text" name="role" value="{{ old('role', $section['role'] ?? '') }}" /></div>
      <div class="admin-field"><label>Приветствие</label><input type="text" name="hi" value="{{ old('hi', $section['hi'] ?? '') }}" /></div>
      <div class="admin-field"><label>Описание</label><textarea name="desc" rows="4">{{ old('desc', $section['desc'] ?? '') }}</textarea></div>
      <div class="admin-field"><label>Заголовок опыта</label><input type="text" name="exp_h" value="{{ old('exp_h', $section['exp_h'] ?? '') }}" /></div>
      <div class="admin-field"><label>Опыт (по строке)</label><textarea name="exp_text" rows="5">{{ implode("\n", $section['exp'] ?? []) }}</textarea></div>
      <div class="admin-field"><label>Заголовок образования</label><input type="text" name="edu_h" value="{{ old('edu_h', $section['edu_h'] ?? '') }}" /></div>
      <div class="admin-field"><label>Образование (по строке)</label><textarea name="edu_text" rows="3">{{ implode("\n", $section['edu'] ?? []) }}</textarea></div>
    @endif

    <div class="admin-actions">
      <button type="submit" class="btn-admin">Сохранить</button>
    </div>
  </form>
</div>
@endsection
