@php
  /** @var \Illuminate\Support\Collection|\App\Models\HeroSlide[] $slides */
  $slides = $slides ?? collect();
  $videoSlide = $slides->first(fn ($s) => $s->hasVideo());
  $videoUrl = $videoSlide?->getVideoUrl();
  // Poster: dedicated poster → local image → null (never a broken external URL)
  $posterUrl = null;
  if ($videoSlide) {
      if ($videoSlide->getFirstMedia('poster')) {
          $posterUrl = $videoSlide->getPosterUrl('hero');
      } elseif ($videoSlide->getFirstMedia('image')) {
          $posterUrl = $videoSlide->getImageUrl('hero');
      }
  }
  $fallbackImage = $posterUrl
      ?? $slides->first(fn ($s) => $s->getFirstMedia('image'))?->getImageUrl('hero')
      ?? $slides->first()?->getImageUrl('hero')
      ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1920&q=85&auto=format&fit=crop';
  $fallbackMobile = null;
  if ($videoSlide?->getFirstMedia('poster')) {
      $fallbackMobile = $videoSlide->getPosterUrl('mobile');
  } elseif ($videoSlide?->getFirstMedia('image')) {
      $fallbackMobile = $videoSlide->getImageUrl('mobile');
  }
  $fallbackMobile = $fallbackMobile
      ?? $slides->first(fn ($s) => $s->getFirstMedia('image'))?->getImageUrl('mobile')
      ?? $fallbackImage;
@endphp
<section class="hero hero--cinematic {{ $videoUrl ? 'hero--has-video' : 'hero--no-video' }}" id="home" data-hero-cinematic>
  <div class="hero-media" aria-hidden="true">
    @if($videoUrl)
      <video
        class="hero-video"
        data-hero-video
        autoplay
        muted
        loop
        playsinline
        webkit-playsinline
        preload="auto"
        @if($posterUrl) poster="{{ $posterUrl }}" @endif
      >
        <source src="{{ $videoUrl }}" type="{{ str_ends_with(strtolower(parse_url($videoUrl, PHP_URL_PATH) ?: $videoUrl), '.webm') ? 'video/webm' : 'video/mp4' }}">
      </video>

      {{-- Single underlay (poster/original image) — shown only until video plays or if it fails --}}
      <div class="hero-image-stack hero-image-stack--underlay" data-hero-images>
        <picture class="hero-image-layer is-active" data-img="0">
          <source media="(max-width: 767px)" srcset="{{ $fallbackMobile }}">
          <img src="{{ $posterUrl ?: $fallbackImage }}" alt="" loading="eager" decoding="async" fetchpriority="high">
        </picture>
      </div>
    @else
      <div class="hero-image-stack" data-hero-images>
        @forelse($slides as $i => $slide)
          @php
            $desk = $slide->getFirstMedia('image')
                ? $slide->getImageUrl('hero')
                : ($slide->getFirstMedia('poster') ? $slide->getPosterUrl('hero') : null);
            $desk = $desk ?: (filter_var((string) $slide->image_url, FILTER_VALIDATE_URL) ? $slide->image_url : null);
            $desk = $desk ?: $fallbackImage;
            $mob = $slide->getFirstMedia('image')
                ? ($slide->getImageUrl('mobile') ?: $desk)
                : $desk;
          @endphp
          <picture class="hero-image-layer @if($loop->first) is-active @endif" data-img="{{ $i }}">
            <source media="(max-width: 767px)" srcset="{{ $mob }}">
            <img src="{{ $desk }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async">
          </picture>
        @empty
          <picture class="hero-image-layer is-active" data-img="0">
            <source media="(max-width: 767px)" srcset="{{ $fallbackMobile }}">
            <img src="{{ $fallbackImage }}" alt="" loading="eager" decoding="async">
          </picture>
        @endforelse
      </div>
    @endif

    <div class="hero-scrim"></div>
    <div class="hero-grain"></div>
  </div>

  <div class="hero-content">
    <div class="hero-content-inner">
      <p class="hero-kicker" data-hero-fade>{{ __('messages.hero_kicker') }}</p>

      <h1 class="hero-title" data-hero-headline>
        <span class="char-reveal"><span class="char-line">{{ __('messages.hero_main_line') }}</span></span>
      </h1>

      <div class="hero-title hero-title--rotate" data-hero-headline>
        <div class="rotating-word" id="rotWord">
          @forelse($slides as $slide)
            <span class="rw-item @if($loop->first)is-active @endif">{{ $slide->label }}</span>
          @empty
            <span class="rw-item is-active">{{ __('messages.hero_default_label') }}</span>
          @endforelse
        </div>
      </div>

      <p class="hero-lead" data-hero-fade>{{ __('messages.hero_paragraph') }}</p>

      <div class="hero-actions" data-hero-fade>
        <a href="#start" class="btn btn-primary btn-lg hero-cta" data-magnetic>
          {{ __('messages.hero_cta_primary') }}
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <a href="#products" class="btn hero-cta-ghost" data-magnetic>
          {{ __('messages.gateway_cta_products') }}
        </a>
      </div>

      <div class="hero-stats" data-hero-fade>
        <div>
          <div class="hero-stat-num">+<span data-counter data-target="500">0</span></div>
          <div class="hero-stat-label">{{ __('messages.stat_houses') }}</div>
        </div>
        <div>
          <div class="hero-stat-num"><span data-counter data-target="12">0</span>M+</div>
          <div class="hero-stat-label">{{ __('messages.stat_birds') }}</div>
        </div>
        <div>
          <div class="hero-stat-num"><span data-counter data-target="15">0</span>+</div>
          <div class="hero-stat-label">{{ __('messages.stat_years') }}</div>
        </div>
        <div>
          <div class="hero-stat-num">8</div>
          <div class="hero-stat-label">{{ __('messages.stat_countries') }}</div>
        </div>
      </div>
    </div>

    <a href="#start" class="hero-scroll" data-hero-fade aria-label="{{ __('messages.hero_scroll') }}">
      <span class="hero-scroll-line" aria-hidden="true"></span>
      <span>{{ __('messages.hero_scroll') }}</span>
    </a>
  </div>
</section>
