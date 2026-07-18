<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class HeroSlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSlide::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'واجهة الموقع';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationLabel = 'الشرائح الرئيسية';
    protected static ?string $label = 'شريحة رئيسية';
    protected static ?string $pluralLabel = 'الشرائح الرئيسية';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('النص والصورة')->schema([
                Forms\Components\TextInput::make('label')
                    ->label('النص الظاهر')
                    ->required()
                    ->maxLength(120)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->label('الصورة')
                    ->collection('image')
                    ->image()
                    ->imageEditor(),

                Forms\Components\TextInput::make('image_url')
                    ->label('أو رابط صورة خارجي')
                    ->url()
                    ->maxLength(500)
                    ->helperText('Unsplash أو CDN — يُستخدم إذا لم تُرفع صورة'),
            ])->columns(2),

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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->square(),
                Tables\Columns\TextColumn::make('label')
                    ->label('النص')
                    ->searchable()
                    ->limit(60),
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
            'index'  => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit'   => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
