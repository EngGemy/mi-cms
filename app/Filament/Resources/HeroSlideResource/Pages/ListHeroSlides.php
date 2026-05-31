<?php
namespace App\Filament\Resources\HeroSlideResource\Pages;
use App\Filament\Resources\HeroSlideResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListHeroSlides extends ListRecords
{
    use Translatable;
    protected static string $resource = HeroSlideResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
