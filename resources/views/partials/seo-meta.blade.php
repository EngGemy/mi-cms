@php($seo = $seo ?? app(\App\Services\Contracts\SeoServiceInterface::class)->toArray())
<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">
<link rel="canonical" href="{{ $seo['canonical'] }}">

<meta property="og:title" content="{{ $seo['title'] }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:image" content="{{ $seo['image'] }}">
<meta property="og:url" content="{{ $seo['canonical'] }}">
<meta property="og:type" content="{{ $seo['type'] }}">
<meta property="og:locale" content="{{ $seo['locale'] }}">
<meta property="og:site_name" content="{{ $seo['site_name'] }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo['title'] }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
<meta name="twitter:image" content="{{ $seo['image'] }}">

<link rel="alternate" hreflang="ar" href="{{ url('/ar' . request()->getRequestUri()) }}">
<link rel="alternate" hreflang="en" href="{{ url('/en' . request()->getRequestUri()) }}">

<meta name="theme-color" content="#C8102E">

@if(!empty($generalSettings?->favicon_path))
<link rel="icon" href="{{ asset('storage/' . $generalSettings->favicon_path) }}">
@endif

@if(!empty($seoSettings?->google_tag_manager_id))
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $seoSettings->google_tag_manager_id }}');</script>
<!-- End Google Tag Manager -->
@elseif(!empty($seoSettings?->google_analytics_id))
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSettings->google_analytics_id }}"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $seoSettings->google_analytics_id }}');</script>
<!-- End Google Analytics -->
@endif
