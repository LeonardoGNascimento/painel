<?php

namespace App\Filament\Resources\GameslistResource\Pages;

use App\Filament\Resources\GameslistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameslist extends EditRecord
{
    protected static string $resource = GameslistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
