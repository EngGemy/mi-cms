@php
  $locale = app()->getLocale();
  $products = $products ?? collect();
@endphp
{{-- Featured systems — clean image-led grid (no carousel noise) --}}
<section id="products" class="home-systems" aria-labelledby="homeSystemsTitle">
  <div class="section-inner">
    <header class="home-systems-head">
      <div data-reveal="left">
        <span class="eyebrow">{{ __('messages.products_eyebrow') }}</span>
        <h2 id="homeSystemsTitle" class="display-2 mt-2" data-reveal="title">
          {{ __('messages.products_title_part1') }}
          <span class="home-systems-accent">{{ __('messages.brand') }}</span>
          {{ __('messages.products_title_part2') }}
        </h2>
      </div>
      <p class="lead home-systems-blurb" data-reveal="right">{{ __('messages.products_blurb') }}</p>
    </header>

    <div class="home-systems-grid" data-stagger>
      @forelse($products as $product)
        <a
          href="{{ route('products.show', [$locale, $product->slug]) }}"
          class="home-system"
          aria-label="{{ $product->name }}"
        >
          <div class="home-system-media">
            <img
              src="{{ $product->getMainImageUrl('card') ?? 'https://images.unsplash.com/photo-1553531009-c4605ebe6122?w=900&q=85&auto=format&fit=crop' }}"
              alt="{{ $product->name }}"
              loading="lazy"
              decoding="async"
              width="720"
              height="900"
            >
            @if($product->badge)
              <span class="home-system-badge">{{ $product->badge }}</span>
            @endif
          </div>
          <div class="home-system-body">
            <h3 class="home-system-title">{{ $product->name }}</h3>
            @if($product->summary)
              <p class="home-system-desc">{{ \Illuminate\Support\Str::limit($product->summary, 110) }}</p>
            @endif
            <span class="home-system-cta">
              {{ __('messages.learn_more') }}
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
          </div>
        </a>
      @empty
        <p class="lead" style="grid-column:1/-1;text-align:center;opacity:.7">{{ __('messages.products_blurb') }}</p>
      @endforelse
    </div>

    <div class="home-systems-foot" data-reveal>
      <a href="{{ route('products.index', $locale) }}" class="btn btn-dark btn-lg" data-magnetic>
        {{ __('messages.products_cta') }}
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
      </a>
    </div>
  </div>
</section>
