<?php

namespace App\Services;

use App\Services\Contracts\SeoServiceInterface;

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
        $appName = config('app.name');
        return [
            'title'       => $this->meta['title']
                ? $this->meta['title'].' — '.$appName
                : $appName,
            'description' => $this->meta['description']
                ?? trans('messages.default_seo_description'),
            'image'       => $this->meta['image'] ?? asset('images/og-default.jpg'),
            'canonical'   => $this->meta['canonical'] ?? request()->fullUrl(),
            'type'        => $this->meta['type'],
            'locale'      => app()->getLocale() === 'ar' ? 'ar_EG' : 'en_US',
            'site_name'   => $appName,
        ];
    }
}
