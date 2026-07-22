<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <section class="projects-index-hero">
    <div class="section-inner" style="position:relative;z-index:2">
      <span class="eyebrow eyebrow--light" data-reveal>{{ __('messages.projects_index_eyebrow') }}</span>
      <h1 class="display-2 mt-3" style="color:#fff" data-reveal="title">{{ __('messages.projects_index_title') }}</h1>
      <p class="lead mt-4" style="color:rgba(255,255,255,.65);max-width:560px" data-reveal>
        {{ __('messages.projects_index_blurb') }}
      </p>

      <form method="GET" action="{{ route('projects.index', app()->getLocale()) }}" class="listing-toolbar listing-toolbar--dark mt-8" data-reveal>
        <div class="filters-row listing-filters" id="projectFilters">
          <a href="{{ route('projects.index', array_filter([app()->getLocale(), 'q' => $searchQuery ?: null])) }}"
             wire:navigate.hover
             class="filter-pill {{ !$active_cat ? 'is-active' : '' }}">
            {{ __('messages.filter_all') }}
          </a>
          @foreach($categories as $key => $names)
            <a href="{{ route('projects.index', array_filter([app()->getLocale(), 'category' => $key, 'q' => $searchQuery ?: null])) }}"
               wire:navigate.hover
               class="filter-pill {{ $active_cat === $key ? 'is-active' : '' }}">
              {{ $names[app()->getLocale()] }}
            </a>
          @endforeach
        </div>
        <div class="listing-search">
          <input type="search" name="q" value="{{ $searchQuery }}"
                 placeholder="{{ __('messages.search_placeholder') }}"
                 aria-label="{{ __('messages.search_placeholder') }}"/>
          @if($active_cat)
            <input type="hidden" name="category" value="{{ $active_cat }}"/>
          @endif
          <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.search') }}</button>
        </div>
      </form>
    </div>
  </section>

  <section class="py-20 lg:py-28" id="listing-grid" data-listing-grid>
    <div class="section-inner">
      @if($projects->isEmpty())
        <div class="text-center py-20">
          <p class="lead" style="color:var(--ink-500)">{{ __('messages.no_projects') }}</p>
          <a href="{{ route('projects.index', app()->getLocale()) }}" class="btn btn-ghost mt-6" wire:navigate.hover>
            {{ __('messages.filter_all') }}
          </a>
        </div>
      @else
        <div class="projects-index-grid listing-grid-anim" data-stagger>
          @foreach($projects as $project)
            <a href="{{ route('projects.show', [app()->getLocale(), $project->slug]) }}"
               class="pi-card" aria-label="{{ $project->title }}">
              <div class="pi-card-img">
                <img src="{{ $project->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=82&auto=format&fit=crop' }}"
                     alt="{{ $project->title }}" loading="lazy" decoding="async"/>
                <div class="pi-card-img-overlay" aria-hidden="true"></div>
                <span class="pi-card-cat">{{ $project->getCategoryLabel() }}</span>
              </div>
              <div class="pi-card-body">
                <div class="pi-card-title">{{ $project->title }}</div>
                <div class="pi-card-meta">
                  @if($project->location_code)
                    <span class="pi-card-meta-item">
                      <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
                      {{ $project->location_code }}
                    </span>
                  @endif
                  @if($project->year)
                    <span class="pi-card-meta-item">
                      <i data-lucide="calendar" class="w-3 h-3" aria-hidden="true"></i>
                      {{ $project->year }}
                    </span>
                  @endif
                </div>
                @if($project->summary)
                  <p style="font-size:13px;color:var(--ink-600);line-height:1.6;margin-top:2px">
                    {{ Str::limit($project->summary, 100) }}
                  </p>
                @endif
              </div>
              <div class="pi-card-arrow">
                <span>{{ __('messages.view_project') }}</span>
                <i data-lucide="arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-4 h-4" aria-hidden="true"></i>
              </div>
            </a>
          @endforeach
        </div>
        <div class="listing-pagination">
          {{ $projects->links() }}
        </div>
      @endif
    </div>
  </section>

  <section class="py-16">
    <div class="section-inner">
      <div class="proj-cta" data-reveal="scale">
        <span class="eyebrow eyebrow--light">{{ __('messages.project_cta_title') }}</span>
        <p class="lead" style="color:rgba(255,255,255,.65);max-width:480px">
          {{ __('messages.project_cta_blurb') }}
        </p>
        <a href="{{ route('home', app()->getLocale()) }}#calculator"
           class="btn btn-primary btn-lg mt-2" data-magnetic>
          {{ __('messages.nav_calculator') }}
        </a>
      </div>
    </div>
  </section>
</x-layouts.public>
