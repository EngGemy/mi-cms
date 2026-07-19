<a href="{{ route('projects.show', [app()->getLocale(), $project->slug]) }}"
   class="project-tile-clean"
   data-cat="{{ $project->category }}"
   aria-label="{{ $project->title }}">

  <div class="project-tile-clean-img">
    <img src="{{ $project->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=85&auto=format&fit=crop' }}"
         alt="{{ $project->title }}" loading="lazy" decoding="async"/>
    <div class="project-tile-clean-img-overlay" aria-hidden="true"></div>
    <span class="project-tile-clean-cat">{{ $project->getCategoryLabel() }}</span>
  </div>

  <div class="project-tile-clean-body">
    <div class="project-tile-clean-title">{{ $project->title }}</div>
    <div class="project-tile-clean-meta">
      @if($project->location_code)
        <span class="project-tile-clean-meta-item">
          <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
          {{ $project->location_code }}
        </span>
      @endif
      @if($project->year)
        <span class="project-tile-clean-meta-item">
          <i data-lucide="calendar" class="w-3 h-3" aria-hidden="true"></i>
          {{ $project->year }}
        </span>
      @endif
    </div>
    @if($project->capacity_birds && $project->capacity_birds > 0)
      <div class="project-tile-clean-stat">
        <span class="project-tile-clean-stat-num">{{ number_format($project->capacity_birds / 1000, 0) }}K</span>
        <span class="project-tile-clean-stat-label">{{ __('messages.birds_unit') }}</span>
      </div>
    @elseif($project->barns_count)
      <div class="project-tile-clean-stat">
        <span class="project-tile-clean-stat-num">{{ $project->barns_count }}</span>
        <span class="project-tile-clean-stat-label">{{ __('messages.barns_unit') }}</span>
      </div>
    @endif
  </div>

  <div class="project-tile-clean-arrow">
    <span>{{ __('messages.view_project') }}</span>
    <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
      @if($arrowRtl ?? app()->getLocale() === 'ar')
        <path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      @else
        <path d="M6 8H13M10 5l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      @endif
    </svg>
  </div>
</a>
