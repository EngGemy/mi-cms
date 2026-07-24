@php
  $locale = app()->getLocale();
  $pillars = config('poultry_services.pillars', []);
  $copy = __('messages.svc_pillars');
  $configuredVideos = config('poultry_services.mosaic_videos', []);
  $heroVideo = collect($slides ?? [])->first(fn ($s) => $s->hasVideo())?->getVideoUrl();
  $mosaic = array_values(array_filter($configuredVideos));
  if (count($mosaic) < 4 && $heroVideo) {
      while (count($mosaic) < 4) {
          $mosaic[] = $heroVideo;
      }
  }
  $positions = ['12% 40%', '38% 55%', '62% 35%', '88% 50%'];
  $fallbackImgs = collect($slides ?? [])
      ->map(fn ($s) => $s->getFirstMedia('image') ? $s->getImageUrl('hero') : null)
      ->filter()
      ->values()
      ->all();
  if (count($fallbackImgs) < 4) {
      $fallbackImgs = array_pad($fallbackImgs, 4, $fallbackImgs[0] ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1200&q=80&auto=format&fit=crop');
  }
@endphp
<section id="services" class="svc-cinema" data-svc-cinema aria-labelledby="svcCinemaTitle">
  <div class="svc-cinema-mosaic" aria-hidden="true">
    @for($i = 0; $i < 4; $i++)
      <div class="svc-cinema-cell" data-svc-cell="{{ $i }}">
        @if(!empty($mosaic[$i]))
          <video
            class="svc-cinema-video"
            muted
            loop
            playsinline
            preload="metadata"
            data-svc-video
            style="--obj-pos: {{ $positions[$i] }}"
          >
            <source src="{{ $mosaic[$i] }}" type="video/mp4">
          </video>
        @endif
        <div class="svc-cinema-still" style="background-image:url('{{ $fallbackImgs[$i] }}')"></div>
        <div class="svc-cinema-cell-shade"></div>
      </div>
    @endfor
    <div class="svc-cinema-vignette"></div>
    <div class="svc-cinema-grain"></div>
  </div>

  <div class="svc-cinema-inner">
    <header class="svc-cinema-head" data-svc-reveal>
      <span class="svc-cinema-eyebrow">{{ __('messages.svc_cinema_eyebrow') }}</span>
      <h2 id="svcCinemaTitle" class="svc-cinema-title">{{ __('messages.svc_cinema_title') }}</h2>
      <p class="svc-cinema-blurb">{{ __('messages.svc_cinema_blurb') }}</p>
    </header>

    <div class="svc-cinema-gates" role="tablist" aria-label="{{ __('messages.svc_cinema_title') }}">
      @foreach($pillars as $key => $meta)
        @php $item = $copy[$key] ?? []; @endphp
        <button
          type="button"
          class="svc-gate"
          role="tab"
          id="svc-tab-{{ $key }}"
          aria-selected="false"
          aria-controls="svc-panel-{{ $key }}"
          data-svc-gate="{{ $key }}"
          data-svc-reveal
          style="--gate-i: {{ $loop->index }}"
        >
          <span class="svc-gate-num">{{ $item['num'] ?? $meta['slug'] }}</span>
          <span class="svc-gate-kicker">{{ $item['kicker'] ?? '' }}</span>
          <span class="svc-gate-title">{{ $item['title'] ?? $key }}</span>
          <span class="svc-gate-tag">{{ $item['tagline'] ?? '' }}</span>
          <span class="svc-gate-cta">
            {{ __('messages.svc_cinema_explore') }}
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </button>
      @endforeach
    </div>
  </div>

  @foreach($pillars as $key => $meta)
    @php $item = $copy[$key] ?? []; @endphp
    <div
      class="svc-panel"
      id="svc-panel-{{ $key }}"
      role="tabpanel"
      aria-labelledby="svc-tab-{{ $key }}"
      data-svc-panel="{{ $key }}"
      hidden
    >
      <div class="svc-panel-scrim" data-svc-close tabindex="-1"></div>
      <div class="svc-panel-sheet">
        <button type="button" class="svc-panel-x" data-svc-close aria-label="{{ __('messages.svc_cinema_close') }}">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>

        <div class="svc-panel-grid">
          <div class="svc-panel-main">
            <span class="svc-panel-kicker">{{ $item['kicker'] ?? '' }} · {{ $item['num'] ?? '' }}</span>
            <h3 class="svc-panel-title">{{ $item['title'] ?? '' }}</h3>
            <p class="svc-panel-tagline">{{ $item['tagline'] ?? '' }}</p>
            <p class="svc-panel-lead">{{ $item['lead'] ?? '' }}</p>
            <p class="svc-panel-story">{{ $item['story'] ?? '' }}</p>

            <div class="svc-panel-actions">
              <a href="{{ route('services.show', [$locale, $key]) }}" class="btn btn-primary">
                {{ __('messages.svc_cinema_explore') }}
              </a>
              @if(!empty($meta['calc_type']))
                <a href="{{ route('home', $locale) }}#start" class="btn btn-dark" data-svc-calc="{{ $meta['calc_type'] }}">
                  {{ __('messages.svc_cinema_calc') }}
                </a>
              @else
                <a href="{{ route('home', $locale) }}#contact" class="btn btn-dark">
                  {{ __('messages.svc_cinema_quote') }}
                </a>
              @endif
            </div>
          </div>

          <div class="svc-panel-side">
            <div class="svc-spec-card">
              <div class="svc-spec-label">{{ __('messages.svc_cinema_specs') }}</div>
              <dl class="svc-spec-list">
                @foreach(($item['specs'] ?? []) as $label => $value)
                  <div class="svc-spec-row">
                    <dt>{{ $label }}</dt>
                    <dd>{{ $value }}</dd>
                  </div>
                @endforeach
              </dl>
            </div>

            <div class="svc-include-card">
              <div class="svc-spec-label">{{ __('messages.svc_cinema_includes') }}</div>
              <ul class="svc-include-list">
                @foreach(($item['highlights'] ?? []) as $line)
                  <li>{{ $line }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</section>
