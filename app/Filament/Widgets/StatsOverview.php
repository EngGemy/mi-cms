<?php

namespace App\Filament\Widgets;

use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\CalculatorRequest;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Models\Product;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $newContacts = ContactSubmission::new()->count();
        $totalContacts = ContactSubmission::count();
        $contactTrend = $totalContacts > 0
            ? round(($newContacts / $totalContacts) * 100, 1)
            : 0;

        $calcThisWeek = CalculatorRequest::where('created_at', '>=', now()->subWeek())->count();
        $calcLastWeek = CalculatorRequest::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->count();
        $calcDiff = $calcLastWeek > 0 ? round((($calcThisWeek - $calcLastWeek) / $calcLastWeek) * 100) : ($calcThisWeek > 0 ? 100 : 0);

        return [
            Stat::make('طلبات تواصل جديدة', $newContacts)
                ->description("{$contactTrend}% من إجمالي الطلبات")
                ->descriptionIcon('heroicon-m-inbox')
                ->color('warning')
                ->chart($this->contactChart()),

            Stat::make('تقديرات الحاسبة هذا الأسبوع', $calcThisWeek)
                ->description($calcDiff >= 0 ? "+{$calcDiff}% عن الأسبوع الماضي" : "{$calcDiff}% عن الأسبوع الماضي")
                ->descriptionIcon('heroicon-m-calculator')
                ->color('info')
                ->chart($this->calculatorChart()),

            Stat::make('مشاريع منشورة', Project::active()->count())
                ->description('مشاريع نشطة على الموقع')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('success'),

            Stat::make('منتجات نشطة', Product::active()->count())
                ->description(Product::featured()->count() . ' منتج مميز')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Stat::make('تعليقات بانتظار المراجعة', BlogComment::pending()->count())
                ->description('يحتاج موافقة')
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color('danger'),

            Stat::make('مشتركي النشرة البريدية', NewsletterSubscriber::active()->count())
                ->description('مشترك مؤكد')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('gray'),
        ];
    }

    private function contactChart(): array
    {
        return ContactSubmission::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }

    private function calculatorChart(): array
    {
        return CalculatorRequest::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }
}
