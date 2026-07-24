@php
  /** @var \Illuminate\Support\Collection|\App\Models\HeroSlide[] $slides */
  $slides = $slides ?? collect();
  $locale = app()->getLocale();
  $pillars = config('poultry_services.pillars', []);
  $pillarCopy = __('messages.svc_pillars');

  $videoSlide = $slides->first(fn ($s) => $s->hasVideo());
  $videoUrl = $videoSlide?->getVideoUrl();
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
<section class="hero hero--cinematic hero--with-gates hero--ux {{ $videoUrl ? 'hero--has-video' : 'hero--no-video' }}" id="home" data-hero-cinematic>
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

    <div class="hero-scrim hero-scrim--ux"></div>
    <div class="hero-grain"></div>
  </div>

  <div class="hero-content">
    <div class="hero-content-inner">
      <p class="hero-brand" data-hero-fade>{{ __('messages.brand') }}</p>
      <p class="hero-kicker" data-hero-fade>{{ __('messages.hero_kicker') }}</p>

      <h1 class="hero-title" data-hero-headline>
        <span class="char-reveal"><span class="char-line">{{ __('messages.hero_main_line') }}</span></span>
      </h1>

      <p class="hero-lead" data-hero-fade>{{ __('messages.hero_paragraph') }}</p>

      <div class="hero-gates" id="services" aria-label="{{ __('messages.svc_cinema_title') }}">
        @foreach($pillars as $key => $meta)
          @php
            $item = $pillarCopy[$key] ?? [];
            $gateImg = $meta['catalog']['gallery'][0]
                ?? $meta['catalog']['poster']
                ?? $fallbackImage;
          @endphp
          <a
            href="{{ route('services.show', [$locale, $key]) }}"
            class="hero-gate hero-gate--visual"
            style="--gate-i: {{ $loop->index }}"
            data-magnetic
          >
            <span class="hero-gate-media" aria-hidden="true">
              <img src="{{ $gateImg }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async">
            </span>
            <span class="hero-gate-shade" aria-hidden="true"></span>
            <span class="hero-gate-body">
              <span class="hero-gate-top">
                <span class="hero-gate-num">{{ $item['num'] ?? $loop->iteration }}</span>
                <span class="hero-gate-kicker">{{ $item['kicker'] ?? '' }}</span>
              </span>
              <span class="hero-gate-title">{{ $item['title'] ?? $key }}</span>
              <span class="hero-gate-tag">{{ $item['tagline'] ?? '' }}</span>
              <span class="hero-gate-cta">
                {{ __('messages.svc_cinema_explore') }}
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </span>
            </span>
          </a>
        @endforeach
      </div>

      <div class="hero-actions hero-actions--secondary" data-hero-fade>
        <a href="#start" class="btn btn-primary hero-cta" data-magnetic>
          {{ __('messages.nav_calculator') }}
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <a href="#contact" class="btn hero-cta-ghost" data-magnetic>
          {{ __('messages.request_quote') }}
        </a>
      </div>
    </div>
  </div>
</section>
