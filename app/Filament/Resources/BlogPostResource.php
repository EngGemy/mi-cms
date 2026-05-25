<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'المدوّنة';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'مقال';
    protected static ?string $pluralLabel = 'مقالات المدوّنة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('المحتوى')->schema([
                    Forms\Components\TextInput::make('title')->required()->live(onBlur: true),
                    Forms\Components\Textarea::make('excerpt')->rows(3)->maxLength(280),
                    Forms\Components\RichEditor::make('content')->required()->columnSpanFull(),
                ]),
                Forms\Components\Tabs\Tab::make('الوسائط')->schema([
                    SpatieMediaLibraryFileUpload::make('featured')
                        ->label('الصورة الرئيسية')
                        ->collection('featured')->image()->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('معرض الصور')
                        ->collection('gallery')->multiple()->reorderable()->image(),
                ]),
                Forms\Components\Tabs\Tab::make('التصنيف والوسوم')->schema([
                    Forms\Components\Select::make('blog_category_id')
                        ->relationship('category', 'name->ar')
                        ->preload()->searchable(),
                    Forms\Components\Select::make('author_id')
                        ->relationship('author', 'name')
                        ->preload()->searchable(),
                    SpatieTagsInput::make('tags')->type('blog'),
                ]),
                Forms\Components\Tabs\Tab::make('SEO')->schema([
                    Forms\Components\TextInput::make('seo_title')->maxLength(120),
                    Forms\Components\Textarea::make('seo_description')->rows(3)->maxLength(170),
                ]),
                Forms\Components\Tabs\Tab::make('النشر')->schema([
                    Forms\Components\DateTimePicker::make('published_at'),
                    Forms\Components\Toggle::make('is_featured'),
                    Forms\Components\Toggle::make('comments_enabled')->default(true),
                    Forms\Components\TextInput::make('reading_time_minutes')->numeric(),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured')->collection('featured')->square(),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->badge(),
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('published_at')->dateTime('Y-m-d')->sortable(),
                Tables\Columns\TextColumn::make('views_count')->sortable(),
                Tables\Columns\TextColumn::make('comments_count')->counts('allComments'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('blog_category_id')->relationship('category', 'name->ar'),
                Tables\Filters\TernaryFilter::make('is_featured'),
                Tables\Filters\Filter::make('published')
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
