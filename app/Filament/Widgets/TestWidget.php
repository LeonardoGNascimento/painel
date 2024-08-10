<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $usuario = auth()->user();
        $contagem = 0;

        if ($usuario->admin === 1) {
            $contagem = User::count();
        }

        if ($usuario->agente === 1) {
            $contagem = User::where(['agente_id' => $usuario->id])->count();
        }

        return [
            Stat::make('Total agentes', User::where(['agente' => 1])->count()),
            Stat::make('Total de Usuários', $contagem),
        ];
    }
}
