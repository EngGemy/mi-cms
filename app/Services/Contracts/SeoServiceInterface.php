<?php

namespace App\Services\Contracts;

interface SeoServiceInterface
{
    public function setTitle(string $title): self;
    public function setDescription(string $description): self;
    public function setImage(?string $url): self;
    public function setCanonical(?string $url): self;
    public function setType(string $type = 'website'): self;
    public function toArray(): array;
}
