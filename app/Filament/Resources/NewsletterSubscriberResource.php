<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'المدوّنة';
    protected static ?string $label = 'مشترك';
    protected static ?string $pluralLabel = 'مشتركو النشرة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('email')->email()->required()->disabled(),
            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('locale')->maxLength(8),
            Forms\Components\TextInput::make('source'),
            Forms\Components\DateTimePicker::make('confirmed_at'),
            Forms\Components\DateTimePicker::make('unsubscribed_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('locale'),
            Tables\Columns\TextColumn::make('source'),
            Tables\Columns\TextColumn::make('confirmed_at')->dateTime('Y-m-d'),
            Tables\Columns\TextColumn::make('unsubscribed_at')->dateTime('Y-m-d'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNewsletterSubscribers::route('/'),
            'edit'   => Pages\EditNewsletterSubscriber::route('/{record}/edit'),
        ];
    }
}
