<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionStageResource\Pages;
use App\Models\ProductionStage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductionStageResource extends Resource
{
    use Translatable;

    protected static ?string $model = ProductionStage::class;
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationGroup = 'واجهة الموقع';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationLabel = 'مراحل الإنتاج';
    protected static ?string $label = 'مرحلة إنتاج';
    protected static ?string $pluralLabel = 'مراحل الإنتاج';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('المحتوى')->schema([
                Forms\Components\TextInput::make('stage_number')
                    ->label('رقم المرحلة')
                    ->required()
                    ->maxLength(4)
                    ->default('01'),

                Forms\Components\TextInput::make('eyebrow')
                    ->label('عنوان فرعي (Eyebrow)')
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('نص صغير فوق العنوان الرئيسي'),

                Forms\Components\TextInput::make('title')
                    ->label('العنوان الرئيسي')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->label('الوصف')
                    ->rows(4)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('الوسائط')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('الصورة')
                    ->collection('image')
                    ->image()
                    ->imageEditor(),

                Forms\Components\Grid::make(1)->schema([
                    SpatieMediaLibraryFileUpload::make('video')
                        ->label('ملف فيديو (MP4/WebM)')
                        ->collection('video')
                        ->acceptedFileTypes(['video/mp4', 'video/webm']),
                    Forms\Components\TextInput::make('video_url')
                        ->label('أو رابط فيديو خارجي (YouTube/Vimeo)')
                        ->url()
                        ->helperText('يُستخدم إذا لم يُرفع ملف فيديو'),
                ]),
            ])->columns(2),

            Forms\Components\Section::make('الترتيب والحالة')->schema([
                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stage_number')
                    ->label('#'),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('الترتيب')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
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
