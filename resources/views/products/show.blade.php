<x-layouts.public :seo="$seo">

  {{-- JSON-LD structured data --}}
  <x-slot:head>
    <script type="application/ld+json">{!! $jsonLd !!}</script>
  </x-slot:head>

  {{-- =====================================================================
       BREADCRUMB
       ===================================================================== --}}
  <nav class="pd-breadcrumb" aria-label="breadcrumb">
    <div class="section-inner">
      <ol class="pd-breadcrumb-list">
        <li><a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.brand') }}</a></li>
        <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
        <li><a href="{{ route('products.index', app()->getLocale()) }}">{{ __('messages.products') }}</a></li>
        <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
        <li aria-current="page">{{ $product->name }}</li>
      </ol>
    </div>
  </nav>

  {{-- =====================================================================
       HERO — GALLERY LEFT + INFO RIGHT
       ===================================================================== --}}
  <section class="pd-hero">
    <div class="section-inner">
      <div class="pd-hero-grid"
        x-data="{
          current: '{{ $mainImage }}',
          thumbs: {{ Js::from($galleryImages) }},
          set(url) { this.current = url; }
        }">

        {{-- GALLERY --}}
        <div class="pd-gallery">
          {{-- Main image --}}
          <div class="pd-gallery-main">
            @if($mainImage)
              <img :src="current" alt="{{ $product->name }}" class="pd-gallery-img" loading="eager">
            @else
              <div class="pd-gallery-placeholder">
                <i data-lucide="image" class="w-16 h-16" style="color:var(--ink-300)"></i>
                <span>{{ __('messages.no_image') }}</span>
              </div>
            @endif
            {{-- Badge --}}
            @if($product->badge)
              <span class="pd-gallery-badge">{{ $product->badge }}</span>
            @endif
          </div>

          {{-- Thumbnails --}}
          @if(count($galleryImages) > 0)
            <div class="pd-gallery-thumbs">
              @if($mainImage)
                <button type="button"
                        @click="set('{{ $mainImage }}')"
                        :class="current === '{{ $mainImage }}' ? 'is-active' : ''"
                        class="pd-thumb" aria-label="{{ __('messages.main_image') }}">
                  <img src="{{ $product->getMainImageUrl('thumb') }}" alt="" loading="lazy">
                </button>
              @endif
              <template x-for="(img, i) in thumbs" :key="i">
                <button type="button"
                        @click="set(img.full)"
                        :class="current === img.full ? 'is-active' : ''"
                        class="pd-thumb"
                        :aria-label="'{{ __('messages.image') }} ' + (i + 2)">
                  <img :src="img.thumb" :alt="img.alt" loading="lazy">
                </button>
              </template>
            </div>
          @endif
        </div>

        {{-- INFO PANEL --}}
        <div class="pd-info">
          @if($product->badge)
            <span class="eyebrow">{{ $product->badge }}</span>
          @endif

          <h1 class="display-2 pd-title">{{ $product->name }}</h1>

          @if($product->summary)
            <p class="lead pd-summary">{{ $product->summary }}</p>
          @endif

          {{-- CTA buttons --}}
          <div class="pd-cta-group">
            <a href="#product-quote" class="btn btn-primary btn-lg" data-magnetic
               onclick="event.preventDefault(); document.getElementById('product-quote').scrollIntoView({behavior:'smooth'})">
              <i data-lucide="mail" class="w-4 h-4"></i>
              {{ __('messages.request_quote') }}
            </a>
            @php
              $wa  = config('mi.whatsapp', '201030003186');
              $msg = urlencode(__('messages.whatsapp_product_msg', ['product' => $product->name]));
            @endphp
            <a href="https://wa.me/{{ $wa }}?text={{ $msg }}"
               target="_blank" rel="noopener noreferrer"
               class="btn btn-ghost btn-lg" data-magnetic>
              <i data-lucide="message-circle" class="w-4 h-4"></i>
              {{ __('messages.whatsapp_cta') }}
            </a>
          </div>

          {{-- Quick trust badges --}}
          <div class="pd-trust">
            <span class="pd-trust-item"><i data-lucide="shield-check" class="w-4 h-4"></i> {{ __('messages.trust_warranty') }}</span>
            <span class="pd-trust-item"><i data-lucide="zap" class="w-4 h-4"></i> {{ __('messages.trust_install') }}</span>
            <span class="pd-trust-item"><i data-lucide="headphones" class="w-4 h-4"></i> {{ __('messages.trust_support') }}</span>
          </div>
        </div>

      </div>{{-- .pd-hero-grid --}}
    </div>
  </section>

  {{-- =====================================================================
       QUICK SPECS STRIP — 4 KEY NUMBERS
       ===================================================================== --}}
  @php
    $specsArr = (array) ($product->specs ?? []);
    $quickSpecs = array_slice($specsArr, 0, 4, true);
  @endphp
  @if(!empty($quickSpecs))
    <section class="pd-strip" data-reveal>
      <div class="section-inner">
        <div class="pd-strip-grid">
          @foreach($quickSpecs as $key => $val)
            <div class="pd-strip-item">
              <span class="pd-strip-val">{{ $val }}</span>
              <span class="pd-strip-key">{{ $key }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- =====================================================================
       DESCRIPTION + FULL SPECS TABLE
       ===================================================================== --}}
  <section class="pd-content">
    <div class="section-inner">
      <div class="pd-content-grid">

        {{-- Description --}}
        <div class="pd-description" data-reveal>
          <h2 class="display-3 pd-section-title">{{ __('messages.product_overview') }}</h2>
          @if($product->description)
            <div class="pd-prose">
              {!! $product->description !!}
            </div>
          @endif
        </div>

        {{-- Specs table --}}
        @if(!empty($specsArr))
          <div class="pd-specs-panel" data-reveal>
            <h2 class="display-3 pd-section-title">{{ __('messages.specs') }}</h2>
            <dl class="pd-specs-dl">
              @foreach($specsArr as $key => $val)
                <div class="pd-spec-row">
                  <dt class="pd-spec-key">{{ $key }}</dt>
                  <dd class="pd-spec-val">{{ $val }}</dd>
                </div>
              @endforeach
            </dl>
          </div>
        @endif

      </div>
    </div>
  </section>

  {{-- =====================================================================
       REQUEST QUOTE FORM
       ===================================================================== --}}
  <section id="product-quote" class="pd-quote-section">
    <div class="section-inner">
      <div class="pd-quote-inner" data-reveal>
        <div class="pd-quote-header">
          <span class="eyebrow">{{ __('messages.quote_eyebrow') }}</span>
          <h2 class="display-3">{{ __('messages.quote_title') }}</h2>
          <p class="lead">{{ __('messages.quote_blurb') }}</p>
        </div>
        <div class="pd-quote-form-wrap">
          <livewire:request-quote :product-id="$product->id" :product-name="$product->name" />
        </div>
      </div>
    </div>
  </section>

  {{-- =====================================================================
       CALCULATOR LINK
       ===================================================================== --}}
  <section class="pd-calc-cta" data-reveal>
    <div class="section-inner">
      <div class="pd-calc-card">
        <div class="pd-calc-card-text">
          <h3 class="display-3">{{ __('messages.calc_cta_title') }}</h3>
          <p class="lead">{{ __('messages.calc_cta_blurb') }}</p>
        </div>
        <a href="{{ route('home', app()->getLocale()) }}#calculator"
           class="btn btn-dark btn-lg" data-magnetic>
          <i data-lucide="calculator" class="w-4 h-4"></i>
          {{ __('messages.calc_eyebrow') }}
        </a>
      </div>
    </div>
  </section>

  {{-- =====================================================================
       RELATED PRODUCTS
       ===================================================================== --}}
  @if($related->count())
    <section class="pd-related">
      <div class="section-inner">
        <div class="pd-related-header" data-reveal>
          <span class="eyebrow">{{ __('messages.related_products_eyebrow') }}</span>
          <h2 class="display-3">{{ __('messages.related_products_title') }}</h2>
        </div>
        <div class="products-grid pd-related-grid" data-stagger>
          @foreach($related as $rel)
            <a href="{{ route('products.show', [app()->getLocale(), $rel->slug]) }}"
               class="product-card">
              <div class="product-card-image">
                @if($rel->badge)
                  <span class="product-card-badge">{{ $rel->badge }}</span>
                @endif
                @if($rel->getMainImageUrl('card'))
                  <img src="{{ $rel->getMainImageUrl('card') }}" alt="{{ $rel->name }}" loading="lazy">
                @else
                  <div class="product-card-image-placeholder">
                    <i data-lucide="image" class="w-8 h-8" style="color:var(--ink-300)"></i>
                  </div>
                @endif
              </div>
              <div class="product-card-body">
                <h3 class="product-card-title">{{ $rel->name }}</h3>
                @if($rel->summary)
                  <p class="product-card-desc">{{ Str::limit($rel->summary, 90) }}</p>
                @endif
                <span class="pd-related-link">{{ __('messages.view_details') }} <i data-lucide="arrow-left" class="w-3 h-3 inline"></i></span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endif

</x-layouts.public>
