{{-- Promotional capacity calculator under the hero --}}
@php
  $cfg = app(\App\Settings\CalculatorSettings::class)->alpineFrontendConfig();
@endphp
<section id="start" class="cap-promo" aria-labelledby="capPromoTitle"
         x-data="miCapacityPromo(@js($cfg))">
  <div class="cap-promo-band">
    <div class="section-inner">
      <div class="cap-promo-intro" data-reveal>
        <span class="cap-promo-eyebrow">{{ __('messages.cap_promo_eyebrow') }}</span>
        <h2 id="capPromoTitle" class="cap-promo-title">{{ __('messages.cap_promo_title') }}</h2>
        <p class="cap-promo-blurb">{{ __('messages.cap_promo_blurb') }}</p>
      </div>

      {{-- Step 1: barn type --}}
      <div class="cap-promo-step" x-show="step === 1" x-transition.opacity.duration.300ms>
        <div class="cap-promo-types" data-stagger>
          <button type="button" class="cap-promo-type" @click="pickType('layer')">
            <span class="cap-promo-type-icon" aria-hidden="true">
              <i data-lucide="egg"></i>
            </span>
            <span class="cap-promo-type-label">{{ __('messages.cap_promo_type_layer') }}</span>
            <span class="cap-promo-type-hint">{{ __('messages.cap_promo_type_layer_hint') }}</span>
            <span class="cap-promo-type-go" aria-hidden="true"><i data-lucide="arrow-left"></i></span>
          </button>
          <button type="button" class="cap-promo-type" @click="pickType('broiler')">
            <span class="cap-promo-type-icon" aria-hidden="true">
              <i data-lucide="drumstick"></i>
            </span>
            <span class="cap-promo-type-label">{{ __('messages.cap_promo_type_broiler') }}</span>
            <span class="cap-promo-type-hint">{{ __('messages.cap_promo_type_broiler_hint') }}</span>
            <span class="cap-promo-type-go" aria-hidden="true"><i data-lucide="arrow-left"></i></span>
          </button>
        </div>
      </div>

      {{-- Step 2: quick data entry --}}
      <div class="cap-promo-step" x-cloak x-show="step === 2"
           x-transition:enter="cap-promo-enter"
           x-transition:enter-start="cap-promo-enter-start"
           x-transition:enter-end="cap-promo-enter-end">
        <div class="cap-promo-data">
          <div class="cap-promo-data-head">
            <button type="button" class="cap-promo-back" @click="backToType()">
              <i data-lucide="arrow-right"></i>
              <span>{{ __('messages.cap_promo_back') }}</span>
            </button>
            <span class="cap-promo-badge"
                  x-text="barnType === 'layer'
                    ? '{{ __('messages.cap_promo_type_layer') }}'
                    : '{{ __('messages.cap_promo_type_broiler') }}'"></span>
          </div>

          <div class="cap-promo-fields">
            <label class="cap-promo-field">
              <span>{{ __('messages.calc_length') }}</span>
              <input type="number" inputmode="numeric" x-model.number="length"
                     :min="minLength" :max="maxLength" step="1"/>
            </label>
            <label class="cap-promo-field">
              <span>{{ __('messages.calc_width') }}</span>
              <input type="number" inputmode="decimal" x-model.number="width"
                     :min="minWidth" :max="maxWidth" step="0.5"/>
            </label>
            <label class="cap-promo-field">
              <span>{{ __('messages.calc_height') }}</span>
              <input type="number" inputmode="decimal" x-model.number="height"
                     :min="minHeight" :max="maxHeight" step="0.5"/>
            </label>
            <label class="cap-promo-field">
              <span>{{ __('messages.calc_floors') }}</span>
              <select x-model.number="floors">
                <template x-for="v in floorsOptions" :key="'pf'+v">
                  <option :value="v" x-text="v"></option>
                </template>
              </select>
            </label>
            <label class="cap-promo-field">
              <span>{{ __('messages.calc_lines') }}</span>
              <select x-model.number="lines">
                <template x-for="v in linesOptions" :key="'pl'+v">
                  <option :value="v" x-text="v"></option>
                </template>
              </select>
            </label>
            <div class="cap-promo-field cap-promo-field--service">
              <span>{{ __('messages.calc_service_length') }}</span>
              <div class="cap-promo-service">
                <button type="button" :class="serviceLength === 8 && 'is-on'" @click="serviceLength = 8">8 {{ __('messages.unit_m') }}</button>
                <button type="button" :class="serviceLength === 10 && 'is-on'" @click="serviceLength = 10">10 {{ __('messages.unit_m') }}</button>
              </div>
            </div>
          </div>

          <p class="cap-promo-note">{{ __('messages.calc_capacity_approx') }}</p>

          <button type="button" class="btn btn-primary cap-promo-open" @click="openModal()">
            {{ __('messages.cap_promo_open') }}
            <i data-lucide="calculator"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Lively calculator workspace modal --}}
  <div class="cap-workspace-modal"
       x-show="modalOpen"
       x-cloak
       x-transition.opacity.duration.250ms
       role="dialog"
       aria-modal="true"
       aria-label="{{ __('messages.nav_calculator') }}"
       @keydown.escape.window="if (modalOpen) closeModal()">
    <div class="cap-workspace-backdrop" @click="closeModal()"></div>
    <div class="cap-workspace-panel"
         x-show="modalOpen"
         x-transition:enter="cap-workspace-enter"
         x-transition:enter-start="cap-workspace-enter-start"
         x-transition:enter-end="cap-workspace-enter-end">
      <button type="button" class="cap-workspace-close" @click="closeModal()" aria-label="{{ __('messages.close_menu') }}">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
      <div class="cap-workspace-scroll" data-lenis-prevent>
        @include('partials.price-calculator', ['cfg' => $cfg])
      </div>
    </div>
  </div>

  @livewire('gateway-help')
</section>
