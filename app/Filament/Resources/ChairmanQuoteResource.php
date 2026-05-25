<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChairmanQuoteResource\Pages;
use App\Models\ChairmanQuote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ChairmanQuoteResource extends Resource
{
    protected static ?string $model = ChairmanQuote::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'الفريق';
    protected static ?string $label = 'كلمة رئيس مجلس الإدارة';
    protected static ?string $pluralLabel = 'كلمات رئيس مجلس الإدارة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('quote')->label('النص')->required()->rows(6)->columnSpanFull(),
            Forms\Components\TextInput::make('signature_name')->label('اسم الإمضاء'),
            Forms\Components\TextInput::make('signature_role')->label('الدور'),
            Forms\Components\TextInput::make('signature_role_en')->label('Role (EN)'),
            SpatieMediaLibraryFileUpload::make('portrait')->collection('portrait')->image()->avatar(),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('signature_name'),
            Tables\Columns\TextColumn::make('quote')->limit(80),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
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
