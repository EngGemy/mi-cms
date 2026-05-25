<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, HasSlug;

    public array $translatable = ['title', 'client_name', 'description', 'summary'];

    protected $fillable = [
        'title', 'slug', 'client_name', 'description', 'summary',
        'category', 'location_code', 'capacity_birds', 'area_m2', 'barns_count',
        'year', 'start_date', 'completion_date',
        'work_types', 'videos', 'video_url', 'duration_months',
        'position', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'is_featured'     => 'boolean',
        'capacity_birds'  => 'integer',
        'year'            => 'integer',
        'position'        => 'integer',
        'area_m2'         => 'integer',
        'barns_count'     => 'integer',
        'start_date'      => 'date',
        'completion_date' => 'date',
        'work_types'      => 'array',
        'videos'          => 'array',
        'duration_months' => 'integer',
    ];

    /* ------------------------------------------------------------------ */
    /*  Constants                                                           */
    /* ------------------------------------------------------------------ */

    public const CATEGORIES = [
        'layer'      => ['ar' => 'إنتاج البيض', 'en' => 'Layer'],
        'broiler'    => ['ar' => 'التسمين',     'en' => 'Broiler'],
        'commercial' => ['ar' => 'تجاري كبير',  'en' => 'Commercial'],
        'machinery'  => ['ar' => 'آلات ومعدّات','en' => 'Machinery'],
    ];

    public const WORK_TYPES = [
        'design'      => ['ar' => 'تصميم هندسي',           'en' => 'Engineering Design'],
        'civil'       => ['ar' => 'أعمال مدنية وإنشاءات',  'en' => 'Civil & Construction'],
        'cages'       => ['ar' => 'بطاريات وأقفاص',         'en' => 'Cages & Equipment'],
        'ventilation' => ['ar' => 'تهوية وتبريد',           'en' => 'Ventilation & Cooling'],
        'electrical'  => ['ar' => 'كهرباء وتحكم ذكي',       'en' => 'Electrical & Smart Control'],
        'feeding'     => ['ar' => 'نظام التغذية الآلي',     'en' => 'Automatic Feeding'],
        'water'       => ['ar' => 'نظام المياه والصرف',     'en' => 'Water & Drainage'],
        'manure'      => ['ar' => 'إزالة السبلة',           'en' => 'Manure Removal'],
        'egg_collect' => ['ar' => 'جمع البيض أوتوماتيكي',  'en' => 'Egg Collection'],
        'lighting'    => ['ar' => 'إضاءة وبرمجة',           'en' => 'Lighting & Programming'],
        'installation'=> ['ar' => 'تركيب وتشغيل',           'en' => 'Installation & Commissioning'],
        'training'    => ['ar' => 'تدريب وتسليم',           'en' => 'Training & Handover'],
    ];

    /* ------------------------------------------------------------------ */
    /*  Slug                                                                */
    /* ------------------------------------------------------------------ */

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn (Project $p) => $p->getTranslation('title', 'en') ?: $p->getTranslation('title', 'ar'))
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(80);
    }

    public function getRouteKeyName(): string { return 'slug'; }

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                       */
    /* ------------------------------------------------------------------ */

    public function stages(): HasMany
    {
        return $this->hasMany(ProjectStage::class)->orderBy('position');
    }

    public function phases(): HasMany
    {
        return $this->hasMany(ProjectPhase::class)->orderBy('position');
    }

    /* ------------------------------------------------------------------ */
    /*  Media                                                               */
    /* ------------------------------------------------------------------ */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('video')->singleFile();
        $this->addMediaCollection('blueprint');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('hero')->width(1600)->quality(85);
        $this->addMediaConversion('card')->width(900)->quality(82);
        $this->addMediaConversion('thumb')->width(400)->quality(80);
    }

    /* ------------------------------------------------------------------ */
    /*  Helpers                                                             */
    /* ------------------------------------------------------------------ */

    public function getCoverUrl(string $conv = 'card'): ?string
    {
        $m = $this->getFirstMedia('cover');
        return $m ? $m->getUrl($conv) : null;
    }

    public function getGalleryUrls(string $conv = 'card'): array
    {
        return $this->getMedia('gallery')
            ->map(fn ($m) => [
                'full'  => $m->getUrl($conv),
                'thumb' => $m->getUrl('thumb'),
                'alt'   => $this->title,
            ])
            ->values()
            ->toArray();
    }

    public function getBlueprintUrls(string $conv = 'card'): array
    {
        return $this->getMedia('blueprint')
            ->map(fn ($m) => [
                'full'  => $m->getUrl($conv),
                'thumb' => $m->getUrl('thumb'),
                'alt'   => $this->title . ' — ' . __('messages.project_blueprint'),
            ])
            ->values()
            ->toArray();
    }

    public function getCategoryLabel(): string
    {
        $locale = app()->getLocale();
        return self::CATEGORIES[$this->category][$locale] ?? $this->category;
    }

    public function getWorkTypeLabels(): array
    {
        $locale = app()->getLocale();
        return collect($this->work_types ?? [])
            ->map(fn ($key) => self::WORK_TYPES[$key][$locale] ?? $key)
            ->values()
            ->toArray();
    }

    /** Parsed videos: each item gets youtube_id / vimeo_id resolved. */
    public function getParsedVideos(): array
    {
        return collect($this->videos ?? [])
            ->filter(fn ($v) => !empty($v['url']))
            ->map(function ($v) {
                $url     = $v['url'];
                $ytMatch = [];
                $viMatch = [];
                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $ytMatch);
                preg_match('/vimeo\.com\/(\d+)/', $url, $viMatch);

                return [
                    'url'        => $url,
                    'title_ar'   => $v['title_ar'] ?? '',
                    'title_en'   => $v['title_en'] ?? '',
                    'youtube_id' => $ytMatch[1] ?? null,
                    'vimeo_id'   => $viMatch[1] ?? null,
                ];
            })
            ->values()
            ->toArray();
    }

    /* legacy single-video helpers kept for BC */
    public function getYoutubeId(): ?string
    {
        if (!$this->video_url) return null;
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $this->video_url, $m);
        return $m[1] ?? null;
    }

    public function getVimeoId(): ?string
    {
        if (!$this->video_url) return null;
        preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $m);
        return $m[1] ?? null;
    }

    public function getDurationLabel(): ?string
    {
        if (!$this->start_date || !$this->completion_date) return null;
        $months = (int) $this->start_date->diffInMonths($this->completion_date);
        return $months > 0 ? $months . ' ' . (app()->getLocale() === 'ar' ? 'شهر' : 'months') : null;
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                              */
    /* ------------------------------------------------------------------ */

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('position');
    }

    public function scopeFeatured(Builder $q): Builder
    {
        return $q->where('is_featured', true)->where('is_active', true)->orderBy('position');
    }

    public function scopeOfCategory(Builder $q, string $c): Builder
    {
        return $q->where('category', $c);
    }

    public function related(int $limit = 3)
    {
        return static::active()
            ->ofCategory($this->category)
            ->where('id', '!=', $this->id)
            ->with('media')
            ->limit($limit)
            ->get();
    }
}
