<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServiceController extends Controller
{
    public function show(Request $request, string $locale, string $slug, SeoServiceInterface $seo): View
    {
        $pillars = config('poultry_services.pillars', []);
        if (! isset($pillars[$slug])) {
            throw new NotFoundHttpException;
        }

        $meta = $pillars[$slug];
        $copy = __('messages.svc_pillars.'.$slug);
        if (! is_array($copy) || empty($copy['title'])) {
            throw new NotFoundHttpException;
        }

        $seo->setTitle($copy['title'].' · MI')
            ->setDescription($copy['lead'] ?? __('messages.default_seo_description'));

        $products = Product::active()
            ->with('media')
            ->when(
                ! empty($meta['product_category']),
                fn ($q) => $q->where('category', $meta['product_category'])
            )
            ->take(6)
            ->get();

        $projectsQuery = Project::active()->with('media');

        if (! empty($meta['project_category'])) {
            $projectsQuery->where('category', $meta['project_category']);
        } elseif (! empty($meta['work_type'])) {
            $projectsQuery->whereJsonContains('work_types', $meta['work_type']);
        }

        $projects = $projectsQuery->take(3)->get();

        return view('services.show', [
            'slug'     => $slug,
            'meta'     => $meta,
            'copy'     => $copy,
            'products' => $products,
            'projects' => $projects,
            'seo'      => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_systems'), 'url' => route('home', $locale).'#services'],
                ['name' => $copy['title'], 'url' => route('services.show', [$locale, $slug])],
            ],
        ]);
    }
}
