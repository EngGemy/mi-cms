<section class="py-24 lg:py-32 bg-paper" id="stagesSection">
  <div class="section-inner">
    <div class="stages-controls">
      <div class="flex-1" data-reveal="left">
        <span class="eyebrow">{{ __('messages.stages_eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.stages_title') }}</h2>
        <p class="lead mt-4 max-w-xl">{{ __('messages.stages_blurb') }}</p>
      </div>
      <div class="stages-nav flex-shrink-0 hidden md:flex" data-reveal="right">
        <button class="stages-btn" id="stagesPrev" aria-label="السابق">
          <i data-lucide="arrow-right" class="w-5 h-5"></i></button>
        <button class="stages-btn" id="stagesNext" aria-label="التالي">
          <i data-lucide="arrow-left" class="w-5 h-5"></i></button>
      </div>
    </div>

    <div class="stages-wrap">
      <div class="stages-track" id="stagesTrack">
        @foreach($stages as $stage)
          <div class="stage-card">
            <div class="stage-image">
              <span class="stage-num">{{ $stage->stage_number }}</span>
              <img src="{{ $stage->getImageUrl() ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=900&q=85&auto=format&fit=crop' }}"
                   alt="{{ $stage->title }}" loading="lazy"/>
              @if($stage->getVideoUrl())
                <button class="stage-play" aria-label="تشغيل الفيديو">
                  <i data-lucide="play" class="w-5 h-5 ml-0.5"></i></button>
              @endif
            </div>
            <div class="stage-body">
              <div class="stage-eyebrow">{{ $stage->eyebrow }}</div>
              <h3 class="stage-title">{{ $stage->title }}</h3>
              <p class="stage-desc">{{ $stage->description }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Progress indicator (dots populated by JS) --}}
    <div class="stages-progress" id="stagesProgress" aria-hidden="true"></div>
  </div>
</section>
