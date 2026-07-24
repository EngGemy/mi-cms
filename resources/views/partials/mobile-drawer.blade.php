@php
  $locale = app()->getLocale();
  $routeIs = fn (string $name) => request()->routeIs($name);
@endphp
<div class="mobile-drawer" id="mobDrawer" role="dialog" aria-modal="true" aria-hidden="true" aria-label="{{ __('messages.nav_menu') }}">
  <div class="mobile-drawer-panel">
    <div class="mobile-drawer-top">
      <span class="mobile-drawer-title">{{ __('messages.nav_menu') }}</span>
      <button type="button" class="mobile-drawer-close" id="mobClose" aria-label="{{ __('messages.close_menu') }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>{{ __('messages.close_menu') }}</span>
      </button>
    </div>

    <nav class="mobile-drawer-nav">
      <a href="{{ route('home', $locale) }}" data-mob-link class="{{ $routeIs('home') ? 'active' : '' }}"><span class="num">01</span><span class="label">{{ __('messages.nav_home') }}</span></a>
      <a href="{{ route('about', $locale) }}" data-mob-link class="{{ $routeIs('about') ? 'active' : '' }}"><span class="num">02</span><span class="label">{{ __('messages.nav_about') }}</span></a>

      <div class="mobile-drawer-group" data-mob-group>
        <button type="button" class="mobile-drawer-group-btn" data-mob-group-btn aria-expanded="false">
          <span class="num">03</span>
          <span class="label">{{ __('messages.nav_systems') }}</span>
          <svg class="mobile-drawer-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
        <div class="mobile-drawer-sub" data-mob-group-panel hidden>
          <a href="{{ route('products.index', $locale) }}" data-mob-link class="{{ $routeIs('products.*') ? 'active' : '' }}">{{ __('messages.nav_all_systems') }}</a>
          <a href="{{ route('home', $locale) }}#features" data-mob-link>{{ __('messages.nav_features') }}</a>
          <a href="{{ route('home', $locale) }}#start" data-mob-link>{{ __('messages.nav_calculator') }}</a>
        </div>
      </div>

      <a href="{{ route('projects.index', $locale) }}" data-mob-link class="{{ $routeIs('projects.*') ? 'active' : '' }}"><span class="num">04</span><span class="label">{{ __('messages.nav_projects') }}</span></a>

      <div class="mobile-drawer-group" data-mob-group>
        <button type="button" class="mobile-drawer-group-btn" data-mob-group-btn aria-expanded="false">
          <span class="num">05</span>
          <span class="label">{{ __('messages.nav_services') }}</span>
          <svg class="mobile-drawer-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
        <div class="mobile-drawer-sub" data-mob-group-panel hidden>
          <a href="{{ route('process.index', $locale) }}" data-mob-link class="{{ $routeIs('process.*') ? 'active' : '' }}">{{ __('messages.nav_how') }}</a>
          <a href="{{ route('home', $locale) }}#start" data-mob-link>{{ __('messages.nav_calculator') }}</a>
          <a href="{{ route('faq.index', $locale) }}" data-mob-link class="{{ $routeIs('faq.*') ? 'active' : '' }}">{{ __('messages.nav_faq') }}</a>
          <a href="{{ route('testimonials.index', $locale) }}" data-mob-link class="{{ $routeIs('testimonials.*') ? 'active' : '' }}">{{ __('messages.nav_testimonials') }}</a>
        </div>
      </div>

      <a href="{{ route('blog.index', $locale) }}" data-mob-link class="{{ $routeIs('blog.*') ? 'active' : '' }}"><span class="num">06</span><span class="label">{{ __('messages.nav_blog') }}</span></a>
      <a href="{{ route('home', $locale) }}#contact" data-mob-link><span class="num">07</span><span class="label">{{ __('messages.nav_contact') }}</span></a>
    </nav>

    <div class="mobile-drawer-footer">
      <a href="{{ route('home', $locale) }}#contact" class="btn btn-primary w-full" data-mob-link style="justify-content:center">
        {{ __('messages.request_quote') }}
      </a>
      <a href="{{ route('locale.switch', $locale === 'ar' ? 'en' : 'ar') }}" class="mobile-drawer-lang" data-mob-link>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.7"/><path d="M3 12h18M12 3c2.5 2.7 3.8 5.7 3.8 9S14.5 18.3 12 21c-2.5-2.7-3.8-5.7-3.8-9S9.5 5.7 12 3z" stroke="currentColor" stroke-width="1.7"/></svg>
        {{ $locale === 'ar' ? 'English' : 'العربية' }}
      </a>
      <div class="mobile-drawer-actions">
        <a href="tel:{{ config('mi.phone_primary') }}" class="btn btn-ghost flex-1">
          <i data-lucide="phone" class="w-4 h-4"></i> {{ __('messages.call_us') }}
        </a>
        <a href="https://wa.me/{{ config('mi.whatsapp') }}" class="btn btn-ghost flex-1 mobile-drawer-wa"
           target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          WhatsApp
        </a>
      </div>
    </div>
  </div>
</div>
