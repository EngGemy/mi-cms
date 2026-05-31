<?php
namespace App\Filament\Resources\ProductionStageResource\Pages;
use App\Filament\Resources\ProductionStageResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateProductionStage extends CreateRecord
{
    use Translatable;
    protected static string $resource = ProductionStageResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make()]; }
}
