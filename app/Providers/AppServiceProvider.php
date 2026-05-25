<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Product;
use App\Services\CalculatorService;
use App\Services\Contracts\CalculatorServiceInterface;
use App\Services\Contracts\SeoServiceInterface;
use App\Services\SeoService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // SOLID Dependency Inversion: bind interfaces to concrete implementations
        $this->app->bind(CalculatorServiceInterface::class, function () {
            return new CalculatorService(config('mi.calculator'));
        });

        $this->app->singleton(SeoServiceInterface::class, SeoService::class);
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // Explicit route model bindings — needed because implicit binding does not
        // resolve correctly when routes are nested under a {locale} prefix group.
        Route::bind('product',  fn ($v) => Product::where('slug', $v)->firstOrFail());
        Route::bind('post',     fn ($v) => BlogPost::where('slug', $v)->firstOrFail());
        Route::bind('category', fn ($v) => BlogCategory::where('slug', $v)->firstOrFail());
    }
}
