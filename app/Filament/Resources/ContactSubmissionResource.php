<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'الطلبات الواردة';
    protected static ?string $label = 'طلب تواصل';
    protected static ?string $pluralLabel = 'طلبات التواصل';

    public static function getNavigationBadge(): ?string
    {
        return (string) ContactSubmission::new()->count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\TextInput::make('company')->disabled(),
            Forms\Components\TextInput::make('flock_size')->disabled(),
            Forms\Components\Textarea::make('message')->rows(5)->disabled(),
            Forms\Components\Select::make('status')->options([
                'new'=>'جديد','contacted'=>'تم التواصل','closed'=>'مغلق'
            ]),
            Forms\Components\DateTimePicker::make('contacted_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('flock_size'),
            Tables\Columns\TextColumn::make('status')->badge()->colors([
                'warning'=>'new', 'info'=>'contacted', 'gray'=>'closed',
            ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i'),
        ])->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'new'=>'جديد','contacted'=>'تم التواصل','closed'=>'مغلق'
            ]),
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
            'index'  => Pages\ListContactSubmissions::route('/'),
            'edit'   => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
