<?php
namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
