<?php
namespace App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListFeatures extends ListRecords
{
    use Translatable;
    protected static string $resource = FeatureResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
