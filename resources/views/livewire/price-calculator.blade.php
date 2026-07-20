@php
  $cfg = $alpineConfig;
@endphp
{{-- Livewire root: keep stable; Alpine UI is wire:ignore so remorph never blanks the card --}}
<div>
  <div
    class="calc-card calc-card--ux"
    wire:ignore
    x-data="miPoultryCalc(@js($cfg))"
    x-cloak
    @keydown.escape.window="if (saved) closeEstimate()"
  >
    {{-- Form always stays — estimate opens as modal overlay --}}
    <div class="calc-hero-result">
      <div class="calc-hero-kicker">{{ __('messages.calc_capacity_title') }}</div>
      <div class="calc-hero-main">
        <span class="calc-hero-num" x-text="fmt(birds)"></span>
        <span class="calc-hero-unit">{{ __('messages.birds_unit') }}</span>
      </div>
      <div class="calc-hero-meta">
        <span>{{ __('messages.calc_effective_length') }}: <strong x-text="effectiveLength + ' م'"></strong></span>
        <span class="calc-hero-dot" aria-hidden="true"></span>
        <span>{{ __('messages.calc_total_nests') }}: <strong x-text="fmt(totalNests)"></strong></span>
      </div>
    </div>

    <div class="calc-form">

        <div class="calc-step">
          <div class="calc-step-head">
            <span class="calc-step-num">1</span>
            <div>
              <div class="calc-section-title calc-section-title--inline">{{ __('messages.calc_dimensions') }}</div>
              <p class="calc-step-hint">{{ __('messages.calc_step_dims_hint') }}</p>
            </div>
          </div>

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
        </div>

        <div class="calc-step">
          <div class="calc-step-head">
            <span class="calc-step-num">2</span>
            <div>
              <div class="calc-section-title calc-section-title--inline">{{ __('messages.calc_battery') }}</div>
              <p class="calc-step-hint">{{ __('messages.calc_step_battery_hint') }}</p>
            </div>
          </div>

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

        <details class="calc-details">
          <summary class="calc-details-summary">{{ __('messages.calc_more_details') }}</summary>
          <div class="calc-capacity-grid calc-capacity-grid--light">
            <div class="calc-capacity-item calc-capacity-item--light">
              <span class="calc-capacity-item-label">{{ __('messages.calc_nests_per_line') }}</span>
              <span class="calc-capacity-item-val" x-text="fmt(nestsPerLine)"></span>
            </div>
            <div class="calc-capacity-item calc-capacity-item--light">
              <span class="calc-capacity-item-label">{{ __('messages.calc_birds_per_nest') }}</span>
              <span class="calc-capacity-item-val" x-text="birdsPerNest"></span>
            </div>
          </div>
          <div class="calc-section-title" style="margin-top:20px">{{ __('messages.calc_tech_outputs') }}</div>
          <div class="calc-tech-grid">
            <div class="calc-tech-item">
              <span class="calc-tech-label">{{ __('messages.calc_rear_fans') }}</span>
              <span class="calc-tech-val" x-text="rearFans"></span>
            </div>
            <div class="calc-tech-item">
              <span class="calc-tech-label">{{ __('messages.calc_cooling') }}</span>
              <span class="calc-tech-val"><span x-text="coolingPadMeters"></span> م</span>
            </div>
            <div class="calc-tech-item">
              <span class="calc-tech-label">{{ __('messages.calc_inlets') }}</span>
              <span class="calc-tech-val" x-text="inlets"></span>
            </div>
            <div class="calc-tech-item">
              <span class="calc-tech-label">{{ __('messages.calc_layer_nests') }}</span>
              <span class="calc-tech-val" x-text="fmt(layerNestsTotal)"></span>
            </div>
          </div>
          <p class="calc-formula-note" x-text="formulaLabel"></p>
        </details>

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
          <i data-lucide="info" class="w-5 h-5 flex-shrink-0" style="color:var(--mi-red)"></i>
          <div>
            <div class="calc-note-title">{{ __('messages.calc_disclaimer_title') }}</div>
            <div class="calc-note-body">{{ __('messages.calc_disclaimer_body') }}</div>
          </div>
        </div>

        <p class="calc-field-error calc-field-error--global" x-show="errors.form" x-text="errors.form"></p>

        <div class="calc-actions">
          <button type="button"
                  class="btn btn-primary calc-action-primary"
                  @click="saveEstimate()"
                  :disabled="saving">
            <span x-show="!saving">
              <i data-lucide="file-text" class="w-4 h-4"></i> {{ __('messages.calc_persist') }}
            </span>
            <span x-show="saving">...</span>
          </button>
          <a href="tel:{{ config('mi.phone_primary') }}" class="btn calc-action-call">
            <i data-lucide="phone" class="w-4 h-4"></i>
            <span dir="ltr">{{ config('mi.phone_primary') }}</span>
          </a>
        </div>
      </div>

    </div>{{-- /.calc-form --}}

      <div class="calc-sticky-bar" aria-live="polite">
        <div>
          <div class="calc-sticky-label">{{ __('messages.calc_capacity_title') }}</div>
          <div class="calc-sticky-value"><span x-text="fmt(birds)"></span> {{ __('messages.birds_unit') }}</div>
        </div>
        <button type="button" class="btn btn-primary calc-sticky-btn" @click="saveEstimate()" :disabled="saving">
          {{ __('messages.calc_persist_short') }}
        </button>
      </div>

    {{-- Estimate modal --}}
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
        class="calc-modal-panel"
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

        <div class="calc-estimate-badge">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 12.5l2 2 4-4.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/></svg>
          <span x-text="savedMsg"></span>
        </div>

        <div class="calc-estimate-kicker" id="calcEstimateTitle">{{ __('messages.calc_estimate_title') }}</div>
        <div class="calc-estimate-main">
          <span class="calc-estimate-num" x-text="fmt(birds)"></span>
          <span class="calc-estimate-unit">{{ __('messages.birds_unit') }}</span>
        </div>

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
            <span>{{ __('messages.calc_floors') }}</span>
            <strong x-text="floors"></strong>
          </div>
          <div class="calc-estimate-item">
            <span>{{ __('messages.calc_lines') }}</span>
            <strong x-text="lines"></strong>
          </div>
          <div class="calc-estimate-item">
            <span>{{ __('messages.calc_total_nests') }}</span>
            <strong x-text="fmt(totalNests)"></strong>
          </div>
        </div>

        <p class="calc-estimate-note">{{ __('messages.calc_estimate_note') }}</p>

        <div class="calc-estimate-actions">
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
</div>

{{--
  Canonical Alpine registration for this Livewire component.
  Full factory inlined so there is zero dependency on Vite module load order.
  Livewire @script runs after Alpine is available and before this component's x-data evaluates.
--}}
@script
<script>
    if (!Alpine.__miPoultryCalcRegistered) {
        Alpine.__miPoultryCalcRegistered = true;
        Alpine.data('miPoultryCalc', (cfg = {}) => ({
            length: Number(cfg.length) || 71,
            width: Number(cfg.width) || 12,
            height: Number(cfg.height) || 3.5,
            floors: Number(cfg.floors) || 3,
            lines: Number(cfg.lines) || 4,
            serviceLength: Number(cfg.serviceLength) || 10,
            birdWeightKg: Number(cfg.birdWeightKg) || 2.1,
            fanCapacityKg: Number(cfg.fanCapacityKg) || 5000,
            coolingPadMetersPerFan: Number(cfg.coolingPadMetersPerFan) || 5.5,
            layerNestModuleM: Number(cfg.layerNestModuleM) || 0.6,
            widthLinesMap: cfg.widthLinesMap || {},
            weightMap: cfg.weightMap || {},
            minLength: Number(cfg.minLength) || 71,
            maxLength: Number(cfg.maxLength) || 300,
            minWidth: Number(cfg.minWidth) || 8,
            maxWidth: Number(cfg.maxWidth) || 30,
            minHeight: Number(cfg.minHeight) || 3,
            maxHeight: Number(cfg.maxHeight) || 6,
            floorsOptions: (cfg.floorsOptions || [1, 2, 3, 4, 5]).map(Number),
            linesOptions: (cfg.linesOptions || [3, 4, 5, 6]).map(Number),
            locale: cfg.locale || 'ar',
            waNumber: String(cfg.waNumber || '201030003186').replace(/\D+/g, ''),
            name: '',
            phone: '',
            saving: false,
            saved: false,
            savedMsg: '',
            requestId: null,
            errors: {},

            birds: 0,
            birdsPerNest: 16,
            effectiveLength: 0,
            nestsPerLine: 0,
            totalNests: 0,
            rearFans: 0,
            coolingPadMeters: 0,
            inlets: 0,
            layerNestsTotal: 0,

            init() {
                this.recompute();
            },

            closeEstimate() {
                this.saved = false;
                document.body.classList.remove('calc-modal-open');
                window.lenis?.start();
            },

            openEstimate() {
                this.saved = true;
                document.body.classList.add('calc-modal-open');
                window.lenis?.stop();
            },

            clamp(key, min, max) {
                let v = Number(this[key]);
                if (Number.isNaN(v)) v = min;
                this[key] = Math.min(max, Math.max(min, v));
            },

            nudge(key, delta) {
                const bounds = {
                    length: [this.minLength, this.maxLength],
                    width: [this.minWidth, this.maxWidth],
                    height: [this.minHeight, this.maxHeight],
                };
                const [min, max] = bounds[key];
                const next = Math.round((Number(this[key]) + delta) * 10) / 10;
                this[key] = Math.min(max, Math.max(min, next));
                if (key === 'length') this.onLengthInput();
                else if (key === 'width') this.onWidthInput();
                else this.recompute();
            },

            onLengthInput() {
                this.clamp('length', this.minLength, this.maxLength);
                this.recompute();
            },

            onWidthInput() {
                this.clamp('width', this.minWidth, this.maxWidth);
                const key = String(this.width);
                const keyInt = String(parseFloat(this.width));
                if (this.widthLinesMap[key] != null) {
                    this.lines = Number(this.widthLinesMap[key]);
                } else if (this.widthLinesMap[keyInt] != null) {
                    this.lines = Number(this.widthLinesMap[keyInt]);
                }
                this.recompute();
            },

            resolveBirdsPerNest() {
                const map = this.weightMap;
                const key = String(this.birdWeightKg);
                if (map[key] != null) return Number(map[key]);
                let closest = 16;
                let closestDiff = Infinity;
                Object.keys(map).forEach((w) => {
                    const diff = Math.abs(Number(w) - this.birdWeightKg);
                    if (diff < closestDiff) {
                        closestDiff = diff;
                        closest = Number(map[w]);
                    }
                });
                return closest;
            },

            recompute() {
                const L = Number(this.length) || 0;
                const floors = Number(this.floors) || 1;
                const lines = Number(this.lines) || 1;

                const rawEffective = Math.max(0, L - this.serviceLength);
                this.effectiveLength = Math.floor(rawEffective / 2) * 2;
                this.birdsPerNest = this.resolveBirdsPerNest();
                this.nestsPerLine = this.effectiveLength * 2 * floors;
                this.totalNests = this.nestsPerLine * lines;
                this.birds = this.totalNests * this.birdsPerNest;

                this.rearFans = Math.ceil((this.birds * this.birdWeightKg) / this.fanCapacityKg) || 0;
                this.coolingPadMeters = Math.ceil(this.rearFans * this.coolingPadMetersPerFan) || 0;
                this.inlets = Math.max(0, (L % 2 === 1) ? ((L - 3) / 2) : ((L - 4) / 2));
                this.inlets = Math.floor(this.inlets);
                const layerNestsPerFace = Math.round(this.effectiveLength / this.layerNestModuleM);
                this.layerNestsTotal = layerNestsPerFace * 2 * floors;
            },

            get formulaLabel() {
                if (this.locale === 'ar') {
                    return 'طول فعّال ' + this.effectiveLength + 'م × 2 وجه × ' + this.floors + ' أدوار × ' + this.lines + ' خط × ' + this.birdsPerNest + ' طير/عش';
                }
                return 'Eff. ' + this.effectiveLength + 'm × 2 faces × ' + this.floors + ' floors × ' + this.lines + ' lines × ' + this.birdsPerNest + ' birds/nest';
            },

            get waLink() {
                const msg = this.locale === 'ar'
                    ? ('السلام عليكم، تم حساب تقدير سعة عنبر:\n• الطيور: ' + this.fmt(this.birds)
                        + '\n• الأبعاد: ' + this.length + '×' + this.width + '×' + this.height + ' م'
                        + '\n• الأدوار/الخطوط: ' + this.floors + '/' + this.lines
                        + '\n• الأعشاش: ' + this.fmt(this.totalNests)
                        + '\nالاسم: ' + this.name
                        + '\nالهاتف: ' + this.phone)
                    : ('Hello, capacity estimate:\n• Birds: ' + this.fmt(this.birds)
                        + '\n• Size: ' + this.length + '×' + this.width + '×' + this.height + ' m'
                        + '\n• Floors/Lines: ' + this.floors + '/' + this.lines
                        + '\n• Nests: ' + this.fmt(this.totalNests)
                        + '\nName: ' + this.name
                        + '\nPhone: ' + this.phone);
                return 'https://wa.me/' + this.waNumber + '?text=' + encodeURIComponent(msg);
            },

            fmt(n) {
                try {
                    return new Intl.NumberFormat(this.locale === 'ar' ? 'ar-EG' : 'en-US').format(Number(n) || 0);
                } catch (e) {
                    return String(n);
                }
            },

            validateLocal() {
                const errors = {};
                if (!this.name || this.name.length < 2) {
                    errors.name = this.locale === 'ar' ? 'الاسم مطلوب' : 'Name is required';
                }
                if (!this.phone || this.phone.replace(/\D+/g, '').length < 8) {
                    errors.phone = this.locale === 'ar' ? 'رقم هاتف صحيح مطلوب' : 'Valid phone is required';
                }
                this.errors = errors;
                return Object.keys(errors).length === 0;
            },

            async saveEstimate() {
                if (!this.validateLocal()) {
                    this.$el.querySelector('#calc-name')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }
                this.saving = true;
                this.errors = {};
                try {
                    const result = await this.$wire.syncAndPersist({
                        length: this.length,
                        width: this.width,
                        height: this.height,
                        floors: this.floors,
                        lines: this.lines,
                        name: this.name,
                        phone: this.phone,
                    });
                    this.requestId = result?.requestId ?? null;
                    this.savedMsg = result?.message || (this.locale === 'ar'
                        ? 'تم حفظ التقدير بنجاح'
                        : 'Estimate saved successfully');
                    this.openEstimate();
                } catch (e) {
                    const msg = String(e?.message || e || '');
                    if (msg.toLowerCase().includes('expired')) {
                        window.location.reload();
                        return;
                    }
                    const bag = e?.errors || e?.detail?.errors;
                    if (bag) {
                        const mapped = {};
                        Object.keys(bag).forEach((k) => {
                            mapped[k.replace(/^data\./, '')] = Array.isArray(bag[k]) ? bag[k][0] : bag[k];
                        });
                        this.errors = { ...this.errors, ...mapped, form: mapped.name || mapped.phone || mapped.form };
                    } else {
                        this.errors = {
                            form: this.locale === 'ar'
                                ? 'تعذّر الحفظ. حاول مرة أخرى.'
                                : 'Could not save. Please try again.',
                        };
                    }
                } finally {
                    this.saving = false;
                }
            },
        }));
    }
</script>
@endscript
