<?php
namespace App\Filament\Resources\ProductionStageResource\Pages;
use App\Filament\Resources\ProductionStageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditProductionStage extends EditRecord
{
    use Translatable;
    protected static string $resource = ProductionStageResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
