<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameslistResource\Pages;
use App\Filament\Resources\GameslistResource\RelationManagers;
use App\Models\Gameslist;
use App\Models\Provider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Spatie\MediaLibrary\InteractsWithMedia;

class GameslistResource extends Resource
{
    protected static ?string $model = Gameslist::class;
    protected static ?string $navigationLabel = 'Lista de jogos';
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationGroup = 'Jogos';
    protected static ?string $modelLabel = 'Jogos';

    public static function canCreate(): bool
    {
        return auth()->user()->admin === 1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('game_id')
                    ->name('Jogo id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('game_slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('game_name')
                    ->name('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('game_provider')
                    ->options(Provider::all()->pluck('nome', 'id'))
                    ->required(),
                Forms\Components\Textarea::make('game_desc')
                    ->name('Descrição')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('extra_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('index_rating')
                    ->name('Ordem')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('api_ext')
                    ->name('API URL')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'aoVivo' => 'Ao vivo',
                        'slot' => 'Slot',
                    ])
                    ->name('Tipo de jogo')
                    ->required(),
                Forms\Components\Toggle::make('demo_available')
                    ->name('Demo')
                    ->required(),
                Forms\Components\Toggle::make('hidden')
                    ->name('Esconder')
                    ->required(),
                Forms\Components\FileUpload::make('game_img'),
                Forms\Components\Toggle::make('disabled')
                    ->name('Desativado')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('game_img')->size(50)->label('Capa'),
                Tables\Columns\TextColumn::make('providers.nome')
                    ->label('Provedor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('Game ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game_name')
                    ->label('Nome do Jogo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game_id')
                    ->label('Game code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo de jogo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('disabled')
                    ->icon(fn (string $state): string => match ($state) {
                        '0' => 'heroicon-o-check-circle',
                        '1' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'success',
                        '1' => 'danger',
                    })
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListGameslists::route('/'),
            'create' => Pages\CreateGameslist::route('/create'),
            'edit' => Pages\EditGameslist::route('/{record}/edit'),
        ];
    }
}
