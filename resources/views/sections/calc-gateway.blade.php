{{-- Cinematic capacity calculator — type pick → immersive modal --}}
@php
  $cfg = app(\App\Settings\CalculatorSettings::class)->alpineFrontendConfig();
@endphp
<section id="start" class="cap-promo" aria-labelledby="capPromoTitle"
         x-data="miCapacityPromo(@js($cfg))">
  <div class="cap-promo-band">
    <div class="cap-promo-atmos" aria-hidden="true">
      <span class="cap-promo-grid"></span>
      <span class="cap-promo-orb cap-promo-orb--a"></span>
      <span class="cap-promo-orb cap-promo-orb--b"></span>
    </div>

    <div class="section-inner cap-promo-layout">
      <div class="cap-promo-intro" data-reveal>
        <div class="cap-promo-kicker">
          <span class="cap-promo-eyebrow">{{ __('messages.cap_promo_eyebrow') }}</span>
          <span class="cap-promo-kicker-line" aria-hidden="true"></span>
          <span class="cap-promo-kicker-hint">{{ __('messages.cap_promo_steps') }}</span>
        </div>
        <h2 id="capPromoTitle" class="cap-promo-title">
          <span class="cap-promo-title-line">{{ __('messages.cap_promo_title_line1') }}</span>
          <span class="cap-promo-title-accent">{{ __('messages.cap_promo_title_line2') }}</span>
        </h2>
        <p class="cap-promo-blurb">{{ __('messages.cap_promo_blurb') }}</p>
        <ul class="cap-promo-points" aria-hidden="true">
          <li>{{ __('messages.calc_capacity_approx') }}</li>
          <li>{{ __('messages.calc_bird_weight') }}: 2100 {{ __('messages.unit_g') }}</li>
          <li>{{ __('messages.calc_fan_spec') }}: 140×140 Munters</li>
        </ul>
      </div>

      <div class="cap-promo-types" data-stagger>
        <button type="button" class="cap-promo-type cap-promo-type--broiler" @click="pickType('broiler')">
          <span class="cap-promo-type-index">01</span>
          <span class="cap-promo-type-glow" aria-hidden="true"></span>
          <span class="cap-promo-type-icon" aria-hidden="true"><i data-lucide="drumstick"></i></span>
          <span class="cap-promo-type-body">
            <span class="cap-promo-type-label">{{ __('messages.cap_promo_type_broiler') }}</span>
            <span class="cap-promo-type-hint">{{ __('messages.cap_promo_type_broiler_hint') }}</span>
          </span>
          <span class="cap-promo-type-cta">
            {{ __('messages.cap_promo_start') }}
            <i data-lucide="arrow-left"></i>
          </span>
        </button>

        <button type="button" class="cap-promo-type cap-promo-type--layer" @click="pickType('layer')">
          <span class="cap-promo-type-index">02</span>
          <span class="cap-promo-type-glow" aria-hidden="true"></span>
          <span class="cap-promo-type-icon" aria-hidden="true"><i data-lucide="egg"></i></span>
          <span class="cap-promo-type-body">
            <span class="cap-promo-type-label">{{ __('messages.cap_promo_type_layer') }}</span>
            <span class="cap-promo-type-hint">{{ __('messages.cap_promo_type_layer_hint') }}</span>
          </span>
          <span class="cap-promo-type-cta">
            {{ __('messages.cap_promo_start') }}
            <i data-lucide="arrow-left"></i>
          </span>
        </button>
      </div>
    </div>
  </div>

  {{-- Teleport out of section stacking context so header never covers the modal --}}
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
