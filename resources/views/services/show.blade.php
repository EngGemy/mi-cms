@php
  $locale = app()->getLocale();
  $calcType = $meta['calc_type'] ?? null;
  $catalog = $meta['catalog'] ?? [];
  $gallery = array_values($catalog['gallery'] ?? []);
  $videoUrl = trim((string) ($catalog['video'] ?? ''));
  $poster = $catalog['poster'] ?? ($gallery[0] ?? null);
  $captions = $copy['gallery_captions'] ?? [];
  $allPillars = config('poultry_services.pillars', []);
  $allCopy = __('messages.svc_pillars');
  $wa = 'https://wa.me/'.config('mi.whatsapp').'?text='.rawurlencode(($copy['title'] ?? '').' — '.__('messages.svc_get_price'));
@endphp
<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <article class="svc-catalog" data-svc-catalog data-svc-page="{{ $slug }}">
    {{-- ===== HERO: gallery + product panel (CN Poul Tech style) ===== --}}
    <section class="svc-cat-hero">
      <div class="section-inner svc-cat-hero-grid">
        <div class="svc-cat-gallery" data-svc-gallery data-reveal>
          <div class="svc-cat-gallery-main">
            <span class="svc-cat-badge">{{ __('messages.svc_catalog_badge') }}</span>
            <img
              src="{{ $gallery[0] ?? $poster }}"
              alt="{{ $copy['title'] }}"
              data-svc-gallery-main
              loading="eager"
              decoding="async"
            >
          </div>
          @if(count($gallery) > 1)
            <div class="svc-cat-thumbs" role="list">
              @foreach($gallery as $i => $img)
                <button
                  type="button"
                  class="svc-cat-thumb {{ $i === 0 ? 'is-active' : '' }}"
                  data-svc-thumb
                  data-src="{{ $img }}"
                  aria-label="{{ $captions[$i] ?? ($copy['title'].' '.($i+1)) }}"
                >
                  <img src="{{ $img }}" alt="" loading="lazy">
                </button>
              @endforeach
            </div>
          @endif
        </div>

        <div class="svc-cat-panel" data-reveal="right">
          <span class="svc-page-kicker">{{ $copy['kicker'] }} · {{ $copy['num'] }}</span>
          <p class="svc-cat-model">{{ __('messages.svc_model_label') }}: <strong>{{ $copy['model'] ?? ($catalog['model'] ?? '') }}</strong></p>
          <h1 class="svc-page-title">{{ $copy['title'] }}</h1>
          <p class="svc-page-tagline">{{ $copy['tagline'] }}</p>
          <p class="svc-page-lead">{{ $copy['lead'] }}</p>

          <div class="svc-cat-quick">
            <div class="svc-spec-label">{{ __('messages.svc_quick_specs') }}</div>
            <dl class="svc-cat-quick-list">
              @foreach(array_slice($copy['specs'] ?? [], 0, 5, true) as $label => $value)
                <div class="svc-page-spec">
                  <dt>{{ $label }}</dt>
                  <dd>{{ $value }}</dd>
                </div>
              @endforeach
            </dl>
          </div>

          <div class="svc-page-actions">
            @if($calcType)
              <a href="{{ route('home', $locale) }}#start" class="btn btn-primary btn-lg" data-svc-calc="{{ $calcType }}">
                {{ __('messages.svc_cinema_calc') }}
              </a>
            @endif
            <a href="{{ route('home', $locale) }}#contact" class="btn btn-dark btn-lg">{{ __('messages.svc_get_price') }}</a>
            <a href="{{ $wa }}" class="btn btn-ghost btn-lg" target="_blank" rel="noopener">WhatsApp</a>
          </div>
        </div>
      </div>
    </section>

    {{-- ===== Sticky tabs ===== --}}
    <nav class="svc-cat-tabs" data-svc-tabs aria-label="{{ $copy['title'] }}">
      <div class="section-inner svc-cat-tabs-inner">
        <a href="#svc-intro" data-svc-tab>{{ __('messages.svc_tab_intro') }}</a>
        <a href="#svc-adv" data-svc-tab>{{ __('messages.svc_tab_adv') }}</a>
        <a href="#svc-types" data-svc-tab>{{ __('messages.svc_tab_types') }}</a>
        <a href="#svc-specs" data-svc-tab>{{ __('messages.svc_tab_specs') }}</a>
        <a href="#svc-gallery" data-svc-tab>{{ __('messages.svc_tab_gallery') }}</a>
        <a href="#svc-video" data-svc-tab>{{ __('messages.svc_tab_video') }}</a>
        <a href="#svc-inquiry" data-svc-tab class="is-cta">{{ __('messages.svc_tab_inquiry') }}</a>
      </div>
    </nav>

    {{-- ===== Introduction ===== --}}
    <section class="svc-cat-section" id="svc-intro">
      <div class="section-inner svc-cat-intro-grid">
        <div data-reveal>
          <span class="eyebrow">{{ __('messages.svc_tab_intro') }}</span>
          <h2 class="display-3 mt-3">{{ $copy['model'] ?? $copy['title'] }}</h2>
          <p class="lead mt-5">{{ $copy['story'] }}</p>
          <ul class="svc-page-bullets mt-8">
            @foreach(($copy['intro_points'] ?? $copy['highlights'] ?? []) as $i => $line)
              <li>
                <span class="svc-bullet-idx">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                <span>{{ $line }}</span>
              </li>
            @endforeach
          </ul>
        </div>
        <aside class="svc-page-specboard" data-reveal="right">
          <div class="svc-spec-label">{{ __('messages.svc_cinema_includes') }}</div>
          <ul class="svc-cat-include">
            @foreach(($copy['highlights'] ?? []) as $line)
              <li>{{ $line }}</li>
            @endforeach
          </ul>
        </aside>
      </div>
    </section>

    {{-- ===== Advantages ===== --}}
    <section class="svc-cat-section svc-cat-section--paper" id="svc-adv">
      <div class="section-inner">
        <span class="eyebrow" data-reveal>{{ __('messages.svc_tab_adv') }}</span>
        <h2 class="display-3 mt-2" data-reveal="title">{{ __('messages.svc_adv_title') }}</h2>
        <div class="svc-cat-adv-grid" data-stagger>
          @foreach(($copy['advantages'] ?? []) as $adv)
            <article class="svc-cat-adv">
              <h3>{{ $adv['title'] }}</h3>
              <p>{{ $adv['desc'] }}</p>
            </article>
          @endforeach
        </div>

        <h3 class="display-3 mt-16 mb-8" data-reveal>{{ __('messages.svc_systems_title') }}</h3>
        <div class="svc-cat-systems" data-stagger>
          @foreach(($copy['systems'] ?? []) as $sys)
            <article class="svc-cat-system">
              <h4>{{ $sys['title'] }}</h4>
              <p>{{ $sys['desc'] }}</p>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    {{-- ===== Types ===== --}}
    <section class="svc-cat-section" id="svc-types">
      <div class="section-inner">
        <span class="eyebrow" data-reveal>{{ __('messages.svc_tab_types') }}</span>
        <h2 class="display-3 mt-2" data-reveal="title">{{ __('messages.svc_types_title') }}</h2>
        <p class="lead mt-4 mb-10" data-reveal>{{ __('messages.svc_types_blurb') }}</p>
        <div class="svc-cat-types" data-stagger>
          @foreach(($copy['types'] ?? []) as $type)
            <article class="svc-cat-type">
              @if(!empty($type['badge']))
                <span class="svc-cat-type-badge">{{ $type['badge'] }}</span>
              @endif
              <h3>{{ $type['name'] }}</h3>
              <p>{{ $type['blurb'] }}</p>
              <dl class="svc-cat-type-specs">
                @foreach(($type['specs'] ?? []) as $k => $v)
                  <div><dt>{{ $k }}</dt><dd>{{ $v }}</dd></div>
                @endforeach
              </dl>
              <a href="{{ route('home', $locale) }}#contact" class="svc-cat-type-cta">{{ __('messages.svc_get_price') }}</a>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    {{-- ===== Specs table ===== --}}
    <section class="svc-cat-section svc-cat-section--dark" id="svc-specs">
      <div class="section-inner">
        <span class="eyebrow eyebrow--light" data-reveal>{{ __('messages.svc_tab_specs') }}</span>
        <h2 class="display-3 mt-2" style="color:#fff" data-reveal="title">{{ __('messages.svc_cinema_specs') }}</h2>
        <div class="svc-cat-spec-table" data-reveal>
          @foreach(($copy['specs'] ?? []) as $label => $value)
            <div class="svc-cat-spec-row">
              <span>{{ $label }}</span>
              <strong>{{ $value }}</strong>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- ===== Gallery ===== --}}
    <section class="svc-cat-section" id="svc-gallery">
      <div class="section-inner">
        <span class="eyebrow" data-reveal>{{ __('messages.svc_tab_gallery') }}</span>
        <h2 class="display-3 mt-2 mb-10" data-reveal="title">{{ __('messages.svc_gallery_title') }}</h2>
        <div class="svc-cat-masonry" data-stagger>
          @foreach($gallery as $i => $img)
            <figure class="svc-cat-masonry-item">
              <img src="{{ $img }}" alt="{{ $captions[$i] ?? $copy['title'] }}" loading="lazy">
              @if(!empty($captions[$i]))
                <figcaption>{{ $captions[$i] }}</figcaption>
              @endif
            </figure>
          @endforeach
        </div>
      </div>
    </section>

    {{-- ===== Video ===== --}}
    <section class="svc-cat-section svc-cat-section--paper" id="svc-video">
      <div class="section-inner">
        <span class="eyebrow" data-reveal>{{ __('messages.svc_tab_video') }}</span>
        <h2 class="display-3 mt-2 mb-8" data-reveal="title">{{ __('messages.svc_video_title') }}</h2>
        <div class="svc-cat-video" data-reveal>
          @if($videoUrl !== '')
            @if(str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be') || str_contains($videoUrl, 'vimeo.com'))
              <div class="svc-cat-video-frame">
                <iframe src="{{ $videoUrl }}" title="{{ $copy['title'] }}" allowfullscreen loading="lazy"></iframe>
              </div>
            @else
              <video class="svc-cat-video-el" controls playsinline preload="metadata" @if($poster) poster="{{ $poster }}" @endif>
                <source src="{{ $videoUrl }}" type="video/mp4">
              </video>
            @endif
          @else
            <div class="svc-cat-video-empty">
              @if($poster)
                <img src="{{ $poster }}" alt="" loading="lazy">
              @endif
              <div class="svc-cat-video-empty-copy">
                <p>{{ __('messages.svc_video_empty') }}</p>
                <a href="{{ $wa }}" class="btn btn-primary" target="_blank" rel="noopener">WhatsApp</a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>

    {{-- ===== Related products ===== --}}
    @if($products->isNotEmpty())
      <section class="svc-cat-section" id="svc-products">
        <div class="section-inner">
          <div class="svc-page-section-head">
            <div>
              <span class="eyebrow" data-reveal>{{ __('messages.svc_cinema_related') }}</span>
              <h2 class="display-3 mt-2" data-reveal="title">{{ __('messages.products') }}</h2>
            </div>
            <a href="{{ route('products.index', array_filter([$locale, 'category' => $meta['product_category'] ?? null])) }}" class="btn btn-dark" data-reveal>
              {{ __('messages.all_products') }}
            </a>
          </div>
          <div class="products-grid listing-grid-anim" data-stagger>
            @foreach($products as $product)
              @include('products._card', ['product' => $product, 'size' => 'normal'])
            @endforeach
          </div>
        </div>
      </section>
    @endif

    @if($projects->isNotEmpty())
      <section class="svc-cat-section svc-cat-section--paper">
        <div class="section-inner">
          <span class="eyebrow" data-reveal>{{ __('messages.nav_projects') }}</span>
          <h2 class="display-3 mt-2 mb-10" data-reveal="title">{{ __('messages.nav_projects') }}</h2>
          <div class="svc-projects-grid" data-stagger>
            @foreach($projects as $project)
              <a href="{{ route('projects.show', [$locale, $project->slug]) }}" class="svc-mini-project">
                <div class="svc-mini-project-media">
                  <img src="{{ $project->getCoverUrl('card') ?? $project->getCoverUrl('hero') ?? ($gallery[0] ?? '') }}"
                       alt="{{ $project->title }}" loading="lazy"/>
                </div>
                <div class="svc-mini-project-body">
                  <span class="label-mono">{{ $project->getCategoryLabel() }}</span>
                  <h3>{{ $project->title }}</h3>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    {{-- ===== Inquiry CTA ===== --}}
    <section class="svc-page-cta" id="svc-inquiry">
      <div class="section-inner svc-page-cta-inner" data-reveal>
        <h2 class="display-2">{{ __('messages.request_quote') }}</h2>
        <p class="lead mt-4">{{ $copy['tagline'] }}</p>
        <div class="svc-page-actions mt-8" style="justify-content:center">
          <a href="{{ route('home', $locale) }}#contact" class="btn btn-primary btn-lg">{{ __('messages.request_quote') }}</a>
          <a href="{{ $wa }}" class="btn btn-dark btn-lg" target="_blank" rel="noopener">WhatsApp</a>
          <a href="{{ route('home', $locale) }}#services" class="btn btn-ghost btn-lg" style="color:#fff;border-color:rgba(255,255,255,.35)">{{ __('messages.svc_back') }}</a>
        </div>
      </div>
    </section>

    <section class="svc-page-siblings">
      <div class="section-inner">
        <span class="eyebrow" data-reveal>{{ __('messages.svc_related_services') }}</span>
        <h2 class="display-3 mt-2" data-reveal="title">{{ __('messages.svc_related_services') }}</h2>
        <p class="lead mt-4 mb-10" data-reveal>{{ __('messages.svc_related_blurb') }}</p>
        <div class="svc-siblings-grid">
          @foreach($allPillars as $key => $pillar)
            @continue($key === $slug)
            @php $sib = $allCopy[$key] ?? []; @endphp
            <a href="{{ route('services.show', [$locale, $key]) }}" class="svc-sibling" data-reveal>
              <span class="svc-sibling-num">{{ $sib['num'] ?? '' }}</span>
              <span class="svc-sibling-kicker">{{ $sib['kicker'] ?? '' }}</span>
              <span class="svc-sibling-title">{{ $sib['title'] ?? $key }}</span>
              <span class="svc-sibling-tag">{{ $sib['tagline'] ?? '' }}</span>
              <span class="svc-sibling-cta">{{ __('messages.svc_cinema_explore') }}</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  </article>
</x-layouts.public>
