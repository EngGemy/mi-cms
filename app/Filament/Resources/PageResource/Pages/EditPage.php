<?php
namespace App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditPage extends EditRecord
{
    use Translatable;
    protected static string $resource = PageResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
