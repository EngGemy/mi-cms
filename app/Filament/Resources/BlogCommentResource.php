<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCommentResource\Pages;
use App\Models\BlogComment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class BlogCommentResource extends Resource
{
    protected static ?string $model = BlogComment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'المدوّنة';
    protected static ?string $label = 'تعليق';
    protected static ?string $pluralLabel = 'التعليقات';

    public static function getNavigationBadge(): ?string
    {
        return (string) BlogComment::pending()->count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('blog_post_id')->relationship('post', 'title->ar')->disabled(),
            Forms\Components\TextInput::make('author_name'),
            Forms\Components\TextInput::make('author_email'),
            Forms\Components\Textarea::make('body')->rows(6),
            Forms\Components\Select::make('status')->options([
                'pending'=>'قيد المراجعة','approved'=>'منشور','spam'=>'سپام'
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('author_name')->searchable(),
            Tables\Columns\TextColumn::make('post.title')->limit(40),
            Tables\Columns\TextColumn::make('body')->limit(60),
            Tables\Columns\TextColumn::make('status')->badge()->colors([
                'warning'=>'pending', 'success'=>'approved', 'danger'=>'spam',
            ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i'),
        ])->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'pending'=>'قيد المراجعة','approved'=>'منشور','spam'=>'سپام',
            ]),
        ])->actions([
            Action::make('approve')->label('قبول')->icon('heroicon-o-check')
                ->visible(fn ($r) => $r->status !== 'approved')
                ->action(fn ($r) => $r->update(['status' => 'approved'])),
            Action::make('spam')->label('سپام')->icon('heroicon-o-no-symbol')->color('danger')
                ->action(fn ($r) => $r->update(['status' => 'spam'])),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogComments::route('/'),
            'edit'   => Pages\EditBlogComment::route('/{record}/edit'),
        ];
    }
}
