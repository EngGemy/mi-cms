<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <section class="pd-index-header">
    <div class="section-inner">
      <span class="eyebrow" data-reveal>{{ __('messages.products_eyebrow') }}</span>
      <h1 class="display-1 pd-index-title" data-reveal="title">{{ __('messages.products_title') }}</h1>
      <p class="lead pd-index-lead" data-reveal>{{ __('messages.products_blurb') }}</p>
    </div>
  </section>

  <section class="pd-index-grid-section" id="listing-grid" data-listing-grid>
    <div class="section-inner">
      <form method="GET" action="{{ route('products.index', app()->getLocale()) }}" class="listing-toolbar" data-reveal>
        <div class="listing-filters" role="tablist" aria-label="{{ __('messages.products_filter_label') }}">
          <a href="{{ route('products.index', array_filter([app()->getLocale(), 'q' => $searchQuery ?: null])) }}"
             wire:navigate.hover
             class="pd-cat-btn {{ !$activeCategory ? 'is-active' : '' }}">
            {{ __('messages.products_filter_all') }}
          </a>
          @foreach($categoryOptions as $opt)
            <a href="{{ route('products.index', array_filter([app()->getLocale(), 'category' => $opt['key'], 'q' => $searchQuery ?: null])) }}"
               wire:navigate.hover
               class="pd-cat-btn {{ $activeCategory === $opt['key'] ? 'is-active' : '' }}">
              {{ $opt['label'] }}
            </a>
          @endforeach
        </div>
        <div class="listing-search">
          <input type="search" name="q" value="{{ $searchQuery }}"
                 placeholder="{{ __('messages.search_placeholder') }}"
                 aria-label="{{ __('messages.search_placeholder') }}"/>
          @if($activeCategory)
            <input type="hidden" name="category" value="{{ $activeCategory }}"/>
          @endif
          <button type="submit" class="btn btn-dark btn-sm">{{ __('messages.search') }}</button>
        </div>
      </form>

      @if($products->isEmpty())
        <p class="pd-empty" style="color:var(--ink-500)">{{ __('messages.no_products') }}</p>
      @else
        <div class="products-grid listing-grid-anim" data-stagger>
          @foreach($products as $product)
            @include('products._card', ['product' => $product, 'size' => $product->is_featured ? 'featured' : 'normal'])
          @endforeach
        </div>
        <div class="listing-pagination">
          {{ $products->links() }}
        </div>
      @endif
    </div>
  </section>

  <section class="pd-index-cta" data-reveal>
    <div class="section-inner">
      <div class="pd-index-cta-inner">
        <h2 class="display-3">{{ __('messages.products_cta_title') }}</h2>
        <p class="lead">{{ __('messages.products_cta_blurb') }}</p>
        <a href="{{ route('home', app()->getLocale()) }}#calculator" class="btn btn-primary btn-lg" data-magnetic>
          {{ __('messages.nav_calculator') }}
        </a>
      </div>
    </div>
  </section>
</x-layouts.public>
