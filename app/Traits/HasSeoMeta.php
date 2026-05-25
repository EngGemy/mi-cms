<?php

namespace App\Traits;

/**
 * Adds SEO meta helpers to translatable models that have
 * `seo_title` and `seo_description` translatable JSON columns.
 */
trait HasSeoMeta
{
    public function seoTitle(?string $fallback = null): string
    {
        $translatable = $this->translatable ?? [];

        return $this->getTranslation('seo_title', app()->getLocale(), false)
            ?: (in_array('title', $translatable) ? $this->getTranslation('title', app()->getLocale(), false) : '')
            ?: (in_array('name', $translatable) ? $this->getTranslation('name', app()->getLocale(), false) : '')
            ?: ($fallback ?? config('app.name'));
    }

    public function seoDescription(?string $fallback = null): string
    {
        $translatable = $this->translatable ?? [];

        return $this->getTranslation('seo_description', app()->getLocale(), false)
            ?: (in_array('summary', $translatable) ? $this->getTranslation('summary', app()->getLocale(), false) : '')
            ?: (in_array('excerpt', $translatable) ? $this->getTranslation('excerpt', app()->getLocale(), false) : '')
            ?: ($fallback ?? '');
    }
}
