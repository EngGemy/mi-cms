<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestContactSubmissions extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = ['default' => 1, 'md' => 1, 'xl' => 1];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactSubmission::query()->latest()->limit(5)
            )
            ->heading('آخر طلبات التواصل')
            ->description('الطلبات الواردة من نموذج التواصل')
            ->emptyStateHeading('لا توجد طلبات تواصل')
            ->emptyStateDescription('ستظهر هنا الطلبات الجديدة بمجرد وصولها.')
            ->emptyStateIcon('heroicon-o-inbox')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable()
                    ->weight('font-bold')
                    ->limit(20),

                Tables\Columns\TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->iconColor('gray')
                    ->copyable()
                    ->limit(22),

                Tables\Columns\TextColumn::make('phone')
                    ->label('الهاتف')
                    ->icon('heroicon-m-phone')
                    ->iconColor('gray')
                    ->copyable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'جديد',
                        'contacted' => 'تم التواصل',
                        'closed' => 'مغلق',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->since()
                    ->sortable()
                    ->tooltip(fn ($record) => $record->created_at->format('Y-m-d H:i')),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('عرض')
                    ->url(fn (ContactSubmission $record): string => ContactSubmissionResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye')
                    ->color('primary')
                    ->size('sm'),
            ])
            ->paginated(false);
    }
}
