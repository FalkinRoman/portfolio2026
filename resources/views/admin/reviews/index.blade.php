@extends('admin.layout')

@section('title', 'Отзывы')

@section('body')
<div class="admin-card">
  <div style="display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:space-between;margin-bottom:1rem">
    <h1 style="margin:0">Отзывы</h1>
    <a class="btn-admin" href="{{ route('admin.reviews.create') }}">Добавить</a>
  </div>
  <p style="margin:0 0 1rem;color:rgba(255,255,255,.55);font-size:0.875rem">
    Аватарки с флагом «В стеке сверху» попадают в блок «С кем уже работал». Карточка отзыва — слайдер ниже.
  </p>
  <table class="admin-table">
    <thead>
      <tr>
        <th></th>
        <th>Имя</th>
        <th>★</th>
        <th>Порядок</th>
        <th>Стек</th>
        <th>На сайте</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($reviews as $r)
      <tr>
        <td style="width:48px">
          @if($r->avatarUrl())
            <img src="{{ $r->avatarUrl() }}" alt="" width="40" height="40" style="border-radius:999px;object-fit:cover;display:block" />
          @else
            <span style="opacity:.4">—</span>
          @endif
        </td>
        <td>{{ $r->name }}</td>
        <td>{{ $r->stars }}</td>
        <td>{{ $r->sort_order }}</td>
        <td>{{ $r->show_in_avatars ? 'да' : 'нет' }}</td>
        <td>{{ $r->is_published ? 'да' : 'нет' }}</td>
        <td style="white-space:nowrap">
          <a href="{{ route('admin.reviews.edit', $r) }}" style="color:#fff;margin-right:0.75rem">Изменить</a>
          <form method="post" action="{{ route('admin.reviews.destroy', $r) }}" style="display:inline" onsubmit="return confirm('Удалить отзыв?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn-admin btn-admin--danger" style="padding:0.25rem 0.6rem;font-size:0.8rem">Удалить</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="opacity:.6">Пока нет отзывов — добавь первый.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
