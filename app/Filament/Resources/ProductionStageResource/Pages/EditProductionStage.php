<?php
namespace App\Filament\Resources\ProductionStageResource\Pages;

use App\Filament\Resources\ProductionStageResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditProductionStage extends EditRecord
{
    protected static string $resource = ProductionStageResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
