<section class="py-24 lg:py-32">
  <div class="section-inner max-w-3xl">
    <div class="text-center mb-12">
      <span class="eyebrow">{{ __('messages.faq_eyebrow') }}</span>
      <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.faq_title') }}</h2>
    </div>
    <div data-reveal>
      @foreach($faqs as $faq)
        <div class="faq-item">
          <button class="faq-q" aria-expanded="false">
            <span>{{ $faq->question }}</span>
            <span class="faq-icon"><i data-lucide="plus" class="w-5 h-5"></i></span>
          </button>
          <div class="faq-a"><div class="faq-a-inner">{{ $faq->answer }}</div></div>
        </div>
      @endforeach
    </div>
  </div>
</section>
