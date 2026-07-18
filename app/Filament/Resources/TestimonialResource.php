<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    use Translatable;

    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'الثقة والسمعة';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationLabel = 'آراء العملاء';
    protected static ?string $label = 'رأي عميل';
    protected static ?string $pluralLabel = 'آراء العملاء';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('محتوى الشهادة')->schema([
                Forms\Components\Textarea::make('quote')
                    ->label('نص الشهادة')
                    ->required()
                    ->rows(4)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('author_name')
                    ->label('اسم العميل')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('author_role')
                    ->label('المسمى الوظيفي / المنصب')
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),
            ])->columns(2),

            Forms\Components\Section::make('المظهر والترتيب')->schema([
                Forms\Components\TextInput::make('initials')
                    ->label('الأحرف الأولى')
                    ->maxLength(8)
                    ->helperText('تظهر كـ avatar إذا لم تتوفر صورة'),
                Forms\Components\ColorPicker::make('avatar_color')
                    ->label('لون الخلفية'),
                Forms\Components\TextInput::make('rating')
                    ->label('التقييم (1–5)')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5),
                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_featured')
                    ->label('مميز'),
                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('author_name')
                ->label('العميل')
                ->searchable(),
            Tables\Columns\TextColumn::make('author_role')
                ->label('المنصب'),
            Tables\Columns\TextColumn::make('rating')
                ->label('التقييم'),
            Tables\Columns\IconColumn::make('is_active')
                ->label('نشط')
                ->boolean(),
        ])->defaultSort('position')->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
