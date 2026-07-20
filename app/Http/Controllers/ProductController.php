<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Contracts\SeoServiceInterface;

class ProductController extends Controller
{
    public function index(SeoServiceInterface $seo)
    {
        $seo->setTitle(__('messages.products_title'));

        $products = Product::active()->with('media')->get();
        $categoriesInUse = $products->pluck('category')->unique()->filter()->values();

        return view('products.index', [
            'products' => $products,
            'categoryOptions' => collect(Product::CATEGORIES)
                ->only($categoriesInUse->all())
                ->map(fn ($labels, $key) => [
                    'key' => $key,
                    'label' => $labels[app()->getLocale()] ?? $labels['en'],
                ])
                ->values(),
            'seo' => $seo->toArray(),
        ]);
    }

    public function show(string $locale, Product $product, SeoServiceInterface $seo)
    {
        $product->load('media');

        $seo->setTitle($product->seoTitle())
            ->setDescription($product->seoDescription())
            ->setImage($product->getMainImageUrl('large'))
            ->setType('product');

        // Gallery images for Alpine.js (full + thumb URLs)
        $galleryImages = $product->getMedia('gallery')
            ->map(fn ($m) => [
                'full'  => $m->getUrl('large'),
                'thumb' => $m->getUrl('thumb'),
                'alt'   => $product->name,
            ])
            ->values()
            ->toArray();

        // JSON-LD structured data
        $specs      = (array) ($product->specs ?? []);
        $jsonLd     = json_encode(array_filter([
            '@context'            => 'https://schema.org',
            '@type'               => 'Product',
            'name'                => $product->name,
            'description'         => $product->summary,
            'image'               => $product->getMainImageUrl('large'),
            'brand'               => ['@type' => 'Brand', 'name' => 'MI Metal Industries'],
            'manufacturer'        => ['@type' => 'Organization', 'name' => 'MI Metal Industries', 'url' => url('/')],
            'offers'              => [
                '@type'        => 'Offer',
                'availability' => 'https://schema.org/InStock',
                'priceCurrency' => 'EGP',
                'seller'       => ['@type' => 'Organization', 'name' => 'MI Metal Industries'],
            ],
            'additionalProperty'  => array_map(fn ($k, $v) => [
                '@type' => 'PropertyValue', 'name' => $k, 'value' => $v,
            ], array_keys($specs), array_values($specs)),
        ]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return view('products.show', [
            'product'       => $product,
            'mainImage'     => $product->getMainImageUrl('large') ?? '',
            'galleryImages' => $galleryImages,
            'related'       => Product::active()->with('media')->where('id', '!=', $product->id)->take(3)->get(),
            'seo'           => $seo->toArray(),
            'jsonLd'        => $jsonLd,
        ]);
    }
}
