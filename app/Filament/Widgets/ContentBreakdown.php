<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HeroSlide;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Filament\Widgets\Widget;

class ContentBreakdown extends Widget
{
    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.content-breakdown';

    protected function getViewData(): array
    {
        return [
            'items' => [
                [
                    'label' => 'المنتجات',
                    'count' => Product::count(),
                    'active' => Product::active()->count(),
                    'icon' => 'heroicon-m-cube',
                    'color' => 'primary',
                    'route' => \App\Filament\Resources\ProductResource::getUrl('index'),
                ],
                [
                    'label' => 'المشاريع',
                    'count' => Project::count(),
                    'active' => Project::active()->count(),
                    'icon' => 'heroicon-m-building-office-2',
                    'color' => 'success',
                    'route' => \App\Filament\Resources\ProjectResource::getUrl('index'),
                ],
                [
                    'label' => 'مقالات المدونة',
                    'count' => BlogPost::count(),
                    'active' => BlogPost::published()->count(),
                    'icon' => 'heroicon-m-document-text',
                    'color' => 'info',
                    'route' => \App\Filament\Resources\BlogPostResource::getUrl('index'),
                ],
                [
                    'label' => 'الصفحات',
                    'count' => Page::count(),
                    'active' => Page::published()->count(),
                    'icon' => 'heroicon-m-document',
                    'color' => 'gray',
                    'route' => \App\Filament\Resources\PageResource::getUrl('index'),
                ],
                [
                    'label' => 'أعضاء الفريق',
                    'count' => TeamMember::count(),
                    'active' => null,
                    'icon' => 'heroicon-m-users',
                    'color' => 'warning',
                    'route' => \App\Filament\Resources\TeamMemberResource::getUrl('index'),
                ],
                [
                    'label' => 'آراء العملاء',
                    'count' => Testimonial::count(),
                    'active' => null,
                    'icon' => 'heroicon-m-star',
                    'color' => 'danger',
                    'route' => \App\Filament\Resources\TestimonialResource::getUrl('index'),
                ],
                [
                    'label' => 'الأسئلة الشائعة',
                    'count' => Faq::count(),
                    'active' => null,
                    'icon' => 'heroicon-m-question-mark-circle',
                    'color' => 'gray',
                    'route' => \App\Filament\Resources\FaqResource::getUrl('index'),
                ],
                [
                    'label' => 'شرائح الهيرو',
                    'count' => HeroSlide::count(),
                    'active' => null,
                    'icon' => 'heroicon-m-photo',
                    'color' => 'primary',
                    'route' => \App\Filament\Resources\HeroSlideResource::getUrl('index'),
                ],
                [
                    'label' => 'المميزات',
                    'count' => Feature::count(),
                    'active' => null,
                    'icon' => 'heroicon-m-sparkles',
                    'color' => 'success',
                    'route' => \App\Filament\Resources\FeatureResource::getUrl('index'),
                ],
            ],
        ];
    }
}
