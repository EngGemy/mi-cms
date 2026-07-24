@php
  $locale = app()->getLocale();
@endphp
<footer class="py-16" style="background:var(--cream)">
  <div class="footer-watermark" aria-hidden="true">MI</div>
  <div class="footer-line"></div>

  <div class="section-inner relative z-10">
    <div class="grid lg:grid-cols-12 gap-8 mb-12">
      <div class="lg:col-span-5 footer-col">
        <a href="{{ route('home', $locale) }}" class="header-brand mb-5 inline-flex footer-brand">
          @php
            $logoSrc = !empty($generalSettings?->logo_path)
                ? \Illuminate\Support\Facades\Storage::disk('public')->url($generalSettings->logo_path)
                : asset('images/logo.jpg');
          @endphp
          <div class="header-brand-logo"><img src="{{ $logoSrc }}" alt="{{ $generalSettings?->site_name ?? 'MI' }}"/></div>
          <div>
            <div style="font-weight:800;font-size:18px">{{ $locale === 'ar' ? 'إم آي' : ($generalSettings?->site_name ?? 'MI') }}</div>
            <div class="label-mono" style="color:var(--ink-500);font-size:10px">{{ $generalSettings?->site_name ?? 'MI' }} · Automatic Poultry Cages</div>
          </div>
        </a>
        <p style="font-size:15px;line-height:1.85;color:var(--ink-600);margin-top:18px;max-width:420px">
          {{ __('messages.footer_blurb') }}
        </p>

        <!-- Newsletter -->
        <form action="{{ route('newsletter.store', $locale) }}" method="POST" class="mt-7 flex gap-2 max-w-md">
          @csrf
          <input type="email" name="email" required placeholder="{{ __('messages.newsletter_placeholder') }}"
                 class="flex-1 px-4 py-3 rounded-full border bg-white" style="border-color:rgba(26,22,17,.1)"/>
          <button class="btn btn-primary">{{ __('messages.subscribe') }}</button>
        </form>
        @if(session('newsletter_ok'))
          <p class="text-sm mt-3" style="color:var(--mi-red)">{{ session('newsletter_ok') }}</p>
        @endif
      </div>

      <div class="lg:col-span-2 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)">{{ __('messages.site_map') }}</div>
        <ul class="space-y-3" style="font-size:14px">
          <li><a href="{{ route('home', $locale) }}" class="footer-link">{{ __('messages.nav_home') }}</a></li>
          <li><a href="{{ route('about', $locale) }}" class="footer-link">{{ __('messages.nav_about') }}</a></li>
          <li><a href="{{ route('products.index', $locale) }}" class="footer-link">{{ __('messages.nav_systems') }}</a></li>
          <li><a href="{{ route('projects.index', $locale) }}" class="footer-link">{{ __('messages.nav_projects') }}</a></li>
          <li><a href="{{ route('process.index', $locale) }}" class="footer-link">{{ __('messages.nav_services') }}</a></li>
          <li><a href="{{ route('blog.index', $locale) }}" class="footer-link">{{ __('messages.nav_blog') }}</a></li>
          <li><a href="{{ route('home', $locale) }}#contact" class="footer-link">{{ __('messages.nav_contact') }}</a></li>
          <li><a href="{{ route('home', $locale) }}#start" class="footer-link">{{ __('messages.nav_calculator') }}</a></li>
        </ul>
      </div>

      <div class="lg:col-span-2 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)">{{ __('messages.products') }}</div>
        <ul class="space-y-3" style="font-size:14px">
          <li><a href="{{ route('products.index', $locale) }}" class="footer-link">{{ __('messages.all_products') }}</a></li>
        </ul>
      </div>

      <div class="lg:col-span-3 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)">{{ __('messages.contact_us') }}</div>
        <ul class="space-y-3" style="font-size:14px;color:var(--ink-700)">
          @php
            $phone   = $contactSettings?->phone_primary ?? config('mi.phone_primary');
            $address = $locale === 'ar' ? ($contactSettings?->address_ar ?? config('mi.address.ar')) : ($contactSettings?->address_en ?? config('mi.address.en'));
            $email   = $contactSettings?->email ?? config('mi.email');
          @endphp
          <li><a href="tel:{{ $phone }}" class="flex items-center gap-3 footer-link">
            <i data-lucide="phone" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span dir="ltr" class="font-mono" style="font-weight:600">{{ $phone }}</span>
          </a></li>
          <li class="flex items-center gap-3">
            <i data-lucide="map-pin" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span>{{ $address }}</span>
          </li>
          <li class="flex items-center gap-3">
            <i data-lucide="mail" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span>{{ $email }}</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="footer-copy pt-8 flex flex-col md:flex-row justify-between gap-3 text-sm"
         style="color:var(--ink-500);border-top:1px solid rgba(26,22,17,.08)">
      <div>© {{ date('Y') }} MI Automatic Poultry Cages. {{ __('messages.rights') }}</div>
    </div>
  </div>
</footer>
