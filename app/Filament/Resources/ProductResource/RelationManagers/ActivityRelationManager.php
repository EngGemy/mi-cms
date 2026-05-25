<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ActivityRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';
    protected static ?string $title       = 'سجل التعديلات';
    protected static ?string $icon        = 'heroicon-o-clock';

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('الحدث')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'created' => 'إنشاء',
                        'updated' => 'تعديل',
                        'deleted' => 'حذف',
                        default   => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default   => 'gray',
                    }),

                Tables\Columns\TextColumn::make('causer.name')
                    ->label('بواسطة')
                    ->default('النظام'),

                Tables\Columns\TextColumn::make('properties')
                    ->label('الحقول المعدَّلة')
                    ->formatStateUsing(function ($record) {
                        $changed = array_keys($record->properties['attributes'] ?? []);
                        return $changed ? implode(', ', $changed) : '—';
                    })
                    ->wrap(),

                Tables\Columns\TextColumn::make('old_values')
                    ->label('القيم قبل التعديل')
                    ->getStateUsing(function ($record) {
                        $old = $record->properties['old'] ?? [];
                        if (empty($old)) return '—';
                        $lines = [];
                        foreach (array_slice($old, 0, 3, true) as $k => $v) {
                            $lines[] = "$k: " . (is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE) : $v);
                        }
                        return implode(' | ', $lines);
                    })
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('new_values')
                    ->label('القيم بعد التعديل')
                    ->getStateUsing(function ($record) {
                        $new = $record->properties['attributes'] ?? [];
                        if (empty($new)) return '—';
                        $lines = [];
                        foreach (array_slice($new, 0, 3, true) as $k => $v) {
                            $lines[] = "$k: " . (is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE) : $v);
                        }
                        return implode(' | ', $lines);
                    })
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('التوقيت')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->paginated([10, 25])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }

    public function isReadOnly(): bool { return true; }
}
