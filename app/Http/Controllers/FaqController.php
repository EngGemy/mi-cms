<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function __invoke(Request $request, SeoServiceInterface $seo): View
    {
        $locale = app()->getLocale();
        $q = trim((string) $request->query('q', ''));
        $category = $request->query('category');

        $seo->setTitle(__('messages.faq_seo_title'))
            ->setDescription(__('messages.faq_seo_desc'));

        $faqs = Faq::active()
            ->when($category, fn ($query) => $query->where('category', $category))
            ->when($q !== '', function ($query) use ($q, $locale) {
                $query->where(function ($inner) use ($q, $locale) {
                    $inner->where("question->{$locale}", 'like', "%{$q}%")
                        ->orWhere('question->ar', 'like', "%{$q}%")
                        ->orWhere('question->en', 'like', "%{$q}%")
                        ->orWhere("answer->{$locale}", 'like', "%{$q}%");
                });
            })
            ->get();

        $categories = Faq::active()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $grouped = $faqs->groupBy(fn ($faq) => $faq->category ?: __('messages.faq_uncategorized'));

        return view('faq.index', [
            'grouped' => $grouped,
            'categories' => $categories,
            'activeCategory' => $category,
            'searchQuery' => $q,
            'seo' => $seo->toArray(),
            'breadcrumbs' => [
                ['name' => __('messages.nav_home'), 'url' => route('home', $locale)],
                ['name' => __('messages.nav_faq'), 'url' => route('faq.index', $locale)],
            ],
        ]);
    }
}
