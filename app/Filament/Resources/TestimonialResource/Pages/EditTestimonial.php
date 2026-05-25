<?php
namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
