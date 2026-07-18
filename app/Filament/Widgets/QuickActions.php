<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\GeneralSettingsPage;
use App\Filament\Resources\BlogPostResource;
use App\Filament\Resources\CalculatorRequestResource;
use App\Filament\Resources\ContactSubmissionResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProjectResource;
use App\Models\ContactSubmission;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.quick-actions';

    protected function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => 'طلبات التواصل',
                    'hint'  => 'الواردات',
                    'icon'  => 'heroicon-m-inbox',
                    'url'   => ContactSubmissionResource::getUrl('index'),
                    'badge' => ContactSubmission::new()->count(),
                ],
                [
                    'label' => 'طلبات الحاسبة',
                    'hint'  => 'الواردات',
                    'icon'  => 'heroicon-m-calculator',
                    'url'   => CalculatorRequestResource::getUrl('index'),
                ],
                [
                    'label' => 'إضافة منتج',
                    'hint'  => 'الكتالوج',
                    'icon'  => 'heroicon-m-cube',
                    'url'   => ProductResource::getUrl('create'),
                ],
                [
                    'label' => 'إضافة مشروع',
                    'hint'  => 'الكتالوج',
                    'icon'  => 'heroicon-m-building-office-2',
                    'url'   => ProjectResource::getUrl('create'),
                ],
                [
                    'label' => 'مقالة جديدة',
                    'hint'  => 'المدونة',
                    'icon'  => 'heroicon-m-pencil-square',
                    'url'   => BlogPostResource::getUrl('create'),
                ],
                [
                    'label' => 'إعدادات الموقع',
                    'hint'  => 'النظام',
                    'icon'  => 'heroicon-m-cog-6-tooth',
                    'url'   => GeneralSettingsPage::getUrl(),
                ],
            ],
        ];
    }
}
