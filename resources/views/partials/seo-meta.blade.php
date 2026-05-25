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
