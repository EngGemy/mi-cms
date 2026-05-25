<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $sitemap = Sitemap::create();
        $locales = config('mi.available_locales', ['ar', 'en']);

        // Home pages per locale
        foreach ($locales as $locale) {
            $sitemap->add(
                Url::create(url($locale))
                    ->setPriority(1.0)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }

        // Products
        foreach (Product::active()->get() as $product) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create(url("$locale/products/{$product->slug}"))
                        ->setPriority(0.8)
                        ->setLastModificationDate($product->updated_at)
                );
            }
        }

        // Blog posts
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
