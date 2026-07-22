@php
  /** @var \Illuminate\Support\Collection|\App\Models\HeroSlide[] $slides */
  $slides = $slides ?? collect();
  $videoSlide = $slides->first(fn ($s) => $s->hasVideo());
  $fallbackImage = $videoSlide?->getPosterUrl('hero')
      ?? $slides->first()?->getImageUrl('hero')
      ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1920&q=85&auto=format&fit=crop';
  $fallbackMobile = $videoSlide?->getPosterUrl('mobile')
      ?? $slides->first()?->getImageUrl('mobile')
      ?? $fallbackImage;
@endphp
<section class="hero hero--cinematic" id="home" data-hero-cinematic>
  <div class="hero-media" aria-hidden="true">
    @if($videoSlide)
      <video
        class="hero-video"
        data-hero-video
        muted
        loop
        playsinline
        preload="metadata"
        poster="{{ $videoSlide->getPosterUrl('hero') }}"
      >
        <source src="{{ $videoSlide->getVideoUrl() }}" type="{{ str_ends_with(strtolower((string) $videoSlide->getVideoUrl()), '.webm') ? 'video/webm' : 'video/mp4' }}">
      </video>
    @endif

    <div class="hero-image-stack {{ $videoSlide ? 'hero-image-stack--fallback' : '' }}" data-hero-images>
      @forelse($slides as $i => $slide)
        @php
          $desk = $slide->getImageUrl('hero') ?: $slide->getPosterUrl('hero') ?: $fallbackImage;
          $mob  = $slide->getImageUrl('mobile') ?: $slide->getPosterUrl('mobile') ?: $desk;
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
