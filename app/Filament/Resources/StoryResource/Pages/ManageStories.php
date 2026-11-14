<?php

namespace App\Filament\Resources\StoryResource\Pages;

use App\Filament\Resources\StoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageStories extends ManageRecords
{
    protected static string $resource = StoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('افزودن استوری'),
        ];
    }
}
