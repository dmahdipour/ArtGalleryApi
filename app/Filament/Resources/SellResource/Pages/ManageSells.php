<?php

namespace App\Filament\Resources\Sells\Pages;

use App\Filament\Resources\SellResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSells extends ManageRecords
{
    protected static string $resource = SellResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
