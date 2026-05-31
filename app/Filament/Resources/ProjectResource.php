<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon  = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'المشاريع والمعرض';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $label           = 'مشروع';
    protected static ?string $pluralLabel     = 'المشاريع';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([

            Tabs::make('project_tabs')->tabs([

                // ── Tab 1: الأساسيات ──────────────────────────────────────────
                Tabs\Tab::make('الأساسيات')->schema([

                    Forms\Components\TextInput::make('title')
                        ->label('عنوان المشروع')
                        ->required()
                        ->maxLength(200)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, Forms\Set $set, $get, $livewire) {
                            if (empty($get('slug')) && isset($livewire->activeLocale) && $livewire->activeLocale === 'en') {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->extraInputAttributes(fn ($livewire) => [
                            'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                        ])
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('client_name')
                            ->label('اسم العميل')
                            ->extraInputAttributes(fn ($livewire) => [
                                'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                            ]),

                        Forms\Components\TextInput::make('location_code')
                            ->label('الموقع الجغرافي')
                            ->placeholder('دمياط، مصر')
                            ->maxLength(150),
                    ]),

                    Forms\Components\Textarea::make('summary')
                        ->label('وصف قصير (للبطاقة)')
                        ->rows(2)
                        ->extraInputAttributes(fn ($livewire) => [
                            'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                        ])
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('description')
                        ->label('الوصف الكامل')
                        ->rows(5)
                        ->extraInputAttributes(fn ($livewire) => [
                            'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                        ])
                        ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                        ->columnSpanFull(),

                ])->columns(1),

                // ── Tab 2: التصنيف والإحصاء ──────────────────────────────────
                Tabs\Tab::make('التصنيف والإحصاء')->schema([

                    Grid::make(2)->schema([
                        Forms\Components\Select::make('category')
                            ->label('الفئة')
                            ->options([
                                'layer'      => 'إنتاج البيض',
                                'broiler'    => 'التسمين',
                                'commercial' => 'تجاري كبير',
                                'machinery'  => 'آلات ومعدّات',
                            ])
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('year')
                            ->label('السنة')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2099),
                    ]),

                    Grid::make(3)->schema([
                        Forms\Components\TextInput::make('capacity_birds')
                            ->label('سعة الطيور')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('barns_count')
                            ->label('عدد العنابر')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('area_m2')
                            ->label('المساحة (م²)')
                            ->numeric()
                            ->minValue(0),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\DatePicker::make('completion_date')
                            ->label('تاريخ الإنجاز')
                            ->displayFormat('Y-m-d'),
                        Forms\Components\TextInput::make('duration_months')
                            ->label('مدة التنفيذ (شهر)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(120),
                    ]),

                    Forms\Components\TextInput::make('video_url')
                        ->label('رابط الفيديو (YouTube / Vimeo)')
                        ->url()
                        ->placeholder('https://youtu.be/...')
                        ->maxLength(500)
                        ->columnSpanFull(),

                ]),

                // ── Tab 3: الصور والوسائط ────────────────────────────────────
                Tabs\Tab::make('الصور والوسائط')->schema([

                    Section::make('الصورة الرئيسية')->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->label('صورة الغلاف')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '4:3'])
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120),
                    ]),

                    Section::make('معرض الصور')->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->label('صور إضافية')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->maxFiles(20),
                    ]),

                    Section::make('فيديو مرفوع (اختياري)')->schema([
                        SpatieMediaLibraryFileUpload::make('video_file')
                            ->collection('video')
                            ->label('ملف الفيديو (MP4)')
                            ->acceptedFileTypes(['video/mp4', 'video/webm'])
                            ->maxSize(102400),
                    ]),

                    Section::make('مخططات التصميم (Blueprints)')->schema([
                        SpatieMediaLibraryFileUpload::make('blueprints')
                            ->collection('blueprint')
                            ->label('مخططات المشروع')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                            ->maxSize(10240)
                            ->maxFiles(15)
                            ->helperText('صور CAD / مخططات / رسومات هندسية'),
                    ]),

                ]),

                // ── Tab 4: الإعدادات والـ SEO ─────────────────────────────────
                Tabs\Tab::make('الإعدادات')->schema([

                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('الـ Slug (URL)')
                            ->required()
                            ->unique(Project::class, 'slug', ignoreRecord: true)
                            ->helperText('يُولَّد تلقائياً من عنوان المشروع بالإنجليزية عند الحفظ')
                            ->extraInputAttributes(['dir' => 'ltr'])
                            ->maxLength(120),

                        Forms\Components\TextInput::make('position')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميَّز على الرئيسية')
                            ->default(false),
                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ]),

                ]),

            ])->columnSpan('full'),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label('')
                    ->square()
                    ->size(56),

                Tables\Columns\TextColumn::make('title')
                    ->label('المشروع')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Project $r) => $r->location_code ?? ''),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('الفئة')
                    ->formatStateUsing(fn ($s) => Project::CATEGORIES[$s][app()->getLocale()] ?? $s)
                    ->colors([
                        'success' => 'layer',
                        'warning' => 'broiler',
                        'info'    => 'commercial',
                        'gray'    => 'machinery',
                    ]),

                Tables\Columns\TextColumn::make('capacity_birds')
                    ->label('الطيور')
                    ->formatStateUsing(fn ($v) => $v ? number_format($v / 1000, 0) . 'K' : '—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('السنة')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميَّز')
                    ->boolean(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('نشط'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('الفئة')
                    ->options([
                        'layer'      => 'إنتاج البيض',
                        'broiler'    => 'التسمين',
                        'commercial' => 'تجاري كبير',
                        'machinery'  => 'آلات ومعدّات',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')->label('المميَّزة فقط'),
                Tables\Filters\TernaryFilter::make('is_active')->label('النشطة فقط'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('position')
            ->reorderable('position');
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\ProjectResource\RelationManagers\PhasesRelationManager::class,
            \App\Filament\Resources\ProjectResource\RelationManagers\StagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
