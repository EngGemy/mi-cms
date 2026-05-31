<?php
namespace App\Filament\Resources\ChairmanQuoteResource\Pages;
use App\Filament\Resources\ChairmanQuoteResource;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateChairmanQuote extends CreateRecord
{
    use Translatable;
    protected static string $resource = ChairmanQuoteResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make()]; }
}
