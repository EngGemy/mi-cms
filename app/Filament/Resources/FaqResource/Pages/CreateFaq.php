<?php
namespace App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateFaq extends CreateRecord
{
    use Translatable;
    protected static string $resource = FaqResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make()]; }
}
