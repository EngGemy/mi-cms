{{-- Capacity calculator stage — primary conversion, sits under hero --}}
@php
  $cfg = app(\App\Settings\CalculatorSettings::class)->alpineFrontendConfig();
  $broilerImg = config('poultry_services.pillars.broiler.catalog.gallery.0')
      ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=85&auto=format&fit=crop';
  $layerImg = config('poultry_services.pillars.layer.catalog.gallery.0')
      ?? 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=900&q=85&auto=format&fit=crop';
@endphp
<section id="start" class="cap-stage" aria-labelledby="capPromoTitle"
         x-data="miCapacityPromo(@js($cfg))">
  <div class="cap-stage-band">
    <div class="cap-stage-atmos" aria-hidden="true">
      <span class="cap-stage-grid"></span>
      <span class="cap-stage-glow cap-stage-glow--a"></span>
      <span class="cap-stage-glow cap-stage-glow--b"></span>
    </div>

    <div class="section-inner cap-stage-inner">
      <header class="cap-stage-head" data-reveal>
        <div class="cap-stage-kicker">
          <span class="cap-stage-eyebrow">{{ __('messages.cap_promo_eyebrow') }}</span>
          <span class="cap-stage-pulse" aria-hidden="true"></span>
          <span class="cap-stage-hint">{{ __('messages.cap_promo_steps') }}</span>
        </div>
        <h2 id="capPromoTitle" class="cap-stage-title">
          <span>{{ __('messages.cap_promo_title_line1') }}</span>
          <em>{{ __('messages.cap_promo_title_line2') }}</em>
        </h2>
        <p class="cap-stage-blurb">{{ __('messages.cap_promo_blurb') }}</p>
      </header>

      <div class="cap-stage-cards" data-stagger>
        <button type="button" class="cap-stage-card cap-stage-card--broiler" @click="pickType('broiler')">
          <span class="cap-stage-card-media" aria-hidden="true">
            <img src="{{ $broilerImg }}" alt="" loading="lazy" decoding="async" width="720" height="480">
          </span>
          <span class="cap-stage-card-shade" aria-hidden="true"></span>
          <span class="cap-stage-card-body">
            <span class="cap-stage-card-meta">
              <span class="cap-stage-card-num">01</span>
              <span class="cap-stage-card-icon"><i data-lucide="drumstick"></i></span>
            </span>
            <span class="cap-stage-card-label">{{ __('messages.cap_promo_type_broiler') }}</span>
            <span class="cap-stage-card-hint">{{ __('messages.cap_promo_type_broiler_hint') }}</span>
            <span class="cap-stage-card-cta">
              {{ __('messages.cap_promo_start') }}
              <i data-lucide="arrow-left"></i>
            </span>
          </span>
        </button>

        <button type="button" class="cap-stage-card cap-stage-card--layer" @click="pickType('layer')">
          <span class="cap-stage-card-media" aria-hidden="true">
            <img src="{{ $layerImg }}" alt="" loading="lazy" decoding="async" width="720" height="480">
          </span>
          <span class="cap-stage-card-shade" aria-hidden="true"></span>
          <span class="cap-stage-card-body">
            <span class="cap-stage-card-meta">
              <span class="cap-stage-card-num">02</span>
              <span class="cap-stage-card-icon"><i data-lucide="egg"></i></span>
            </span>
            <span class="cap-stage-card-label">{{ __('messages.cap_promo_type_layer') }}</span>
            <span class="cap-stage-card-hint">{{ __('messages.cap_promo_type_layer_hint') }}</span>
            <span class="cap-stage-card-cta">
              {{ __('messages.cap_promo_start') }}
              <i data-lucide="arrow-left"></i>
            </span>
          </span>
        </button>
      </div>

      <ul class="cap-stage-notes" data-reveal aria-hidden="true">
        <li>{{ __('messages.calc_capacity_approx') }}</li>
        <li>{{ __('messages.calc_bird_weight') }}: 2100 {{ __('messages.unit_g') }}</li>
        <li>{{ __('messages.calc_fan_spec') }}: 140×140 Munters</li>
      </ul>
    </div>
  </div>

  <template x-teleport="body">
    <div class="cap-workspace-modal"
         x-show="modalOpen"
         x-cloak
         role="dialog"
         aria-modal="true"
         aria-labelledby="capWorkspaceTitle"
         @keydown.escape.window="if (modalOpen) closeModal()">
      <div class="cap-workspace-backdrop"
           x-show="modalOpen"
           x-transition.opacity.duration.350ms
           @click="closeModal()"></div>

      <div class="cap-workspace-panel"
           x-show="modalOpen"
           x-transition:enter="cap-workspace-enter"
           x-transition:enter-start="cap-workspace-enter-start"
           x-transition:enter-end="cap-workspace-enter-end"
           x-transition:leave="cap-workspace-leave"
           x-transition:leave-start="cap-workspace-leave-start"
           x-transition:leave-end="cap-workspace-leave-end"
           @click.stop>
        <header class="cap-workspace-top">
          <div class="cap-workspace-brand">
            <span class="cap-workspace-eyebrow">{{ __('messages.nav_calculator') }}</span>
            <h3 id="capWorkspaceTitle" class="cap-workspace-title">{{ __('messages.cap_promo_title') }}</h3>
          </div>
          <div class="cap-workspace-meta">
            <span class="cap-workspace-badge"
                  x-text="barnType === 'layer'
                    ? '{{ __('messages.cap_promo_type_layer') }}'
                    : '{{ __('messages.cap_promo_type_broiler') }}'"></span>
            <button type="button" class="cap-workspace-close" @click="closeModal()"
                    aria-label="{{ __('messages.close_menu') }}">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </header>

        <div class="cap-workspace-scroll" data-lenis-prevent>
          @include('partials.price-calculator', ['cfg' => $cfg, 'immersive' => true])
        </div>
      </div>
    </div>
  </template>

  @livewire('gateway-help')
</section>
