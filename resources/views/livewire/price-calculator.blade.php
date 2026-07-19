@php
  $cfg = $alpineConfig;
@endphp
<div
  class="calc-card"
  data-reveal
  x-data="miPoultryCalc(@js($cfg))"
  x-cloak
>
  <div class="calc-form">

    <div class="calc-section-title">{{ __('messages.calc_dimensions') }}</div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_length') }}</span>
        <span class="calc-value-pill" x-text="length + ' م'"></span>
      </div>
      <input type="range" class="calc-slider" x-model.number="length" @input="onLengthInput()" min="81" max="300" step="1"/>
      <div class="calc-hint">{{ __('messages.calc_length_hint') }}</div>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_width') }}</span>
        <span class="calc-value-pill" x-text="width + ' م'"></span>
      </div>
      <input type="range" class="calc-slider" x-model.number="width" @input="onWidthInput()" min="8" max="30" step="0.5"/>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_height') }}</span>
        <span class="calc-value-pill" x-text="height + ' م'"></span>
      </div>
      <input type="range" class="calc-slider" x-model.number="height" @input="recompute()" min="3" max="6" step="0.5"/>
    </div>

    <div class="calc-section-title" style="margin-top:32px">{{ __('messages.calc_battery') }}</div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_floors') }}</span>
        <span class="calc-value-pill" x-text="floors"></span>
      </div>
      <div class="calc-radio-group">
        <template x-for="v in [1,2,3,4,5]" :key="'f'+v">
          <button type="button" class="calc-radio" :class="floors === v && 'is-active'"
                  @click="floors = v; recompute()" x-text="v"></button>
        </template>
      </div>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_lines') }}</span>
        <span class="calc-value-pill" x-text="lines"></span>
      </div>
      <div class="calc-radio-group">
        <template x-for="v in [3,4,5,6]" :key="'l'+v">
          <button type="button" class="calc-radio" :class="lines === v && 'is-active'"
                  @click="lines = v; recompute()" x-text="v"></button>
        </template>
      </div>
    </div>

    {{-- Capacity only — no prices --}}
    <div class="calc-capacity-card" wire:ignore>
      <div class="calc-capacity-header">
        <div>
          <div class="calc-capacity-label">{{ __('messages.calc_capacity_title') }}</div>
          <div class="calc-capacity-formula">
            <span x-text="formulaLabel"></span>
          </div>
        </div>
        <div class="calc-capacity-num">
          <span x-text="fmt(birds)"></span>
          <span class="calc-capacity-unit">{{ __('messages.birds_unit') }}</span>
        </div>
      </div>

      <div class="calc-capacity-grid">
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">{{ __('messages.calc_effective_length') }}</span>
          <span class="calc-capacity-item-val"><span x-text="effectiveLength"></span> م</span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">{{ __('messages.calc_total_nests') }}</span>
          <span class="calc-capacity-item-val" x-text="fmt(totalNests)"></span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">{{ __('messages.calc_nests_per_line') }}</span>
          <span class="calc-capacity-item-val" x-text="fmt(nestsPerLine)"></span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">{{ __('messages.calc_birds_per_nest') }}</span>
          <span class="calc-capacity-item-val" x-text="birdsPerNest"></span>
        </div>
      </div>
    </div>

    <div class="calc-section-title" style="margin-top:32px">{{ __('messages.calc_tech_outputs') }}</div>
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

    <div class="mt-8 p-5 rounded-2xl" style="background:rgba(200,16,46,.05);border:1px solid rgba(200,16,46,.12)">
      <div class="flex items-start gap-3">
        <i data-lucide="info" class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:var(--mi-red)"></i>
        <div>
          <div style="font-weight:700;font-size:14px;color:var(--ink-900);margin-bottom:4px">
            {{ __('messages.calc_disclaimer_title') }}
          </div>
          <div style="font-size:13px;line-height:1.7;color:var(--ink-600)">{{ __('messages.calc_disclaimer_body') }}</div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap gap-3 mt-6">
      <button type="button"
              class="btn btn-primary flex-1"
              data-magnetic
              wire:loading.attr="disabled"
              @click="saveEstimate()"
              :disabled="saving">
        <span wire:loading.remove wire:target="syncAndPersist">
          <i data-lucide="send" class="w-4 h-4"></i> {{ __('messages.calc_persist') }}
        </span>
        <span wire:loading wire:target="syncAndPersist">...</span>
      </button>
      <a href="tel:{{ config('mi.phone_primary') }}" class="btn flex-1"
         style="background:var(--ink-900);color:#fff;border:1.5px solid var(--ink-900)" data-magnetic>
        <i data-lucide="phone" class="w-4 h-4"></i>
        <span dir="ltr">{{ config('mi.phone_primary') }}</span>
      </a>
    </div>
    @if(session('calc_ok'))
      <p class="text-sm mt-4" style="color:var(--mi-red)">✔ {{ session('calc_ok') }}</p>
    @endif
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

  onLengthInput() {
    this.recompute();
  },

  onWidthInput() {
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
      // Livewire shows page-expired dialog when CSRF dies; nudge a soft reload once.
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
