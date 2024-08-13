<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $usuario = auth()->user();

        if ($usuario->admin === 1) {
            // Se o usuário for um administrador, mostra todos os usuários
            return User::query();
        }
    
        if ($usuario->agente === 1 && $usuario->admin === 0) {
            // Para agentes, incluindo usuários do agente e dos sub-agentes
            return User::where(function ($query) use ($usuario) {
                $query->where('agente_id', $usuario->id) // Usuários diretamente atribuídos ao agente
                      ->orWhereIn('agente_id', function ($subQuery) use ($usuario) {
                          // Subconsulta para obter todos os sub-agentes do agente
                          $subQuery->select('id')
                                   ->from('users')
                                   ->where('agente_id', $usuario->id);
                      });
            })->orWhere('id', $usuario->id); // Inclui o próprio usuário
        }
    
        // Caso o usuário não se encaixe em nenhuma das condições acima
        return User::query()->whereRaw('1 = 0'); // Consulta vazia para segurança
    }
}
