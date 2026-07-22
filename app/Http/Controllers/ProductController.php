<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, SeoServiceInterface $seo)
    {
        $seo->setTitle(__('messages.products_title'))
            ->setDescription(__('messages.products_seo_desc'));

        $category = $request->query('category');
        $q = trim((string) $request->query('q', ''));
        $locale = app()->getLocale();

        $products = Product::active()
            ->with('media')
            ->when($category && array_key_exists($category, Product::CATEGORIES),
                fn ($query) => $query->where('category', $category))
            ->when($q !== '', function ($query) use ($q, $locale) {
                $query->where(function ($inner) use ($q, $locale) {
                    $inner->where("name->{$locale}", 'like', "%{$q}%")
                        ->orWhere('name->ar', 'like', "%{$q}%")
                        ->orWhere('name->en', 'like', "%{$q}%");
                });
            })
            ->paginate(9)
            ->withQueryString();

        $categoriesInUse = Product::active()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        return view('products.index', [
            'products' => $products,
            'activeCategory' => $category,
            'searchQuery' => $q,
            'categoryOptions' => collect(Product::CATEGORIES)
                ->only($categoriesInUse->all())
                ->map(fn ($labels, $key) => [
                    'key' => $key,
                    'label' => $labels[$locale] ?? $labels['en'],
                ])
                ->values(),
            'seo' => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_products'), 'url' => route('products.index', $locale)],
            ],
        ]);
    }

    public function show(string $locale, Product $product, SeoServiceInterface $seo)
    {
        $product->load('media');

        $seo->setTitle($product->seoTitle())
            ->setDescription($product->seoDescription())
            ->setImage($product->getMainImageUrl('large'))
            ->setType('product');

        $galleryImages = $product->getMedia('gallery')
            ->map(fn ($m) => [
                'full' => $m->getUrl('large'),
                'thumb' => $m->getUrl('thumb'),
                'alt' => $product->name,
            ])
            ->values()
            ->toArray();

        $specs = (array) ($product->specs ?? []);
        $jsonLd = json_encode(array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->summary,
            'image' => $product->getMainImageUrl('large'),
            'brand' => ['@type' => 'Brand', 'name' => 'MI Metal Industries'],
            'manufacturer' => ['@type' => 'Organization', 'name' => 'MI Metal Industries', 'url' => url('/')],
            'offers' => [
                '@type' => 'Offer',
                'availability' => 'https://schema.org/InStock',
                'priceCurrency' => 'EGP',
                'seller' => ['@type' => 'Organization', 'name' => 'MI Metal Industries'],
            ],
            'additionalProperty' => array_map(fn ($k, $v) => [
                '@type' => 'PropertyValue', 'name' => $k, 'value' => $v,
            ], array_keys($specs), array_values($specs)),
        ]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return view('products.show', [
            'product' => $product,
            'mainImage' => $product->getMainImageUrl('large') ?? '',
            'galleryImages' => $galleryImages,
            'related' => Product::active()->with('media')->where('id', '!=', $product->id)->take(3)->get(),
            'seo' => $seo->toArray(),
            'jsonLd' => $jsonLd,
        ]);
    }
}
