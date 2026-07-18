<?php

namespace App\Filament\Pages;

use App\Settings\SeoSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SeoSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-magnifying-glass-circle';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 30;
    protected static ?string $navigationLabel = 'SEO والتحليلات';
    protected static string  $view            = 'filament.pages.seo-settings';
    protected static ?string $title           = 'SEO والتحليلات';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(SeoSettings::class);

        $this->form->fill([
            'meta_title_ar'         => $s->meta_title_ar,
            'meta_title_en'         => $s->meta_title_en,
            'meta_description_ar'   => $s->meta_description_ar,
            'meta_description_en'   => $s->meta_description_en,
            'og_image_path'         => $s->og_image_path ? [$s->og_image_path] : [],
            'google_analytics_id'   => $s->google_analytics_id,
            'google_tag_manager_id' => $s->google_tag_manager_id,
        ]);
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
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->image()
                            ->maxSize(2048)
                            ->imagePreviewHeight('120')
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
        $data = $this->form->getState();

        $s = app(SeoSettings::class);
        $s->meta_title_ar         = $data['meta_title_ar'] ?? null;
        $s->meta_title_en         = $data['meta_title_en'] ?? null;
        $s->meta_description_ar   = $data['meta_description_ar'] ?? null;
        $s->meta_description_en   = $data['meta_description_en'] ?? null;
        $s->og_image_path         = is_array($data['og_image_path'] ?? null) ? ($data['og_image_path'][0] ?? null) : ($data['og_image_path'] ?? null);
        $s->google_analytics_id   = $data['google_analytics_id'] ?? null;
        $s->google_tag_manager_id = $data['google_tag_manager_id'] ?? null;
        $s->save();

        $this->data['og_image_path'] = $s->og_image_path ? [$s->og_image_path] : [];

        Notification::make()->title('تم الحفظ')->success()->send();
    }
}
