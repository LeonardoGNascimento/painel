<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class UsuariosWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $usuario = auth()->user();
        $contagemUsuario = 0;
        $contagemAgente = 0;
        $contagemSubAgente = 0;

        if ($usuario->admin === 1) {
            $contagemUsuario = User::count();
            $contagemAgente = User::where(['agente' => 1, 'agente_id' => null])->count();
            $contagemSubAgente = User::where(['agente' => 1])->whereNotNull('agente_id')->count();
        }

        if ($usuario->agente === 1 && $usuario->admin === 0) {
            $subAgentesIds = User::where('agente_id', $usuario->id)
                ->pluck('id'); // IDs dos sub-agentes

            $contagemUsuario = User::where(['agente_id' => $usuario->id, 'agente' => 0])
                ->orWhereIn('agente_id', $subAgentesIds)
                ->where('agente', 0)
                ->count();

            $contagemAgente = User::where(['agente' => 1, 'agente_id' => $usuario->id])->count();

            $contagemSubAgente = User::where('agente', 1)
                ->whereIn('id', $subAgentesIds)
                ->count();
        }

        // if ($usuario->admin === 0 && $usuario->agente_id > 0 && $usuario->agente === 1) {
        //     // Sub-agente vê os usuários atribuídos a ele e aos seus sub-agentes
        //     $subAgentesIds = User::where('agente_id', $usuario->id)
        //         ->pluck('id'); // IDs dos sub-agentes

        //     // Contagem de usuários atribuídos ao sub-agente e aos sub-agentes do sub-agente
        //     $contagemUsuario = User::where('agente_id', $usuario->id)
        //         ->orWhereIn('agente_id', $subAgentesIds)
        //         ->count();

        //     // Contagem de sub-agentes diretamente atribuídos ao sub-agente
        //     $contagemSubAgente = User::where('agente', 1)
        //         ->where('agente_id', $usuario->id)
        //         ->count();
        // }

        return [
            Stat::make('Total agentes', $contagemAgente),
            Stat::make('Total sub-agentes', $contagemSubAgente),
            Stat::make('Total de Usuários', $contagemUsuario),
        ];
    }
}
