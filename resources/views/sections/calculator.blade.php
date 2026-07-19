<section id="calculator" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="eyebrow">{{ __('messages.calc_eyebrow') }}</span>
      <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.calc_title') }}</h2>
      <p class="lead mt-5" data-reveal data-reveal-delay="0.1">{{ __('messages.calc_blurb') }}</p>
    </div>
    <div>
      @livewire('price-calculator')
    </div>
  </div>
</section>
