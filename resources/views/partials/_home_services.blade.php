@php
  $services = $cms['services'] ?? [];
  $serviceItems = $services['items'] ?? [];
@endphp
      <section class="section wrap reveal" id="services">
        <div class="section-head">
          <span class="chip">{{ $services['chip'] ?? '' }}</span>
          <h2 class="display-sm">{!! nl2br(e($services['h2'] ?? '')) !!}</h2>
          <p class="lead">{{ $services['lead'] ?? '' }}</p>
        </div>
        <div class="services-grid">
          @foreach($serviceItems as $item)
          <article class="service-card">
            <div class="service-thumb folder-preview">
              <span class="folder-back"></span>
              @foreach(array_slice($item['images'] ?? [], 0, 3) as $imgIdx => $imgPath)
                @php($src = \App\Support\Cms::mediaUrl($imgPath))
                @if($src)
                  <img class="folder-file file-{{ $imgIdx + 1 }}" src="{{ $src }}" alt="" />
                @endif
              @endforeach
              <span class="folder-front"></span>
            </div>
            <h3>{{ $item['title'] ?? '' }}</h3>
          </article>
          @endforeach
        </div>
      </section>
