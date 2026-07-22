@php
  $locale = app()->getLocale();
  $phone = config('mi.phone_primary');
  $wa = config('mi.whatsapp');
  $address = $locale === 'ar'
      ? ($contactSettings?->address_ar ?? __('messages.home_cta_location'))
      : ($contactSettings?->address_en ?? __('messages.home_cta_location'));
@endphp
<section id="contact" class="home-cta" aria-labelledby="homeCtaTitle">
  <div class="section-inner home-cta-inner">
    <div class="home-cta-copy" data-reveal>
      <span class="eyebrow home-cta-eyebrow">{{ __('messages.contact_eyebrow') }}</span>
      <h2 id="homeCtaTitle" class="display-3 home-cta-title">{{ __('messages.home_cta_title') }}</h2>
      <p class="home-cta-blurb">{{ __('messages.home_cta_blurb') }}</p>
    </div>

    <div class="home-cta-actions" data-stagger>
      <a href="tel:{{ $phone }}" class="home-cta-card">
        <span class="home-cta-card-label">{{ __('messages.call_us') }}</span>
        <span class="home-cta-card-value" dir="ltr">{{ $phone }}</span>
      </a>
      <a href="https://wa.me/{{ $wa }}" class="home-cta-card home-cta-card--wa" target="_blank" rel="noopener noreferrer">
        <span class="home-cta-card-label">WhatsApp</span>
        <span class="home-cta-card-value">{{ __('messages.home_cta_whatsapp') }}</span>
      </a>
      <div class="home-cta-card home-cta-card--static">
        <span class="home-cta-card-label">{{ __('messages.home_cta_location_label') }}</span>
        <span class="home-cta-card-value">{{ $address }}</span>
      </div>
    </div>

    <div class="home-cta-links" data-reveal>
      <a href="{{ route('home', $locale) }}#calculator" class="btn btn-primary">{{ __('messages.nav_calculator') }}</a>
      <a href="mailto:{{ config('mi.email', 'info@mi-poultry.com') }}" class="btn home-cta-ghost">{{ __('messages.home_cta_email') }}</a>
    </div>
  </div>
</section>
