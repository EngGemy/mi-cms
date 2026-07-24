<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\Project;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(SeoServiceInterface $seo): View
    {
        $seo->setTitle(__('messages.home_seo_title'))
            ->setDescription(__('messages.home_seo_description'));

        return view('home', [
            'heroSlides' => HeroSlide::active()->with('media')->get(),
            'featuredProducts' => Product::active()->with('media')->take(3)->get(),
            'projects' => Project::active()->with('media')->take(4)->get(),
            'seo' => $seo->toArray(),
        ]);
    }
}
