<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.seo-meta')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Fraunces:ital,opsz,wght@0,9..144,300..900;1,9..144,300..900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{-- Sync factory before Alpine (Vite modules are deferred) --}}
    <script src="{{ asset('js/mi-poultry-calc.js') }}?v={{ @filemtime(public_path('js/mi-poultry-calc.js')) ?: '1' }}"></script>
    {{ $head ?? '' }}
</head>
<body>

@include('partials.loader')
@include('partials.header')
@include('partials.mobile-drawer')

<main>
    {{ $slot ?? '' }}
    @yield('content')
</main>

@include('partials.footer')
@include('partials.whatsapp')

@livewireScripts
@stack('scripts')
</body>
</html>
