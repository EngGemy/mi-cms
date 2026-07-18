<div class="calc-card" data-reveal>
  <div class="calc-form">

    {{-- Dimensions --}}
    <div class="calc-section-title">{{ __('messages.calc_dimensions') }}</div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_length') }}</span>
        <span class="calc-value-pill">{{ $length }} م</span>
      </div>
      <input type="range" class="calc-slider" wire:model.live.debounce.300ms="length" min="81" max="300" step="1"/>
      <div class="calc-hint">الحد الأدنى 81 متر · الحد الأقصى 300 متر</div>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_width') }}</span>
        <span class="calc-value-pill">{{ $width }} م</span>
      </div>
      <input type="range" class="calc-slider" wire:model.live.debounce.300ms="width" min="8" max="30" step="0.5"/>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_height') }}</span>
        <span class="calc-value-pill">{{ $height }} م</span>
      </div>
      <input type="range" class="calc-slider" wire:model.live.debounce.300ms="height" min="3" max="6" step="0.5"/>
    </div>

    {{-- Battery config --}}
    <div class="calc-section-title" style="margin-top:32px">{{ __('messages.calc_battery') }}</div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_floors') }}</span>
        <span class="calc-value-pill">{{ $floors }}</span>
      </div>
      <div class="calc-radio-group">
        @foreach([1,2,3,4,5] as $v)
          <button type="button" wire:click="$set('floors', {{ $v }})" wire:loading.attr="disabled"
                  class="calc-radio @if($floors === $v) is-active @endif">{{ $v }}</button>
        @endforeach
      </div>
    </div>

    <div class="calc-row">
      <div class="calc-label">
        <span class="calc-label-text">{{ __('messages.calc_lines') }}</span>
        <span class="calc-value-pill">{{ $lines }}</span>
      </div>
      <div class="calc-radio-group">
        @foreach([3,4,5,6] as $v)
          <button type="button" wire:click="$set('lines', {{ $v }})"
                  class="calc-radio @if($lines === $v) is-active @endif">{{ $v }}</button>
        @endforeach
      </div>
    </div>

    @php $b = $breakdown; @endphp

    {{-- Result: Capacity --}}
    <div class="calc-capacity-card">
      <div class="calc-capacity-header">
        <div>
          <div class="calc-capacity-label">السعة التقديرية</div>
          <div class="calc-capacity-formula">
            طول فعّال {{ $b['effective_length'] ?? 0 }}م × 2 وجه × {{ $b['inputs']['floors'] ?? $floors }} أدوار × {{ $b['inputs']['lines'] ?? $lines }} خط × {{ $b['birds_per_nest'] ?? 16 }} طير/عش
          </div>
        </div>
        <div class="calc-capacity-num">
          {{ number_format($b['birds'] ?? 0) }}
          <span class="calc-capacity-unit">طائر</span>
        </div>
      </div>

      <div class="calc-capacity-grid">
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">الطول الفعّال</span>
          <span class="calc-capacity-item-val">{{ $b['effective_length'] ?? 0 }} م</span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">إجمالي الأعشاش</span>
          <span class="calc-capacity-item-val">{{ number_format($b['total_nests'] ?? 0) }}</span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">الأعشاش / خط</span>
          <span class="calc-capacity-item-val">{{ number_format($b['nests_per_line'] ?? 0) }}</span>
        </div>
        <div class="calc-capacity-item">
          <span class="calc-capacity-item-label">الطيور / العش</span>
          <span class="calc-capacity-item-val">{{ $b['birds_per_nest'] ?? 16 }}</span>
        </div>
      </div>
    </div>

    {{-- Technical outputs (no prices) --}}
    <div class="calc-section-title" style="margin-top:32px">مخرجات فنية</div>
    <div class="calc-tech-grid">
      <div class="calc-tech-item">
        <span class="calc-tech-label">الشفاطات الخلفية</span>
        <span class="calc-tech-val">{{ $b['rear_fans'] ?? 0 }}</span>
      </div>
      <div class="calc-tech-item">
        <span class="calc-tech-label">وحدات التبريد</span>
        <span class="calc-tech-val">{{ $b['cooling_pad_meters'] ?? 0 }} م</span>
      </div>
      <div class="calc-tech-item">
        <span class="calc-tech-label">شبابيك الهواء</span>
        <span class="calc-tech-val">{{ $b['inlets'] ?? 0 }}</span>
      </div>
      <div class="calc-tech-item">
        <span class="calc-tech-label">أعشاش البياض (كل الأدوار)</span>
        <span class="calc-tech-val">{{ number_format($b['layer_nests_total'] ?? 0) }}</span>
      </div>
    </div>

    {{-- Disclaimer + actions --}}
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
      <button type="button" wire:click="persist" class="btn btn-primary flex-1" data-magnetic>
        <i data-lucide="send" class="w-4 h-4"></i> {{ __('messages.calc_persist') }}
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
