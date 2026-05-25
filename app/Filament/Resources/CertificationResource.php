<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'من نحن';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'شهادة اعتماد';
    protected static ?string $pluralLabel = 'الشهادات والاعتمادات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('المعلومات الأساسية')->schema([
                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image()
                    ->imageEditor()
                    ->label('شعار/صورة الشهادة')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('name.ar')->label('الاسم (عربي)')->required(),
                Forms\Components\TextInput::make('name.en')->label('الاسم (إنجليزي)')->required(),
                Forms\Components\TextInput::make('issuer.ar')->label('جهة الإصدار (عربي)')->required(),
                Forms\Components\TextInput::make('issuer.en')->label('جهة الإصدار (إنجليزي)')->required(),
                Forms\Components\TextInput::make('year')
                    ->numeric()->minValue(1990)->maxValue(2030)
                    ->label('سنة الحصول'),
            ])->columns(2),

            Forms\Components\Section::make('الوصف')->schema([
                Forms\Components\Textarea::make('description.ar')->label('الوصف (عربي)')->rows(3),
                Forms\Components\Textarea::make('description.en')->label('الوصف (إنجليزي)')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('الإعدادات')->schema([
                Forms\Components\TextInput::make('position')->numeric()->default(0)->label('الترتيب'),
                Forms\Components\Toggle::make('is_active')->default(true)->label('نشط'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->conversion('thumb')
                    ->label('الشعار')
                    ->width(60)->height(40),
                Tables\Columns\TextColumn::make('name')
                    ->getStateUsing(fn ($record) => $record->getTranslation('name', 'ar', false) ?: $record->getTranslation('name', 'en', false))
                    ->label('الاسم')->searchable(),
                Tables\Columns\TextColumn::make('issuer')
                    ->getStateUsing(fn ($record) => $record->getTranslation('issuer', 'ar', false))
                    ->label('جهة الإصدار'),
                Tables\Columns\TextColumn::make('year')->label('السنة')->sortable(),
                Tables\Columns\TextColumn::make('position')->label('الترتيب')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('نشط'),
            ])
            ->defaultSort('position')
            ->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'edit'   => Pages\EditCertification::route('/{record}/edit'),
        ];
    }
}
