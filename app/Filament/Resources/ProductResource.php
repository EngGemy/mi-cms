<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\ActivityRelationManager;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model          = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'الكتالوج';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $label           = 'منتج';
    protected static ?string $pluralLabel     = 'المنتجات';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()
                ->tabs([

                    // ── Tab 1: Content ──────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('المحتوى')->icon('heroicon-o-document-text')->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('اسم المنتج')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('badge')
                                ->label('شارة (Badge)')
                                ->maxLength(60)
                                ->hint('تظهر فوق الاسم — مثل: Best Seller')
                                ->columnSpan(1),

                            Forms\Components\TextInput::make('position')
                                ->label('الترتيب')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ]),

                        Forms\Components\Textarea::make('summary')
                            ->label('الملخص')
                            ->rows(2)
                            ->maxLength(300)
                            ->hint('يظهر في بطاقة المنتج وصفحة التفاصيل — اجعله مقنعاً'),

                        Forms\Components\RichEditor::make('description')
                            ->label('الوصف الكامل')
                            ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'heading', 'redo', 'undo'])
                            ->columnSpanFull(),
                    ]),

                    // ── Tab 2: Specs ────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('المواصفات')->icon('heroicon-o-list-bullet')->schema([
                        Forms\Components\KeyValue::make('specs')
                            ->label('مواصفات المنتج')
                            ->keyLabel('المواصفة / الخاصية')
                            ->valueLabel('القيمة')
                            ->addButtonLabel('إضافة مواصفة')
                            ->reorderable()
                            ->columnSpanFull()
                            ->hint('أدخل كل مواصفة وقيمتها — ستظهر في جدول المواصفات وشريط الأرقام البارزة'),
                    ]),

                    // ── Tab 3: Media ────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('الوسائط')->icon('heroicon-o-photo')->schema([
                        SpatieMediaLibraryFileUpload::make('main')
                            ->label('الصورة الرئيسية')
                            ->collection('main')
                            ->image()
                            ->imageEditor()
                            ->hint('تُستخدم في صفحة التفاصيل (1400px) وبطاقات القائمة (800px)')
                            ->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('معرض الصور')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->hint('صور إضافية تظهر كـ thumbnails قابلة للنقر في معرض الصور')
                            ->columnSpanFull(),
                    ]),

                    // ── Tab 4: SEO ───────────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('SEO')->icon('heroicon-o-magnifying-glass')->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('عنوان SEO')
                            ->maxLength(120)
                            ->hint('مثالي: 55-65 حرف'),

                        Forms\Components\Textarea::make('seo_description')
                            ->label('وصف SEO')
                            ->rows(3)
                            ->maxLength(170)
                            ->hint('مثالي: 150-160 حرف'),
                    ]),

                    // ── Tab 5: Settings ──────────────────────────────────────
                    Forms\Components\Tabs\Tab::make('الإعدادات')->icon('heroicon-o-cog')->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->label('مفعَّل')
                                ->default(true)
                                ->helperText('أوقف هذا الزر لإخفاء المنتج من الموقع'),

                            Forms\Components\Toggle::make('is_featured')
                                ->label('منتج مميز')
                                ->helperText('يظهر في القسم المميز بالموقع'),
                        ]),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (الرابط)')
                            ->hint('⚠️ تغيير الـ slug يكسر الروابط القديمة')
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->rule('regex:/^[a-z0-9\-]+$/')
                            ->helperText('حروف إنجليزية صغيرة وأرقام وشرطات فقط'),
                    ]),

                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('main')
                    ->collection('main')
                    ->square()
                    ->size(52)
                    ->label(''),

                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('badge')
                    ->label('Badge')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('position')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('مفعَّل')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('آخر تعديل')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('position')
            ->reorderable('position')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('الحالة'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('المميزة'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelationManagers(): array
    {
        return [
            ActivityRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
