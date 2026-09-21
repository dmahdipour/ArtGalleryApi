<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageProjects extends ManageRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    

    protected function afterCreate(): void
    {
        $this->createThumbnail();
    }

    protected function afterSave(): void
    {
        $this->createThumbnail();
    }

    protected function createThumbnail(): void
    {
        $project = $this->record;

        if (! $project->image) {
            return;
        }

        $sourcePath = Storage::disk('public')->path($project->image);

        if (! file_exists($sourcePath)) {
            return;
        }

        $image = Image::read($sourcePath);

        $image->scale(
            width: (int) ($image->width() * 0.1),
        );

        $thumbnailPath = 'images/projects/thumbnails/' . basename($project->image);

        Storage::disk('public')->put(
            $thumbnailPath,
            $image->encode()
        );

        $project->updateQuietly([
            'thumbnail' => $thumbnailPath,
        ]);
    }
}