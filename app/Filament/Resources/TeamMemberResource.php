<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TeamMemberResource extends Resource
{
    use Translatable;

    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'الفريق';
    protected static ?string $label = 'عضو الفريق';
    protected static ?string $pluralLabel = 'الفريق';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('الهوية والمنصب')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\TextInput::make('role')
                    ->label('الدور / المنصب')
                    ->required()
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ]),

                Forms\Components\Textarea::make('description')
                    ->label('نبذة قصيرة')
                    ->rows(3)
                    ->extraInputAttributes(fn ($livewire) => [
                        'dir' => isset($livewire->activeLocale) && $livewire->activeLocale === 'en' ? 'ltr' : 'rtl',
                    ])
                    ->helperText('مطلوب بالعربية — الإنجليزية اختيارية')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('الصورة والهوية البصرية')->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('الصورة الشخصية')
                    ->collection('avatar')
                    ->image()
                    ->imageEditor()
                    ->avatar(),

                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('initials')
                        ->label('الأحرف الأولى')
                        ->maxLength(8)
                        ->helperText('تظهر عند غياب الصورة'),
                    Forms\Components\ColorPicker::make('badge_color')
                        ->label('لون الشارة'),
                ]),
            ])->columns(2),

            Forms\Components\Section::make('بيانات التواصل')->schema([
                Forms\Components\TextInput::make('phone')
                    ->label('الهاتف')
                    ->tel(),
                Forms\Components\TextInput::make('whatsapp')
                    ->label('واتساب'),
                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email(),
            ])->columns(3),

            Forms\Components\Section::make('الترتيب والحالة')->schema([
                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_featured')
                    ->label('مميز'),
                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                ->collection('avatar')
                ->circular()
                ->label(''),
            Tables\Columns\TextColumn::make('name')
                ->label('الاسم')
                ->searchable(),
            Tables\Columns\TextColumn::make('role')
                ->label('المنصب'),
            Tables\Columns\TextColumn::make('phone')
                ->label('الهاتف'),
            Tables\Columns\IconColumn::make('is_featured')
                ->label('مميز')
                ->boolean(),
            Tables\Columns\IconColumn::make('is_active')
                ->label('نشط')
                ->boolean(),
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
