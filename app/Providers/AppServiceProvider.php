<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Product;
use App\Services\CalculatorService;
use App\Services\Contracts\CalculatorServiceInterface;
use App\Services\Contracts\SeoServiceInterface;
use App\Services\SeoService;
use App\Settings\CalculatorSettings;
use App\Settings\ContactSettings;
use App\Settings\GeneralSettings;
use App\Settings\SeoSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CalculatorServiceInterface::class, function ($app) {
            $s = $app->make(CalculatorSettings::class);
            $tech = $s->techConfig();

            return new CalculatorService(array_merge([
                'concrete_m2'    => $s->concrete_m2,
                'steel_m2'       => $s->steel_m2,
                'walls_m2'       => $s->walls_m2,
                'tanks_fixed'    => $s->tanks_fixed,
                'bird_cost'      => $s->bird_cost,
                'rear_fan'       => $s->rear_fan,
                'cooling_factor' => $s->cooling_factor,
                'window'         => $s->window,
                'side_fan'       => $s->side_fan,
                'heater'         => $s->heater,
                'control_fixed'  => $s->control_fixed,
            ], $tech));
        });

        $this->app->singleton(SeoServiceInterface::class, SeoService::class);
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        Route::bind('product',  fn ($v) => Product::where('slug', $v)->firstOrFail());
        Route::bind('post',     fn ($v) => BlogPost::where('slug', $v)->firstOrFail());
        Route::bind('category', fn ($v) => BlogCategory::where('slug', $v)->firstOrFail());

        // Share settings with all public views so partials can read them directly.
        View::composer('*', function ($view) {
            if (!$view->getName() || str_starts_with($view->getName(), 'filament')) {
                return;
            }
            try {
                $view->with('generalSettings',  app(GeneralSettings::class));
                $view->with('contactSettings',  app(ContactSettings::class));
                $view->with('seoSettings',      app(SeoSettings::class));
                $view->with('aboutSettings',    app(\App\Settings\AboutSettings::class));
            } catch (\Throwable) {
                // Settings table may not exist yet (first migration run).
            }
        });
    }
}
