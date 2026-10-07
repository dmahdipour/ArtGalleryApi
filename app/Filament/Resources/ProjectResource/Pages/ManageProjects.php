<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Services\MeliPayamakService;
use App\Models\Project;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ManageProjects extends ManageRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->after(function ($record) {

                    // ایجاد thumbnail
                    ProjectResource::generateThumbnail($record);

                    // ارسال پیامک به مدیر
                    try {
                        app(MeliPayamakService::class)->sendPattern(
                            $record->member->name_fa,
                            config('services.melipayamak.admin_phone'),
                            config('services.melipayamak.body_ids.new_project')
                        );
                    } catch (\Throwable $e) {
                        // خطای SMS نباید باعث شکست ثبت اثر شود
                        report($e);
                    }
                }),
        ];
    }
}