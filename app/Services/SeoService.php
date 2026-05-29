<?php

namespace App\Services;

use App\Services\Contracts\SeoServiceInterface;
use App\Settings\GeneralSettings;
use App\Settings\SeoSettings;

class SeoService implements SeoServiceInterface
{
    protected array $meta = [
        'title'       => null,
        'description' => null,
        'image'       => null,
        'canonical'   => null,
        'type'        => 'website',
    ];

    public function setTitle(string $title): self
    {
        $this->meta['title'] = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->meta['description'] = mb_substr(strip_tags($description), 0, 160);
        return $this;
    }

    public function setImage(?string $url): self
    {
        $this->meta['image'] = $url;
        return $this;
    }

    public function setCanonical(?string $url): self
    {
        $this->meta['canonical'] = $url;
        return $this;
    }

    public function setType(string $type = 'website'): self
    {
        $this->meta['type'] = $type;
        return $this;
    }

    public function toArray(): array
    {
        try {
            $seoSettings     = app(SeoSettings::class);
            $generalSettings = app(GeneralSettings::class);

            $locale   = app()->getLocale();
            $siteName = $generalSettings->site_name ?? config('app.name');

            $defaultTitle = $locale === 'ar'
                ? ($seoSettings->meta_title_ar ?? $siteName)
                : ($seoSettings->meta_title_en ?? $siteName);

            $defaultDesc = $locale === 'ar'
                ? ($seoSettings->meta_description_ar ?? trans('messages.default_seo_description'))
                : ($seoSettings->meta_description_en ?? trans('messages.default_seo_description'));

            $defaultImage = $seoSettings->og_image_path
                ? asset('storage/' . $seoSettings->og_image_path)
                : asset('images/og-default.jpg');
        } catch (\Throwable) {
            $siteName     = config('app.name');
            $defaultTitle = $siteName;
            $defaultDesc  = trans('messages.default_seo_description');
            $defaultImage = asset('images/og-default.jpg');
        }

        return [
            'title'       => $this->meta['title']
                ? $this->meta['title'].' — '.$siteName
                : $defaultTitle,
            'description' => $this->meta['description'] ?? $defaultDesc,
            'image'       => $this->meta['image'] ?? $defaultImage,
            'canonical'   => $this->meta['canonical'] ?? request()->fullUrl(),
            'type'        => $this->meta['type'],
            'locale'      => app()->getLocale() === 'ar' ? 'ar_EG' : 'en_US',
            'site_name'   => $siteName,
        ];
    }
}
