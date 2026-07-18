<?php

namespace App\Filament\Pages;

use App\Settings\AboutSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AboutSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'واجهة الموقع';
    protected static ?int    $navigationSort  = 5;
    protected static ?string $navigationLabel = 'صفحة من نحن';
    protected static string  $view            = 'filament.pages.about-settings';
    protected static ?string $title           = 'صفحة من نحن';

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(AboutSettings::class);

        $this->form->fill([
            'hero_image_path'   => $s->hero_image_path ? [$s->hero_image_path] : [],
            'video_poster_path' => $s->video_poster_path ? [$s->video_poster_path] : [],
            'teaser_image_path' => $s->teaser_image_path ? [$s->teaser_image_path] : [],
            'video_url'         => $s->video_url,
            'seo'               => $s->seo,
            'hero'              => $s->hero,
            'stats'             => $s->stats,
            'story'             => $s->story,
            'milestones'        => $s->milestones,
            'vmg'               => $s->vmg,
            'values_header'     => $s->values_header,
            'values'            => $s->values,
            'certs'             => $s->certs,
            'video'             => $s->video,
            'catalog'           => $s->catalog,
            'final_cta'         => $s->final_cta,
            'teaser'            => $s->teaser,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('about')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('SEO')->schema([
                            Forms\Components\TextInput::make('seo.title_ar')->label('عنوان SEO (عربي)'),
                            Forms\Components\TextInput::make('seo.title_en')->label('SEO Title (EN)'),
                            Forms\Components\Textarea::make('seo.desc_ar')->label('وصف SEO (عربي)')->rows(3),
                            Forms\Components\Textarea::make('seo.desc_en')->label('SEO Description (EN)')->rows(3),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الهيرو')->schema([
                            Forms\Components\FileUpload::make('hero_image_path')
                                ->label('صورة الهيرو')
                                ->disk('public')->directory('settings')->visibility('public')
                                ->image()->maxSize(4096)->columnSpanFull(),
                            Forms\Components\TextInput::make('hero.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('hero.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('hero.line1_ar')->label('سطر العنوان 1 عربي'),
                            Forms\Components\TextInput::make('hero.line1_en')->label('Title line 1 EN'),
                            Forms\Components\TextInput::make('hero.line2_ar')->label('سطر العنوان 2 عربي'),
                            Forms\Components\TextInput::make('hero.line2_en')->label('Title line 2 EN'),
                            Forms\Components\Textarea::make('hero.lead_ar')->label('المقدمة عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('hero.lead_en')->label('Lead EN')->rows(3)->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الإحصائيات')->schema([
                            Forms\Components\Repeater::make('stats')
                                ->label('الأرقام')
                                ->schema([
                                    Forms\Components\TextInput::make('value')->label('الرقم')->numeric()->required(),
                                    Forms\Components\TextInput::make('suffix')->label('لاحقة')->placeholder('+ / M+'),
                                    Forms\Components\TextInput::make('label_ar')->label('التسمية عربي')->required(),
                                    Forms\Components\TextInput::make('label_en')->label('Label EN')->required(),
                                ])
                                ->columns(4)
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => ($state['label_ar'] ?? null) ?: ($state['label_en'] ?? null))
                                ->columnSpanFull(),
                        ]),

                        Forms\Components\Tabs\Tab::make('القصة والخط الزمني')->schema([
                            Forms\Components\TextInput::make('story.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('story.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('story.title_ar')->label('العنوان عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('story.title_en')->label('Title EN')->columnSpanFull(),
                            Forms\Components\Textarea::make('story.blurb_ar')->label('الوصف عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('story.blurb_en')->label('Blurb EN')->rows(3)->columnSpanFull(),
                            Forms\Components\Repeater::make('milestones')
                                ->label('محطات الخط الزمني')
                                ->schema([
                                    Forms\Components\TextInput::make('year')->label('السنة')->required()->maxLength(4),
                                    Forms\Components\TextInput::make('icon')->label('أيقونة Lucide')->placeholder('award')->helperText('اسم أيقونة lucide بدون بادئة'),
                                    Forms\Components\TextInput::make('title_ar')->label('العنوان عربي')->required(),
                                    Forms\Components\TextInput::make('title_en')->label('Title EN')->required(),
                                    Forms\Components\Textarea::make('desc_ar')->label('الوصف عربي')->rows(2)->columnSpanFull(),
                                    Forms\Components\Textarea::make('desc_en')->label('Desc EN')->rows(2)->columnSpanFull(),
                                ])
                                ->columns(2)
                                ->collapsible()
                                ->reorderable()
                                ->itemLabel(fn (array $state): ?string => trim(($state['year'] ?? '') . ' — ' . ($state['title_ar'] ?? $state['title_en'] ?? '')))
                                ->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الرؤية والرسالة')->schema([
                            Forms\Components\TextInput::make('vmg.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('vmg.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('vmg.title_ar')->label('عنوان القسم عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('vmg.title_en')->label('Section title EN')->columnSpanFull(),
                            Forms\Components\TextInput::make('vmg.vision_title_ar')->label('عنوان الرؤية عربي'),
                            Forms\Components\TextInput::make('vmg.vision_title_en')->label('Vision title EN'),
                            Forms\Components\Textarea::make('vmg.vision_text_ar')->label('نص الرؤية عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('vmg.vision_text_en')->label('Vision text EN')->rows(3)->columnSpanFull(),
                            Forms\Components\TextInput::make('vmg.mission_title_ar')->label('عنوان الرسالة عربي'),
                            Forms\Components\TextInput::make('vmg.mission_title_en')->label('Mission title EN'),
                            Forms\Components\Textarea::make('vmg.mission_text_ar')->label('نص الرسالة عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('vmg.mission_text_en')->label('Mission text EN')->rows(3)->columnSpanFull(),
                            Forms\Components\TextInput::make('vmg.goals_title_ar')->label('عنوان الأهداف عربي'),
                            Forms\Components\TextInput::make('vmg.goals_title_en')->label('Goals title EN'),
                            Forms\Components\Textarea::make('vmg.goals_text_ar')->label('نص الأهداف عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('vmg.goals_text_en')->label('Goals text EN')->rows(3)->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('القيم')->schema([
                            Forms\Components\TextInput::make('values_header.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('values_header.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('values_header.title_ar')->label('العنوان عربي'),
                            Forms\Components\TextInput::make('values_header.title_en')->label('Title EN'),
                            Forms\Components\Repeater::make('values')
                                ->label('القيم')
                                ->schema([
                                    Forms\Components\TextInput::make('icon')->label('أيقونة Lucide')->placeholder('shield-check'),
                                    Forms\Components\TextInput::make('title_ar')->label('العنوان عربي')->required(),
                                    Forms\Components\TextInput::make('title_en')->label('Title EN')->required(),
                                    Forms\Components\Textarea::make('desc_ar')->label('الوصف عربي')->rows(2)->columnSpanFull(),
                                    Forms\Components\Textarea::make('desc_en')->label('Desc EN')->rows(2)->columnSpanFull(),
                                ])
                                ->columns(3)
                                ->collapsible()
                                ->reorderable()
                                ->itemLabel(fn (array $state): ?string => $state['title_ar'] ?? $state['title_en'] ?? null)
                                ->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الشهادات (نصوص)')->schema([
                            Forms\Components\TextInput::make('certs.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('certs.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('certs.title_ar')->label('العنوان عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('certs.title_en')->label('Title EN')->columnSpanFull(),
                            Forms\Components\Textarea::make('certs.blurb_ar')->label('الوصف عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('certs.blurb_en')->label('Blurb EN')->rows(3)->columnSpanFull(),
                            Forms\Components\Placeholder::make('certs_hint')
                                ->content('قائمة الشهادات نفسها تُدار من قائمة «الاعتمادات» في الشريط الجانبي.')
                                ->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الفيديو')->schema([
                            Forms\Components\TextInput::make('video_url')
                                ->label('رابط الفيديو (MP4)')
                                ->url()
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('video_poster_path')
                                ->label('صورة الغلاف')
                                ->disk('public')->directory('settings')->visibility('public')
                                ->image()->maxSize(4096)->columnSpanFull(),
                            Forms\Components\TextInput::make('video.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('video.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('video.title_ar')->label('العنوان عربي'),
                            Forms\Components\TextInput::make('video.title_en')->label('Title EN'),
                            Forms\Components\Textarea::make('video.blurb_ar')->label('الوصف عربي')->rows(2)->columnSpanFull(),
                            Forms\Components\Textarea::make('video.blurb_en')->label('Blurb EN')->rows(2)->columnSpanFull(),
                            Forms\Components\TextInput::make('video.badge')->label('Badge (EN/AR)'),
                            Forms\Components\TextInput::make('video.caption')->label('Caption'),
                            Forms\Components\TextInput::make('video.headline_ar')->label('العنوان فوق الفيديو عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('video.headline_en')->label('Overlay headline EN')->columnSpanFull(),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('الكتالوج والـ CTA')->schema([
                            Forms\Components\TextInput::make('catalog.eyebrow_ar')->label('كتالوج · Eyebrow عربي'),
                            Forms\Components\TextInput::make('catalog.eyebrow_en')->label('Catalog · Eyebrow EN'),
                            Forms\Components\TextInput::make('catalog.title_ar')->label('عنوان الكتالوج عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('catalog.title_en')->label('Catalog title EN')->columnSpanFull(),
                            Forms\Components\Textarea::make('catalog.blurb_ar')->label('وصف الكتالوج عربي')->rows(2)->columnSpanFull(),
                            Forms\Components\Textarea::make('catalog.blurb_en')->label('Catalog blurb EN')->rows(2)->columnSpanFull(),
                            Forms\Components\TextInput::make('catalog.download_ar')->label('نص زر التحميل عربي'),
                            Forms\Components\TextInput::make('catalog.download_en')->label('Download button EN'),
                            Forms\Components\TextInput::make('final_cta.eyebrow_ar')->label('CTA · Eyebrow عربي'),
                            Forms\Components\TextInput::make('final_cta.eyebrow_en')->label('CTA · Eyebrow EN'),
                            Forms\Components\TextInput::make('final_cta.title_ar')->label('عنوان CTA عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('final_cta.title_en')->label('CTA title EN')->columnSpanFull(),
                            Forms\Components\Textarea::make('final_cta.blurb_ar')->label('وصف CTA عربي')->rows(2)->columnSpanFull(),
                            Forms\Components\Textarea::make('final_cta.blurb_en')->label('CTA blurb EN')->rows(2)->columnSpanFull(),
                            Forms\Components\TextInput::make('final_cta.btn_ar')->label('نص الزر عربي'),
                            Forms\Components\TextInput::make('final_cta.btn_en')->label('Button EN'),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('قسم الرئيسية')->schema([
                            Forms\Components\FileUpload::make('teaser_image_path')
                                ->label('صورة قسم من نحن في الرئيسية')
                                ->disk('public')->directory('settings')->visibility('public')
                                ->image()->maxSize(4096)->columnSpanFull(),
                            Forms\Components\TextInput::make('teaser.eyebrow_ar')->label('Eyebrow عربي'),
                            Forms\Components\TextInput::make('teaser.eyebrow_en')->label('Eyebrow EN'),
                            Forms\Components\TextInput::make('teaser.title_ar')->label('العنوان عربي')->columnSpanFull(),
                            Forms\Components\TextInput::make('teaser.title_en')->label('Title EN')->columnSpanFull(),
                            Forms\Components\Textarea::make('teaser.blurb_ar')->label('الوصف عربي')->rows(3)->columnSpanFull(),
                            Forms\Components\Textarea::make('teaser.blurb_en')->label('Blurb EN')->rows(3)->columnSpanFull(),
                            Forms\Components\TextInput::make('teaser.badge_years')->label('رقم الشارة')->placeholder('15+'),
                            Forms\Components\TextInput::make('teaser.badge_ar')->label('نص الشارة عربي'),
                            Forms\Components\TextInput::make('teaser.badge_en')->label('Badge EN'),
                            Forms\Components\TextInput::make('teaser.cta_ar')->label('نص الزر عربي'),
                            Forms\Components\TextInput::make('teaser.cta_en')->label('CTA EN'),
                        ])->columns(2),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
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
        $s = app(AboutSettings::class);

        $s->hero_image_path = $this->firstPath($data['hero_image_path'] ?? null);
        $s->video_poster_path = $this->firstPath($data['video_poster_path'] ?? null);
        $s->teaser_image_path = $this->firstPath($data['teaser_image_path'] ?? null);
        $s->video_url = $data['video_url'] ?? null;
        $s->seo = $data['seo'] ?? [];
        $s->hero = $data['hero'] ?? [];
        $s->stats = array_values($data['stats'] ?? []);
        $s->story = $data['story'] ?? [];
        $s->milestones = array_values($data['milestones'] ?? []);
        $s->vmg = $data['vmg'] ?? [];
        $s->values_header = $data['values_header'] ?? [];
        $s->values = array_values($data['values'] ?? []);
        $s->certs = $data['certs'] ?? [];
        $s->video = $data['video'] ?? [];
        $s->catalog = $data['catalog'] ?? [];
        $s->final_cta = $data['final_cta'] ?? [];
        $s->teaser = $data['teaser'] ?? [];
        $s->save();

        $this->data['hero_image_path'] = $s->hero_image_path ? [$s->hero_image_path] : [];
        $this->data['video_poster_path'] = $s->video_poster_path ? [$s->video_poster_path] : [];
        $this->data['teaser_image_path'] = $s->teaser_image_path ? [$s->teaser_image_path] : [];

        Notification::make()->title('تم الحفظ')->success()->send();
    }

    private function firstPath(mixed $value): ?string
    {
        return is_array($value) ? ($value[0] ?? null) : ($value ?: null);
    }
}
