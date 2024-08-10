<?php

namespace App\Filament\Widgets;

use App\Models\BalanceTransactions;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use NumberFormatter;

class Recargas extends BaseWidget
{
    protected function getStats(): array
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        $valores = array_reduce(
            BalanceTransactions::all()->toArray(),
            fn ($atual, $item) => $atual + $item['credit'] + $item['debit'],
            0
        );

        return [
            Stat::make('Saldo total', $formatter->formatCurrency(auth()->user()->balance, 'BRL'))
                ->description('Saldo da plataforma')->chart([
                    30, 3, 30, 3, 30, 3, 30
                ])->color('success'),
            Stat::make('Recargas', $formatter->formatCurrency($valores, 'BRL'))->description('Recargas do mês')->chart([
                30, 3, 30, 3, 30, 3, 30
            ])->color('success'),
            // Stat::make('Gastos', 'R$ 10,00')->description('Gastos do mês')->chart([
            //     30, 3, 30, 3, 30, 3, 30
            // ])->color('danger')
        ];
    }
}
