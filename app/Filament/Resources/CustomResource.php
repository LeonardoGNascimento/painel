<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomResource\Pages;
use App\Models\Custom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class CustomResource extends Resource
{
    protected static ?string $model = Custom::class;
    protected static ?string $navigationIcon = 'heroicon-s-cog';
    protected static ?string $navigationGroup = 'Configurações';
    protected static ?string $modelLabel = 'Configurações';

    public static function canAccess(): bool
    {
        return auth()->user()->admin === 1;
    }

    public static function canCreate(): bool
    {
        return Custom::count() > 0 ? false : true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('primary')
                    ->name('Cor')
                    ->options([
                        "Slate" => "Slate",
                        "Gray" => "Gray",
                        "Zinc" => "Zinc",
                        "Neutral" => "Neutral",
                        "Stone" => "Stone",
                        "Red" => "Red",
                        "Orange" => "Orange",
                        "Amber" => "Amber",
                        "Yellow" => "Yellow",
                        "Lime" => "Lime",
                        "Green" => "Green",
                        "Emerald" => "Emerald",
                        "Teal" => "Teal",
                        "Cyan" => "Cyan",
                        "Sky" => "Sky",
                        "Blue" => "Blue",
                        "Indigo" => "Indigo",
                        "Violet" => "Violet",
                        "Purple" => "Purple",
                        "Fuchsia" => "Fuchsia",
                        "Pink" => "Pink",
                        "Rose" => "Rose"
                    ])
                    ->required(),
                Forms\Components\TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('logo')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')->size(50)->label('Logo'),
                Tables\Columns\TextColumn::make('primary')
                    ->label('Cor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustoms::route('/'),
        ];
    }
}
