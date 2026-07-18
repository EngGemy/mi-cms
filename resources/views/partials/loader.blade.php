@php
  $logoPath = $generalSettings?->logo_path ?? null;
  $logoSrc = $logoPath
      ? \Illuminate\Support\Facades\Storage::disk('public')->url($logoPath)
      : asset('images/logo.jpg');
  $siteName = $generalSettings?->site_name ?? 'MI Automatic Poultry Cages';
@endphp
<div class="loader" id="loader" aria-hidden="true">
  <div class="loader-inner">
    <div class="loader-logo-wrap">
      <div class="loader-logo">
        <img src="{{ $logoSrc }}" alt="{{ $siteName }}" onerror="this.src='/images/logo.jpg';this.onerror=null;"/>
      </div>
      <div class="loader-logo-ring"></div>
      <div class="loader-logo-ring" style="animation-delay:.6s"></div>
    </div>

    <div class="loader-brand" dir="rtl">
      <span class="loader-brand-word">إم آي</span>
      <span class="loader-brand-dot">·</span>
      <span class="loader-brand-word serif-italic">automatic poultry cages</span>
    </div>

    <div class="loader-bar-wrap">
      <div class="loader-bar-track">
        <div class="loader-bar-fill" id="loaderBarFill"></div>
        <div class="loader-bar-shimmer"></div>
      </div>
    </div>

    <div class="loader-meta">
      <span class="loader-meta-label">جاري التحميل</span>
      <span class="loader-pct" id="loaderPct">0%</span>
    </div>
  </div>
</div>
