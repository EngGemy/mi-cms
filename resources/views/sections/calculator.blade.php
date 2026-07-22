<section id="calculator" class="calc-section">
  <div class="section-inner">
    <div class="calc-section-head" data-reveal>
      <span class="eyebrow">{{ __('messages.calc_eyebrow') }}</span>
      <h2 class="display-2 mt-2">{{ __('messages.calc_title') }}</h2>
      <p class="lead mt-5">{{ __('messages.calc_blurb') }}</p>
    </div>
    @include('partials.price-calculator')
  </div>
</section>
