@php
  $locale = app()->getLocale();
  $about = $aboutSettings ?? null;
  try {
      $about = $about ?? app(\App\Settings\AboutSettings::class);
  } catch (\Throwable) {
      $about = null;
  }
  $storyImg = $about
      ? $about->teaserImageUrl($about->teaser['fallback_image'] ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=85&auto=format&fit=crop')
      : 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=85&auto=format&fit=crop';
@endphp
{{-- Editorial story — one purpose, one image, clear CTA --}}
<section id="about" class="home-story" aria-labelledby="homeStoryTitle">
  <div class="section-inner home-story-grid">
    <figure class="home-story-media" data-reveal="left">
      <img
        src="{{ $storyImg }}"
        alt="{{ __('messages.about_img_alt') }}"
        loading="lazy"
        decoding="async"
        width="960"
        height="1200"
      >
      <figcaption class="home-story-badge">
        <span class="home-story-badge-num">{{ $about?->teaser['badge_years'] ?? '15+' }}</span>
        <span class="home-story-badge-txt">{{ __('messages.about_badge') }}</span>
      </figcaption>
    </figure>

    <div class="home-story-copy" data-reveal="right">
      <span class="eyebrow">{{ __('messages.home_story_eyebrow') }}</span>
      <h2 id="homeStoryTitle" class="display-2 home-story-title">{{ __('messages.home_story_title') }}</h2>
      <p class="lead home-story-lead">{{ __('messages.home_story_blurb') }}</p>

      <ul class="home-story-points">
        <li>
          <strong>{{ __('messages.home_story_p1_title') }}</strong>
          <span>{{ __('messages.home_story_p1_desc') }}</span>
        </li>
        <li>
          <strong>{{ __('messages.home_story_p2_title') }}</strong>
          <span>{{ __('messages.home_story_p2_desc') }}</span>
        </li>
        <li>
          <strong>{{ __('messages.home_story_p3_title') }}</strong>
          <span>{{ __('messages.home_story_p3_desc') }}</span>
        </li>
      </ul>

      <div class="home-story-actions">
        <a href="{{ route('about', $locale) }}" class="btn btn-dark" data-magnetic>
          {{ __('messages.about_cta') }}
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <a href="#products" class="home-story-link">{{ __('messages.home_story_systems') }}</a>
      </div>
    </div>
  </div>
</section>
