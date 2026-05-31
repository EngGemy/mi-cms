<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CertificationResource extends Resource
{
    use Translatable;

    protected static ?string $model = Certification::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'من نحن';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'شهادة اعتماد';
    protected static ?string $pluralLabel = 'الشهادات والاعتمادات';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('المعلومات الأساسية')->schema([
                SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image()
                    ->imageEditor()
                    ->label('شعار / صورة الشهادة')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('name')
                    ->label('اسم الشهادة')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('issuer')
                    ->label('جهة الإصدار')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('year')
                    ->label('سنة الحصول')
                    ->numeric()
                    ->minValue(1990)
                    ->maxValue(2030),
            ])->columns(2),

            Forms\Components\Section::make('الوصف')->schema([
                Forms\Components\Textarea::make('description')
                    ->label('الوصف')
                    ->rows(3)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('الترتيب والحالة')->schema([
                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
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
                    ->label('الاسم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuer')
                    ->label('جهة الإصدار'),
                Tables\Columns\TextColumn::make('year')
                    ->label('السنة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('الترتيب')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
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
