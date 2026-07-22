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

  @livewire('gateway-help')
</section>
