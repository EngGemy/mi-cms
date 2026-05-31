<?php
namespace App\Filament\Resources\CertificationResource\Pages;
use App\Filament\Resources\CertificationResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateCertification extends CreateRecord
{
    use Translatable;
    protected static string $resource = CertificationResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make()]; }
}
