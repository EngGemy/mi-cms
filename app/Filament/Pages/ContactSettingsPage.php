<?php

namespace App\Filament\Pages;

use App\Settings\ContactSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactSettingsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 20;
    protected static string  $view            = 'filament.pages.contact-settings';
    protected static ?string $title           = 'بيانات التواصل والعنوان';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(ContactSettings::class);
        $this->data = [
            'phone_primary' => $s->phone_primary,
            'phone_support' => $s->phone_support,
            'whatsapp'      => $s->whatsapp,
            'email'         => $s->email,
            'inbox'         => $s->inbox,
            'address_ar'    => $s->address_ar,
            'address_en'    => $s->address_en,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('أرقام الهاتف')
                    ->schema([
                        Forms\Components\TextInput::make('phone_primary')
                            ->label('الهاتف الرئيسي')
                            ->tel()
                            ->placeholder('+201030003186'),
                        Forms\Components\TextInput::make('phone_support')
                            ->label('هاتف الدعم')
                            ->tel()
                            ->placeholder('+201030003186'),
                        Forms\Components\TextInput::make('whatsapp')
                            ->label('واتساب (الرقم بدون +)')
                            ->placeholder('201030003186'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('البريد الإلكتروني')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('البريد العام')
                            ->email()
                            ->placeholder('info@mi-poultry.com'),
                        Forms\Components\TextInput::make('inbox')
                            ->label('صندوق رسائل التواصل')
                            ->email()
                            ->placeholder('sales@mi-poultry.com'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('العنوان')
                    ->schema([
                        Forms\Components\TextInput::make('address_ar')
                            ->label('العنوان بالعربية')
                            ->placeholder('دمياط · مصر'),
                        Forms\Components\TextInput::make('address_en')
                            ->label('العنوان بالإنجليزية')
                            ->placeholder('Damietta · Egypt'),
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
        $s = app(ContactSettings::class);
        $s->phone_primary = $this->data['phone_primary'] ?? null;
        $s->phone_support = $this->data['phone_support'] ?? null;
        $s->whatsapp      = $this->data['whatsapp']      ?? null;
        $s->email         = $this->data['email']         ?? null;
        $s->inbox         = $this->data['inbox']         ?? null;
        $s->address_ar    = $this->data['address_ar']    ?? null;
        $s->address_en    = $this->data['address_en']    ?? null;
        $s->save();

        Notification::make()->title('تم حفظ بيانات التواصل')->success()->send();
    }
}
