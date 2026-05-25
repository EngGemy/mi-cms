<?php
namespace App\Filament\Resources\ChairmanQuoteResource\Pages;

use App\Filament\Resources\ChairmanQuoteResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditChairmanQuote extends EditRecord
{
    protected static string $resource = ChairmanQuoteResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
