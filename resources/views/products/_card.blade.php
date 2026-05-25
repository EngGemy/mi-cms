<a href="{{ route('products.show', [app()->getLocale(), $product->slug]) }}"
   class="product-card {{ $size === 'featured' ? 'product-card--featured' : '' }}">
  <div class="product-card-image">
    @if($product->badge)
      <span class="product-card-badge">{{ $product->badge }}</span>
    @endif
    @if($product->is_featured)
      <span class="product-card-featured-tag">
        <i data-lucide="star" class="w-3 h-3"></i>
      </span>
    @endif
    @if($product->getMainImageUrl('card'))
      <img src="{{ $product->getMainImageUrl('card') }}" alt="{{ $product->name }}" loading="lazy">
    @else
      <div class="product-card-image-placeholder">
        <i data-lucide="image" class="w-10 h-10" style="color:var(--ink-300)"></i>
      </div>
    @endif
  </div>
  <div class="product-card-body">
    <h3 class="product-card-title">{{ $product->name }}</h3>
    @if($product->summary)
      <p class="product-card-desc">{{ Str::limit($product->summary, 110) }}</p>
    @endif
    <div class="product-card-footer">
      <span class="pd-card-cta">{{ __('messages.view_details') }}</span>
      <i data-lucide="arrow-left" class="w-4 h-4" style="color:var(--mi-red)"></i>
    </div>
  </div>
</a>
