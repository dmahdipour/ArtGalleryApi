<?php

namespace App\Filament\Resources\TechniqueResource\Pages;

use App\Filament\Resources\TechniqueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTechniques extends ManageRecords
{
    protected static string $resource = TechniqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
