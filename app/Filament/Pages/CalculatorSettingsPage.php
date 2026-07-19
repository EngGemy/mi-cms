<?php

namespace App\Filament\Pages;

use App\Settings\CalculatorSettings;
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
    protected static ?string $navigationLabel = 'إعدادات الحاسبة';
    protected static string  $view            = 'filament.pages.calculator-settings';
    protected static ?string $title           = 'إعدادات حاسبة السعة';
    protected static ?string $slug            = 'calculator-settings-page';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(CalculatorSettings::class);

        $this->form->fill([
            // Capacity engineering
            'bird_weight_kg' => $s->bird_weight_kg,
            'service_length' => $s->service_length,
            'fan_capacity_kg' => $s->fan_capacity_kg,
            'cooling_pad_meters_per_fan' => $s->cooling_pad_meters_per_fan,
            'layer_nest_module_m' => $s->layer_nest_module_m,
            'width_lines_map' => $this->mapToKeyValue($s->width_lines_map ?? []),
            'broiler_weight_birds_map' => $this->mapToKeyValue($s->broiler_weight_birds_map ?? []),

            // Defaults & bounds
            'default_length' => $s->default_length,
            'default_width' => $s->default_width,
            'default_height' => $s->default_height,
            'default_floors' => $s->default_floors,
            'default_lines' => $s->default_lines,
            'min_length' => $s->min_length,
            'max_length' => $s->max_length,
            'min_width' => $s->min_width,
            'max_width' => $s->max_width,
            'min_height' => $s->min_height,
            'max_height' => $s->max_height,
            'floors_options' => array_map('strval', $s->floors_options ?? [1, 2, 3, 4, 5]),
            'lines_options' => array_map('strval', $s->lines_options ?? [3, 4, 5, 6]),

            // Legacy prices (optional)
            'concrete_m2' => $s->concrete_m2,
            'steel_m2' => $s->steel_m2,
            'walls_m2' => $s->walls_m2,
            'tanks_fixed' => $s->tanks_fixed,
            'bird_cost' => $s->bird_cost,
            'rear_fan' => $s->rear_fan,
            'cooling_factor' => $s->cooling_factor,
            'window' => $s->window,
            'side_fan' => $s->side_fan,
            'heater' => $s->heater,
            'control_fixed' => $s->control_fixed,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معاملات السعة الهندسية')
                    ->description('تتحكم مباشرة في حساب عدد الطيور والأعشاش والمخرجات الفنية على الموقع.')
                    ->schema([
                        Forms\Components\TextInput::make('bird_weight_kg')
                            ->label('وزن الطائر الافتراضي (كجم)')
                            ->numeric()->minValue(0.5)->maxValue(5)->step(0.05)
                            ->required()
                            ->helperText('يُستخدم لاختيار عدد الطيور/العش من جدول الأوزان.'),
                        Forms\Components\TextInput::make('service_length')
                            ->label('طول منطقة الخدمات (م)')
                            ->numeric()->minValue(0)->maxValue(50)->step(0.5)
                            ->required()
                            ->helperText('يُطرح من الطول الكلي لحساب الطول الفعّال.'),
                        Forms\Components\TextInput::make('fan_capacity_kg')
                            ->label('سعة المروحة الخلفية (كجم)')
                            ->numeric()->minValue(100)->step(100)
                            ->required(),
                        Forms\Components\TextInput::make('cooling_pad_meters_per_fan')
                            ->label('أمتار التبريد لكل مروحة')
                            ->numeric()->minValue(0.1)->step(0.1)
                            ->required(),
                        Forms\Components\TextInput::make('layer_nest_module_m')
                            ->label('وحدة عش البياض (م)')
                            ->numeric()->minValue(0.1)->step(0.05)
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('جدول العرض → عدد الخطوط')
                    ->description('عند اختيار عرض معيّن في الحاسبة يُقترح عدد الخطوط تلقائياً.')
                    ->schema([
                        Forms\Components\KeyValue::make('width_lines_map')
                            ->label('العرض (م) → الخطوط')
                            ->keyLabel('العرض بالمتر')
                            ->valueLabel('عدد الخطوط')
                            ->reorderable()
                            ->addActionLabel('إضافة عرض')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('جدول الوزن → طيور لكل عش')
                    ->description('وزن الطائر (كجم) يحدد كم طائر في العش الواحد.')
                    ->schema([
                        Forms\Components\KeyValue::make('broiler_weight_birds_map')
                            ->label('الوزن (كجم) → طيور/عش')
                            ->keyLabel('وزن الطائر كجم')
                            ->valueLabel('عدد الطيور في العش')
                            ->reorderable()
                            ->addActionLabel('إضافة وزن')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('القيم الافتراضية للحاسبة')
                    ->description('تظهر كقيم ابتدائية للزائر عند فتح الحاسبة.')
                    ->schema([
                        Forms\Components\TextInput::make('default_length')->label('الطول الافتراضي (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('default_width')->label('العرض الافتراضي (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('default_height')->label('الارتفاع الافتراضي (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('default_floors')->label('عدد الأدوار الافتراضي')->numeric()->integer()->required(),
                        Forms\Components\TextInput::make('default_lines')->label('عدد الخطوط الافتراضي')->numeric()->integer()->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('حدود الإدخال على الموقع')
                    ->description('الحد الأدنى/الأقصى الذي يمكن للزائر اختياره في السلايدرز.')
                    ->schema([
                        Forms\Components\TextInput::make('min_length')->label('أقل طول (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('max_length')->label('أعلى طول (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('min_width')->label('أقل عرض (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('max_width')->label('أعلى عرض (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('min_height')->label('أقل ارتفاع (م)')->numeric()->required(),
                        Forms\Components\TextInput::make('max_height')->label('أعلى ارتفاع (م)')->numeric()->required(),
                        Forms\Components\TagsInput::make('floors_options')
                            ->label('خيارات عدد الأدوار')
                            ->placeholder('اضغط Enter بعد كل رقم')
                            ->helperText('مثال: 1 ثم 2 ثم 3…')
                            ->columnSpan(1),
                        Forms\Components\TagsInput::make('lines_options')
                            ->label('خيارات عدد الخطوط')
                            ->placeholder('اضغط Enter بعد كل رقم')
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('أسعار تقديرية داخلية (اختياري / قديم)')
                    ->description('لا تظهر للزائر حالياً — محفوظة للحسابات الداخلية إن لزم.')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('concrete_m2')->label('خرسانة / م²')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('steel_m2')->label('حديد / م²')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('walls_m2')->label('جدران / م²')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('tanks_fixed')->label('خزانات ثابتة')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('bird_cost')->label('تكلفة الطائر')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('rear_fan')->label('مروحة خلفية')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('cooling_factor')->label('معامل تبريد')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('window')->label('شباك')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('side_fan')->label('مروحة جانبية')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('heater')->label('سخّان')->numeric()->minValue(0),
                        Forms\Components\TextInput::make('control_fixed')->label('لوحة تحكم ثابتة')->numeric()->minValue(0),
                    ])
                    ->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $s = app(CalculatorSettings::class);

        $s->bird_weight_kg = (float) ($data['bird_weight_kg'] ?? 2.1);
        $s->service_length = (float) ($data['service_length'] ?? 10);
        $s->fan_capacity_kg = (float) ($data['fan_capacity_kg'] ?? 5000);
        $s->cooling_pad_meters_per_fan = (float) ($data['cooling_pad_meters_per_fan'] ?? 5.5);
        $s->layer_nest_module_m = (float) ($data['layer_nest_module_m'] ?? 0.6);
        $s->width_lines_map = $this->keyValueToMap($data['width_lines_map'] ?? []);
        $s->broiler_weight_birds_map = $this->keyValueToMap($data['broiler_weight_birds_map'] ?? []);

        $s->default_length = (float) ($data['default_length'] ?? 81);
        $s->default_width = (float) ($data['default_width'] ?? 12);
        $s->default_height = (float) ($data['default_height'] ?? 3.5);
        $s->default_floors = (int) ($data['default_floors'] ?? 3);
        $s->default_lines = (int) ($data['default_lines'] ?? 4);

        $s->min_length = (float) ($data['min_length'] ?? 81);
        $s->max_length = (float) ($data['max_length'] ?? 300);
        $s->min_width = (float) ($data['min_width'] ?? 8);
        $s->max_width = (float) ($data['max_width'] ?? 30);
        $s->min_height = (float) ($data['min_height'] ?? 3);
        $s->max_height = (float) ($data['max_height'] ?? 6);

        $s->floors_options = $this->tagsToIntList($data['floors_options'] ?? []) ?: [1, 2, 3, 4, 5];
        $s->lines_options = $this->tagsToIntList($data['lines_options'] ?? []) ?: [3, 4, 5, 6];

        $s->concrete_m2 = (float) ($data['concrete_m2'] ?? 0);
        $s->steel_m2 = (float) ($data['steel_m2'] ?? 0);
        $s->walls_m2 = (float) ($data['walls_m2'] ?? 0);
        $s->tanks_fixed = (float) ($data['tanks_fixed'] ?? 0);
        $s->bird_cost = (float) ($data['bird_cost'] ?? 0);
        $s->rear_fan = (float) ($data['rear_fan'] ?? 0);
        $s->cooling_factor = (float) ($data['cooling_factor'] ?? 0);
        $s->window = (float) ($data['window'] ?? 0);
        $s->side_fan = (float) ($data['side_fan'] ?? 0);
        $s->heater = (float) ($data['heater'] ?? 0);
        $s->control_fixed = (float) ($data['control_fixed'] ?? 0);

        $s->save();

        Notification::make()
            ->title('تم حفظ إعدادات الحاسبة')
            ->body('التغييرات تظهر فوراً على حاسبة الموقع.')
            ->success()
            ->send();
    }

    /** @param  array<string, mixed>  $map */
    private function mapToKeyValue(array $map): array
    {
        $out = [];
        foreach ($map as $k => $v) {
            // skip float-normalized duplicates like "12.0" if "12" exists
            if (is_numeric($k) && str_contains((string) $k, '.') && isset($map[(string) (int) (float) $k])) {
                continue;
            }
            $out[(string) $k] = (string) $v;
        }

        return $out;
    }

    /** @param  array<string, mixed>  $kv */
    private function keyValueToMap(array $kv): array
    {
        $out = [];
        foreach ($kv as $k => $v) {
            $key = trim((string) $k);
            if ($key === '' || $v === null || $v === '') {
                continue;
            }
            $out[$key] = (int) $v;
        }

        return $out;
    }

    /** @param  array<int, mixed>  $tags */
    private function tagsToIntList(array $tags): array
    {
        return array_values(array_unique(array_filter(array_map(
            static fn ($v) => (int) $v,
            $tags
        ), static fn ($v) => $v > 0)));
    }
}
