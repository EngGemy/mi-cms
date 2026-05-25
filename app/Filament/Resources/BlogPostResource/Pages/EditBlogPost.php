<?php
namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
