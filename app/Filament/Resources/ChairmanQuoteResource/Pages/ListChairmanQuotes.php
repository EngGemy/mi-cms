<?php
namespace App\Filament\Resources\ChairmanQuoteResource\Pages;
use App\Filament\Resources\ChairmanQuoteResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListChairmanQuotes extends ListRecords
{
    use Translatable;
    protected static string $resource = ChairmanQuoteResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
