<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Illuminate\Contracts\Support\Htmlable;

class Login extends \Filament\Pages\Auth\Login
{
    protected static string $view = 'filament.auth.login';
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function getHeading(): string | Htmlable
    {
        return '';
    }
}
