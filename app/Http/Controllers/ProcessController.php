<?php

namespace App\Http\Controllers;

use App\Models\ProductionStage;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\View\View;

class ProcessController extends Controller
{
    public function __invoke(SeoServiceInterface $seo): View
    {
        $locale = app()->getLocale();

        $seo->setTitle(__('messages.process_seo_title'))
            ->setDescription(__('messages.process_seo_desc'));

        return view('process.index', [
            'stages' => ProductionStage::active()->with('media')->get(),
            'howSteps' => __('messages.how_steps'),
            'seo' => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_how'), 'url' => route('process.index', $locale)],
            ],
        ]);
    }
}
