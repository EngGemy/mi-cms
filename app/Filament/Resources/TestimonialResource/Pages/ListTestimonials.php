<?php
namespace App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListTestimonials extends ListRecords
{
    use Translatable;
    protected static string $resource = TestimonialResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
