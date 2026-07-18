<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'لوحة التحكم';
    protected static ?int $navigationSort = -1;
    protected static ?string $title = 'لوحة التحكم';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\QuickActions::class,
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\LatestContactSubmissions::class,
            \App\Filament\Widgets\LatestCalculatorRequests::class,
            \App\Filament\Widgets\LatestBlogPosts::class,
            \App\Filament\Widgets\ContentBreakdown::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'default' => 1,
            'md' => 2,
            'xl' => 3,
        ];
    }
}
