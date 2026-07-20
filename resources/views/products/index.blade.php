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
    <div class="section-inner"
         x-data="{ cat: 'all' }">

      @if($categoryOptions->isNotEmpty())
        <div class="pd-cat-filters" data-reveal role="tablist" aria-label="{{ __('messages.products_filter_label') }}">
          <button type="button"
                  class="pd-cat-btn"
                  :class="{ 'is-active': cat === 'all' }"
                  @click="cat = 'all'">
            {{ __('messages.products_filter_all') }}
          </button>
          @foreach($categoryOptions as $opt)
            <button type="button"
                    class="pd-cat-btn"
                    :class="{ 'is-active': cat === '{{ $opt['key'] }}' }"
                    @click="cat = '{{ $opt['key'] }}'">
              {{ $opt['label'] }}
            </button>
          @endforeach
        </div>
      @endif

      @if($products->isEmpty())
        <p class="pd-empty" style="color:var(--ink-500)">{{ __('messages.no_products') }}</p>
      @else
        @php $featured = $products->where('is_featured', true); $rest = $products->where('is_featured', false); @endphp
        @if($featured->isNotEmpty())
          <div class="pd-index-featured" data-stagger>
            @foreach($featured as $product)
              <div x-show="cat === 'all' || cat === '{{ $product->category }}'" x-cloak>
                @include('products._card', ['product' => $product, 'size' => 'featured'])
              </div>
            @endforeach
          </div>
        @endif

        @if($rest->isNotEmpty())
          <div class="products-grid mt-12" data-stagger>
            @foreach($rest as $product)
              <div x-show="cat === 'all' || cat === '{{ $product->category }}'" x-cloak>
                @include('products._card', ['product' => $product, 'size' => 'normal'])
              </div>
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
