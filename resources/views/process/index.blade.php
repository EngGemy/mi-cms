@php
  $stagesCount = $stages->count();
  $useStagesCarousel = $stagesCount > 3;
@endphp
<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <section class="page-hero page-hero--process">
    <div class="section-inner page-hero-center">
      <span class="eyebrow" data-reveal>{{ __('messages.process_eyebrow') }}</span>
      <h1 class="display-2 mt-3 process-page-title" data-reveal="title">{{ __('messages.process_title') }}</h1>
      <p class="lead mt-4" data-reveal>{{ __('messages.process_blurb') }}</p>
    </div>
  </section>

  <section class="process-how py-20">
    <div class="section-inner">
      <h2 class="display-3 mb-10 process-how-title" data-reveal="title">{!! __('messages.how_title') !!}</h2>
      <div class="process-how-grid" data-stagger>
        @foreach($howSteps as $i => $step)
          <div class="step @if($i === 2) step--dark @endif">
            <div class="step-num">{{ $i + 1 }}</div>
            <h3 class="step-title">{{ $step['title'] }}</h3>
            <p class="step-desc">{{ $step['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="process-timeline py-20 lg:py-28" id="processTimeline" @unless($useStagesCarousel) data-process-timeline @endunless>
    <div class="section-inner">
      <div class="page-hero-center mb-12">
        <span class="eyebrow" data-reveal>{{ __('messages.stages_eyebrow') }}</span>
        <h2 class="display-3 mt-2 process-page-title" data-reveal="title">{{ __('messages.stages_title') }}</h2>
      </div>

      @if($stages->isEmpty())
        <p class="lead page-hero-center" style="color:var(--ink-500)">{{ __('messages.process_empty') }}</p>
      @elseif($useStagesCarousel)
        <div
          class="process-stages-carousel mi-carousel"
          data-mi-carousel
          data-mi-force
          data-mi-when-over="3"
          data-mi-per="1.15"
        >
          @foreach($stages as $stage)
            <article class="process-stage mi-carousel-item" data-process-stage>
              <div class="process-stage-media">
                <span class="process-stage-num">{{ $stage->stage_number }}</span>
                <img src="{{ $stage->getImageUrl() ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=900&q=85&auto=format&fit=crop' }}"
                     alt="{{ $stage->title }}" loading="lazy" decoding="async"/>
              </div>
              <div class="process-stage-body">
                <div class="process-stage-eyebrow">{{ $stage->eyebrow }}</div>
                <h3 class="process-stage-title">{{ $stage->title }}</h3>
                <p class="process-stage-desc">{{ $stage->description }}</p>
              </div>
            </article>
          @endforeach
        </div>
      @else
        <div class="process-track">
          @foreach($stages as $stage)
            <article class="process-stage" data-process-stage>
              <div class="process-stage-media">
                <span class="process-stage-num">{{ $stage->stage_number }}</span>
                <img src="{{ $stage->getImageUrl() ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=900&q=85&auto=format&fit=crop' }}"
                     alt="{{ $stage->title }}" loading="lazy" decoding="async"/>
              </div>
              <div class="process-stage-body">
                <div class="process-stage-eyebrow">{{ $stage->eyebrow }}</div>
                <h3 class="process-stage-title">{{ $stage->title }}</h3>
                <p class="process-stage-desc">{{ $stage->description }}</p>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <section class="page-bottom-cta" data-reveal>
    <div class="section-inner page-bottom-cta-inner">
      <h2 class="display-3">{{ __('messages.process_cta_title') }}</h2>
      <p class="lead">{{ __('messages.process_cta_blurb') }}</p>
      <div class="page-bottom-cta-actions">
        <a href="{{ route('home', app()->getLocale()) }}#start" class="btn btn-primary">{{ __('messages.nav_calculator') }}</a>
        <a href="{{ route('home', app()->getLocale()) }}#contact" class="btn btn-dark">{{ __('messages.nav_contact') }}</a>
      </div>
    </div>
  </section>
</x-layouts.public>
