<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChairmanQuoteResource\Pages;
use App\Models\ChairmanQuote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ChairmanQuoteResource extends Resource
{
    use Translatable;

    protected static ?string $model = ChairmanQuote::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'الفريق';
    protected static ?string $label = 'كلمة رئيس مجلس الإدارة';
    protected static ?string $pluralLabel = 'كلمات رئيس مجلس الإدارة';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('الاقتباس')->schema([
                Forms\Components\Textarea::make('quote')
                    ->label('نص الاقتباس')
                    ->required()
                    ->rows(6)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('التوقيع والصورة')->schema([
                Forms\Components\TextInput::make('signature_name')
                    ->label('اسم الإمضاء')
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('signature_role')
                    ->label('الدور / اللقب')
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('يدعم العربية والإنجليزية عبر مبدّل اللغة'),

                SpatieMediaLibraryFileUpload::make('portrait')
                    ->label('الصورة الشخصية')
                    ->collection('portrait')
                    ->image()
                    ->avatar(),

                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('portrait')
                ->collection('portrait')
                ->circular()
                ->label(''),
            Tables\Columns\TextColumn::make('signature_name')
                ->label('الاسم'),
            Tables\Columns\TextColumn::make('quote')
                ->label('الاقتباس')
                ->limit(80),
            Tables\Columns\IconColumn::make('is_active')
                ->label('نشط')
                ->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListChairmanQuotes::route('/'),
            'create' => Pages\CreateChairmanQuote::route('/create'),
            'edit'   => Pages\EditChairmanQuote::route('/{record}/edit'),
        ];
    }
}
