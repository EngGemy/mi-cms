<?php

namespace App\Filament\Widgets;

use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\CalculatorRequest;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('طلبات تواصل جديدة', ContactSubmission::new()->count())
                ->descriptionIcon('heroicon-m-inbox')->color('warning'),
            Stat::make('تقديرات الحاسبة', CalculatorRequest::count())
                ->descriptionIcon('heroicon-m-calculator')->color('info'),
            Stat::make('تعليقات بانتظار المراجعة', BlogComment::pending()->count())
                ->descriptionIcon('heroicon-m-chat-bubble-left')->color('danger'),
            Stat::make('مقالات منشورة', BlogPost::published()->count())
                ->descriptionIcon('heroicon-m-pencil-square'),
            Stat::make('مشتركو النشرة', NewsletterSubscriber::active()->count())
                ->descriptionIcon('heroicon-m-envelope')->color('success'),
        ];
    }
}
