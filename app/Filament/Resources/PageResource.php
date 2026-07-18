<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'المدونة والصفحات';
    protected static ?int $navigationSort = 40;
    protected static ?string $navigationLabel = 'الصفحات الثابتة';
    protected static ?string $label = 'صفحة';
    protected static ?string $pluralLabel = 'الصفحات الثابتة';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('هوية الصفحة')->schema([
                Forms\Components\TextInput::make('slug')
                    ->label('Slug (الرابط الثابت)')
                    ->required()
                    ->unique(Page::class, 'slug', ignoreRecord: true)
                    ->placeholder('about | terms | privacy')
                    ->helperText('لا يتغير بتغيير اللغة — حروف إنجليزية وشرطات فقط')
                    ->extraInputAttributes(['dir' => 'ltr']),

                Forms\Components\Toggle::make('is_published')
                    ->label('منشورة')
                    ->default(true),
            ])->columns(2),

            Forms\Components\Section::make('المحتوى')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('عنوان الصفحة')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('content')
                    ->label('المحتوى')
                    ->required()
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\TextInput::make('seo_title')
                    ->label('عنوان SEO')
                    ->maxLength(120)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),
                Forms\Components\Textarea::make('seo_description')
                    ->label('وصف SEO')
                    ->rows(3)
                    ->maxLength(170)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('slug')
                ->label('Slug'),
            Tables\Columns\TextColumn::make('title')
                ->label('العنوان')
                ->searchable(),
            Tables\Columns\IconColumn::make('is_published')
                ->label('منشورة')
                ->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
