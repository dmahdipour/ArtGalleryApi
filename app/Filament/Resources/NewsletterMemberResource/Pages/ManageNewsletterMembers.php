<?php

namespace App\Filament\Resources\NewsletterMemberResource\Pages;

use App\Filament\Resources\NewsletterMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNewsletterMembers extends ManageRecords
{
    protected static string $resource = NewsletterMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
