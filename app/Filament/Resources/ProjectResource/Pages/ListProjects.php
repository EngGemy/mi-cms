<?php
namespace App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListProjects extends ListRecords
{
    use Translatable;
    protected static string $resource = ProjectResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
