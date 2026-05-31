<?php
namespace App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditFeature extends EditRecord
{
    use Translatable;
    protected static string $resource = FeatureResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
