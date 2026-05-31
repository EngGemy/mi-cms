<?php
namespace App\Filament\Resources\ProductionStageResource\Pages;
use App\Filament\Resources\ProductionStageResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListProductionStages extends ListRecords
{
    use Translatable;
    protected static string $resource = ProductionStageResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
