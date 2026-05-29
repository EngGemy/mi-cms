@php($locale = app()->getLocale())
<header>
  <div class="header-inner">
    <a href="{{ route('home', $locale) }}" class="header-brand">
      @php($logoSrc = !empty($generalSettings?->logo_path) ? asset('storage/' . $generalSettings->logo_path) : asset('images/logo.jpg'))
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

    <div class="flex items-center gap-3">
      <a href="{{ route('locale.switch', $locale === 'ar' ? 'en' : 'ar') }}"
         class="lang-btn hidden md:inline-flex">
        <i data-lucide="globe" class="w-4 h-4"></i>
        {{ $locale === 'ar' ? 'EN' : 'ع' }}
      </a>
      <a href="#contact" class="btn btn-dark btn-sm hidden md:inline-flex">
        {{ __('messages.cta_consultation') }}
      </a>
      <button class="header-mobile-btn" id="mobBtn" aria-label="القائمة">
        <i data-lucide="menu" class="w-5 h-5" id="mobIcon"></i>
      </button>
    </div>
  </div>
</header>
