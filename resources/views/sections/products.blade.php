<section id="products" class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow">{{ __('messages.products_eyebrow') }} · 06</span>
        <h2 class="display-2 mt-2" data-reveal="title">
          {{ __('messages.products_title_part1') }}
          <span class="serif-italic" style="color:var(--mi-red)">{{ __('messages.brand') }}</span>
          {{ __('messages.products_title_part2') }}
        </h2>
      </div>
      <p class="lead lg:text-right" data-reveal="right">{{ __('messages.products_blurb') }}</p>
    </div>

    <div
      class="products-grid mi-carousel"
      data-mi-carousel
      data-mi-per="1"
      data-stagger
    >
      @foreach($products as $product)
        <a href="{{ route('products.show', [app()->getLocale(), $product->slug]) }}"
           class="product-card mi-carousel-item">
          <div class="product-card-image">
            @if($product->badge)
              <span class="product-card-badge">{{ $product->badge }}</span>
            @endif
            <img src="{{ $product->getMainImageUrl('card') ?? 'https://images.unsplash.com/photo-1553531009-c4605ebe6122?w=900&q=85&auto=format&fit=crop' }}"
                 alt="{{ $product->name }}" loading="lazy"/>
          </div>
          <div class="product-card-body">
            <h3 class="product-card-title">{{ $product->name }}</h3>
            <p class="product-card-desc">{{ $product->summary }}</p>
            @if(!empty($product->specs))
              <div class="product-card-meta">
                @foreach(array_slice((array) $product->specs, 0, 2) as $key => $val)
                  <div>{{ $key }} <strong>{{ $val }}</strong></div>
                  @if(!$loop->last)<div style="color:var(--ink-300)">·</div>@endif
                @endforeach
              </div>
            @endif
          </div>
        </a>
      @endforeach
    </div>

    <div class="text-center mt-12" data-reveal data-reveal-delay="0.2">
      <a href="#contact" class="btn btn-dark btn-lg" data-magnetic>
        {{ __('messages.products_cta') }} <i data-lucide="arrow-left" class="w-4 h-4"></i>
      </a>
    </div>
  </div>
</section>
