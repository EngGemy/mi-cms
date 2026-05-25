<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\ProjectPhase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Section;

class PhasesRelationManager extends RelationManager
{
    protected static string $relationship = 'phases';
    protected static ?string $title       = 'بنود/مراحل التنفيذ';
    protected static ?string $label       = 'بند';
    protected static ?string $pluralLabel = 'البنود';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('title.ar')
                    ->label('العنوان (عربي)')
                    ->required()->maxLength(150),

                Forms\Components\TextInput::make('title.en')
                    ->label('Title (English)')
                    ->required()->maxLength(150),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Textarea::make('description.ar')
                    ->label('الوصف (عربي)')->rows(3),

                Forms\Components\Textarea::make('description.en')
                    ->label('Description (English)')->rows(3),
            ]),

            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('icon')
                    ->label('أيقونة Lucide')
                    ->placeholder('e.g. hammer, zap, settings')
                    ->maxLength(50)
                    ->helperText('اسم أيقونة من مكتبة Lucide'),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'completed'   => 'مكتمل',
                        'in_progress' => 'جارٍ التنفيذ',
                        'planned'     => 'مخطط',
                    ])
                    ->default('completed')
                    ->required(),

                Forms\Components\TextInput::make('position')
                    ->label('الترتيب')
                    ->numeric()
                    ->default(0),
            ]),

            Forms\Components\TextInput::make('video_url')
                ->label('رابط فيديو (YouTube / Vimeo)')
                ->url()
                ->placeholder('https://youtu.be/...')
                ->maxLength(500)
                ->helperText('بديل عن رفع ملف الفيديو مباشرة')
                ->columnSpanFull(),

            Section::make('وسائط المرحلة')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->label('صورة المرحلة')
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120),

                SpatieMediaLibraryFileUpload::make('video')
                    ->collection('video')
                    ->label('ملف فيديو (MP4)')
                    ->acceptedFileTypes(['video/mp4', 'video/webm'])
                    ->maxSize(102400)
                    ->helperText('الأولوية للرابط إذا أُدخل رابط فيديو أعلاه'),
            ])->columns(2),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->defaultSort('position')
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label('#')
                    ->sortable()
                    ->width(40),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label('صورة')
                    ->square()
                    ->size(48)
                    ->defaultImageUrl(fn () => ''),

                Tables\Columns\TextColumn::make('title')
                    ->label('البند')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn ($s) => ProjectPhase::STATUSES[$s][app()->getLocale()] ?? $s)
                    ->colors([
                        'success' => 'completed',
                        'warning' => 'in_progress',
                        'gray'    => 'planned',
                    ]),

                Tables\Columns\IconColumn::make('has_video')
                    ->label('فيديو')
                    ->boolean()
                    ->getStateUsing(fn (ProjectPhase $record) => $record->hasVideo()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('إضافة بند'),
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
}
