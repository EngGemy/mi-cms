@php
  $locale = app()->getLocale();
  $routeIs = fn (string $name) => request()->routeIs($name);
@endphp
<header>
  <div class="header-inner">
    <a href="{{ route('home', $locale) }}" class="header-brand" data-header-brand>
      @php
        $logoPath = $generalSettings?->logo_path ?? null;
        $logoSrc = $logoPath
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($logoPath)
            : asset('images/logo.jpg');
      @endphp
      <div class="header-brand-logo">
        <span class="header-brand-glow" aria-hidden="true"></span>
        <img src="{{ $logoSrc }}" alt="{{ $generalSettings?->site_name ?? 'MI' }}"/>
        <span class="header-brand-sheen" aria-hidden="true"></span>
      </div>
      <span class="header-brand-text">{{ $locale === 'ar' ? 'إم آي' : ($generalSettings?->site_name ?? 'MI') }}</span>
    </a>

    <nav class="header-nav">
      <a href="{{ route('products.index', $locale) }}" class="{{ $routeIs('products.*') ? 'active' : '' }}">{{ __('messages.nav_products') }}</a>
      <a href="{{ route('home', $locale) }}#features">{{ __('messages.nav_features') }}</a>
      <a href="{{ route('projects.index', $locale) }}" class="{{ $routeIs('projects.*') ? 'active' : '' }}">{{ __('messages.nav_projects') }}</a>
      <a href="{{ route('home', $locale) }}#calculator">{{ __('messages.nav_calculator') }}</a>
      <a href="{{ route('process.index', $locale) }}" class="{{ $routeIs('process.*') ? 'active' : '' }}">{{ __('messages.nav_how') }}</a>
      <a href="{{ route('about', $locale) }}" class="{{ $routeIs('about') ? 'active' : '' }}">{{ __('messages.nav_about') }}</a>
      <a href="{{ route('blog.index', $locale) }}" class="{{ $routeIs('blog.*') ? 'active' : '' }}">{{ __('messages.nav_blog') }}</a>
      <a href="{{ route('home', $locale) }}#contact">{{ __('messages.nav_contact') }}</a>
    </nav>

    <div class="header-actions">
      <a href="{{ route('locale.switch', $locale === 'ar' ? 'en' : 'ar') }}"
         class="lang-btn header-desktop-only">
        <i data-lucide="globe" class="w-4 h-4"></i>
        {{ $locale === 'ar' ? 'EN' : 'ع' }}
      </a>
      <a href="{{ route('home', $locale) }}#contact" class="btn btn-dark btn-sm header-desktop-only">
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
