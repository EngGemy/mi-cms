<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionStageResource\Pages;
use App\Models\ProductionStage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductionStageResource extends Resource
{
    protected static ?string $model = ProductionStage::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'محتوى الصفحة الرئيسية';
    protected static ?int $navigationSort = 3;
    protected static ?string $label = 'مرحلة إنتاج';
    protected static ?string $pluralLabel = 'مراحل الإنتاج';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('stage_number')->label('رقم المرحلة')->required()->maxLength(4)->default('01'),
            Forms\Components\TextInput::make('eyebrow')->label('عنوان فرعي (EN/AR)'),
            Forms\Components\TextInput::make('title')->label('العنوان')->required(),
            Forms\Components\Textarea::make('description')->rows(4),
            SpatieMediaLibraryFileUpload::make('image')->collection('image')->image()->imageEditor(),
            SpatieMediaLibraryFileUpload::make('video')->collection('video')->acceptedFileTypes(['video/mp4','video/webm']),
            Forms\Components\TextInput::make('video_url')->url()->label('أو رابط فيديو خارجي (YouTube/Vimeo)'),
            Forms\Components\TextInput::make('position')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stage_number'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('position')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])->defaultSort('position')->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProductionStages::route('/'),
            'create' => Pages\CreateProductionStage::route('/create'),
            'edit'   => Pages\EditProductionStage::route('/{record}/edit'),
        ];
    }
}
