@extends('admin.layout')

@section('title', 'Проекты')

@section('body')
<div class="admin-card">
  <div style="display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:space-between;margin-bottom:1rem">
    <h1 style="margin:0">Проекты</h1>
    <a class="btn-admin" href="{{ route('admin.projects.create') }}">Добавить</a>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Название</th>
        <th>Slug</th>
        <th>Порядок</th>
        <th>На сайте</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($projects as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td><code style="opacity:.8">{{ $p->slug }}</code></td>
        <td>{{ $p->sort_order }}</td>
        <td>{{ $p->is_published ? 'да' : 'нет' }}</td>
        <td style="white-space:nowrap">
          <a href="{{ route('project.show', $p) }}" target="_blank" rel="noopener" style="color:#a5b4fc;margin-right:0.75rem">Просмотр</a>
          <a href="{{ route('admin.projects.edit', $p) }}" style="color:#fff">Изменить</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
