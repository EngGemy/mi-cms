/**
 * MI Poultry capacity calculator — classic script (NOT a Vite module).
 * Loaded sync in <head> BEFORE Livewire so alpine:init registers Alpine.data
 * before any x-data="miPoultryCalc(...)" evaluates.
 */
(function (global) {
  'use strict';

  function miPoultryCalcFactory(cfg) {
    cfg = cfg || {};
    return {
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

      init: function () { this.recompute(); },

      closeEstimate: function () {
        this.saved = false;
        document.body.classList.remove('calc-modal-open');
        if (global.lenis) global.lenis.start();
      },

      openEstimate: function () {
        this.saved = true;
        document.body.classList.add('calc-modal-open');
        if (global.lenis) global.lenis.stop();
      },

      clamp: function (key, min, max) {
        var v = Number(this[key]);
        if (Number.isNaN(v)) v = min;
        this[key] = Math.min(max, Math.max(min, v));
      },

      nudge: function (key, delta) {
        var bounds = {
          length: [this.minLength, this.maxLength],
          width: [this.minWidth, this.maxWidth],
          height: [this.minHeight, this.maxHeight],
        };
        var pair = bounds[key] || [0, 9999];
        var next = Math.round((Number(this[key]) + delta) * 10) / 10;
        this[key] = Math.min(pair[1], Math.max(pair[0], next));
        if (key === 'length') this.onLengthInput();
        else if (key === 'width') this.onWidthInput();
        else this.recompute();
      },

      onLengthInput: function () {
        this.clamp('length', this.minLength, this.maxLength);
        this.recompute();
      },

      onWidthInput: function () {
        this.clamp('width', this.minWidth, this.maxWidth);
        var key = String(this.width);
        var keyInt = String(parseFloat(this.width));
        if (this.widthLinesMap[key] != null) this.lines = Number(this.widthLinesMap[key]);
        else if (this.widthLinesMap[keyInt] != null) this.lines = Number(this.widthLinesMap[keyInt]);
        this.recompute();
      },

      resolveBirdsPerNest: function () {
        var map = this.weightMap;
        var key = String(this.birdWeightKg);
        if (map[key] != null) return Number(map[key]);
        var closest = 16;
        var closestDiff = Infinity;
        var self = this;
        Object.keys(map).forEach(function (w) {
          var diff = Math.abs(Number(w) - self.birdWeightKg);
          if (diff < closestDiff) {
            closestDiff = diff;
            closest = Number(map[w]);
          }
        });
        return closest;
      },

      recompute: function () {
        var L = Number(this.length) || 0;
        var floors = Number(this.floors) || 1;
        var lines = Number(this.lines) || 1;
        var rawEffective = Math.max(0, L - this.serviceLength);
        this.effectiveLength = Math.floor(rawEffective / 2) * 2;
        this.birdsPerNest = this.resolveBirdsPerNest();
        this.nestsPerLine = this.effectiveLength * 2 * floors;
        this.totalNests = this.nestsPerLine * lines;
        this.birds = this.totalNests * this.birdsPerNest;
        this.rearFans = Math.ceil((this.birds * this.birdWeightKg) / this.fanCapacityKg) || 0;
        this.coolingPadMeters = Math.ceil(this.rearFans * this.coolingPadMetersPerFan) || 0;
        var rawInlets = (L % 2 === 1) ? ((L - 3) / 2) : ((L - 4) / 2);
        this.inlets = Math.max(0, Math.floor(rawInlets));
        var layerNestsPerFace = Math.round(this.effectiveLength / this.layerNestModuleM);
        this.layerNestsTotal = layerNestsPerFace * 2 * floors;
      },

      get formulaLabel() {
        if (this.locale === 'ar') {
          return 'طول فعّال ' + this.effectiveLength + 'م × 2 وجه × ' + this.floors + ' أدوار × ' + this.lines + ' خط × ' + this.birdsPerNest + ' طير/عش';
        }
        return 'Eff. ' + this.effectiveLength + 'm × 2 faces × ' + this.floors + ' floors × ' + this.lines + ' lines × ' + this.birdsPerNest + ' birds/nest';
      },

      get waLink() {
        var msg = this.locale === 'ar'
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

      fmt: function (n) {
        try {
          return new Intl.NumberFormat(this.locale === 'ar' ? 'ar-EG' : 'en-US').format(Number(n) || 0);
        } catch (e) {
          return String(n);
        }
      },

      validateLocal: function () {
        var errors = {};
        if (!this.name || String(this.name).trim().length < 2) {
          errors.name = this.locale === 'ar' ? 'الاسم مطلوب' : 'Name is required';
        }
        if (!this.phone || String(this.phone).replace(/\D+/g, '').length < 8) {
          errors.phone = this.locale === 'ar' ? 'رقم هاتف صحيح مطلوب' : 'Valid phone is required';
        }
        this.errors = errors;
        return Object.keys(errors).length === 0;
      },

      saveEstimate: async function () {
        if (!this.validateLocal()) {
          var el = this.$el.querySelector('#calc-name');
          if (el) el.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }
        this.saving = true;
        this.errors = {};
        try {
          var result = await this.$wire.syncAndPersist({
            length: this.length,
            width: this.width,
            height: this.height,
            floors: this.floors,
            lines: this.lines,
            name: this.name,
            phone: this.phone,
          });
          this.requestId = (result && result.requestId != null) ? result.requestId : null;
          this.savedMsg = (result && result.message) || (this.locale === 'ar'
            ? 'تم حفظ التقدير بنجاح'
            : 'Estimate saved successfully');
          this.openEstimate();
        } catch (e) {
          var msg = String((e && e.message) || e || '');
          if (msg.toLowerCase().includes('expired')) {
            global.location.reload();
            return;
          }
          var bag = (e && e.errors) || (e && e.detail && e.detail.errors);
          if (bag) {
            var mapped = {};
            Object.keys(bag).forEach(function (k) {
              mapped[k.replace(/^data\./, '')] = Array.isArray(bag[k]) ? bag[k][0] : bag[k];
            });
            this.errors = Object.assign({}, this.errors, mapped, {
              form: mapped.name || mapped.phone || mapped.form,
            });
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
    };
  }

  global.miPoultryCalcFactory = miPoultryCalcFactory;

  var mountCount = 0;

  function isMounted(el) {
    try {
      var Alpine = global.Alpine;
      if (!Alpine || typeof Alpine.$data !== 'function') return false;
      var data = Alpine.$data(el);
      return !!(data && typeof data.saveEstimate === 'function' && typeof data.fmt === 'function');
    } catch (e) {
      return false;
    }
  }

  /**
   * Livewire sandboxes Alpine expressions — window.miPoultryCalcFactory in x-data never runs.
   * Cards use x-ignore + data-calc-cfg; we mount via Alpine.data(key) + initTree so $wire works.
   */
  function mountCalcs() {
    var Alpine = global.Alpine;
    if (!Alpine || typeof Alpine.data !== 'function' || typeof Alpine.initTree !== 'function') return 0;

    var mounted = 0;
    var nodes = document.querySelectorAll('[data-mi-calc]');
    for (var i = 0; i < nodes.length; i++) {
      var el = nodes[i];
      if (isMounted(el)) {
        mounted += 1;
        continue;
      }

      var cfg = {};
      try {
        cfg = JSON.parse(el.getAttribute('data-calc-cfg') || '{}');
      } catch (e) {
        cfg = {};
      }

      try {
        if (typeof Alpine.destroyTree === 'function') Alpine.destroyTree(el);
      } catch (e2) { /* ignore */ }

      var key = el.getAttribute('data-mi-calc-key');
      if (!key) {
        mountCount += 1;
        key = 'miCalc' + mountCount;
        el.setAttribute('data-mi-calc-key', key);
      }

      Alpine.data(key, (function (capturedCfg) {
        return function () {
          return miPoultryCalcFactory(capturedCfg);
        };
      })(cfg));

      el.removeAttribute('x-ignore');
      el.setAttribute('x-data', key);

      try {
        Alpine.initTree(el);
        if (isMounted(el)) mounted += 1;
      } catch (e3) {
        console.warn('[miPoultryCalc] mount failed', e3);
      }
    }
    return mounted;
  }

  function boot() {
    mountCalcs();
    var tries = 0;
    var t = setInterval(function () {
      tries += 1;
      var n = mountCalcs();
      var total = document.querySelectorAll('[data-mi-calc]').length;
      if ((total > 0 && n >= total) || tries >= 25) clearInterval(t);
    }, 150);
  }

  document.addEventListener('alpine:initialized', boot);
  document.addEventListener('livewire:init', boot);
  document.addEventListener('livewire:navigated', mountCalcs);
  document.addEventListener('DOMContentLoaded', boot);

  if (global.Alpine && global.Alpine.version) {
    boot();
  }
})(window);
