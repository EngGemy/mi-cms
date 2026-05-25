<?php
namespace App\Filament\Resources\HeroSlideResource\Pages;

use App\Filament\Resources\HeroSlideResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditHeroSlide extends EditRecord
{
    protected static string $resource = HeroSlideResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
