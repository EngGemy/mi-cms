<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'الثقة والمصداقية';
    protected static ?string $label = 'شهادة عميل';
    protected static ?string $pluralLabel = 'شهادات العملاء';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('quote')->required()->rows(4),
            Forms\Components\TextInput::make('author_name')->required(),
            Forms\Components\TextInput::make('author_role'),
            Forms\Components\TextInput::make('initials')->maxLength(8),
            Forms\Components\ColorPicker::make('avatar_color'),
            Forms\Components\TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->default(5),
            Forms\Components\TextInput::make('position')->numeric()->default(0),
            Forms\Components\Toggle::make('is_featured'),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('author_name')->searchable(),
            Tables\Columns\TextColumn::make('author_role'),
            Tables\Columns\TextColumn::make('rating'),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
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
