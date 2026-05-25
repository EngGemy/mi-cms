<section id="features" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="eyebrow">{{ __('messages.features_eyebrow') }}</span>
      <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.features_title') }}</h2>
      <p class="lead mt-5" data-reveal data-reveal-delay="0.1">{{ __('messages.features_blurb') }}</p>
    </div>
    <div class="grid lg:grid-cols-3 gap-5" data-stagger>
      @foreach($features as $feature)
        <div class="feature-card">
          <div class="feature-image" data-parallax="0.06">
            <img src="{{ $feature->getFirstMediaUrl('image', 'card') ?: 'https://images.unsplash.com/photo-1531155179084-3e1f15110922?w=1200&q=85&auto=format&fit=crop' }}"
                 alt="{{ $feature->title }}" loading="lazy"/>
          </div>
          <div class="feature-body">
            <h3 class="feature-title">{{ $feature->title }}</h3>
            <p class="feature-desc">{{ $feature->description }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
