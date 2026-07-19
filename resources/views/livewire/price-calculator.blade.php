@php
  $cfg = $alpineConfig;
@endphp
<div
  class="calc-card calc-card--ux"
  data-reveal
  x-data="miPoultryCalc(@js($cfg))"
  x-cloak
>
  {{-- Primary result: always first & sticky on mobile --}}
  <div class="calc-hero-result" wire:ignore>
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

      {{-- Length --}}
      <div class="calc-control">
        <div class="calc-control-top">
          <label class="calc-label-text" for="calc-length">{{ __('messages.calc_length') }}</label>
          <div class="calc-stepper">
            <button type="button" class="calc-stepper-btn" @click="nudge('length', -1)" aria-label="-">−</button>
            <input id="calc-length" type="number" class="calc-num-input" inputmode="numeric"
                   x-model.number="length" @change="clamp('length', 81, 300); onLengthInput()"
                   min="81" max="300" step="1"/>
            <button type="button" class="calc-stepper-btn" @click="nudge('length', 1)" aria-label="+">+</button>
          </div>
        </div>
        <input type="range" class="calc-slider" x-model.number="length" @input="onLengthInput()"
               min="81" max="300" step="1" aria-hidden="true" tabindex="-1"/>
        <div class="calc-hint">{{ __('messages.calc_length_hint') }}</div>
      </div>

      {{-- Width --}}
      <div class="calc-control">
        <div class="calc-control-top">
          <label class="calc-label-text" for="calc-width">{{ __('messages.calc_width') }}</label>
          <div class="calc-stepper">
            <button type="button" class="calc-stepper-btn" @click="nudge('width', -0.5)" aria-label="-">−</button>
            <input id="calc-width" type="number" class="calc-num-input" inputmode="decimal"
                   x-model.number="width" @change="clamp('width', 8, 30); onWidthInput()"
                   min="8" max="30" step="0.5"/>
            <button type="button" class="calc-stepper-btn" @click="nudge('width', 0.5)" aria-label="+">+</button>
          </div>
        </div>
        <input type="range" class="calc-slider" x-model.number="width" @input="onWidthInput()"
               min="8" max="30" step="0.5" aria-hidden="true" tabindex="-1"/>
      </div>

      {{-- Height --}}
      <div class="calc-control">
        <div class="calc-control-top">
          <label class="calc-label-text" for="calc-height">{{ __('messages.calc_height') }}</label>
          <div class="calc-stepper">
            <button type="button" class="calc-stepper-btn" @click="nudge('height', -0.5)" aria-label="-">−</button>
            <input id="calc-height" type="number" class="calc-num-input" inputmode="decimal"
                   x-model.number="height" @change="clamp('height', 3, 6); recompute()"
                   min="3" max="6" step="0.5"/>
            <button type="button" class="calc-stepper-btn" @click="nudge('height', 0.5)" aria-label="+">+</button>
          </div>
        </div>
        <input type="range" class="calc-slider" x-model.number="height" @input="recompute()"
               min="3" max="6" step="0.5" aria-hidden="true" tabindex="-1"/>
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
          <template x-for="v in [1,2,3,4,5]" :key="'f'+v">
            <button type="button" class="calc-chip" :class="floors === v && 'is-active'"
                    :aria-pressed="floors === v"
                    @click="floors = v; recompute()" x-text="v"></button>
          </template>
        </div>
      </div>

      <div class="calc-control">
        <div class="calc-control-label-only">{{ __('messages.calc_lines') }}</div>
        <div class="calc-chip-group" role="group" aria-label="{{ __('messages.calc_lines') }}">
          <template x-for="v in [3,4,5,6]" :key="'l'+v">
            <button type="button" class="calc-chip" :class="lines === v && 'is-active'"
                    :aria-pressed="lines === v"
                    @click="lines = v; recompute()" x-text="v"></button>
          </template>
        </div>
      </div>
    </div>

    {{-- Details (collapsed by default on small screens via CSS details) --}}
    <details class="calc-details">
      <summary class="calc-details-summary">{{ __('messages.calc_more_details') }}</summary>
      <div class="calc-capacity-grid calc-capacity-grid--light" wire:ignore>
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
      <div class="calc-tech-grid" wire:ignore>
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

    <div class="calc-note">
      <i data-lucide="info" class="w-5 h-5 flex-shrink-0" style="color:var(--mi-red)"></i>
      <div>
        <div class="calc-note-title">{{ __('messages.calc_disclaimer_title') }}</div>
        <div class="calc-note-body">{{ __('messages.calc_disclaimer_body') }}</div>
      </div>
    </div>

    <div class="calc-actions">
      <button type="button"
              class="btn btn-primary calc-action-primary"
              wire:loading.attr="disabled"
              @click="saveEstimate()"
              :disabled="saving">
        <span wire:loading.remove wire:target="syncAndPersist">
          <i data-lucide="send" class="w-4 h-4"></i> {{ __('messages.calc_persist') }}
        </span>
        <span wire:loading wire:target="syncAndPersist">...</span>
      </button>
      <a href="tel:{{ config('mi.phone_primary') }}" class="btn calc-action-call">
        <i data-lucide="phone" class="w-4 h-4"></i>
        <span dir="ltr">{{ config('mi.phone_primary') }}</span>
      </a>
    </div>
    @if(session('calc_ok'))
      <p class="text-sm mt-4" style="color:var(--mi-red)">✔ {{ session('calc_ok') }}</p>
    @endif
  </div>

  {{-- Mobile sticky birds bar --}}
  <div class="calc-sticky-bar" aria-live="polite">
    <div>
      <div class="calc-sticky-label">{{ __('messages.calc_capacity_title') }}</div>
      <div class="calc-sticky-value"><span x-text="fmt(birds)"></span> {{ __('messages.birds_unit') }}</div>
    </div>
    <button type="button" class="btn btn-primary calc-sticky-btn" @click="saveEstimate()" :disabled="saving">
      {{ __('messages.calc_persist_short') }}
    </button>
  </div>
</div>

@script
<script>
Alpine.data('miPoultryCalc', (cfg) => ({
  length: Number(cfg.length) || 81,
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
  locale: cfg.locale || 'ar',
  saving: false,

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

  clamp(key, min, max) {
    let v = Number(this[key]);
    if (Number.isNaN(v)) v = min;
    this[key] = Math.min(max, Math.max(min, v));
  },

  nudge(key, delta) {
    const bounds = {
      length: [81, 300],
      width: [8, 30],
      height: [3, 6],
    };
    const [min, max] = bounds[key];
    const next = Math.round((Number(this[key]) + delta) * 10) / 10;
    this[key] = Math.min(max, Math.max(min, next));
    if (key === 'length') this.onLengthInput();
    else if (key === 'width') this.onWidthInput();
    else this.recompute();
  },

  onLengthInput() {
    this.clamp('length', 81, 300);
    this.recompute();
  },

  onWidthInput() {
    this.clamp('width', 8, 30);
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
      return `طول فعّال ${this.effectiveLength}م × 2 وجه × ${this.floors} أدوار × ${this.lines} خط × ${this.birdsPerNest} طير/عش`;
    }
    return `Eff. ${this.effectiveLength}m × 2 faces × ${this.floors} floors × ${this.lines} lines × ${this.birdsPerNest} birds/nest`;
  },

  fmt(n) {
    try {
      return new Intl.NumberFormat(this.locale === 'ar' ? 'ar-EG' : 'en-US').format(Number(n) || 0);
    } catch (e) {
      return String(n);
    }
  },

  async saveEstimate() {
    this.saving = true;
    try {
      await $wire.syncAndPersist({
        length: this.length,
        width: this.width,
        height: this.height,
        floors: this.floors,
        lines: this.lines,
      });
    } catch (e) {
      if (String(e?.message || e).toLowerCase().includes('expired')) {
        window.location.reload();
      }
    } finally {
      this.saving = false;
    }
  },
}));
</script>
@endscript
