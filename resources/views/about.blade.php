<x-layouts.public :seo="$seo">

@php
  /** @var \App\Settings\AboutSettings $about */
  $heroFallback = $about->hero['fallback_image'] ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1800&q=80&auto=format&fit=crop';
  $heroImg = $about->heroImageUrl($heroFallback);
  $videoPosterFallback = $about->video['fallback_poster'] ?? 'https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop';
  $videoPoster = $about->videoPosterUrl($videoPosterFallback);
  $videoSrc = $about->video_url ?: null;
@endphp

{{-- ================================================================
     HERO
     ================================================================ --}}
<section class="about-hero">
  <div class="about-hero-bg" aria-hidden="true">
    <img src="{{ $heroImg }}"
         alt="" loading="eager" class="about-hero-img" id="aboutHeroBg"/>
    <div class="about-hero-overlay"></div>
  </div>
  <div class="section-inner about-hero-inner">
    <span class="eyebrow eyebrow--light" data-reveal>{{ $about->text($about->hero, 'eyebrow') }}</span>
    <h1 class="display-1 about-hero-title" data-about-title>
      <span class="about-title-line">{{ $about->text($about->hero, 'line1') }}</span>
      <span class="about-title-line">{{ $about->text($about->hero, 'line2') }}</span>
    </h1>
    <p class="lead about-hero-lead" data-reveal>{{ $about->text($about->hero, 'lead') }}</p>
  </div>
</section>

{{-- ================================================================
     STATS
     ================================================================ --}}
@if(!empty($about->stats))
<section class="about-stats-bar">
  <div class="section-inner">
    <div class="about-stats-grid" data-stagger>
      @foreach($about->stats as $stat)
        <div class="about-stat">
          <div class="about-stat-num">
            <span data-counter data-target="{{ (int) ($stat['value'] ?? 0) }}">0</span>{{ $stat['suffix'] ?? '' }}
          </div>
          <div class="about-stat-label label-mono">{{ $about->text($stat, 'label') }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ================================================================
     STORY + TIMELINE
     ================================================================ --}}
<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="about-story-intro" data-reveal>
      <span class="eyebrow">{{ $about->text($about->story, 'eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ $about->text($about->story, 'title') }}</h2>
      <p class="lead mt-5 max-w-2xl">{{ $about->text($about->story, 'blurb') }}</p>
    </div>

    @if(!empty($about->milestones))
    <div class="about-timeline" id="aboutTimeline">
      <div class="about-timeline-line" id="timelineLine"></div>

      @foreach($about->milestones as $i => $m)
        <div class="about-milestone" data-milestone="{{ $i }}">
          <div class="about-milestone-dot">
            <i data-lucide="{{ $m['icon'] ?? 'award' }}" class="w-4 h-4"></i>
          </div>
          <div class="about-milestone-card">
            <div class="about-milestone-year label-mono">{{ $m['year'] ?? '' }}</div>
            <h3 class="about-milestone-title">{{ $about->text($m, 'title') }}</h3>
            <p class="about-milestone-desc">{{ $about->text($m, 'desc') }}</p>
          </div>
        </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ================================================================
     VISION / MISSION / GOALS
     ================================================================ --}}
<section class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center mb-16" data-reveal>
      <span class="eyebrow">{{ $about->text($about->vmg, 'eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ $about->text($about->vmg, 'title') }}</h2>
    </div>
    <div class="about-vmg-grid" data-stagger>
      <div class="about-vmg-card">
        <div class="about-vmg-icon"><i data-lucide="eye" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ $about->text($about->vmg, 'vision_title') }}</h3>
        <p class="about-vmg-text">{{ $about->text($about->vmg, 'vision_text') }}</p>
      </div>
      <div class="about-vmg-card about-vmg-card--accent">
        <div class="about-vmg-icon"><i data-lucide="target" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ $about->text($about->vmg, 'mission_title') }}</h3>
        <p class="about-vmg-text">{{ $about->text($about->vmg, 'mission_text') }}</p>
      </div>
      <div class="about-vmg-card">
        <div class="about-vmg-icon"><i data-lucide="trending-up" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ $about->text($about->vmg, 'goals_title') }}</h3>
        <p class="about-vmg-text">{{ $about->text($about->vmg, 'goals_text') }}</p>
      </div>
    </div>
  </div>
</section>

{{-- ================================================================
     CORE VALUES
     ================================================================ --}}
@if(!empty($about->values))
<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="about-values-header" data-reveal>
      <span class="eyebrow">{{ $about->text($about->values_header, 'eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ $about->text($about->values_header, 'title') }}</h2>
    </div>
    <div class="about-values-grid" data-stagger>
      @foreach($about->values as $v)
        <div class="about-value-item">
          <div class="about-value-icon"><i data-lucide="{{ $v['icon'] ?? 'star' }}" class="w-6 h-6"></i></div>
          <h4 class="about-value-title">{{ $about->text($v, 'title') }}</h4>
          <p class="about-value-desc">{{ $about->text($v, 'desc') }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ================================================================
     CERTIFICATIONS
     ================================================================ --}}
@if($certifications->isNotEmpty())
<section class="py-24 lg:py-32 bg-paper" id="certificationsSection">
  <div class="section-inner">
    <div class="text-center mb-14" data-reveal>
      <span class="eyebrow">{{ $about->text($about->certs, 'eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ $about->text($about->certs, 'title') }}</h2>
      <p class="lead mt-4 max-w-xl mx-auto">{{ $about->text($about->certs, 'blurb') }}</p>
    </div>
    <div class="about-certs-grid" data-stagger>
      @foreach($certifications as $i => $cert)
        <div class="about-cert-card" role="button" tabindex="0"
             data-cert-card
             data-cert-index="{{ $i }}"
             data-cert-name="{{ $cert->name }}"
             data-cert-issuer="{{ $cert->issuer }}"
             data-cert-img="{{ $cert->getFirstMediaUrl('logo') ?? '' }}">
          @if($cert->getLogoUrl())
            <img src="{{ $cert->getLogoUrl() }}" alt="{{ $cert->name }}" loading="lazy" class="about-cert-logo"/>
          @else
            <div class="about-cert-logo-placeholder">
              <i data-lucide="award" class="w-8 h-8"></i>
            </div>
          @endif
          <div class="about-cert-body">
            <div class="about-cert-name">{{ $cert->name }}</div>
            <div class="about-cert-issuer label-mono">{{ $cert->issuer }}</div>
            @if($cert->year)
              <div class="about-cert-year">{{ $cert->year }}</div>
            @endif
          </div>
          <div class="cert-hover-preview" aria-hidden="true">
            @if($cert->getFirstMediaUrl('logo'))
              <img src="{{ $cert->getFirstMediaUrl('logo') }}" alt=""/>
            @else
              <div class="cert-hover-placeholder"><i data-lucide="award" class="w-10 h-10"></i></div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ================================================================
     VIDEO ABOUT US
     ================================================================ --}}
@if($videoSrc)
<section class="py-24 lg:py-32" id="aboutVideoSection">
  <div class="section-inner">
    <div class="grid lg:grid-cols-12 gap-10 items-end mb-10">
      <div class="lg:col-span-7" data-reveal="left">
        <span class="eyebrow">{{ $about->text($about->video, 'eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ $about->text($about->video, 'title') }}</h2>
      </div>
      <p class="lead lg:col-span-5" data-reveal="right">{{ $about->text($about->video, 'blurb') }}</p>
    </div>
    <div class="video-showcase about-video-showcase" data-reveal="scale" data-parallax="0.05">
      <video autoplay muted loop playsinline poster="{{ $videoPoster }}">
        <source src="{{ $videoSrc }}" type="video/mp4">
      </video>
      <div class="video-overlay">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
          <span class="label-mono text-white">{{ $about->video['badge'] ?? 'MI POULTRY · FACTORY' }}</span>
        </div>
        <div>
          <div class="serif-italic text-white" style="font-size:18px">{{ $about->video['caption'] ?? 'made in damietta' }}</div>
          <div class="display-3 text-white mt-1">{{ $about->text($about->video, 'headline') }}</div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ================================================================
     CATALOG CTA
     ================================================================ --}}
<section class="about-catalog-section">
  <div class="section-inner">
    <div class="about-catalog-inner" data-reveal>
      <div class="about-catalog-text">
        <span class="eyebrow eyebrow--light">{{ $about->text($about->catalog, 'eyebrow') }}</span>
        <h2 class="display-2 mt-3">{{ $about->text($about->catalog, 'title') }}</h2>
        <p class="lead mt-5">{{ $about->text($about->catalog, 'blurb') }}</p>
        <div class="about-catalog-actions">
          @if($catalogUrl)
            <a href="{{ $catalogUrl }}" target="_blank" rel="noopener"
               class="btn btn-primary" data-magnetic>
              <i data-lucide="download" class="w-4 h-4"></i>
              {{ $about->text($about->catalog, 'download') }}
            </a>
          @endif
          <a href="{{ route('products.index', app()->getLocale()) }}"
             class="btn btn-ghost {{ $catalogUrl ? '' : 'btn-primary' }}" data-magnetic>
            {{ __('messages.all_products') }}
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
          </a>
        </div>
      </div>
      <div class="about-catalog-visual" aria-hidden="true">
        @if($catalogUrl)
          <a href="{{ $catalogUrl }}" target="_blank" rel="noopener" download class="about-catalog-badge-link">
        @endif
        <div class="about-catalog-badge">
          <i data-lucide="file-text" class="w-12 h-12"></i>
          <div class="label-mono mt-2">PDF</div>
        </div>
        @if($catalogUrl)
          </a>
        @endif
      </div>
    </div>
  </div>
</section>

{{-- ================================================================
     FINAL CTA
     ================================================================ --}}
<section class="py-24 lg:py-32 bg-paper">
  <div class="section-inner text-center" data-reveal>
    <span class="eyebrow">{{ $about->text($about->final_cta, 'eyebrow') }}</span>
    <h2 class="display-2 mt-3">{{ $about->text($about->final_cta, 'title') }}</h2>
    <p class="lead mt-5 max-w-xl mx-auto">{{ $about->text($about->final_cta, 'blurb') }}</p>
    <a href="{{ route('home', app()->getLocale()) }}#contact"
       class="btn btn-dark btn-lg mt-8" data-magnetic>
      {{ $about->text($about->final_cta, 'btn') }}
      <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
  </div>
</section>

{{-- Certification Modal (Slider) --}}
<div class="cert-modal-overlay" id="certModal" aria-hidden="true">
  <button class="cert-modal-close" id="certModalClose" aria-label="{{ __('messages.close') }}">
    <i data-lucide="x" class="w-6 h-6"></i>
  </button>

  <button class="cert-modal-arrow cert-modal-arrow--prev" id="certModalPrev" aria-label="السابق">
    <i data-lucide="chevron-right" class="w-6 h-6"></i>
  </button>
  <button class="cert-modal-arrow cert-modal-arrow--next" id="certModalNext" aria-label="التالي">
    <i data-lucide="chevron-left" class="w-6 h-6"></i>
  </button>

  <div class="cert-modal-container">
    <div class="cert-modal-visual">
      <img src="" alt="" id="certModalImg" class="cert-modal-img"/>
      <div class="cert-modal-placeholder" id="certModalPlaceholder">
        <i data-lucide="award" class="w-16 h-16"></i>
      </div>
    </div>
    <div class="cert-modal-info">
      <div class="cert-modal-name" id="certModalName"></div>
      <div class="cert-modal-issuer label-mono" id="certModalIssuer"></div>
      <div class="cert-modal-counter" id="certModalCounter"></div>
    </div>
  </div>
</div>

</x-layouts.public>
