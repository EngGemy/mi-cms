// Price calculator Alpine component.
// Register on alpine:init AND immediately if Alpine already booted (Vite race).

function registerMiPoultryCalc(Alpine) {
  if (!Alpine || Alpine.__miPoultryCalcRegistered) return;
  Alpine.__miPoultryCalcRegistered = true;

  Alpine.data('miPoultryCalc', (cfg = {}) => ({
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
    minLength: Number(cfg.minLength) || 81,
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

document.addEventListener('alpine:init', () => registerMiPoultryCalc(window.Alpine));

// Vite module may load after Alpine already started
if (window.Alpine) {
  registerMiPoultryCalc(window.Alpine);
}

document.addEventListener('livewire:init', () => {
  if (window.Alpine) registerMiPoultryCalc(window.Alpine);
});
