<?php
namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditFeature extends EditRecord
{
    protected static string $resource = FeatureResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
