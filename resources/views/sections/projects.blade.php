{{--
  Projects Section — MI Poultry CMS
  McKinsey B2B: white/black/red, clean featured + uniform grid, GSAP filter, stagger entrance.
--}}
<section class="projects-section py-24 lg:py-32" id="projects">
  <div class="section-inner">

    {{-- Header --}}
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-10">
      <div data-reveal="left">
        <span class="eyebrow">{{ __('messages.projects_eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.projects_title') }}</h2>
      </div>
      <div data-reveal="right" class="flex flex-col gap-4">
        <p class="lead">{{ __('messages.projects_blurb') }}</p>
        <a href="{{ route('projects.index', app()->getLocale()) }}"
           class="projects-cta-link inline-flex items-center gap-2 font-mono text-xs uppercase tracking-widest text-ink-600 hover:text-mi-red transition-colors self-start">
          {{ __('messages.projects_cta') }}
          <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            @if(app()->getLocale() === 'ar')
              <path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            @else
              <path d="M6 8H13M10 5l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            @endif
          </svg>
        </a>
      </div>
    </div>

    {{-- Filter Pills --}}
    <div class="filters-row" data-reveal id="projectFilters">
      <button class="filter-pill is-active" data-filter="all">{{ __('messages.filter_all') }}</button>
      @foreach(\App\Models\Project::CATEGORIES as $key => $names)
        <button class="filter-pill" data-filter="{{ $key }}">{{ $names[app()->getLocale()] }}</button>
      @endforeach
    </div>

    @php
      $featured = $projects->firstWhere('is_featured', true);
      $rest = $projects->filter(fn($p) => $p->id !== ($featured?->id))->values();
    @endphp

    {{-- Featured Card --}}
    @if($featured)
    <div class="mb-10" data-reveal id="projectsFeatured" data-cat="{{ $featured->category }}">
      <a href="{{ route('projects.show', [app()->getLocale(), $featured->slug]) }}"
         class="project-featured" aria-label="{{ $featured->title }}">

        <div class="project-featured-img">
          <img src="{{ $featured->getCoverUrl('hero') ?? $featured->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1600&q=85&auto=format&fit=crop' }}"
               alt="{{ $featured->title }}" loading="lazy" decoding="async"/>
          <div class="project-featured-overlay" aria-hidden="true"></div>
        </div>

        <div class="project-featured-body">
          <span class="project-featured-cat">{{ $featured->getCategoryLabel() }}</span>
          <h3 class="display-3 project-featured-title">{{ $featured->title }}</h3>
          <div class="project-featured-meta">
            @if($featured->location_code)
              <span class="project-featured-meta-item">
                <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
                {{ $featured->location_code }}
              </span>
            @endif
            @if($featured->year)
              <span class="project-featured-meta-item">
                <i data-lucide="calendar" class="w-3 h-3" aria-hidden="true"></i>
                {{ $featured->year }}
              </span>
            @endif
          </div>

          @if($featured->capacity_birds && $featured->capacity_birds > 0)
            <div class="project-featured-stat">
              <span class="project-featured-stat-num">{{ number_format($featured->capacity_birds) }}</span>
              <span class="project-featured-stat-label">{{ __('messages.birds_unit') }}</span>
            </div>
          @endif

          <div class="project-featured-arrow">
            <span>{{ __('messages.view_project') }}</span>
            <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
              @if(app()->getLocale() === 'ar')
                <path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              @else
                <path d="M6 8H13M10 5l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              @endif
            </svg>
          </div>
        </div>
      </a>
    </div>
    @endif

    {{-- Projects Uniform Grid --}}
    <div class="projects-grid-clean" id="projectsGrid" data-stagger>
      @foreach($rest as $project)
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
              @if(app()->getLocale() === 'ar')
                <path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              @else
                <path d="M6 8H13M10 5l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              @endif
            </svg>
          </div>
        </a>
      @endforeach
    </div>

    {{-- CTA to all projects --}}
    @if($projects->count() >= 6)
    <div class="text-center mt-12" data-reveal>
      <a href="{{ route('projects.index', app()->getLocale()) }}" class="btn btn-ghost">
        {{ __('messages.projects_cta') }}
        <i data-lucide="arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-4 h-4"></i>
      </a>
    </div>
    @endif

  </div>
</section>
