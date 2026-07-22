<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\ChairmanQuote;
use App\Models\TeamMember;
use App\Services\Contracts\SeoServiceInterface;
use App\Settings\AboutSettings;
use App\Settings\GeneralSettings;

class AboutController extends Controller
{
    public function __invoke(
        string $locale,
        SeoServiceInterface $seo,
        GeneralSettings $settings,
        AboutSettings $about,
    ) {
        $seoTitle = $about->text($about->seo, 'title', __('messages.about_page_seo_title'));
        $seoDesc = $about->text($about->seo, 'desc', __('messages.about_page_seo_desc'));

        $seo->setTitle($seoTitle)->setDescription($seoDesc);

        return view('about', [
            'about' => $about,
            'certifications' => Certification::active()->with('media')->get(),
            'catalogUrl' => $settings->catalog_pdf_url,
            'chairmanQuote' => ChairmanQuote::active()->latest()->first(),
            'teamMembers' => TeamMember::active()->take(12)->get(),
            'seo' => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_about'), 'url' => route('about', $locale)],
            ],
        ]);
    }
}
