<x-layouts.public :seo="$seo">

  {{-- JSON-LD --}}
  <x-slot:head>
    <script type="application/ld+json">{!! $jsonLd !!}</script>
  </x-slot:head>

  {{-- =====================================================================
       BREADCRUMB
       ===================================================================== --}}
  <nav class="proj-breadcrumb" aria-label="breadcrumb">
    <div class="section-inner">
      <ol class="proj-breadcrumb-list">
        <li><a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.brand') }}</a></li>
        <li><i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-3 h-3"></i></li>
        <li><a href="{{ route('projects.index', app()->getLocale()) }}">{{ __('messages.projects_eyebrow') }}</a></li>
        <li><i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-3 h-3"></i></li>
        <li aria-current="page">{{ $project->title }}</li>
      </ol>
    </div>
  </nav>

  {{-- =====================================================================
       HERO — CINEMATIC FULL-BLEED
       ===================================================================== --}}
  <section class="proj-hero" aria-labelledby="proj-title">

    {{-- Background image with parallax --}}
    <div class="proj-hero-bg" data-proj-parallax>
      @if($project->getCoverUrl('hero'))
        <img src="{{ $project->getCoverUrl('hero') }}"
             alt="{{ $project->title }}"
             fetchpriority="high" decoding="async"/>
      @else
        <div style="background:var(--ink-800);width:100%;height:100%;"></div>
      @endif
    </div>
    <div class="proj-hero-overlay" aria-hidden="true"></div>

    <div class="proj-hero-inner">

      {{-- Category badge --}}
      <div data-proj-fade style="--d:0s">
        <span class="proj-hero-cat">{{ $project->getCategoryLabel() }}</span>
      </div>

      {{-- Title —  per-line clip reveal --}}
      <h1 id="proj-title" class="display-1 proj-hero-title" data-proj-title>
        @php
          $titleWords = explode(' ', $project->title);
          $mid = (int) ceil(count($titleWords) / 2);
          $line1 = implode(' ', array_slice($titleWords, 0, $mid));
          $line2 = implode(' ', array_slice($titleWords, $mid));
        @endphp
        <span class="title-line">{{ $line1 }}</span>
        @if($line2)
          <span class="title-line">{{ $line2 }}</span>
        @endif
      </h1>

      {{-- Meta row --}}
      <div class="proj-hero-meta" data-proj-fade style="--d:.3s">
        @if($project->location_code)
          <span class="proj-hero-meta-item">
            <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
            {{ $project->location_code }}
          </span>
        @endif
        @if($project->year)
          <span class="proj-hero-meta-item">
            <i data-lucide="calendar" class="w-3 h-3" aria-hidden="true"></i>
            {{ $project->year }}
          </span>
        @endif
        @if($project->client_name)
          <span class="proj-hero-meta-item">
            <i data-lucide="building-2" class="w-3 h-3" aria-hidden="true"></i>
            {{ $project->client_name }}
          </span>
        @endif
      </div>

    </div>
  </section>

  {{-- =====================================================================
       STATS BAR — McKINSEY COUNT-UP
       ===================================================================== --}}
  <div class="proj-stats" role="region" aria-label="{{ __('messages.project_stats_title') }}">
    <div class="proj-stats-inner">

      @if($project->capacity_birds && $project->capacity_birds > 0)
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="{{ $project->capacity_birds }}">0</span>
          <span class="proj-stat-unit">{{ __('messages.birds_unit') }}</span>
        </div>
        <div class="proj-stat-label">{{ __('messages.project_capacity') }}</div>
      </div>
      @endif

      @if($project->barns_count)
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="{{ $project->barns_count }}">0</span>
          <span class="proj-stat-unit">{{ __('messages.barns_unit') }}</span>
        </div>
        <div class="proj-stat-label">{{ __('messages.project_barns') }}</div>
      </div>
      @endif

      @if($project->area_m2)
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="{{ $project->area_m2 }}">0</span>
          <span class="proj-stat-unit">{{ __('messages.sqm_unit') }}</span>
        </div>
        <div class="proj-stat-label">{{ __('messages.project_area') }}</div>
      </div>
      @endif

      @if($project->duration_months)
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="{{ $project->duration_months }}">0</span>
          <span class="proj-stat-unit">{{ app()->getLocale() === 'ar' ? 'شهر' : 'mo' }}</span>
        </div>
        <div class="proj-stat-label">{{ app()->getLocale() === 'ar' ? 'مدة التنفيذ' : 'Duration' }}</div>
      </div>
      @endif

      @if($project->year)
      <div class="proj-stat">
        <div class="proj-stat-num">{{ $project->year }}</div>
        <div class="proj-stat-label">{{ __('messages.project_year') }}</div>
      </div>
      @endif

    </div>
  </div>

  {{-- =====================================================================
       DESCRIPTION + INFO CARD
       ===================================================================== --}}
  <section class="py-20 lg:py-28">
    <div class="proj-content">
      <div class="proj-detail-grid">

        {{-- Description --}}
        <div data-reveal>
          <span class="proj-section-label">{{ __('messages.project_description') }}</span>
          @if($project->description)
            <div class="proj-description">
              {!! nl2br(e($project->description)) !!}
            </div>
          @endif
        </div>

        {{-- Info sidebar --}}
        <aside class="proj-info-card" data-reveal>
          @if($project->client_name)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_client') }}</span>
              <span class="proj-info-val">{{ $project->client_name }}</span>
            </div>
          @endif
          @if($project->location_code)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_location') }}</span>
              <span class="proj-info-val">{{ $project->location_code }}</span>
            </div>
          @endif
          <div class="proj-info-row">
            <span class="proj-info-key">{{ __('messages.project_category') }}</span>
            <span class="proj-info-val">{{ $project->getCategoryLabel() }}</span>
          </div>
          @if($project->completion_date)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_year') }}</span>
              <span class="proj-info-val">{{ $project->completion_date->format('Y') }}</span>
            </div>
          @elseif($project->year)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_year') }}</span>
              <span class="proj-info-val">{{ $project->year }}</span>
            </div>
          @endif
          @if($project->capacity_birds && $project->capacity_birds > 0)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_capacity') }}</span>
              <span class="proj-info-val">{{ number_format($project->capacity_birds) }}</span>
            </div>
          @endif
          @if($project->barns_count)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_barns') }}</span>
              <span class="proj-info-val">{{ $project->barns_count }}</span>
            </div>
          @endif
          @if($project->area_m2)
            <div class="proj-info-row">
              <span class="proj-info-key">{{ __('messages.project_area') }}</span>
              <span class="proj-info-val">{{ number_format($project->area_m2) }} {{ __('messages.sqm_unit') }}</span>
            </div>
          @endif
        </aside>

      </div>
    </div>
  </section>

  {{-- =====================================================================
       PROJECT CATALOGUE - IMAGE + VIDEO SLIDER
       ===================================================================== --}}
  <section class="proj-catalogue py-20 lg:py-28">
    @if(count($projectCatalogue) > 0)
    <div class="proj-content"
         x-data="{
           idx: 0,
           items: {{ Js::from($projectCatalogue) }},
           current() { return this.items[this.idx] || {}; },
           prev() { this.idx = (this.idx - 1 + this.items.length) % this.items.length; },
           next() { this.idx = (this.idx + 1) % this.items.length; },
           go(i) { this.idx = i; },
         }"
         @keydown.arrow-left.window="{{ app()->getLocale() === 'ar' ? 'next()' : 'prev()' }}"
         @keydown.arrow-right.window="{{ app()->getLocale() === 'ar' ? 'prev()' : 'next()' }}">

      <div class="proj-catalogue-head">
        <div data-reveal="left">
          <span class="proj-section-label">{{ __('messages.project_catalogue') }}</span>
          <h2 class="display-3 mt-1">{{ __('messages.project_catalogue_title') }}</h2>
        </div>
        <div class="proj-catalogue-count label-mono" data-reveal="right">
          <span x-text="idx + 1"></span> / <span x-text="items.length"></span>
        </div>
      </div>

      <div class="proj-catalogue-stage" data-reveal>
        <div class="proj-catalogue-media">
          <template x-if="current().type === 'image'">
            <img :src="current().full" :alt="current().title" loading="lazy" decoding="async">
          </template>

          <template x-if="current().type === 'embed_video'">
            <iframe :src="current().embed"
                    :title="current().title"
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"></iframe>
          </template>

          <template x-if="current().type === 'file_video'">
            <video :src="current().src"
                   :poster="current().poster"
                   controls
                   preload="metadata"></video>
          </template>
        </div>

        <div class="proj-catalogue-panel">
          <span class="proj-catalogue-badge" x-text="current().badge"></span>
          <h3 x-text="current().title"></h3>
          <p>{{ __('messages.project_catalogue_blurb') }}</p>

          <div class="proj-catalogue-actions">
            <button type="button" class="proj-catalogue-nav" @click="prev()" aria-label="Previous">
              <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" class="w-5 h-5"></i>
            </button>
            <button type="button" class="proj-catalogue-nav" @click="next()" aria-label="Next">
              <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-5 h-5"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="proj-catalogue-thumbs" data-stagger>
        <template x-for="(item, i) in items" :key="i">
          <button type="button"
                  class="proj-catalogue-thumb"
                  :class="{ 'is-active': idx === i }"
                  @click="go(i)"
                  :aria-label="item.title">
            <img x-show="item.thumb" :src="item.thumb" :alt="item.title" loading="lazy" decoding="async">
            <span class="proj-catalogue-thumb-fallback" x-show="!item.thumb">
              <i data-lucide="play" class="w-4 h-4"></i>
            </span>
            <span class="proj-catalogue-thumb-type" x-show="item.type !== 'image'">
              <i data-lucide="play" class="w-3 h-3"></i>
            </span>
          </button>
        </template>
      </div>
    </div>
    @else
    <div class="proj-content">
      <div class="proj-catalogue-head">
        <div data-reveal="left">
          <span class="proj-section-label">{{ __('messages.project_catalogue') }}</span>
          <h2 class="display-3 mt-1">{{ __('messages.project_catalogue_title') }}</h2>
        </div>
      </div>

      <div class="proj-catalogue-empty" data-reveal>
        <div class="proj-catalogue-empty-icon">
          <i data-lucide="images" class="w-7 h-7"></i>
        </div>
        <div>
          <span class="proj-catalogue-badge">{{ __('messages.project_catalogue') }}</span>
          <h3>{{ __('messages.project_catalogue_empty_title') }}</h3>
          <p>{{ __('messages.project_catalogue_empty_blurb') }}</p>
        </div>
      </div>
    </div>
    @endif
  </section>

  {{-- =====================================================================
       PROJECT PHASES / EXECUTION ITEMS (with media)
       ===================================================================== --}}
  @if($project->phases && $project->phases->count() > 0)
  <section class="proj-phases py-20 lg:py-28">
    <div class="proj-phases-inner">
      <span class="proj-section-label" data-reveal>{{ __('messages.project_phases_title') }}</span>
      <h2 class="display-3 mt-1 mb-10" data-reveal>{{ __('messages.project_phases_subtitle') }}</h2>

      <div class="proj-phases-grid" data-stagger>
        @foreach($project->phases as $phase)
          @php
            $phaseImg   = $phase->getImageUrl('card');
            $phaseVideo = $phase->hasVideo();
            $phaseEmbed = $phase->getVideoEmbed();
            $phaseVtype = $phase->getVideoType();
          @endphp
          <div class="proj-phase-card" data-reveal
               @if($phaseVideo) x-data="{ playing: false }" :class="playing ? 'is-playing' : ''" @endif>

            {{-- Media area (image, video, or icon fallback) --}}
            <div class="proj-phase-media">
              @if($phaseImg)
                <img src="{{ $phaseImg }}" alt="{{ $phase->title }}" loading="lazy" decoding="async"/>
              @endif

              @if($phaseVideo && $phaseEmbed)
                {{-- Play button on image or standalone --}}
                <div class="proj-phase-video-overlay" @click="playing = true" x-show="!playing">
                  <button type="button" class="proj-phase-play-btn" aria-label="{{ __('messages.project_play_video') }}">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M8 5v14l11-7z"/></svg>
                  </button>
                </div>
                <iframe x-show="playing"
                        :src="playing ? '{{ $phaseEmbed }}' : ''"
                        class="proj-phase-video-iframe"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        title="{{ $phase->title }}"
                        loading="lazy"></iframe>
              @elseif($phaseVideo && $phaseVtype === 'file')
                <div class="proj-phase-video-overlay" @click="playing = true" x-show="!playing">
                  <button type="button" class="proj-phase-play-btn" aria-label="{{ __('messages.project_play_video') }}">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M8 5v14l11-7z"/></svg>
                  </button>
                </div>
                <video x-show="playing"
                       x-ref="vid"
                       class="proj-phase-video-iframe"
                       :autoplay="playing"
                       controls
                       preload="none"
                       x-init="$watch('playing', v => { if(v) $refs.vid.play(); })">
                  <source src="{{ $phase->getVideoUrl() }}" type="video/mp4">
                </video>
              @endif

              @if(!$phaseImg && !$phaseVideo)
                {{-- Fallback: large icon on soft background --}}
                <div class="proj-phase-fallback">
                  @if($phase->icon)
                    <i data-lucide="{{ $phase->icon }}" class="w-8 h-8" aria-hidden="true"></i>
                  @else
                    <span class="proj-phase-num-fallback">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                  @endif
                </div>
              @endif
            </div>

            <div class="proj-phase-body">
              <div class="proj-phase-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
              <div class="proj-phase-title">{{ $phase->title }}</div>
              @if($phase->description)
                <div class="proj-phase-desc">{{ $phase->description }}</div>
              @endif
              <div class="proj-phase-status" style="background: {{ $phase->getStatusColor() }}15; color: {{ $phase->getStatusColor() }};">
                <span class="proj-phase-status-dot" style="background: {{ $phase->getStatusColor() }};"></span>
                {{ $phase->getStatusLabel() }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- =====================================================================
       PROJECT VIDEO — LAZY (URL or uploaded file)
       ===================================================================== --}}
  @php
    $projectVideoUrl   = $project->video_url;
    $projectVideoMedia = $project->getFirstMedia('video');
    $projectVideoSrc   = $projectVideoUrl ?: ($projectVideoMedia ? $projectVideoMedia->getUrl() : null);
    $projectYtId       = $project->getYoutubeId();
    $projectViId       = $project->getVimeoId();
    $projectIsEmbed    = $projectYtId || $projectViId;
  @endphp

  @if($projectVideoSrc)
  <section class="py-16 lg:py-20">
    <div class="proj-content">

      <span class="proj-section-label" data-reveal>{{ __('messages.project_video') }}</span>

      <div class="proj-video-wrap" data-reveal
           x-data="{ playing: false }"
           :class="playing ? 'is-playing' : ''"
           @click="playing = true">

        {{-- Poster --}}
        @php $poster = $project->getCoverUrl('card'); @endphp
        @if($poster)
          <img class="proj-video-poster" src="{{ $poster }}" alt="{{ $project->title }}" loading="lazy">
        @endif

        {{-- Play overlay --}}
        <div class="proj-video-overlay" x-show="!playing">
          <button type="button" class="proj-video-btn" :aria-label="'{{ __('messages.project_play_video') }}'">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7" aria-hidden="true">
              <path d="M8 5v14l11-7z"/>
            </svg>
          </button>
          <span class="proj-video-label">{{ __('messages.project_play_video') }}</span>
        </div>

        {{-- Lazy player — prioritize embed, then file URL --}}
        @if($projectYtId)
          <iframe x-show="playing"
                  :src="playing ? 'https://www.youtube.com/embed/{{ $projectYtId }}?autoplay=1&rel=0' : ''"
                  class="proj-video-iframe"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                  title="{{ $project->title }}"
                  loading="lazy"></iframe>
        @elseif($projectViId)
          <iframe x-show="playing"
                  :src="playing ? 'https://player.vimeo.com/video/{{ $projectViId }}?autoplay=1' : ''"
                  class="proj-video-iframe"
                  allow="autoplay; fullscreen; picture-in-picture"
                  allowfullscreen
                  title="{{ $project->title }}"
                  loading="lazy"></iframe>
        @else
          <video x-show="playing"
                 x-ref="vid"
                 class="proj-video-iframe"
                 :autoplay="playing"
                 controls
                 preload="none"
                 x-init="$watch('playing', v => { if(v) $refs.vid.play(); })">
            <source src="{{ $projectVideoSrc }}" type="video/mp4">
          </video>
        @endif

      </div>
    </div>
  </section>
  @endif

  {{-- =====================================================================
       BLUEPRINT / DESIGN GALLERY
       ===================================================================== --}}
  @if(count($blueprintImages) > 0)
  <section class="py-16 lg:py-20" style="background:var(--paper)">
    <div class="proj-content"
         x-data="{
           open: false,
           idx: 0,
           images: {{ Js::from($blueprintImages) }},
           openAt(i) { this.idx = i; this.open = true; document.body.style.overflow = 'hidden'; },
           close()   { this.open = false; document.body.style.overflow = ''; },
           prev()    { this.idx = (this.idx - 1 + this.images.length) % this.images.length; },
           next()    { this.idx = (this.idx + 1) % this.images.length; },
         }"
         @keydown.escape.window="close()"
         @keydown.arrow-left.window="open && ({{ app()->getLocale() === 'ar' ? 'next()' : 'prev()' }})"
         @keydown.arrow-right.window="open && ({{ app()->getLocale() === 'ar' ? 'prev()' : 'next()' }})">

      <span class="proj-section-label" data-reveal>{{ __('messages.project_blueprint') }}</span>

      <div class="proj-gallery-grid" data-stagger>
        @foreach($blueprintImages as $i => $img)
          <button type="button"
                  class="proj-gallery-item"
                  @click="openAt({{ $i }})"
                  aria-label="{{ $img['alt'] }} {{ $i + 1 }}">
            <img src="{{ $img['thumb'] }}"
                 data-full="{{ $img['full'] }}"
                 alt="{{ $img['alt'] }} {{ $i + 1 }}"
                 loading="lazy" decoding="async"/>
          </button>
        @endforeach
      </div>

      {{-- Lightbox --}}
      <div class="proj-lightbox"
           x-show="open"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-150"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click.self="close()"
           role="dialog" aria-modal="true"
           style="display:none">

        <img :src="images[idx]?.full"
             :alt="images[idx]?.alt"
             class="proj-lightbox-img"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"/>

        <button type="button" class="proj-lightbox-close" @click="close()" aria-label="Close">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <button type="button" class="proj-lightbox-nav proj-lightbox-prev"
                @click="prev()" aria-label="Previous">
          <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" class="w-5 h-5"></i>
        </button>
        <button type="button" class="proj-lightbox-nav proj-lightbox-next"
                @click="next()" aria-label="Next">
          <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-5 h-5"></i>
        </button>

        <div class="proj-lightbox-counter" aria-live="polite">
          <span x-text="idx + 1"></span> / <span x-text="images.length"></span>
        </div>

      </div>

    </div>
  </section>
  @endif

  {{-- =====================================================================
       GALLERY — LIGHTBOX (Alpine, no external lib)
       ===================================================================== --}}
  @if(count($galleryImages) > 0)
  <section class="py-16 lg:py-20">
    <div class="proj-content"
         x-data="{
           open: false,
           idx: 0,
           images: {{ Js::from($galleryImages) }},
           openAt(i) { this.idx = i; this.open = true; document.body.style.overflow = 'hidden'; },
           close()   { this.open = false; document.body.style.overflow = ''; },
           prev()    { this.idx = (this.idx - 1 + this.images.length) % this.images.length; },
           next()    { this.idx = (this.idx + 1) % this.images.length; },
         }"
         @keydown.escape.window="close()"
         @keydown.arrow-left.window="open && ({{ app()->getLocale() === 'ar' ? 'next()' : 'prev()' }})"
         @keydown.arrow-right.window="open && ({{ app()->getLocale() === 'ar' ? 'prev()' : 'next()' }})">

      <span class="proj-section-label" data-reveal>{{ __('messages.project_gallery') }}</span>

      <div class="proj-gallery-grid" data-stagger>
        @foreach($galleryImages as $i => $img)
          <button type="button"
                  class="proj-gallery-item"
                  @click="openAt({{ $i }})"
                  aria-label="{{ __('messages.project_img_alt') }} {{ $i + 1 }}">
            <img src="{{ $img['thumb'] }}"
                 data-full="{{ $img['full'] }}"
                 alt="{{ $img['alt'] }} {{ $i + 1 }}"
                 loading="lazy" decoding="async"/>
          </button>
        @endforeach
      </div>

      {{-- Lightbox --}}
      <div class="proj-lightbox"
           x-show="open"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-150"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click.self="close()"
           role="dialog" aria-modal="true"
           style="display:none">

        <img :src="images[idx]?.full"
             :alt="images[idx]?.alt"
             class="proj-lightbox-img"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"/>

        <button type="button" class="proj-lightbox-close" @click="close()" aria-label="Close">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <button type="button" class="proj-lightbox-nav proj-lightbox-prev"
                @click="prev()" aria-label="Previous">
          <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" class="w-5 h-5"></i>
        </button>
        <button type="button" class="proj-lightbox-nav proj-lightbox-next"
                @click="next()" aria-label="Next">
          <i data-lucide="chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-5 h-5"></i>
        </button>

        <div class="proj-lightbox-counter" aria-live="polite">
          <span x-text="idx + 1"></span> / <span x-text="images.length"></span>
        </div>

      </div>

    </div>
  </section>
  @endif

  {{-- =====================================================================
       RELATED PROJECTS
       ===================================================================== --}}
  @if($related->count() > 0)
  <section class="py-20 lg:py-28" style="background:var(--paper)">
    <div class="proj-content">

      <div class="flex items-end justify-between gap-6 mb-10">
        <div data-reveal="left">
          <span class="proj-section-label">{{ $project->getCategoryLabel() }}</span>
          <h2 class="display-3 mt-1">{{ __('messages.project_related') }}</h2>
        </div>
        <a href="{{ route('projects.index', app()->getLocale()) }}"
           class="projects-cta-link hidden lg:inline-flex items-center gap-2" data-reveal="right">
          {{ __('messages.projects_cta') }}
          <i data-lucide="arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-4 h-4"></i>
        </a>
      </div>

      <div class="proj-related-grid" data-stagger>
        @foreach($related as $rel)
          <a href="{{ route('projects.show', [app()->getLocale(), $rel->slug]) }}"
             class="pi-card">
            <div class="pi-card-img">
              <img src="{{ $rel->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=82&auto=format&fit=crop' }}"
                   alt="{{ $rel->title }}" loading="lazy" decoding="async"/>
              <div class="pi-card-img-overlay" aria-hidden="true"></div>
              <span class="pi-card-cat">{{ $rel->getCategoryLabel() }}</span>
            </div>
            <div class="pi-card-body">
              <div class="pi-card-title">{{ $rel->title }}</div>
              <div class="pi-card-meta">
                @if($rel->location_code)
                  <span class="pi-card-meta-item">
                    <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
                    {{ $rel->location_code }}
                  </span>
                @endif
              </div>
              @if($rel->capacity_birds && $rel->capacity_birds > 0)
                <div class="pi-card-stat">
                  <span class="pi-card-stat-num">{{ number_format($rel->capacity_birds / 1000, 0) }}K</span>
                  <span class="pi-card-stat-label">{{ __('messages.birds_unit') }}</span>
                </div>
              @endif
            </div>
            <div class="pi-card-arrow">
              <span>{{ __('messages.view_project') }}</span>
              <i data-lucide="arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-4 h-4"></i>
            </div>
          </a>
        @endforeach
      </div>

    </div>
  </section>
  @endif

  {{-- =====================================================================
       CTA — START YOUR PROJECT
       ===================================================================== --}}
  <section class="py-20 lg:py-28">
    <div class="proj-content">
      <div class="proj-cta" data-reveal="scale">
        <span class="eyebrow eyebrow--light">{{ __('messages.project_cta_title') }}</span>
        <p class="lead" style="color:rgba(255,255,255,.65);max-width:480px">
          {{ __('messages.project_cta_blurb') }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center mt-2">
          <a href="{{ route('home', app()->getLocale()) }}#contact"
             class="btn btn-primary btn-lg" data-magnetic>
            {{ __('messages.project_cta_btn') }}
            <i data-lucide="arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" class="w-4 h-4"></i>
          </a>
          <a href="{{ route('home', app()->getLocale()) }}#start"
             class="btn btn-ghost btn-lg" style="color:#fff;border-color:rgba(255,255,255,.2)">
            {{ __('messages.calc_eyebrow') }}
          </a>
        </div>
      </div>
    </div>
  </section>


</x-layouts.public>
