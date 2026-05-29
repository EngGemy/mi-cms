<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class GeneralSettingsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-paint-brush';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 10;
    protected static string  $view            = 'filament.pages.general-settings';
    protected static ?string $title           = 'الموقع والهوية';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(GeneralSettings::class);
        $this->data = [
            'site_name'    => $s->site_name,
            'logo_path'    => $s->logo_path    ? [$s->logo_path] : [],
            'favicon_path' => $s->favicon_path ? [$s->favicon_path] : [],
            'catalog_pdf_url' => $s->catalog_pdf_url,
            'facebook_url' => $s->facebook_url,
            'instagram_url'=> $s->instagram_url,
            'youtube_url'  => $s->youtube_url,
            'twitter_url'  => $s->twitter_url,
            'linkedin_url' => $s->linkedin_url,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('الهوية البصرية')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('اسم الموقع')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('logo_path')
                            ->label('شعار الموقع (Logo)')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->imagePreviewHeight('80')
                            ->maxSize(2048)
                            ->helperText('PNG أو SVG بخلفية شفافة مفضل. الحد الأقصى 2MB.'),
                        Forms\Components\FileUpload::make('favicon_path')
                            ->label('أيقونة المتصفح (Favicon)')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->imagePreviewHeight('48')
                            ->maxSize(512)
                            ->helperText('ICO أو PNG بحجم 32×32 أو 64×64.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('الكتالوج')
                    ->schema([
                        Forms\Components\TextInput::make('catalog_pdf_url')
                            ->label('رابط كتالوج PDF')
                            ->url()
                            ->placeholder('https://example.com/catalog.pdf')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('روابط التواصل الاجتماعي')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook')->url()->placeholder('https://facebook.com/...'),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram')->url()->placeholder('https://instagram.com/...'),
                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube')->url()->placeholder('https://youtube.com/...'),
                        Forms\Components\TextInput::make('twitter_url')
                            ->label('X (Twitter)')->url()->placeholder('https://x.com/...'),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn')->url()->placeholder('https://linkedin.com/...'),
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
        $s = app(GeneralSettings::class);
        $s->site_name       = $this->data['site_name'] ?? null;
        $s->logo_path       = is_array($this->data['logo_path']) ? ($this->data['logo_path'][0] ?? null) : ($this->data['logo_path'] ?? null);
        $s->favicon_path    = is_array($this->data['favicon_path']) ? ($this->data['favicon_path'][0] ?? null) : ($this->data['favicon_path'] ?? null);
        $s->catalog_pdf_url = $this->data['catalog_pdf_url'] ?? null;
        $s->facebook_url    = $this->data['facebook_url'] ?? null;
        $s->instagram_url   = $this->data['instagram_url'] ?? null;
        $s->youtube_url     = $this->data['youtube_url'] ?? null;
        $s->twitter_url     = $this->data['twitter_url'] ?? null;
        $s->linkedin_url    = $this->data['linkedin_url'] ?? null;
        $s->save();

        Notification::make()->title('تم حفظ إعدادات الموقع')->success()->send();
    }
}
