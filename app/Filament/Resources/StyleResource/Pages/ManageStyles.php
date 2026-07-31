<?php

namespace App\Filament\Resources\StyleResource\Pages;

use App\Filament\Resources\StyleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageStyles extends ManageRecords
{
    protected static string $resource = StyleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
