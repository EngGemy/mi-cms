@php
  /** @var \Illuminate\Support\Collection|\App\Models\HeroSlide[] $slides */
  $slides = $slides ?? collect();
  $locale = app()->getLocale();
  $pillars = config('poultry_services.pillars', []);
  $pillarCopy = __('messages.svc_pillars');

  $fallbackImage = 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1920&q=85&auto=format&fit=crop';
  $hasAnyVideo = $slides->contains(fn ($s) => $s->hasVideo());
  $slideCount = max(1, $slides->count());
@endphp
<section
  class="hero hero--cinematic hero--with-gates hero--ux {{ $hasAnyVideo ? 'hero--has-video' : 'hero--no-video' }}"
  id="home"
  data-hero-cinematic
  data-hero-interval="3800"
>
  <div class="hero-media" aria-hidden="true">
    <div class="hero-media-stack" data-hero-media>
      @forelse($slides as $i => $slide)
        @php
          $videoUrl = $slide->hasVideo() ? $slide->getVideoUrl() : null;
          $posterUrl = null;
          if ($slide->getFirstMedia('poster')) {
              $posterUrl = $slide->getPosterUrl('hero');
          } elseif ($slide->getFirstMedia('image')) {
              $posterUrl = $slide->getImageUrl('hero');
          }
          $desk = $posterUrl
              ?? $slide->getImageUrl('hero')
              ?? (filter_var((string) $slide->image_url, FILTER_VALIDATE_URL) ? $slide->image_url : null)
              ?? $fallbackImage;
          $mob = $slide->getFirstMedia('image')
              ? ($slide->getImageUrl('mobile') ?: $desk)
              : ($slide->getFirstMedia('poster') ? ($slide->getPosterUrl('mobile') ?: $desk) : $desk);
        @endphp
        <div
          class="hero-media-layer @if($loop->first) is-active @endif"
          data-hero-layer="{{ $i }}"
          data-hero-has-video="{{ $videoUrl ? '1' : '0' }}"
        >
          @if($videoUrl)
            <video
              class="hero-video"
              data-hero-video
              muted
              loop
              playsinline
              webkit-playsinline
              preload="{{ $loop->first ? 'auto' : 'metadata' }}"
              @if($posterUrl) poster="{{ $posterUrl }}" @endif
            >
              <source src="{{ $videoUrl }}" type="{{ str_ends_with(strtolower(parse_url($videoUrl, PHP_URL_PATH) ?: $videoUrl), '.webm') ? 'video/webm' : 'video/mp4' }}">
            </video>
          @endif
          <picture class="hero-media-still {{ $videoUrl ? 'hero-media-still--under' : '' }}">
            <source media="(max-width: 767px)" srcset="{{ $mob }}">
            <img
              src="{{ $desk }}"
              alt=""
              loading="{{ $loop->first ? 'eager' : 'lazy' }}"
              decoding="async"
              @if($loop->first) fetchpriority="high" @endif
            >
          </picture>
        </div>
      @empty
        <div class="hero-media-layer is-active" data-hero-layer="0" data-hero-has-video="0">
          <picture class="hero-media-still">
            <img src="{{ $fallbackImage }}" alt="" loading="eager" decoding="async" fetchpriority="high">
          </picture>
        </div>
      @endforelse
    </div>

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

      <div class="hero-title hero-title--rotate" data-hero-headline>
        <div class="rotating-word" id="rotWord" aria-live="polite">
          @forelse($slides as $slide)
            <span class="rw-item @if($loop->first)is-active @endif">{{ $slide->label }}</span>
          @empty
            <span class="rw-item is-active">{{ __('messages.hero_default_label') }}</span>
          @endforelse
        </div>
      </div>

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

      @if($slideCount > 1)
        <div class="hero-progress" data-hero-fade aria-hidden="true">
          @for($d = 0; $d < $slideCount; $d++)
            <span class="hero-progress-dot @if($d === 0) is-active @endif" data-hero-dot="{{ $d }}"></span>
          @endfor
        </div>
      @endif
    </div>
  </div>
</section>
