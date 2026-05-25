<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Services\Contracts\SeoServiceInterface;
use App\Settings\GeneralSettings;

class AboutController extends Controller
{
    public function __invoke(string $locale, SeoServiceInterface $seo, GeneralSettings $settings)
    {
        $seo->setTitle(__('messages.about_page_seo_title'))
            ->setDescription(__('messages.about_page_seo_desc'));

        return view('about', [
            'certifications' => Certification::active()->with('media')->get(),
            'catalogUrl'     => $settings->catalog_pdf_url,
            'seo'            => $seo->toArray(),
        ]);
    }
}
