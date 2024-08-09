<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Recargas extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Saldo total', 'R$ 10,00')->description('Saldo da plataforma')->chart([
                30, 3, 30, 3, 30, 3, 30
            ])->color('success'),
            Stat::make('Recargas', 'R$ 10,00')->description('Recargas do mês')->chart([
                30, 3, 30, 3, 30, 3, 30
            ])->color('success'),
            Stat::make('Gastos', 'R$ 10,00')->description('Gastos do mês')->chart([
                30, 3, 30, 3, 30, 3, 30
            ])->color('danger')
        ];
    }
}
