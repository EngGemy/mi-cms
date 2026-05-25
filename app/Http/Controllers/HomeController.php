<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ChairmanQuote;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\ProductionStage;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(SeoServiceInterface $seo): View
    {
        $seo->setTitle(__('messages.home_seo_title'))
            ->setDescription(__('messages.home_seo_description'));

        return view('home', [
            'heroSlides'       => HeroSlide::active()->get(),
            'featuredProducts' => Product::active()->take(6)->get(),
            'features'         => Feature::active()->take(3)->get(),
            'productionStages' => ProductionStage::active()->take(6)->get(),
            'projects'         => Project::active()->take(8)->get(),
            'teamMembers'      => TeamMember::active()->take(3)->get(),
            'testimonials'     => Testimonial::active()->take(4)->get(),
            'faqs'             => Faq::active()->get(),
            'chairmanQuote'    => ChairmanQuote::active()->latest()->first(),
            'latestPosts'      => BlogPost::published()->take(3)->get(),
            'seo'              => $seo->toArray(),
        ]);
    }
}
