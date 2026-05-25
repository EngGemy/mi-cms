<section id="how" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow">{{ __('messages.how_eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{!! __('messages.how_title') !!}</h2>
      </div>
      <p class="lead" data-reveal="right">{{ __('messages.how_blurb') }}</p>
    </div>
    <div class="grid lg:grid-cols-3 gap-5" data-stagger>
      @foreach(__('messages.how_steps') as $i => $step)
        <div class="step @if($i === 2) bg-ink-900 @endif"
             @if($i === 2) style="background:var(--ink-900);color:#fff;border-color:var(--ink-900)" @endif>
          <div class="step-num" @if($i === 2) style="color:var(--mi-red-light)" @endif>{{ ['١','٢','٣'][$i] }}</div>
          <h3 class="step-title" @if($i === 2) style="color:#fff" @endif>{{ $step['title'] }}</h3>
          <p class="step-desc" @if($i === 2) style="color:rgba(255,255,255,.72)" @endif>{{ $step['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
