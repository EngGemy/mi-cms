<?php

namespace App\Filament\Pages;

use App\Settings\CalculatorSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class CalculatorSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'الإعدادات';
    protected static ?int    $navigationSort  = 40;
    protected static string  $view            = 'filament.pages.calculator-settings';
    protected static ?string $title           = 'أسعار الحاسبة التقديرية';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(CalculatorSettings::class);

        $this->form->fill([
            'concrete_m2'    => $s->concrete_m2,
            'steel_m2'       => $s->steel_m2,
            'walls_m2'       => $s->walls_m2,
            'tanks_fixed'    => $s->tanks_fixed,
            'bird_cost'      => $s->bird_cost,
            'rear_fan'       => $s->rear_fan,
            'cooling_factor' => $s->cooling_factor,
            'window'         => $s->window,
            'side_fan'       => $s->side_fan,
            'heater'         => $s->heater,
            'control_fixed'  => $s->control_fixed,
            'bird_weight_kg' => $s->bird_weight_kg,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('أسعار البناء (لكل م²) — جنيه مصري')
                    ->schema([
                        Forms\Components\TextInput::make('concrete_m2')
                            ->label('سعر الخرسانة / م²')
                            ->numeric()->minValue(0)->step(100),
                        Forms\Components\TextInput::make('steel_m2')
                            ->label('سعر الحديد / م²')
                            ->numeric()->minValue(0)->step(100),
                        Forms\Components\TextInput::make('walls_m2')
                            ->label('سعر الجدران / م²')
                            ->numeric()->minValue(0)->step(100),
                        Forms\Components\TextInput::make('tanks_fixed')
                            ->label('تكلفة الخزانات (ثابتة)')
                            ->numeric()->minValue(0)->step(1000),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('البطاريات والطيور')
                    ->schema([
                        Forms\Components\TextInput::make('bird_cost')
                            ->label('تكلفة الطائر الواحد (جنيه)')
                            ->numeric()->minValue(0)->step(10),
                        Forms\Components\TextInput::make('bird_weight_kg')
                            ->label('وزن الطائر (كجم) — للحساب الداخلي')
                            ->numeric()->minValue(0)->step(0.1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('المعدات والتجهيزات')
                    ->schema([
                        Forms\Components\TextInput::make('rear_fan')
                            ->label('سعر المروحة الخلفية')
                            ->numeric()->minValue(0)->step(1000),
                        Forms\Components\TextInput::make('cooling_factor')
                            ->label('معامل التبريد (لكل مروحة خلفية)')
                            ->numeric()->minValue(0)->step(100),
                        Forms\Components\TextInput::make('window')
                            ->label('سعر الشباك الواحد')
                            ->numeric()->minValue(0)->step(100),
                        Forms\Components\TextInput::make('side_fan')
                            ->label('سعر المروحة الجانبية')
                            ->numeric()->minValue(0)->step(1000),
                        Forms\Components\TextInput::make('heater')
                            ->label('سعر السخّان الواحد')
                            ->numeric()->minValue(0)->step(1000),
                        Forms\Components\TextInput::make('control_fixed')
                            ->label('تكلفة لوحة التحكم (ثابتة)')
                            ->numeric()->minValue(0)->step(1000),
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

        $s = app(CalculatorSettings::class);
        $s->concrete_m2    = (float) ($data['concrete_m2'] ?? 0);
        $s->steel_m2       = (float) ($data['steel_m2'] ?? 0);
        $s->walls_m2       = (float) ($data['walls_m2'] ?? 0);
        $s->tanks_fixed    = (float) ($data['tanks_fixed'] ?? 0);
        $s->bird_cost      = (float) ($data['bird_cost'] ?? 0);
        $s->rear_fan       = (float) ($data['rear_fan'] ?? 0);
        $s->cooling_factor = (float) ($data['cooling_factor'] ?? 0);
        $s->window         = (float) ($data['window'] ?? 0);
        $s->side_fan       = (float) ($data['side_fan'] ?? 0);
        $s->heater         = (float) ($data['heater'] ?? 0);
        $s->control_fixed  = (float) ($data['control_fixed'] ?? 0);
        $s->bird_weight_kg = (float) ($data['bird_weight_kg'] ?? 2.1);
        $s->save();

        Notification::make()->title('تم الحفظ')->success()->send();
    }
}
