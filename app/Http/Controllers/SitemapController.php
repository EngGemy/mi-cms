<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Project;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $sitemap = Sitemap::create();
        $locales = config('mi.available_locales', ['ar', 'en']);

        $static = [
            '' => 1.0,
            '/products' => 0.9,
            '/projects' => 0.9,
            '/about' => 0.8,
            '/process' => 0.8,
            '/faq' => 0.7,
            '/testimonials' => 0.7,
            '/blog' => 0.8,
        ];

        foreach ($locales as $locale) {
            foreach ($static as $path => $priority) {
                $sitemap->add(
                    Url::create(url($locale.$path))
                        ->setPriority($priority)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                );
            }
        }

        foreach (Product::active()->get() as $product) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create(url("$locale/products/{$product->slug}"))
                        ->setPriority(0.8)
                        ->setLastModificationDate($product->updated_at)
                );
            }
        }

        foreach (Project::active()->get() as $project) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create(url("$locale/projects/{$project->slug}"))
                        ->setPriority(0.75)
                        ->setLastModificationDate($project->updated_at)
                );
            }
        }

        foreach (BlogPost::published()->get() as $post) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create(url("$locale/blog/{$post->slug}"))
                        ->setPriority(0.7)
                        ->setLastModificationDate($post->updated_at)
                );
            }
        }

        return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
    }
}
