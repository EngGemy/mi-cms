<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\ProjectStage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class StagesRelationManager extends RelationManager
{
    protected static string $relationship = 'stages';
    protected static ?string $title       = 'مراحل البناء';
    protected static ?string $label       = 'مرحلة';
    protected static ?string $pluralLabel = 'المراحل';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('title.ar')
                    ->label('اسم المرحلة (عربي)')
                    ->required()->maxLength(150),

                Forms\Components\TextInput::make('title.en')
                    ->label('Stage Name (English)')
                    ->required()->maxLength(150),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Textarea::make('description.ar')
                    ->label('الوصف (عربي)')->rows(3),

                Forms\Components\Textarea::make('description.en')
                    ->label('Description (English)')->rows(3),
            ]),

            Forms\Components\Grid::make(3)->schema([
                Forms\Components\DatePicker::make('started_at')
                    ->label('تاريخ البدء')
                    ->displayFormat('Y-m-d'),

                Forms\Components\DatePicker::make('completed_at')
                    ->label('تاريخ الانتهاء')
                    ->displayFormat('Y-m-d'),

                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')->numeric()->default(0),
            ]),

            Forms\Components\Toggle::make('is_done')
                ->label('مكتملة')->default(true),

            SpatieMediaLibraryFileUpload::make('photos')
                ->collection('photos')
                ->label('صور المرحلة')
                ->multiple()
                ->reorderable()
                ->image()
                ->imageEditor()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(5120)
                ->maxFiles(10)
                ->columnSpanFull(),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photos')
                    ->collection('photos')
                    ->label('صورة')
                    ->square()->size(48)
                    ->limit(1),

                Tables\Columns\TextColumn::make('title')
                    ->label('المرحلة')
                    ->sortable(),

                Tables\Columns\TextColumn::make('started_at')
                    ->label('البداية')
                    ->date('Y-m-d'),

                Tables\Columns\TextColumn::make('completed_at')
                    ->label('الانتهاء')
                    ->date('Y-m-d'),

                Tables\Columns\IconColumn::make('is_done')
                    ->label('مكتملة')->boolean(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('إضافة مرحلة'),
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
