<?php
namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditBlogCategory extends EditRecord
{
    protected static string $resource = BlogCategoryResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
