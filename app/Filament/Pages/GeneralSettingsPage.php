<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class GeneralSettingsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 10;
    protected static string  $view            = 'filament.pages.general-settings';
    protected static ?string $title           = 'الإعدادات العامة';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(GeneralSettings::class);
        $this->data = [
            'catalog_pdf_url' => $settings->catalog_pdf_url,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('catalog_pdf_url')
                    ->label('رابط كتالوج PDF')
                    ->url()
                    ->placeholder('https://example.com/catalog.pdf')
                    ->helperText('أدخل الرابط المباشر لملف الكتالوج PDF. يمكن رفع الملف يدوياً وإدخال رابطه هنا.')
                    ->columnSpanFull(),
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
        $settings = app(GeneralSettings::class);
        $settings->catalog_pdf_url = $this->data['catalog_pdf_url'] ?? null;
        $settings->save();

        Notification::make()
            ->title('تم حفظ الإعدادات بنجاح')
            ->success()
            ->send();
    }
}
