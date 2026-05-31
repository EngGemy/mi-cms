<?php
namespace App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditProject extends EditRecord
{
    use Translatable;
    protected static string $resource = ProjectResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
