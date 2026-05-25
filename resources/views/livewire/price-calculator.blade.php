<div class="calc-card" data-reveal>
  <div class="calc-grid">

    <div class="calc-form">
      <div class="calc-section-title">{{ __('messages.calc_dimensions') }}</div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text">{{ __('messages.calc_length') }}</span>
          <span class="calc-value-pill">{{ $length }} م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="length" min="30" max="150" step="1"/>
      </div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text">{{ __('messages.calc_width') }}</span>
          <span class="calc-value-pill">{{ $width }} م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="width" min="8" max="20" step="1"/>
      </div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text">{{ __('messages.calc_height') }}</span>
          <span class="calc-value-pill">{{ $height }} م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="height" min="3" max="5" step="0.5"/>
      </div>

      <div class="calc-section-title" style="margin-top:32px">{{ __('messages.calc_battery') }}</div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text">{{ __('messages.calc_floors') }}</span>
          <span class="calc-value-pill">{{ $floors }}</span>
        </div>
        <div class="calc-radio-group">
          @foreach([3,4,5] as $v)
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
    </div>

    <div class="calc-result">
      <div class="relative" style="z-index:1">
        <div class="calc-birds-bar">
          <div>
            <div class="calc-birds-bar-label">{{ __('messages.calc_capacity') }}</div>
            <div style="color:rgba(255,255,255,.5);font-size:11px;margin-top:2px" class="font-mono">
              EFFECTIVE LENGTH × 2 × FLOORS × LINES × 16
            </div>
          </div>
          <div class="calc-birds-bar-num">{{ number_format($breakdown['birds'] ?? 0) }}
            <span style="font-size:14px;font-weight:600;color:rgba(255,255,255,.6);margin-right:6px">طائر</span>
          </div>
        </div>

        <div class="calc-section-title" style="margin-top:24px">بند الإنشاءات</div>
        @php($c = $breakdown['construction'] ?? [])
        <div class="calc-line"><div class="calc-line-name">الخرسانات</div><div class="calc-line-val">{{ number_format($c['concrete'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الاستيل</div><div class="calc-line-val">{{ number_format($c['steel'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الحوائط</div><div class="calc-line-val">{{ number_format($c['walls'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الخزانات</div><div class="calc-line-val">{{ number_format($c['tanks'] ?? 0) }}</div></div>
        <div class="calc-subtotal"><span>إجمالي الإنشاءات</span><span class="calc-subtotal-val">{{ number_format($c['total'] ?? 0) }}</span></div>

        <div class="calc-section-title" style="margin-top:20px">بند البطارية</div>
        <div class="calc-line"><div class="calc-line-name">البطاريات</div><div class="calc-line-val">{{ number_format($breakdown['battery']['total'] ?? 0) }}</div></div>

        <div class="calc-section-title" style="margin-top:20px">بند المشتملات</div>
        @php($a = $breakdown['accessories'] ?? [])
        <div class="calc-line"><div class="calc-line-name">الشفاطات الخلفية ({{ $a['rear_fans']['count'] ?? 0 }})</div><div class="calc-line-val">{{ number_format($a['rear_fans']['total'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">منظومة التبريد</div><div class="calc-line-val">{{ number_format($a['cooling']['total'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الشبابيك ({{ $a['windows']['count'] ?? 0 }})</div><div class="calc-line-val">{{ number_format($a['windows']['total'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الشفاطات الجانبية ({{ $a['side_fans']['count'] ?? 0 }})</div><div class="calc-line-val">{{ number_format($a['side_fans']['total'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">الدفايات ({{ $a['heaters']['count'] ?? 0 }})</div><div class="calc-line-val">{{ number_format($a['heaters']['total'] ?? 0) }}</div></div>
        <div class="calc-line"><div class="calc-line-name">منظومة التحكم</div><div class="calc-line-val">{{ number_format($a['control']['total'] ?? 0) }}</div></div>
        <div class="calc-subtotal"><span>إجمالي المشتملات</span><span class="calc-subtotal-val">{{ number_format($a['total'] ?? 0) }}</span></div>

        <div class="calc-grand">
          <div class="calc-grand-label">{{ __('messages.calc_grand_total') }}</div>
          <div class="calc-grand-num">
            <span class="calc-grand-currency">ج.م</span>{{ number_format($breakdown['grand_total'] ?? 0) }}
          </div>
          <div class="calc-grand-note">{{ __('messages.calc_grand_note') }}</div>
        </div>

        <div class="flex flex-wrap gap-3 mt-6">
          <button type="button" wire:click="persist" class="btn btn-primary flex-1" data-magnetic>
            <i data-lucide="send" class="w-4 h-4"></i> {{ __('messages.calc_persist') }}
          </button>
          <a href="tel:{{ config('mi.phone_primary') }}" class="btn flex-1"
             style="background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.2);backdrop-filter:blur(8px)" data-magnetic>
            <i data-lucide="phone" class="w-4 h-4"></i>
            <span dir="ltr">{{ config('mi.phone_primary') }}</span>
          </a>
        </div>
        @if(session('calc_ok'))
          <p class="text-sm mt-4" style="color:var(--mi-red-light)">✔ {{ session('calc_ok') }}</p>
        @endif
      </div>
    </div>
  </div>
</div>
