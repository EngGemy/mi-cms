<?php
namespace App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditTestimonial extends EditRecord
{
    use Translatable;
    protected static string $resource = TestimonialResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), DeleteAction::make()]; }
}
