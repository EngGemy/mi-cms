<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FeatureResource extends Resource
{
    use Translatable;

    protected static ?string $model = Feature::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'محتوى الصفحة الرئيسية';
    protected static ?int $navigationSort = 2;
    protected static ?string $label = 'ميزة';
    protected static ?string $pluralLabel = 'المزايا';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('المحتوى')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('icon')
                    ->label('أيقونة Lucide')
                    ->placeholder('shield-check, zap, star…')
                    ->helperText('اسم أيقونة من مكتبة lucide.dev'),

                Forms\Components\Textarea::make('description')
                    ->label('الوصف')
                    ->rows(4)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('الصورة والترتيب')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('الصورة')
                    ->collection('image')
                    ->image()
                    ->imageEditor(),

                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('position')
                        ->label('الترتيب')
                        ->numeric()
                        ->default(0),
                    Forms\Components\Toggle::make('is_active')
                        ->label('نشط')
                        ->default(true),
                ]),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                ->collection('image')
                ->square(),
            Tables\Columns\TextColumn::make('title')
                ->label('العنوان')
                ->searchable(),
            Tables\Columns\TextColumn::make('position')
                ->label('الترتيب')
                ->sortable(),
            Tables\Columns\IconColumn::make('is_active')
                ->label('نشط')
                ->boolean(),
        ])->defaultSort('position')->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit'   => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
