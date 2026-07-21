{{-- Direct path to calculator — sits under the hero --}}
<section id="start" class="calc-gateway" aria-labelledby="calcGatewayTitle">
  <div class="calc-gateway-cta-band">
    <div class="section-inner">
      <div class="calc-gateway-intro" data-reveal>
        <span class="calc-gateway-eyebrow">{{ __('messages.gateway_eyebrow') }}</span>
        <h2 id="calcGatewayTitle" class="calc-gateway-title">{{ __('messages.gateway_title') }}</h2>
        <p class="calc-gateway-blurb">{{ __('messages.gateway_blurb') }}</p>
      </div>

      <div class="calc-gateway-actions" data-stagger>
        <a href="#calculator" class="calc-gateway-action">
          <span class="calc-gateway-action-label">{{ __('messages.gateway_cta_calc') }}</span>
          <span class="calc-gateway-action-arrow" aria-hidden="true">
            <i data-lucide="arrow-left"></i>
          </span>
        </a>
        <a href="#products" class="calc-gateway-action">
          <span class="calc-gateway-action-label">{{ __('messages.gateway_cta_products') }}</span>
          <span class="calc-gateway-action-arrow" aria-hidden="true">
            <i data-lucide="arrow-left"></i>
          </span>
        </a>
        <a href="#how" class="calc-gateway-action">
          <span class="calc-gateway-action-label">{{ __('messages.gateway_cta_method') }}</span>
          <span class="calc-gateway-action-arrow" aria-hidden="true">
            <i data-lucide="arrow-left"></i>
          </span>
        </a>
      </div>
    </div>
  </div>

  <div
    class="calc-gateway-help-band"
    x-data="{ pick: null }"
    data-reveal
  >
    <div class="section-inner">
      <div class="calc-gateway-help-head">
        <span class="calc-gateway-eyebrow calc-gateway-eyebrow--help">{{ __('messages.gateway_help_eyebrow') }}</span>
        <h3 class="calc-gateway-help-title">
          {{ __('messages.gateway_help_title') }}
          <span class="calc-gateway-help-icon" aria-hidden="true">
            <i data-lucide="scan-search"></i>
          </span>
        </h3>
        <p class="calc-gateway-help-blurb">{{ __('messages.gateway_help_blurb') }}</p>
      </div>

      <div class="calc-gateway-chips" role="group" aria-label="{{ __('messages.gateway_help_title') }}">
        @foreach([
          'layers' => 'gateway_chip_layers',
          'broilers' => 'gateway_chip_broilers',
          'turnkey' => 'gateway_chip_turnkey',
          'consult' => 'gateway_chip_consult',
        ] as $key => $msg)
          <button
            type="button"
            class="calc-gateway-chip"
            :class="pick === '{{ $key }}' && 'is-on'"
            @click="pick = '{{ $key }}'"
          >{{ __("messages.{$msg}") }}</button>
        @endforeach
      </div>

      <div class="calc-gateway-continue-wrap">
        <a
          href="#calculator"
          class="calc-gateway-continue"
          :class="pick && 'is-ready'"
          @click="if (pick) sessionStorage.setItem('miCalcIntent', pick)"
        >
          <span>{{ __('messages.gateway_help_continue') }}</span>
          <i data-lucide="arrow-left" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
</section>
