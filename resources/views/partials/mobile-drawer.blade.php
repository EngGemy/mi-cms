@php($locale = app()->getLocale())
<div class="mobile-drawer" id="mobDrawer">
  <div class="mobile-drawer-inner">
    <a href="#products" data-mob-link><span class="num">01</span>{{ __('messages.nav_products') }}</a>
    <a href="#features" data-mob-link><span class="num">02</span>{{ __('messages.nav_features') }}</a>
    <a href="#how" data-mob-link><span class="num">03</span>{{ __('messages.nav_how') }}</a>
    <a href="#calculator" data-mob-link><span class="num">04</span>{{ __('messages.nav_calculator') }}</a>
    <a href="{{ route('blog.index', $locale) }}" data-mob-link><span class="num">05</span>{{ __('messages.nav_blog') }}</a>
    <a href="#about" data-mob-link><span class="num">06</span>{{ __('messages.nav_about') }}</a>
    <a href="#contact" data-mob-link><span class="num">07</span>{{ __('messages.nav_contact') }}</a>

    <div class="mt-auto pt-8 border-t border-white/10 flex gap-3">
      <a href="tel:{{ config('mi.phone_primary') }}" class="btn btn-primary flex-1">
        <i data-lucide="phone" class="w-4 h-4"></i> {{ __('messages.call_us') }}
      </a>
      <a href="https://wa.me/{{ config('mi.whatsapp') }}" class="btn btn-ghost flex-1"
         style="color:#fff;border-color:rgba(255,255,255,.2)">
        <i data-lucide="message-circle" class="w-4 h-4"></i> WhatsApp
      </a>
    </div>
  </div>
</div>
