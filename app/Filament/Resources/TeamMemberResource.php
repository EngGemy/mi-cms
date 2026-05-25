<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'الفريق';
    protected static ?string $label = 'عضو الفريق';
    protected static ?string $pluralLabel = 'الفريق';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('role')->required(),
            Forms\Components\Textarea::make('description')->rows(3),
            Forms\Components\TextInput::make('initials')->maxLength(8),
            Forms\Components\ColorPicker::make('badge_color'),
            SpatieMediaLibraryFileUpload::make('avatar')->collection('avatar')->image()->imageEditor()->avatar(),
            Forms\Components\TextInput::make('phone')->tel(),
            Forms\Components\TextInput::make('whatsapp'),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\Toggle::make('is_featured'),
            Forms\Components\TextInput::make('position')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('role'),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\IconColumn::make('is_featured')->boolean(),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
        ])->defaultSort('position')->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
