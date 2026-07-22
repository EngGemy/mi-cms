@php
  $logoPath = $generalSettings?->logo_path ?? null;
  $logoSrc = $logoPath
      ? \Illuminate\Support\Facades\Storage::disk('public')->url($logoPath)
      : asset('images/logo.jpg');
  $siteName = $generalSettings?->site_name ?? 'MI Automatic Poultry Cages';
  // Word-level split keeps Arabic letter joining intact
  $arWords = ['إم', 'آي'];
@endphp
<div class="loader" id="loader" aria-hidden="true">
  <div class="loader-vignette" aria-hidden="true"></div>
  <div class="loader-inner">
    <div class="loader-logo-wrap" data-loader-logo-wrap>
      <div class="loader-logo-glow" aria-hidden="true"></div>
      <div class="loader-logo-orbit" aria-hidden="true"></div>
      <div class="loader-logo-orbit loader-logo-orbit--2" aria-hidden="true"></div>
      <div class="loader-logo">
        <img src="{{ $logoSrc }}" alt="{{ $siteName }}" onerror="this.src='/images/logo.jpg';this.onerror=null;"/>
        <span class="loader-logo-sheen" aria-hidden="true"></span>
      </div>
      <div class="loader-logo-ring"></div>
      <div class="loader-logo-ring" style="--ring-delay:.55s"></div>
      <div class="loader-logo-ring loader-logo-ring--accent" style="--ring-delay:1.1s"></div>
      <div class="loader-logo-flare" aria-hidden="true"></div>
    </div>

    <div class="loader-brand" dir="rtl">
      <span class="loader-brand-ar" aria-label="إم آي">
        @foreach($arWords as $i => $word)
          @if($i > 0)<span class="loader-brand-char loader-brand-char--space" aria-hidden="true">&nbsp;</span>@endif
          <span class="loader-brand-char">{{ $word }}</span>
        @endforeach
      </span>
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
