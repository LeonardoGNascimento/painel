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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Lista de Usuarios';
    protected static ?string $modelLabel = 'Usuarios';
    protected static ?string $navigationGroup = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\Toggle::make('agente')
                    ->default(null),
                Forms\Components\Toggle::make('admin')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('games_played')
                ->label('Total jogadas')
                ->searchable(),
            Tables\Columns\TextColumn::make('balance')
                ->label('Saldo')
                ->money('BRL'),
            // Tables\Columns\TextColumn::make('active_currency')
            //     ->searchable()->label('Moeda'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];

        if (auth()->user()->admin === 1) {
            $columns[] = Tables\Columns\ToggleColumn::make('agente');
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
