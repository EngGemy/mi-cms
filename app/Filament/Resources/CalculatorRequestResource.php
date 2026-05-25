<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalculatorRequestResource\Pages;
use App\Models\CalculatorRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CalculatorRequestResource extends Resource
{
    protected static ?string $model = CalculatorRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'الطلبات الواردة';
    protected static ?string $label = 'تقدير محفوظ';
    protected static ?string $pluralLabel = 'تقديرات الحاسبة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('length')->disabled(),
            Forms\Components\TextInput::make('width')->disabled(),
            Forms\Components\TextInput::make('height')->disabled(),
            Forms\Components\TextInput::make('floors')->disabled(),
            Forms\Components\TextInput::make('lines')->disabled(),
            Forms\Components\TextInput::make('bird_count')->disabled(),
            Forms\Components\TextInput::make('grand_total')->prefix('EGP')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('#'),
            Tables\Columns\TextColumn::make('length')->suffix(' م'),
            Tables\Columns\TextColumn::make('width')->suffix(' م'),
            Tables\Columns\TextColumn::make('height')->suffix(' م'),
            Tables\Columns\TextColumn::make('floors'),
            Tables\Columns\TextColumn::make('lines'),
            Tables\Columns\TextColumn::make('bird_count')->numeric(),
            Tables\Columns\TextColumn::make('grand_total')->money('EGP'),
            Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i'),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCalculatorRequests::route('/'),
            'edit'   => Pages\EditCalculatorRequest::route('/{record}/edit'),
        ];
    }
}
