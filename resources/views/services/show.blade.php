@php
  $locale = app()->getLocale();
  $calcType = $meta['calc_type'] ?? null;
  $allPillars = config('poultry_services.pillars', []);
  $allCopy = __('messages.svc_pillars');
@endphp
<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <article class="svc-page" data-svc-page="{{ $slug }}">
    <section class="svc-page-hero">
      <div class="svc-page-hero-bg" aria-hidden="true">
        <div class="svc-page-hero-wash"></div>
        <div class="svc-page-hero-grid"></div>
        <div class="svc-page-hero-orb"></div>
      </div>
      <div class="section-inner svc-page-hero-inner">
        <span class="svc-page-kicker" data-reveal>{{ $copy['kicker'] }} · {{ $copy['num'] }}</span>
        <h1 class="svc-page-title" data-reveal="title">{{ $copy['title'] }}</h1>
        <p class="svc-page-tagline" data-reveal>{{ $copy['tagline'] }}</p>
        <p class="svc-page-lead" data-reveal>{{ $copy['lead'] }}</p>
        <div class="svc-page-actions" data-reveal>
          @if($calcType)
            <a href="{{ route('home', $locale) }}#start" class="btn btn-primary btn-lg" data-svc-calc="{{ $calcType }}">
              {{ __('messages.svc_cinema_calc') }}
            </a>
          @endif
          <a href="{{ route('home', $locale) }}#contact" class="btn btn-dark btn-lg">
            {{ __('messages.svc_cinema_quote') }}
          </a>
        </div>
      </div>
    </section>

    <section class="svc-page-story">
      <div class="section-inner svc-page-story-grid">
        <div class="svc-page-story-copy" data-reveal>
          <span class="eyebrow">{{ __('messages.svc_cinema_includes') }}</span>
          <h2 class="display-3 mt-3">{{ $copy['title'] }}</h2>
          <p class="lead mt-5">{{ $copy['story'] }}</p>
          <ul class="svc-page-bullets mt-8">
            @foreach(($copy['highlights'] ?? []) as $i => $line)
              <li>
                <span class="svc-bullet-idx">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                <span>{{ $line }}</span>
              </li>
            @endforeach
          </ul>
        </div>
        <aside class="svc-page-specboard" data-reveal="right">
          <div class="svc-spec-label">{{ __('messages.svc_cinema_specs') }}</div>
          <dl class="svc-page-specs">
            @foreach(($copy['specs'] ?? []) as $label => $value)
              <div class="svc-page-spec">
                <dt>{{ $label }}</dt>
                <dd>{{ $value }}</dd>
              </div>
            @endforeach
          </dl>
        </aside>
      </div>
    </section>

    @if($products->isNotEmpty())
      <section class="svc-page-related">
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
      <section class="svc-page-projects">
        <div class="section-inner">
          <span class="eyebrow" data-reveal>{{ __('messages.nav_projects') }}</span>
          <h2 class="display-3 mt-2 mb-10" data-reveal="title">{{ __('messages.nav_projects') }}</h2>
          <div class="svc-projects-grid" data-stagger>
            @foreach($projects as $project)
              <a href="{{ route('projects.show', [$locale, $project->slug]) }}" class="svc-mini-project">
                <div class="svc-mini-project-media">
                  <img src="{{ $project->getCoverUrl('card') ?? $project->getCoverUrl('hero') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=800&q=80' }}"
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

    <section class="svc-page-cta">
      <div class="section-inner svc-page-cta-inner" data-reveal>
        <h2 class="display-2">{{ __('messages.request_quote') }}</h2>
        <p class="lead mt-4">{{ $copy['tagline'] }}</p>
        <div class="svc-page-actions mt-8" style="justify-content:center">
          <a href="{{ route('home', $locale) }}#contact" class="btn btn-primary btn-lg">{{ __('messages.request_quote') }}</a>
          <a href="{{ route('home', $locale) }}#services" class="btn btn-dark btn-lg">{{ __('messages.svc_back') }}</a>
        </div>
      </div>
    </section>
  </article>
</x-layouts.public>
