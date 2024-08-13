<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $navigationLabel = 'Lista de Usuarios';
    protected static ?string $modelLabel = 'Usuarios';
    protected static ?string $navigationGroup = 'Usuarios';

    public static function form(Form $form): Form
    {
        $agentes = [];

        foreach (User::where(['agente' => 1])->get()->toArray() as $agente) {
            $agentes[$agente['id']] = $agente['name'];
        }

        $campos = [
            Forms\Components\TextInput::make('name')
                ->name('Nome')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->name('Senha')
                ->password()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('games_played')
                ->name('Jogos jogados')
                ->required()
                ->maxLength(100)
                ->default(0),
            Forms\Components\TextInput::make('balance')
                ->name('Saldo')
                ->required()
                ->maxLength(100)
                ->default(0),
            Forms\Components\TextInput::make('active_currency')
                ->name('Moeda')
                ->required()
                ->maxLength(100)
                ->default('USD'),
            Forms\Components\TextInput::make('player_id')
                ->numeric()
                ->default(null),

        ];

        if (auth()->user()->agente === 1 || auth()->user()->admin === 1) {
            $campos[] = Forms\Components\Toggle::make('agente')
                ->default(null);
            $campos[] = Forms\Components\Select::make('agente_id')
                ->options($agentes)
                ->disabled(fn() => auth()->user()->agente === 1 && auth()->user()->admin === 0)
                ->default(auth()->user()->agente === 1 ? auth()->user()->id : null);
        }

        if (auth()->user()->admin === 1) {
            $campos[] = Forms\Components\Toggle::make('admin')
                ->default(null);
        }

        return $form
            ->schema($campos);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('agenteResponsavel.email')
                ->label('Agente responsável')
                ->searchable(),
            Tables\Columns\TextColumn::make('games_played')
                ->label('Total jogadas')
                ->searchable(),
            Tables\Columns\TextColumn::make('balance')
                ->label('Saldo')
                ->money('BRL'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];

        if (auth()->user()->agente === 1 || auth()->user()->admin === 1) {
            $columns[] = Tables\Columns\ToggleColumn::make('agente');
        }

        if (auth()->user()->admin === 1) {
            $columns[] = Tables\Columns\ToggleColumn::make('admin');
        }

        return $table
            ->columns($columns)
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
