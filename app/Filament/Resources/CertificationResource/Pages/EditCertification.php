<?php
namespace App\Filament\Resources\CertificationResource\Pages;
use App\Filament\Resources\CertificationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditCertification extends EditRecord
{
    use Translatable;
    protected static string $resource = CertificationResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
