<section class="py-24 lg:py-32">
  <div class="section-inner mb-10">
    <div class="text-center max-w-2xl mx-auto">
      <span class="eyebrow">{{ __('messages.testimonials_eyebrow') }}</span>
      <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.testimonials_title') }}</h2>
    </div>
  </div>
  <div class="marquee" data-reveal="scale">
    <div class="marquee-track">
      @foreach($testimonials as $t)
        <div class="testimonial-card">
          <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
          <p class="testimonial-quote">"{{ $t->quote }}"</p>
          <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
        </div>
      @endforeach
      {{-- duplicate for seamless marquee --}}
      @foreach($testimonials as $t)
        <div class="testimonial-card">
          <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
          <p class="testimonial-quote">"{{ $t->quote }}"</p>
          <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
