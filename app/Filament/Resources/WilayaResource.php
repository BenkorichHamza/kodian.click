<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WilayaResource\Pages;
use App\Filament\Resources\WilayaResource\RelationManagers;
use App\Models\Wilaya;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WilayaResource extends Resource
{
    protected static ?string $model = Wilaya::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('nameAr')->required(),
                Forms\Components\TextInput::make('message'),
                Forms\Components\TextInput::make('messageAr'),
                Forms\Components\TextInput::make('code')->required(),
                Forms\Components\Checkbox::make('isActive')->default(false),
                Forms\Components\Checkbox::make('isSoon')->default(false),
                Forms\Components\TextInput::make('status')->integer(),
                Forms\Components\TextInput::make('longitude')->numeric(),
                Forms\Components\TextInput::make('latitude')->numeric(),
                FileUpload::make('img')->image()
                ->disk("public")->imageEditorMode(1)->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                "img" => Tables\Columns\ImageColumn::make('img'),
                "isActive" => Tables\Columns\IconColumn::make('isActive')->boolean()->sortable(),
                "isSoon" => Tables\Columns\IconColumn::make('isSoon')->boolean()->sortable(),
                "status" => Tables\Columns\IconColumn::make('status')->sortable(),
                "code" => Tables\Columns\TextColumn::make('code')->searchable(),
                "name" => Tables\Columns\TextColumn::make('name')->searchable(),
                "namAr" => Tables\Columns\TextColumn::make('nameAr'),
                "message" => Tables\Columns\TextColumn::make('message')->searchable(),
                "messageAr" => Tables\Columns\TextColumn::make('messageAr')->searchable(),
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
            'index' => Pages\ListWilayas::route('/'),
            'create' => Pages\CreateWilaya::route('/create'),
            'edit' => Pages\EditWilaya::route('/{record}/edit'),
        ];
    }
}
