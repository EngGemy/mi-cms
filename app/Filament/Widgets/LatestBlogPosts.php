<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Models\BlogPost;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBlogPosts extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = ['default' => 1, 'md' => 1, 'xl' => 1];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BlogPost::query()->with('author')->latest()->limit(5)
            )
            ->heading('آخر مقالات المدونة')
            ->description('المحتوى المنشور حديثاً')
            ->emptyStateHeading('لا توجد مقالات')
            ->emptyStateDescription('ابدأ بكتابة أول مقال.')
            ->emptyStateIcon('heroicon-o-document-text')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->weight('font-bold')
                    ->limit(28),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('الكاتب')
                    ->icon('heroicon-m-user')
                    ->iconColor('gray')
                    ->default('—'),

                Tables\Columns\IconColumn::make('published_at')
                    ->label('النشر')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->state(fn ($record) => $record->published_at !== null && $record->published_at <= now()),

                Tables\Columns\TextColumn::make('views_count')
                    ->label('المشاهدات')
                    ->numeric()
                    ->icon('heroicon-m-eye')
                    ->iconColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('Y-m-d H:i')),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('تعديل')
                    ->url(fn (BlogPost $record): string => BlogPostResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square')
                    ->color('primary')
                    ->size('sm'),
            ])
            ->paginated(false);
    }
}
