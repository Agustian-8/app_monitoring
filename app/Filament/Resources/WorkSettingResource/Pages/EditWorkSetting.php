<?php

namespace App\Filament\Resources\WorkSettingResource\Pages;

use App\Filament\Resources\WorkSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkSetting extends EditRecord
{
    protected static string $resource = WorkSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
