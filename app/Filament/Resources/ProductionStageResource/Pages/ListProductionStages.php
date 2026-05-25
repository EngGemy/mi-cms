<?php
namespace App\Filament\Resources\ProductionStageResource\Pages;

use App\Filament\Resources\ProductionStageResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListProductionStages extends ListRecords
{
    protected static string $resource = ProductionStageResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
