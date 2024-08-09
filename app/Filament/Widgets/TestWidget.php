<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total agentes', '1'),
            Stat::make('Total de Sub Agentes', '1'),
            Stat::make('Total de Usuários', User::count()),
        ];
    }
}
