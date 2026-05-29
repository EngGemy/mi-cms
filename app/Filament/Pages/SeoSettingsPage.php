<?php

namespace App\Filament\Pages;

use App\Settings\SeoSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SeoSettingsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-magnifying-glass-circle';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 30;
    protected static string  $view            = 'filament.pages.seo-settings';
    protected static ?string $title           = 'الميتا وتحسين محركات البحث';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(SeoSettings::class);
        $this->data = [
            'meta_title_ar'        => $s->meta_title_ar,
            'meta_title_en'        => $s->meta_title_en,
            'meta_description_ar'  => $s->meta_description_ar,
            'meta_description_en'  => $s->meta_description_en,
            'og_image_path'        => $s->og_image_path ? [$s->og_image_path] : [],
            'google_analytics_id'  => $s->google_analytics_id,
            'google_tag_manager_id'=> $s->google_tag_manager_id,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('عناوين الصفحة الافتراضية')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title_ar')
                            ->label('عنوان الميتا (عربي)')
                            ->maxLength(70)
                            ->helperText('الحد الأمثل 60 حرفاً'),
                        Forms\Components\TextInput::make('meta_title_en')
                            ->label('Meta Title (English)')
                            ->maxLength(70)
                            ->helperText('Optimal: 60 characters'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('وصف الميتا الافتراضي')
                    ->schema([
                        Forms\Components\Textarea::make('meta_description_ar')
                            ->label('وصف الميتا (عربي)')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('الحد الأمثل 155 حرفاً'),
                        Forms\Components\Textarea::make('meta_description_en')
                            ->label('Meta Description (English)')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Optimal: 155 characters'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('صورة Open Graph الافتراضية')
                    ->schema([
                        Forms\Components\FileUpload::make('og_image_path')
                            ->label('صورة OG (1200×630 px مفضل)')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->imagePreviewHeight('120')
                            ->maxSize(4096)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('تتبع الزوار')
                    ->schema([
                        Forms\Components\TextInput::make('google_analytics_id')
                            ->label('معرّف Google Analytics')
                            ->placeholder('G-XXXXXXXXXX'),
                        Forms\Components\TextInput::make('google_tag_manager_id')
                            ->label('معرّف Google Tag Manager')
                            ->placeholder('GTM-XXXXXXX'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('حفظ الإعدادات')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $s = app(SeoSettings::class);
        $s->meta_title_ar         = $this->data['meta_title_ar']         ?? null;
        $s->meta_title_en         = $this->data['meta_title_en']         ?? null;
        $s->meta_description_ar   = $this->data['meta_description_ar']   ?? null;
        $s->meta_description_en   = $this->data['meta_description_en']   ?? null;
        $s->og_image_path         = is_array($this->data['og_image_path']) ? ($this->data['og_image_path'][0] ?? null) : ($this->data['og_image_path'] ?? null);
        $s->google_analytics_id   = $this->data['google_analytics_id']   ?? null;
        $s->google_tag_manager_id = $this->data['google_tag_manager_id'] ?? null;
        $s->save();

        Notification::make()->title('تم حفظ إعدادات SEO')->success()->send();
    }
}
