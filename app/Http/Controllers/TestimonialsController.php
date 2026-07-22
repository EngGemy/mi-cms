<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\View\View;

class TestimonialsController extends Controller
{
    public function __invoke(SeoServiceInterface $seo): View
    {
        $locale = app()->getLocale();

        $seo->setTitle(__('messages.testimonials_seo_title'))
            ->setDescription(__('messages.testimonials_seo_desc'));

        return view('testimonials.index', [
            'testimonials' => Testimonial::active()->paginate(12)->withQueryString(),
            'seo' => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_testimonials'), 'url' => route('testimonials.index', $locale)],
            ],
        ]);
    }
}
