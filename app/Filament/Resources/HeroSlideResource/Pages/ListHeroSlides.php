<?php
namespace App\Filament\Resources\HeroSlideResource\Pages;

use App\Filament\Resources\HeroSlideResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListHeroSlides extends ListRecords
{
    protected static string $resource = HeroSlideResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
