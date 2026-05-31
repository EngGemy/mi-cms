<?php
namespace App\Filament\Resources\TeamMemberResource\Pages;
use App\Filament\Resources\TeamMemberResource;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListTeamMembers extends ListRecords
{
    use Translatable;
    protected static string $resource = TeamMemberResource::class;
    protected function getHeaderActions(): array { return [LocaleSwitcher::make(), CreateAction::make()]; }
}
