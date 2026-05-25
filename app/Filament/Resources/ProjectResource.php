<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
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
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon  = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'المشاريع والمعرض';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $label           = 'مشروع';
    protected static ?string $pluralLabel     = 'المشاريع';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Tabs::make('project_tabs')->tabs([

                // ── Tab 1: الأساسيات ─────────────────────────────────────────
                Tabs\Tab::make('الأساسيات')->schema([

                    Grid::make(2)->schema([

                        Forms\Components\TextInput::make('title.ar')
                            ->label('العنوان (عربي)')
                            ->required()
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                                // Auto-generate slug from EN title if slug is empty
                            }),

                        Forms\Components\TextInput::make('title.en')
                            ->label('Title (English)')
                            ->required()
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                                if (empty($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('client_name.ar')->label('اسم العميل (عربي)'),
                        Forms\Components\TextInput::make('client_name.en')->label('Client Name (English)'),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\Textarea::make('summary.ar')->label('وصف قصير (عربي) — للبطاقة')->rows(2),
                        Forms\Components\Textarea::make('summary.en')->label('Short Summary (English) — for Card')->rows(2),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\Textarea::make('description.ar')->label('الوصف الكامل (عربي)')->rows(5),
                        Forms\Components\Textarea::make('description.en')->label('Full Description (English)')->rows(5),
                    ]),

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

                        Forms\Components\TextInput::make('location_code')
                            ->label('الموقع')
                            ->placeholder('دمياط، مصر')
                            ->maxLength(150),
                    ]),

                    Grid::make(3)->schema([

                        Forms\Components\TextInput::make('capacity_birds')
                            ->label('سعة الطيور')
                            ->numeric()->minValue(0),

                        Forms\Components\TextInput::make('barns_count')
                            ->label('عدد العنابر')
                            ->numeric()->minValue(0),

                        Forms\Components\TextInput::make('area_m2')
                            ->label('المساحة (م²)')
                            ->numeric()->minValue(0),
                    ]),

                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('السنة')
                            ->numeric()->minValue(2000)->maxValue(2099),
                        Forms\Components\DatePicker::make('completion_date')
                            ->label('تاريخ الإنجاز')
                            ->displayFormat('Y-m-d'),

                        Forms\Components\TextInput::make('duration_months')
                            ->label('مدة التنفيذ (شهر)')
                            ->numeric()->minValue(0)->maxValue(120),
                    ]),

                    Forms\Components\TextInput::make('video_url')
                        ->label('رابط الفيديو (YouTube / Vimeo)')
                        ->url()
                        ->placeholder('https://youtu.be/...')
                        ->maxLength(500),

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

                ]),

                // ── Tab 4: الإعدادات ──────────────────────────────────────────
                Tabs\Tab::make('الإعدادات والـ SEO')->schema([

                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('الـ Slug (URL)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('يُولَّد تلقائياً من عنوان المشروع بالإنجليزية.')
                            ->maxLength(120),

                        Forms\Components\TextInput::make('position')
                            ->label('الترتيب')
                            ->numeric()->default(0),
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
                    ->size(56)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),

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

                Tables\Columns\TextColumn::make('year')->label('السنة')->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميَّز')->boolean(),

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
            RelationManagers\PhasesRelationManager::class,
            RelationManagers\StagesRelationManager::class,
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
