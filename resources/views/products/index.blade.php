<x-layouts.public :seo="$seo">

  {{-- PAGE HEADER --}}
  <section class="pd-index-header">
    <div class="section-inner">
      <span class="eyebrow" data-reveal>{{ __('messages.products_eyebrow') }}</span>
      <h1 class="display-1 pd-index-title" data-reveal>{{ __('messages.products_title') }}</h1>
      <p class="lead pd-index-lead" data-reveal>{{ __('messages.products_blurb') }}</p>
    </div>
  </section>

  {{-- PRODUCTS GRID --}}
  <section class="pd-index-grid-section">
    <div class="section-inner">

      @if($products->isEmpty())
        <p class="pd-empty" style="color:var(--ink-500)">{{ __('messages.no_products') }}</p>
      @else
        {{-- Featured row --}}
        @php $featured = $products->where('is_featured', true); $rest = $products->where('is_featured', false); @endphp
        @if($featured->isNotEmpty())
          <div class="pd-index-featured" data-stagger>
            @foreach($featured as $product)
              @include('products._card', ['product' => $product, 'size' => 'featured'])
            @endforeach
          </div>
        @endif

        @if($rest->isNotEmpty())
          <div class="products-grid mt-12" data-stagger>
            @foreach($rest as $product)
              @include('products._card', ['product' => $product, 'size' => 'normal'])
            @endforeach
          </div>
        @endif
      @endif

    </div>
  </section>

  {{-- BOTTOM CTA --}}
  <section class="pd-index-cta" data-reveal>
    <div class="section-inner">
      <div class="pd-index-cta-inner">
        <h2 class="display-3">{{ __('messages.products_cta_title') }}</h2>
        <p class="lead">{{ __('messages.products_cta_blurb') }}</p>
        <a href="{{ route('home', app()->getLocale()) }}#contact"
           class="btn btn-primary btn-lg" data-magnetic>
          {{ __('messages.cta_consultation') }}
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
      </div>
    </div>
  </section>

</x-layouts.public>
