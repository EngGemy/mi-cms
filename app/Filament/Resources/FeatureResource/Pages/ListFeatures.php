<?php
namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListFeatures extends ListRecords
{
    protected static string $resource = FeatureResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
