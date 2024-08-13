<?php

namespace App\Filament\Pages;

use App\Models\Plano as ModelsPlano;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class Plano extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-equals';
    protected static string $view = 'filament.pages.plano';
    protected static ?string $navigationGroup = 'Cobrança';

    protected function getData(): array
    {
        return ModelsPlano::where('status', 1)->get()->toArray();
    }
}
