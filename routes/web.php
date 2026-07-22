<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestimonialsController;

/*
|--------------------------------------------------------------------------
| Public Web Routes — bilingual via {locale} prefix
|--------------------------------------------------------------------------
| The SetLocale middleware enforces ar|en and falls back to APP_LOCALE.
*/

// Locale switcher endpoint (writes a cookie, redirects back)
Route::get('lang/{locale}', [LocaleController::class, 'switch'])
    ->whereIn('locale', ['ar', 'en'])
    ->name('locale.switch');

// SEO
Route::get('sitemap.xml', SitemapController::class)->name('sitemap');
Route::view('robots.txt', 'robots')->name('robots');

Route::group([
    'prefix' => '{locale}',
    'where'  => ['locale' => 'ar|en'],
    'middleware' => ['web', 'set.locale'],
], function () {

    Route::get('/', [HomeController::class, '__invoke'])->name('home');

    // About
    Route::get('about', AboutController::class)->name('about');

    // Process / FAQ / Testimonials
    Route::get('process', ProcessController::class)->name('process.index');
    Route::get('faq', FaqController::class)->name('faq.index');
    Route::get('testimonials', TestimonialsController::class)->name('testimonials.index');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Projects
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Blog
    Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('blog/category/{category}', [BlogController::class, 'category'])->name('blog.category');
    Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('blog/{post}/comment', [BlogController::class, 'comment'])->name('blog.comment');

    // Contact form
    Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

    // Capacity calculator estimate (Alpine → JSON, no Livewire)
    Route::post('calculator/estimate', [\App\Http\Controllers\CalculatorEstimateController::class, 'store'])
        ->name('calculator.estimate');

    // Newsletter
    Route::post('newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
});

// Default redirect to APP_LOCALE
Route::get('/', function () {
    return redirect(app()->getLocale());
});
