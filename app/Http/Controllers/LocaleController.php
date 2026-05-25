<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        $available = config('mi.available_locales', ['ar', 'en']);
        if (!in_array($locale, $available, true)) abort(404);

        $back = $request->headers->get('referer') ?: url('/');
        // Swap the first segment of the URL to the new locale
        $url = preg_replace('#^(https?://[^/]+)/(ar|en)(/|$)#', '$1/'.$locale.'$3', $back);

        return redirect($url)->withCookie(cookie('locale', $locale, 60 * 24 * 365));
    }
}
