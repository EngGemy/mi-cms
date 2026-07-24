<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class HeroSlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSlide::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'واجهة الموقع';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationLabel = 'الشرائح الرئيسية';
    protected static ?string $label = 'شريحة رئيسية';
    protected static ?string $pluralLabel = 'الشرائح الرئيسية';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('النص')->schema([
                Forms\Components\TextInput::make('label')
                    ->label('النص الظاهر')
                    ->required()
                    ->maxLength(120)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('فيديو الخلفية (سينمائي)')->schema([
                SpatieMediaLibraryFileUpload::make('video')
                    ->label('فيديو الخلفية')
                    ->collection('video')
                    ->acceptedFileTypes(['video/mp4', 'video/webm'])
                    ->maxSize(20480)
                    ->downloadable()
                    ->openable()
                    ->helperText('مطلوب للهيرو السينمائي: 1920×1080 MP4 H.264، حلقة ≤15 ثانية، ≤8MB مفضّل (حد أقصى 20MB)، بدون صوت.')
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('video_preview')
                    ->label('معاينة الفيديو على الموقع')
                    ->content(function (?HeroSlide $record) {
                        if (! $record?->hasVideo()) {
                            return new \Illuminate\Support\HtmlString(
                                '<p style="margin:0;font-size:13px;color:#8a7f74;">ارفع فيديو ثم احفظ الصفحة لتظهر المعاينة هنا.</p>'
                            );
                        }
                        $url = e($record->getVideoUrl());

                        return new \Illuminate\Support\HtmlString(
                            '<div style="border:1px solid rgba(26,22,17,.1);border-radius:14px;overflow:hidden;background:#111;">'
                            .'<video src="'.$url.'" controls muted playsinline preload="metadata" style="display:block;width:100%;max-height:280px;background:#000;"></video>'
                            .'<div style="padding:10px 14px;font-size:12px;color:#6b635b;background:#faf7f2;">إن اشتغلت المعاينة هنا ولم تظهر في الرئيسية: تأكد أن <code>APP_URL</code> يطابق الدومين، ونفّذ <code>php artisan storage:link</code>.</div>'
                            .'</div>'
                        );
                    })
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('poster')
                    ->label('صورة الملصق (Poster)')
                    ->collection('poster')
                    ->image()
                    ->imageEditor()
                    ->helperText('مهم: ارفع صورة 1920×1080 JPG/WebP — تظهر قبل تشغيل الفيديو وعند فشل التشغيل. بدونها ستظهر صورة الـ Fallback.')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('صورة بديلة (Fallback)')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('صورة الشريحة')
                    ->collection('image')
                    ->image()
                    ->imageEditor()
                    ->helperText('تُستخدم إذا لم يُرفع فيديو/Poster، أو كاحتياطي عند فشل الفيديو.'),

                Forms\Components\TextInput::make('image_url')
                    ->label('أو رابط صورة خارجي')
                    ->url()
                    ->maxLength(500)
                    ->helperText('يجب أن يكون رابط كامل يبدأ بـ https:// — اتركه فارغًا إن رفعت صورة محلية.'),
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->square()
                    ->label('صورة'),
                Tables\Columns\IconColumn::make('has_video')
                    ->label('فيديو')
                    ->boolean()
                    ->getStateUsing(fn (HeroSlide $record) => $record->hasVideo()),
                Tables\Columns\TextColumn::make('label')
                    ->label('النص')
                    ->searchable()
                    ->limit(60),
                Tables\Columns\TextColumn::make('position')
                    ->label('الترتيب')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
            ])
            ->defaultSort('position')
            ->reorderable('position');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit'   => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
