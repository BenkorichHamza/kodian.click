<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommuneResource\Pages;
use App\Models\Commune;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommuneResource extends Resource
{
    protected static ?string $model = Commune::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('nameAr')->required(),
                Forms\Components\TextInput::make('longitude')->numeric(),
                Forms\Components\TextInput::make('latitude')->numeric(),
                Forms\Components\Select::make('wilaya_id')
                    ->relationship('wilaya', 'name'),
                Forms\Components\FileUpload::make('img')->image()
                ->disk("public")->imageEditorMode(1)->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               "img" => Tables\Columns\ImageColumn::make('img'),
                "Wilaya" => Tables\Columns\TextColumn::make('wilaya.name')->searchable(),
                "name" => Tables\Columns\TextColumn::make('name')->searchable(),
                "namAr" => Tables\Columns\TextColumn::make('nameAr'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCommunes::route('/'),
            'create' => Pages\CreateCommune::route('/create'),
            'edit' => Pages\EditCommune::route('/{record}/edit'),
        ];
    }
}
