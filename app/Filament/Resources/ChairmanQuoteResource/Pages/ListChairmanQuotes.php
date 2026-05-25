<?php
namespace App\Filament\Resources\ChairmanQuoteResource\Pages;

use App\Filament\Resources\ChairmanQuoteResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListChairmanQuotes extends ListRecords
{
    protected static string $resource = ChairmanQuoteResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
