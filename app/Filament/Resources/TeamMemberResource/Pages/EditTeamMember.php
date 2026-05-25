<?php
namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
