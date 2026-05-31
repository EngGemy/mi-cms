<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;

class BlogPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'المدوّنة';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'مقال';
    protected static ?string $pluralLabel = 'مقالات المدوّنة';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([

                Forms\Components\Tabs\Tab::make('المحتوى')->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('العنوان')
                        ->required()
                        ->live(onBlur: true)
                        ->extraInputAttributes(fn ($livewire) => [
                            'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                        ]),

                    Forms\Components\Textarea::make('excerpt')
                        ->label('مقتطف (للبطاقة)')
                        ->rows(3)
                        ->maxLength(280)
                        ->extraInputAttributes(fn ($livewire) => [
                            'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                        ]),

                    Forms\Components\RichEditor::make('content')
                        ->label('المحتوى الكامل')
                        ->required()
                        ->columnSpanFull(),
                ]),

                Forms\Components\Tabs\Tab::make('الوسائط')->schema([
                    SpatieMediaLibraryFileUpload::make('featured')
                        ->label('الصورة الرئيسية')
                        ->collection('featured')
                        ->image()
                        ->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('معرض الصور')
                        ->collection('gallery')
                        ->multiple()
                        ->reorderable()
                        ->image(),
                ]),

                Forms\Components\Tabs\Tab::make('التصنيف والوسوم')->schema([
                    Forms\Components\Select::make('blog_category_id')
                        ->relationship('category', 'name->ar')
                        ->label('التصنيف')
                        ->preload()
                        ->searchable(),
                    Forms\Components\Select::make('author_id')
                        ->relationship('author', 'name')
                        ->label('الكاتب')
                        ->preload()
                        ->searchable(),
                    SpatieTagsInput::make('tags')
                        ->label('الوسوم')
                        ->type('blog'),
                ]),

                Forms\Components\Tabs\Tab::make('SEO')->schema([
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
                ]),

                Forms\Components\Tabs\Tab::make('النشر')->schema([
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('تاريخ النشر'),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('مميز'),
                    Forms\Components\Toggle::make('comments_enabled')
                        ->label('التعليقات مفعّلة')
                        ->default(true),
                    Forms\Components\TextInput::make('reading_time_minutes')
                        ->label('وقت القراءة (دقيقة)')
                        ->numeric(),
                ]),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured')
                    ->collection('featured')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->badge(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('الكاتب'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('النشر')
                    ->dateTime('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('المشاهدات')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('blog_category_id')
                    ->relationship('category', 'name->ar')
                    ->label('التصنيف'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('المميزة'),
                Tables\Filters\Filter::make('published')
                    ->label('المنشورة')
                    ->query(fn ($q) => $q->whereNotNull('published_at')),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit'   => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
