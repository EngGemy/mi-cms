<x-layouts.public :seo="$seo">

{{-- ================================================================
     HERO
     ================================================================ --}}
<section class="about-hero">
  <div class="about-hero-bg" aria-hidden="true">
    <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1800&q=80&auto=format&fit=crop"
         alt="" loading="eager" class="about-hero-img" id="aboutHeroBg"/>
    <div class="about-hero-overlay"></div>
  </div>
  <div class="section-inner about-hero-inner">
    <span class="eyebrow eyebrow--light" data-reveal>{{ __('messages.about_hero_eyebrow') }}</span>
    <h1 class="display-1 about-hero-title" data-about-title>
      <span class="about-title-line">{{ __('messages.about_hero_line1') }}</span>
      <span class="about-title-line">{{ __('messages.about_hero_line2') }}</span>
    </h1>
    <p class="lead about-hero-lead" data-reveal>{{ __('messages.about_hero_lead') }}</p>
  </div>
</section>

{{-- ================================================================
     STATS
     ================================================================ --}}
<section class="about-stats-bar">
  <div class="section-inner">
    <div class="about-stats-grid" data-stagger>
      <div class="about-stat">
        <div class="about-stat-num"><span data-counter data-target="16">0</span>+</div>
        <div class="about-stat-label label-mono">{{ __('messages.about_stat_years') }}</div>
      </div>
      <div class="about-stat">
        <div class="about-stat-num"><span data-counter data-target="2000">0</span>+</div>
        <div class="about-stat-label label-mono">{{ __('messages.about_stat_barns') }}</div>
      </div>
      <div class="about-stat">
        <div class="about-stat-num"><span data-counter data-target="18">0</span>M+</div>
        <div class="about-stat-label label-mono">{{ __('messages.about_stat_birds') }}</div>
      </div>
      <div class="about-stat">
        <div class="about-stat-num"><span data-counter data-target="9">0</span>+</div>
        <div class="about-stat-label label-mono">{{ __('messages.about_stat_countries') }}</div>
      </div>
    </div>
  </div>
</section>

{{-- ================================================================
     STORY + TIMELINE
     ================================================================ --}}
<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="about-story-intro" data-reveal>
      <span class="eyebrow">{{ __('messages.about_story_eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ __('messages.about_story_title') }}</h2>
      <p class="lead mt-5 max-w-2xl">{{ __('messages.about_story_blurb') }}</p>
    </div>

    <div class="about-timeline" id="aboutTimeline">
      <div class="about-timeline-line" id="timelineLine"></div>

      @php
        $milestones = [
          ['year'=>'2008','icon'=>'building-2','key'=>'tm_2008'],
          ['year'=>'2012','icon'=>'wrench','key'=>'tm_2012'],
          ['year'=>'2016','icon'=>'award','key'=>'tm_2016'],
          ['year'=>'2019','icon'=>'globe','key'=>'tm_2019'],
          ['year'=>'2022','icon'=>'cpu','key'=>'tm_2022'],
          ['year'=>'2026','icon'=>'rocket','key'=>'tm_2026'],
        ];
      @endphp

      @foreach($milestones as $i => $m)
        <div class="about-milestone" data-milestone="{{ $i }}">
          <div class="about-milestone-dot">
            <i data-lucide="{{ $m['icon'] }}" class="w-4 h-4"></i>
          </div>
          <div class="about-milestone-card">
            <div class="about-milestone-year label-mono">{{ $m['year'] }}</div>
            <h3 class="about-milestone-title">{{ __('messages.' . $m['key'] . '_title') }}</h3>
            <p class="about-milestone-desc">{{ __('messages.' . $m['key'] . '_desc') }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ================================================================
     VISION / MISSION / GOALS
     ================================================================ --}}
<section class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center mb-16" data-reveal>
      <span class="eyebrow">{{ __('messages.about_vmg_eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ __('messages.about_vmg_title') }}</h2>
    </div>
    <div class="about-vmg-grid" data-stagger>
      <div class="about-vmg-card">
        <div class="about-vmg-icon"><i data-lucide="eye" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ __('messages.about_vision_title') }}</h3>
        <p class="about-vmg-text">{{ __('messages.about_vision_text') }}</p>
      </div>
      <div class="about-vmg-card about-vmg-card--accent">
        <div class="about-vmg-icon"><i data-lucide="target" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ __('messages.about_mission_title') }}</h3>
        <p class="about-vmg-text">{{ __('messages.about_mission_text') }}</p>
      </div>
      <div class="about-vmg-card">
        <div class="about-vmg-icon"><i data-lucide="trending-up" class="w-7 h-7"></i></div>
        <h3 class="about-vmg-heading">{{ __('messages.about_goals_title') }}</h3>
        <p class="about-vmg-text">{{ __('messages.about_goals_text') }}</p>
      </div>
    </div>
  </div>
</section>

{{-- ================================================================
     CORE VALUES
     ================================================================ --}}
<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="about-values-header" data-reveal>
      <span class="eyebrow">{{ __('messages.about_values_eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ __('messages.about_values_title') }}</h2>
    </div>
    <div class="about-values-grid" data-stagger>
      @php
        $values = [
          ['icon'=>'shield-check','key'=>'val_quality'],
          ['icon'=>'lightbulb',   'key'=>'val_innovation'],
          ['icon'=>'handshake',   'key'=>'val_commitment'],
          ['icon'=>'users',       'key'=>'val_customer'],
          ['icon'=>'leaf',        'key'=>'val_sustainability'],
          ['icon'=>'star',        'key'=>'val_excellence'],
        ];
      @endphp
      @foreach($values as $v)
        <div class="about-value-item">
          <div class="about-value-icon"><i data-lucide="{{ $v['icon'] }}" class="w-6 h-6"></i></div>
          <h4 class="about-value-title">{{ __('messages.' . $v['key'] . '_title') }}</h4>
          <p class="about-value-desc">{{ __('messages.' . $v['key'] . '_desc') }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ================================================================
     CERTIFICATIONS
     ================================================================ --}}
@if($certifications->isNotEmpty())
<section class="py-24 lg:py-32 bg-paper" id="certificationsSection">
  <div class="section-inner">
    <div class="text-center mb-14" data-reveal>
      <span class="eyebrow">{{ __('messages.about_certs_eyebrow') }}</span>
      <h2 class="display-2 mt-3">{{ __('messages.about_certs_title') }}</h2>
      <p class="lead mt-4 max-w-xl mx-auto">{{ __('messages.about_certs_blurb') }}</p>
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
          {{-- Hover preview tooltip --}}
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
<section class="py-24 lg:py-32" id="aboutVideoSection">
  <div class="section-inner">
    <div class="grid lg:grid-cols-12 gap-10 items-end mb-10">
      <div class="lg:col-span-7" data-reveal="left">
        <span class="eyebrow">{{ __('messages.about_video_eyebrow') ?? 'Factory Tour' }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.about_video_title') ?? 'See How We Build Excellence' }}</h2>
      </div>
      <p class="lead lg:col-span-5" data-reveal="right">{{ __('messages.about_video_blurb') ?? 'Take a virtual walk through our state-of-the-art manufacturing facility in Damietta.' }}</p>
    </div>
    <div class="video-showcase about-video-showcase" data-reveal="scale" data-parallax="0.05">
      <video autoplay muted loop playsinline poster="https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop">
        <source src="https://videos.pexels.com/video-files/3045163/3045163-uhd_2560_1440_25fps.mp4" type="video/mp4">
      </video>
      <div class="video-overlay">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
          <span class="label-mono text-white">MI POULTRY · FACTORY</span>
        </div>
        <div>
          <div class="serif-italic text-white" style="font-size:18px">made in damietta</div>
          <div class="display-3 text-white mt-1">{{ __('messages.about_video_headline') ?? 'Precision Engineering for Modern Poultry' }}</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ================================================================
     CATALOG CTA
     ================================================================ --}}
<section class="about-catalog-section">
  <div class="section-inner">
    <div class="about-catalog-inner" data-reveal>
      <div class="about-catalog-text">
        <span class="eyebrow eyebrow--light">{{ __('messages.about_catalog_eyebrow') }}</span>
        <h2 class="display-2 mt-3">{{ __('messages.about_catalog_title') }}</h2>
        <p class="lead mt-5">{{ __('messages.about_catalog_blurb') }}</p>
        <div class="about-catalog-actions">
          @if($catalogUrl)
            <a href="{{ $catalogUrl }}" target="_blank" rel="noopener"
               class="btn btn-primary" data-magnetic>
              <i data-lucide="download" class="w-4 h-4"></i>
              {{ __('messages.about_catalog_download') }}
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
    <span class="eyebrow">{{ __('messages.about_final_cta_eyebrow') }}</span>
    <h2 class="display-2 mt-3">{{ __('messages.about_final_cta_title') }}</h2>
    <p class="lead mt-5 max-w-xl mx-auto">{{ __('messages.about_final_cta_blurb') }}</p>
    <a href="{{ route('home', app()->getLocale()) }}#contact"
       class="btn btn-dark btn-lg mt-8" data-magnetic>
      {{ __('messages.about_final_cta_btn') }}
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
