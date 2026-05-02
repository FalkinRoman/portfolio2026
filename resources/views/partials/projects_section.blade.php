      <section class="section wrap reveal" id="projects">
        <div class="section-head">
          <span class="chip">Проекты</span>
          <h2 class="display-sm">{!! nl2br(e("Собрано в прод,\nзаточено на рост")) !!}</h2>
          <p class="lead">От лендингов до продукта: код, скорость и поддержка</p>
        </div>
        @foreach($projects as $project)
        @continue(!$project->publicUrl($project->card_image))
        <a class="project-card" href="{{ route('project.show', $project) }}">
          <img src="{{ $project->publicUrl($project->card_image) }}" alt="{{ $project->name }}" />
          <div class="project-chip">
            <span class="project-logo">
              @if($project->publicUrl($project->logo_image))
                <img src="{{ $project->publicUrl($project->logo_image) }}" alt="" />
              @else
                <img src="{{ $project->publicUrl($project->card_image) }}" alt="" />
              @endif
            </span>
            <span class="project-name">{{ $project->name }}</span>
          </div>
        </a>
        @endforeach
      </section>
