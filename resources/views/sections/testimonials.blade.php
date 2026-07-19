<section class="py-24 lg:py-32" id="testimonials">
  <div class="section-inner mb-10">
    <div class="text-center max-w-2xl mx-auto">
      <span class="eyebrow">{{ __('messages.testimonials_eyebrow') }}</span>
      <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.testimonials_title') }}</h2>
    </div>
  </div>

  {{-- Desktop: marquee --}}
  <div class="marquee testimonials-desktop" data-reveal="scale">
    <div class="marquee-track">
      @foreach($testimonials as $t)
        <div class="testimonial-card">
          <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
          <p class="testimonial-quote">"{{ $t->quote }}"</p>
          <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
        </div>
      @endforeach
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

  {{-- Mobile: Swiper --}}
  <div class="section-inner testimonials-mobile">
    <div class="mi-carousel testimonials-carousel" data-mi-carousel data-mi-per="1.08" data-mi-force-mobile>
      @foreach($testimonials as $t)
        <div class="testimonial-card mi-carousel-item">
          <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
          <p class="testimonial-quote">"{{ $t->quote }}"</p>
          <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
