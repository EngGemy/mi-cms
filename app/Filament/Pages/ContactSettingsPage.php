<?php

namespace App\Filament\Pages;

use App\Settings\ContactSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 20;
    protected static ?string $navigationLabel = 'التواصل والعنوان';
    protected static string  $view            = 'filament.pages.contact-settings';
    protected static ?string $title           = 'التواصل والعنوان';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(ContactSettings::class);

        $this->form->fill([
            'phone_primary' => $s->phone_primary,
            'phone_support' => $s->phone_support,
            'whatsapp'      => $s->whatsapp,
            'email'         => $s->email,
            'inbox'         => $s->inbox,
            'address_ar'    => $s->address_ar,
            'address_en'    => $s->address_en,
        ]);
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
        $data = $this->form->getState();

        $s = app(ContactSettings::class);
        $s->phone_primary = $data['phone_primary'] ?? null;
        $s->phone_support = $data['phone_support'] ?? null;
        $s->whatsapp      = $data['whatsapp'] ?? null;
        $s->email         = $data['email'] ?? null;
        $s->inbox         = $data['inbox'] ?? null;
        $s->address_ar    = $data['address_ar'] ?? null;
        $s->address_en    = $data['address_en'] ?? null;
        $s->save();

        Notification::make()->title('تم الحفظ')->success()->send();
    }
}
