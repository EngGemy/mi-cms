<?php
namespace App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditFaq extends EditRecord
{
    use Translatable;
    protected static string $resource = FaqResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
