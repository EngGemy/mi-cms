@php
  $waNumber = preg_replace('/\D+/', '', (string) ($contactSettings?->whatsapp ?? config('mi.whatsapp', '201030003186')));
  $waMsg = rawurlencode(__('messages.whatsapp_float_msg'));
  $waUrl = 'https://wa.me/' . $waNumber . ($waMsg ? '?text=' . $waMsg : '');
@endphp
<nav class="mi-rail" aria-label="{{ __('messages.rail_aria') }}">
  <a href="#start" class="mi-rail-btn" title="{{ __('messages.rail_calc') }}">
    <span class="mi-rail-icon" aria-hidden="true"><i data-lucide="calculator"></i></span>
    <span class="mi-rail-label">{{ __('messages.rail_calc') }}</span>
  </a>
  <a href="#contact" class="mi-rail-btn" title="{{ __('messages.rail_contact') }}">
    <span class="mi-rail-icon" aria-hidden="true"><i data-lucide="message-circle"></i></span>
    <span class="mi-rail-label">{{ __('messages.rail_contact') }}</span>
  </a>
  <button
    type="button"
    class="mi-rail-btn"
    title="{{ __('messages.rail_share') }}"
    data-mi-share
    data-share-url="{{ url()->current() }}"
    data-share-title="{{ config('app.name', 'MI') }}"
    data-share-fallback="{{ $waUrl }}"
  >
    <span class="mi-rail-icon" aria-hidden="true"><i data-lucide="share-2"></i></span>
    <span class="mi-rail-label">{{ __('messages.rail_share') }}</span>
  </button>
</nav>
