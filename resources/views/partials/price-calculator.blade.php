@php
  /** @var array $cfg */
  $cfg = $cfg ?? app(\App\Settings\CalculatorSettings::class)->alpineFrontendConfig();
@endphp
{{-- Pure Alpine calculator — no Livewire. Factory: public/js/mi-calc.js --}}
<div
  class="calc-shell"
  x-data="miPoultryCalcInline(@js($cfg))"
  @keydown.escape.window="if (saved) closeEstimate()"
>
  <div class="calc-shell-grid">
    {{-- Live capacity panel --}}
    <aside class="calc-live" aria-live="polite">
      <div class="calc-live-kicker">{{ __('messages.calc_capacity_title') }}</div>
      <div class="calc-live-type" x-show="barnType">
        <span x-text="barnType === 'layer'
          ? '{{ __('messages.cap_promo_type_layer') }}'
          : '{{ __('messages.cap_promo_type_broiler') }}'"></span>
      </div>
      <div class="calc-live-main">
        <span class="calc-live-num" x-text="fmt(birds)"></span>
        <span class="calc-live-unit">{{ __('messages.birds_unit') }}</span>
      </div>
      <p class="calc-live-approx">{{ __('messages.calc_capacity_approx') }}</p>
      <div class="calc-live-meta">
        <div class="calc-live-meta-item">
          <span>{{ __('messages.calc_bird_weight') }}</span>
          <strong>2100 {{ __('messages.unit_g') }}</strong>
        </div>
        <div class="calc-live-meta-item">
          <span>{{ __('messages.calc_fan_spec') }}</span>
          <strong x-text="fanSpec">140×140 Munters Italy</strong>
        </div>
        <div class="calc-live-meta-item">
          <span>{{ __('messages.calc_effective_length') }}</span>
          <strong x-text="effectiveLength + ' {{ __('messages.unit_m') }}'"></strong>
        </div>
      </div>

      <div class="calc-live-stats">
        <div class="calc-live-stat">
          <span>{{ __('messages.calc_effective_length') }}</span>
          <strong x-text="effectiveLength + ' م'"></strong>
        </div>
        <div class="calc-live-stat">
          <span>{{ __('messages.calc_total_nests') }}</span>
          <strong x-text="fmt(totalNests)"></strong>
        </div>
        <div class="calc-live-stat">
          <span>{{ __('messages.calc_birds_per_nest') }}</span>
          <strong x-text="birdsPerNest"></strong>
        </div>
        <div class="calc-live-stat">
          <span>{{ __('messages.calc_nests_per_line') }}</span>
          <strong x-text="fmt(nestsPerLine)"></strong>
        </div>
      </div>

      <div class="calc-live-tech">
        <div class="calc-live-tech-title">{{ __('messages.calc_tech_outputs') }}</div>
        <div class="calc-live-tech-grid">
          <div><span>{{ __('messages.calc_rear_fans') }}</span><b x-text="rearFans"></b></div>
          <div><span>{{ __('messages.calc_fan_spec') }}</span><b style="font-size:11px" x-text="fanSpec"></b></div>
          <div><span>{{ __('messages.calc_cooling') }}</span><b><span x-text="coolingPadMeters"></span> م</b></div>
          <div><span>{{ __('messages.calc_inlets') }}</span><b x-text="inlets"></b></div>
          <div x-show="barnType !== 'broiler'"><span>{{ __('messages.calc_layer_nests') }}</span><b x-text="fmt(layerNestsTotal)"></b></div>
        </div>
      </div>
    </aside>

    {{-- Controls --}}
    <div class="calc-workspace">
      <div class="calc-step">
        <div class="calc-step-head">
          <span class="calc-step-num">1</span>
          <div>
            <div class="calc-section-title calc-section-title--inline">{{ __('messages.calc_dimensions') }}</div>
            <p class="calc-step-hint">{{ __('messages.calc_step_dims_hint') }}</p>
          </div>
        </div>

        <div class="calc-dims-grid">
          <div class="calc-control">
            <div class="calc-control-top">
              <label class="calc-label-text" for="calc-length">{{ __('messages.calc_length') }}</label>
              <div class="calc-stepper">
                <button type="button" class="calc-stepper-btn" @click="nudge('length', -1)" aria-label="-">−</button>
                <input id="calc-length" type="number" class="calc-num-input" inputmode="numeric"
                       x-model.number="length" @change="clamp('length', minLength, maxLength); onLengthInput()"
                       :min="minLength" :max="maxLength" step="1"/>
                <button type="button" class="calc-stepper-btn" @click="nudge('length', 1)" aria-label="+">+</button>
              </div>
            </div>
            <input type="range" class="calc-slider" x-model.number="length" @input="onLengthInput()"
                   :min="minLength" :max="maxLength" step="1" aria-hidden="true" tabindex="-1"/>
            <div class="calc-hint">
              <span x-text="(locale === 'ar'
                ? ('الحد الأدنى ' + minLength + ' م · الحد الأقصى ' + maxLength + ' م')
                : ('Min ' + minLength + ' m · Max ' + maxLength + ' m'))"></span>
            </div>
          </div>

          <div class="calc-control">
            <div class="calc-control-top">
              <label class="calc-label-text" for="calc-width">{{ __('messages.calc_width') }}</label>
              <div class="calc-stepper">
                <button type="button" class="calc-stepper-btn" @click="nudge('width', -0.5)" aria-label="-">−</button>
                <input id="calc-width" type="number" class="calc-num-input" inputmode="decimal"
                       x-model.number="width" @change="clamp('width', minWidth, maxWidth); onWidthInput()"
                       :min="minWidth" :max="maxWidth" step="0.5"/>
                <button type="button" class="calc-stepper-btn" @click="nudge('width', 0.5)" aria-label="+">+</button>
              </div>
            </div>
            <input type="range" class="calc-slider" x-model.number="width" @input="onWidthInput()"
                   :min="minWidth" :max="maxWidth" step="0.5" aria-hidden="true" tabindex="-1"/>
          </div>

          <div class="calc-control">
            <div class="calc-control-top">
              <label class="calc-label-text" for="calc-height">{{ __('messages.calc_height') }}</label>
              <div class="calc-stepper">
                <button type="button" class="calc-stepper-btn" @click="nudge('height', -0.5)" aria-label="-">−</button>
                <input id="calc-height" type="number" class="calc-num-input" inputmode="decimal"
                       x-model.number="height" @change="clamp('height', minHeight, maxHeight); recompute()"
                       :min="minHeight" :max="maxHeight" step="0.5"/>
                <button type="button" class="calc-stepper-btn" @click="nudge('height', 0.5)" aria-label="+">+</button>
              </div>
            </div>
            <input type="range" class="calc-slider" x-model.number="height" @input="recompute()"
                   :min="minHeight" :max="maxHeight" step="0.5" aria-hidden="true" tabindex="-1"/>
          </div>

          <div class="calc-control">
            <div class="calc-control-label-only">{{ __('messages.calc_service_length') }}</div>
            <div class="calc-chip-group" role="group" aria-label="{{ __('messages.calc_service_length') }}">
              <template x-for="v in serviceLengthOptions" :key="'svc'+v">
                <button type="button" class="calc-chip" :class="serviceLength === v && 'is-active'"
                        :aria-pressed="serviceLength === v"
                        @click="setServiceLength(v)" x-text="v + ' {{ __('messages.unit_m') }}'"></button>
              </template>
            </div>
            <div class="calc-hint">{{ __('messages.calc_service_hint') }}</div>
          </div>
        </div>
      </div>

      <div class="calc-step">
        <div class="calc-step-head">
          <span class="calc-step-num">2</span>
          <div>
            <div class="calc-section-title calc-section-title--inline">{{ __('messages.calc_battery') }}</div>
            <p class="calc-step-hint">{{ __('messages.calc_step_battery_hint') }}</p>
          </div>
        </div>

        <div class="calc-battery-grid">
          <div class="calc-control">
            <div class="calc-control-label-only">{{ __('messages.calc_floors') }}</div>
            <div class="calc-chip-group" role="group" aria-label="{{ __('messages.calc_floors') }}">
              <template x-for="v in floorsOptions" :key="'f'+v">
                <button type="button" class="calc-chip" :class="floors === v && 'is-active'"
                        :aria-pressed="floors === v"
                        @click="floors = v; recompute()" x-text="v"></button>
              </template>
            </div>
          </div>

          <div class="calc-control">
            <div class="calc-control-label-only">{{ __('messages.calc_lines') }}</div>
            <div class="calc-chip-group" role="group" aria-label="{{ __('messages.calc_lines') }}">
              <template x-for="v in linesOptions" :key="'l'+v">
                <button type="button" class="calc-chip" :class="lines === v && 'is-active'"
                        :aria-pressed="lines === v"
                        @click="lines = v; recompute()" x-text="v"></button>
              </template>
            </div>
          </div>
        </div>
      </div>

      <div class="calc-step calc-step--contact">
        <div class="calc-step-head">
          <span class="calc-step-num">3</span>
          <div>
            <div class="calc-section-title calc-section-title--inline">{{ __('messages.calc_contact_title') }}</div>
            <p class="calc-step-hint">{{ __('messages.calc_contact_hint') }}</p>
          </div>
        </div>
        <div class="calc-contact-grid">
          <div class="calc-control">
            <label class="calc-label-text" for="calc-name">{{ __('messages.field_name') }}</label>
            <input id="calc-name" type="text" class="calc-text-input" autocomplete="name"
                   x-model.trim="name" :class="errors.name && 'is-invalid'"
                   placeholder="{{ __('messages.field_name') }}"/>
            <p class="calc-field-error" x-show="errors.name" x-text="errors.name"></p>
          </div>
          <div class="calc-control">
            <label class="calc-label-text" for="calc-phone">{{ __('messages.field_phone') }}</label>
            <input id="calc-phone" type="tel" class="calc-text-input" autocomplete="tel" inputmode="tel"
                   x-model.trim="phone" :class="errors.phone && 'is-invalid'"
                   placeholder="{{ __('messages.field_phone') }}"/>
            <p class="calc-field-error" x-show="errors.phone" x-text="errors.phone"></p>
          </div>
        </div>
      </div>

      <div class="calc-note">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" style="color:var(--mi-red);flex-shrink:0">
          <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
          <path d="M12 8v5M12 16.5v.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <div>
          <div class="calc-note-title">{{ __('messages.calc_disclaimer_title') }}</div>
          <div class="calc-note-body">{{ __('messages.calc_disclaimer_body') }}</div>
        </div>
      </div>

      <p class="calc-field-error calc-field-error--global" x-show="errors.form" x-text="errors.form"></p>

      <div class="calc-actions">
        <button type="button" class="btn btn-primary calc-action-primary"
                @click="saveEstimate()" :disabled="saving">
          <span x-show="!saving">{{ __('messages.calc_persist') }}</span>
          <span x-show="saving">{{ __('messages.sending') }}</span>
        </button>
        <a href="tel:{{ config('mi.phone_primary') }}" class="btn calc-action-call">
          <span dir="ltr">{{ config('mi.phone_primary') }}</span>
        </a>
      </div>
    </div>
  </div>

  <div class="calc-sticky-bar" aria-live="polite">
    <div>
      <div class="calc-sticky-label">{{ __('messages.calc_capacity_title') }}</div>
      <div class="calc-sticky-value"><span x-text="fmt(birds)"></span> {{ __('messages.birds_unit') }}</div>
      <div class="calc-sticky-approx">{{ __('messages.calc_capacity_approx') }}</div>
    </div>
    <button type="button" class="btn btn-primary calc-sticky-btn" @click="saveEstimate()" :disabled="saving">
      {{ __('messages.calc_persist_short') }}
    </button>
  </div>

  {{-- Full estimate modal --}}
  <div
    class="calc-modal"
    x-show="saved"
    x-cloak
    x-transition.opacity.duration.250ms
    role="dialog"
    aria-modal="true"
    aria-labelledby="calcEstimateTitle"
    @click.self="closeEstimate()"
  >
    <div
      class="calc-modal-panel calc-modal-panel--full"
      x-show="saved"
      x-transition:enter="calc-modal-enter"
      x-transition:enter-start="calc-modal-enter-start"
      x-transition:enter-end="calc-modal-enter-end"
      @click.stop
    >
      <button type="button" class="calc-modal-close" @click="closeEstimate()" aria-label="{{ __('messages.close_menu') }}">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>

      <div class="calc-modal-scroll">
        <div class="calc-estimate-badge">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/></svg>
          <span x-text="savedMsg"></span>
        </div>

        <div class="calc-estimate-kicker" id="calcEstimateTitle">{{ __('messages.calc_estimate_title') }}</div>
        <div class="calc-estimate-main">
          <span class="calc-estimate-num" x-text="fmt(birds)"></span>
          <span class="calc-estimate-unit">{{ __('messages.birds_unit') }}</span>
        </div>
        <p class="calc-estimate-ref" x-show="requestId">
          {{ __('messages.calc_request_ref') }}
          <strong x-text="'#' + requestId"></strong>
        </p>

        <div class="calc-estimate-section">
          <div class="calc-estimate-section-title">{{ __('messages.calc_dimensions') }}</div>
          <div class="calc-estimate-grid">
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_length') }}</span>
              <strong x-text="length + ' م'"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_width') }}</span>
              <strong x-text="width + ' م'"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_height') }}</span>
              <strong x-text="height + ' م'"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_effective_length') }}</span>
              <strong x-text="effectiveLength + ' م'"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_floors') }}</span>
              <strong x-text="floors"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_lines') }}</span>
              <strong x-text="lines"></strong>
            </div>
          </div>
        </div>

        <div class="calc-estimate-section">
          <div class="calc-estimate-section-title">{{ __('messages.calc_capacity') }}</div>
          <div class="calc-estimate-grid">
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_total_nests') }}</span>
              <strong x-text="fmt(totalNests)"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_nests_per_line') }}</span>
              <strong x-text="fmt(nestsPerLine)"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_birds_per_nest') }}</span>
              <strong x-text="birdsPerNest"></strong>
            </div>
            <div class="calc-estimate-item calc-estimate-item--accent">
              <span>{{ __('messages.calc_capacity_title') }}</span>
              <strong x-text="fmt(birds) + ' ' + (locale === 'ar' ? 'طائر' : 'birds')"></strong>
            </div>
          </div>
        </div>

        <div class="calc-estimate-section">
          <div class="calc-estimate-section-title">{{ __('messages.calc_tech_outputs') }}</div>
          <div class="calc-estimate-grid">
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_rear_fans') }}</span>
              <strong x-text="rearFans"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_cooling') }}</span>
              <strong x-text="coolingPadMeters + ' م'"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_inlets') }}</span>
              <strong x-text="inlets"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.calc_layer_nests') }}</span>
              <strong x-text="fmt(layerNestsTotal)"></strong>
            </div>
          </div>
        </div>

        <div class="calc-estimate-section">
          <div class="calc-estimate-section-title">{{ __('messages.calc_contact_title') }}</div>
          <div class="calc-estimate-grid calc-estimate-grid--2">
            <div class="calc-estimate-item">
              <span>{{ __('messages.field_name') }}</span>
              <strong x-text="name"></strong>
            </div>
            <div class="calc-estimate-item">
              <span>{{ __('messages.field_phone') }}</span>
              <strong dir="ltr" x-text="phone"></strong>
            </div>
          </div>
        </div>

        <p class="calc-estimate-note">{{ __('messages.calc_estimate_note') }}</p>
      </div>

      <div class="calc-modal-footer">
        <a class="btn btn-primary calc-estimate-wa"
           :href="waLink"
           target="_blank"
           rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          {{ __('messages.calc_estimate_whatsapp') }}
        </a>
        <button type="button" class="btn calc-estimate-again" @click="closeEstimate()">
          {{ __('messages.calc_estimate_again') }}
        </button>
      </div>
    </div>
  </div>
</div>
