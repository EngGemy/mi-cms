<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <section class="page-hero">
    <div class="section-inner">
      <span class="eyebrow" data-reveal>{{ __('messages.testimonials_eyebrow') }}</span>
      <h1 class="display-2 mt-3" data-reveal="title">{{ __('messages.testimonials_page_title') }}</h1>
      <p class="lead mt-4" data-reveal>{{ __('messages.testimonials_page_blurb') }}</p>
    </div>
  </section>

  {{-- Desktop marquee of current page items --}}
  <div class="marquee testimonials-desktop testimonials-page-marquee" data-reveal="scale" aria-label="{{ __('messages.testimonials_page_title') }}">
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
        <div class="testimonial-card" aria-hidden="true">
          <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
          <p class="testimonial-quote">"{{ $t->quote }}"</p>
          <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
        </div>
      @endforeach
    </div>
  </div>

  <section class="py-16 lg:py-24" id="listing-grid" data-listing-grid>
    <div class="section-inner">
      <div class="testimonials-grid listing-grid-anim testimonials-mobile" data-stagger>
        @forelse($testimonials as $t)
          <article class="testimonial-card">
            <div class="testimonial-avatar" @if($t->avatar_color) style="background:{{ $t->avatar_color }}" @endif>{{ $t->initials }}</div>
            <p class="testimonial-quote">"{{ $t->quote }}"</p>
            <div style="font-weight:700;font-size:15px">{{ $t->author_name }}</div>
            <div class="label-mono" style="color:var(--ink-500);margin-top:2px">{{ $t->author_role }}</div>
          </article>
        @empty
          <p class="lead" style="color:var(--ink-500)">{{ __('messages.testimonials_empty') }}</p>
        @endforelse
      </div>
      <div class="listing-pagination">
        {{ $testimonials->links() }}
      </div>
    </div>
  </section>

  <section class="page-bottom-cta" data-reveal>
    <div class="section-inner page-bottom-cta-inner">
      <h2 class="display-3">{{ __('messages.testimonials_cta_title') }}</h2>
      <a href="{{ route('home', app()->getLocale()) }}#contact" class="btn btn-primary">{{ __('messages.nav_contact') }}</a>
    </div>
  </section>
</x-layouts.public>
