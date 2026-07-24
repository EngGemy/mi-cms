@php
  $locale = app()->getLocale();
  $routeIs = fn (string $name) => request()->routeIs($name);
  $systemsOpen = $routeIs('products.*') || $routeIs('services.*') || request()->url() === route('home', $locale).'#features';
  $servicesOpen = $routeIs('process.*') || $routeIs('faq.*') || $routeIs('testimonials.*');
@endphp
<header class="site-header">
  <div class="header-inner">
    <a href="{{ route('home', $locale) }}" class="header-brand" data-header-brand>
      @php
        $logoPath = $generalSettings?->logo_path ?? null;
        $logoSrc = $logoPath
            ? '/storage/'.ltrim($logoPath, '/')
            : asset('images/logo.jpg');
      @endphp
      <div class="header-brand-logo">
        <span class="header-brand-glow" aria-hidden="true"></span>
        <img src="{{ $logoSrc }}" alt="{{ $generalSettings?->site_name ?? 'MI' }}"/>
        <span class="header-brand-sheen" aria-hidden="true"></span>
      </div>
      <span class="header-brand-text">{{ $locale === 'ar' ? 'إم آي' : ($generalSettings?->site_name ?? 'MI') }}</span>
    </a>

    <nav class="header-nav" aria-label="{{ __('messages.nav_menu') }}">
      <a href="{{ route('home', $locale) }}" class="{{ $routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a>
      <a href="{{ route('about', $locale) }}" class="{{ $routeIs('about') ? 'active' : '' }}">{{ __('messages.nav_about') }}</a>

      <div class="nav-drop" data-nav-drop>
        <button type="button" class="nav-drop-trigger {{ ($routeIs('products.*') || $routeIs('services.*')) ? 'active' : '' }}"
                aria-expanded="false" aria-haspopup="true" data-nav-drop-btn>
          {{ __('messages.nav_systems') }}
          <svg class="nav-drop-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="nav-drop-panel" data-nav-drop-panel hidden>
          <a href="{{ route('products.index', $locale) }}">{{ __('messages.nav_all_systems') }}</a>
          <a href="{{ route('services.show', [$locale, 'broiler']) }}">{{ __('messages.nav_svc_broiler') }}</a>
          <a href="{{ route('services.show', [$locale, 'layer']) }}">{{ __('messages.nav_svc_layer') }}</a>
          <a href="{{ route('services.show', [$locale, 'construction']) }}">{{ __('messages.nav_svc_build') }}</a>
          <a href="{{ route('home', $locale) }}#features">{{ __('messages.nav_features') }}</a>
          <a href="{{ route('home', $locale) }}#start">{{ __('messages.nav_calculator') }}</a>
        </div>
      </div>

      <a href="{{ route('projects.index', $locale) }}" class="{{ $routeIs('projects.*') ? 'active' : '' }}">{{ __('messages.nav_projects') }}</a>

      <div class="nav-drop" data-nav-drop>
        <button type="button" class="nav-drop-trigger {{ $servicesOpen ? 'active' : '' }}"
                aria-expanded="false" aria-haspopup="true" data-nav-drop-btn>
          {{ __('messages.nav_services') }}
          <svg class="nav-drop-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="nav-drop-panel" data-nav-drop-panel hidden>
          <a href="{{ route('process.index', $locale) }}">{{ __('messages.nav_how') }}</a>
          <a href="{{ route('home', $locale) }}#start">{{ __('messages.nav_calculator') }}</a>
          <a href="{{ route('faq.index', $locale) }}">{{ __('messages.nav_faq') }}</a>
          <a href="{{ route('testimonials.index', $locale) }}">{{ __('messages.nav_testimonials') }}</a>
        </div>
      </div>

      <a href="{{ route('blog.index', $locale) }}" class="{{ $routeIs('blog.*') ? 'active' : '' }}">{{ __('messages.nav_blog') }}</a>
      <a href="{{ route('home', $locale) }}#contact">{{ __('messages.nav_contact') }}</a>
    </nav>

    <div class="header-actions">
      <a href="{{ route('locale.switch', $locale === 'ar' ? 'en' : 'ar') }}"
         class="lang-btn header-desktop-only">
        <i data-lucide="globe" class="w-4 h-4"></i>
        {{ $locale === 'ar' ? 'EN' : 'ع' }}
      </a>
      <a href="{{ route('home', $locale) }}#contact" class="btn btn-dark btn-sm header-desktop-only header-quote-btn">
        {{ __('messages.request_quote') }}
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
