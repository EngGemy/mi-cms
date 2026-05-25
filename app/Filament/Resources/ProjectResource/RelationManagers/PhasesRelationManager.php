<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\ProjectPhase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PhasesRelationManager extends RelationManager
{
    protected static string $relationship = 'phases';
    protected static ?string $title       = 'بنود/مراحل التنفيذ';
    protected static ?string $label       = 'بند';
    protected static ?string $pluralLabel = 'البنود';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('title.ar')
                    ->label('العنوان (عربي)')
                    ->required()->maxLength(150),

                Forms\Components\TextInput::make('title.en')
                    ->label('Title (English)')
                    ->required()->maxLength(150),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Textarea::make('description.ar')
                    ->label('الوصف (عربي)')->rows(3),

                Forms\Components\Textarea::make('description.en')
                    ->label('Description (English)')->rows(3),
            ]),

            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('icon')
                    ->label('أيقونة Lucide')
                    ->placeholder('e.g. hammer, zap, settings')
                    ->maxLength(50)
                    ->helperText('اسم أيقونة من مكتبة Lucide'),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'completed'   => 'مكتمل',
                        'in_progress' => 'جارٍ التنفيذ',
                        'planned'     => 'مخطط',
                    ])
                    ->default('completed')
                    ->required(),

                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
            ]),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label('#')
                    ->sortable()
                    ->width(40),

                Tables\Columns\TextColumn::make('title')
                    ->label('البند')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn ($s) => ProjectPhase::STATUSES[$s][app()->getLocale()] ?? $s)
                    ->colors([
                        'success' => 'completed',
                        'warning' => 'in_progress',
                        'gray'    => 'planned',
                    ]),

                Tables\Columns\TextColumn::make('icon')
                    ->label('الأيقونة')
                    ->formatStateUsing(fn ($s) => $s ? '<i data-lucide="' . $s . '" class="w-4 h-4"></i>' : '—')
                    ->html(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('إضافة بند'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
