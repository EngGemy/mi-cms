<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CalculatorRequestResource;
use App\Models\CalculatorRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCalculatorRequests extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = ['default' => 1, 'md' => 1, 'xl' => 1];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CalculatorRequest::query()->with('contactSubmission')->latest()->limit(5)
            )
            ->heading('آخر تقديرات الحاسبة')
            ->description('الطلبات القادمة من حاسبة التكلفة')
            ->emptyStateHeading('لا توجد تقديرات')
            ->emptyStateDescription('ستظهر هنا التقديرات الجديدة.')
            ->emptyStateIcon('heroicon-o-calculator')
            ->columns([
                Tables\Columns\TextColumn::make('contactSubmission.name')
                    ->label('العميل')
                    ->default('—')
                    ->weight('font-bold')
                    ->limit(20),

                Tables\Columns\TextColumn::make('bird_count')
                    ->label('عدد الطيور')
                    ->numeric()
                    ->icon('heroicon-m-clipboard-document-list')
                    ->iconColor('gray'),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('التكلفة التقديرية')
                    ->money('EGP')
                    ->color('success')
                    ->weight('font-bold'),

                Tables\Columns\TextColumn::make('dimensions')
                    ->label('المساحة')
                    ->state(fn ($record) => "{$record->length} × {$record->width} م")
                    ->icon('heroicon-m-square-3-stack-3d')
                    ->iconColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('Y-m-d H:i')),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('عرض')
                    ->url(fn (CalculatorRequest $record): string => CalculatorRequestResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye')
                    ->color('primary')
                    ->size('sm'),
            ])
            ->paginated(false);
    }
}
