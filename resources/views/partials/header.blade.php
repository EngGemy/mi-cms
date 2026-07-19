@php
  $locale = app()->getLocale();
@endphp
<header>
  <div class="header-inner">
    <a href="{{ route('home', $locale) }}" class="header-brand">
      @php
        $logoPath = $generalSettings?->logo_path ?? null;
        $logoSrc = $logoPath
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($logoPath)
            : asset('images/logo.jpg');
      @endphp
      <div class="header-brand-logo"><img src="{{ $logoSrc }}" alt="{{ $generalSettings?->site_name ?? 'MI' }}"/></div>
      <span class="header-brand-text">{{ $locale === 'ar' ? 'إم آي' : ($generalSettings?->site_name ?? 'MI') }}</span>
    </a>

    <nav class="header-nav">
      <a href="#products">{{ __('messages.nav_products') }}</a>
      <a href="#features">{{ __('messages.nav_features') }}</a>
      <a href="#how">{{ __('messages.nav_how') }}</a>
      <a href="#calculator">{{ __('messages.nav_calculator') }}</a>
      <a href="{{ route('blog.index', $locale) }}">{{ __('messages.nav_blog') }}</a>
      <a href="{{ route('about', $locale) }}">{{ __('messages.nav_about') }}</a>
    </nav>

    <div class="header-actions">
      <a href="{{ route('locale.switch', $locale === 'ar' ? 'en' : 'ar') }}"
         class="lang-btn header-desktop-only">
        <i data-lucide="globe" class="w-4 h-4"></i>
        {{ $locale === 'ar' ? 'EN' : 'ع' }}
      </a>
      <a href="#contact" class="btn btn-dark btn-sm header-desktop-only">
        {{ __('messages.cta_consultation') }}
      </a>
      <button type="button" class="header-mobile-btn" id="mobBtn"
              aria-label="{{ __('messages.nav_menu') }}"
              aria-controls="mobDrawer"
              aria-expanded="false">
        <span class="header-mobile-icon header-mobile-icon--menu" aria-hidden="true">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </span>
        <span class="header-mobile-icon header-mobile-icon--close" aria-hidden="true">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </span>
      </button>
    </div>
  </div>
</header>
