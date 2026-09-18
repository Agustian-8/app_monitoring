<?php

namespace App\Filament\Resources\WorkSettingResource\Pages;

use App\Filament\Resources\WorkSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkSettings extends ListRecords
{
    protected static string $resource = WorkSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
