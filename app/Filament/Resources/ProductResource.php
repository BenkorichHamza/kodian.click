<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Features')->columns(
                    [
                        'sm' => 2,
                        'xl' => 4,
                    ]
                )->schema([

                    Forms\Components\Checkbox::make('isAvailable')->default(true),
                    Forms\Components\Checkbox::make('isFeatured')->default(false),
                    Forms\Components\Checkbox::make('isSponsored')->default(false),
                    Forms\Components\Checkbox::make('isNew')->default(false),
                ]),
                Forms\Components\TextInput::make('name')->unique()->required(),
                Forms\Components\TextInput::make('price')->required(),
                Forms\Components\TextInput::make('nameAr')->formatStateUsing(fn (?Product $record): string => $record?->name ?? ''),
                Forms\Components\TextInput::make('description')->formatStateUsing(fn (?Product $record): string => $record?->name ?? ''),
                Forms\Components\TextInput::make('descriptionAr')->formatStateUsing(fn (?Product $record): string => $record?->name ?? ''),
                Forms\Components\TextInput::make('barcode'),
                Forms\Components\TextInput::make('code')->default(fn (?Product $record): string => $record?->barcode ?? ''),
                Forms\Components\TextInput::make('discount')->required()->default(0),
                Forms\Components\Checkbox::make('isInteger')->default(true),
                Forms\Components\Checkbox::make('inputPrice')->default(false),
                Forms\Components\TextInput::make('unit')->default("u"),
                Forms\Components\TextInput::make('step')->default(1),
                Forms\Components\Select::make('categories')
                    ->multiple()
                    ->relationship('categories', 'name')->preload(),
                Forms\Components\Select::make('brand')
                    ->relationship('brand', 'name'),
                FileUpload::make('img')->image()
                    ->disk("public")->imageEditorMode(1)->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              "img" => Tables\Columns\ImageColumn::make('img'),
              "isAvailable" => Tables\Columns\IconColumn::make('isAvailable')->boolean()->sortable(),
              "isFeatured" => Tables\Columns\IconColumn::make('isFeatured')->boolean()->sortable(),
              "isSponsored" => Tables\Columns\IconColumn::make('isSponsored')->boolean()->sortable(),
              "isNew" => Tables\Columns\IconColumn::make('isNew')->boolean()->sortable(),
              "name" => Tables\Columns\TextColumn::make('name')->searchable(),
              "namAr" => Tables\Columns\TextColumn::make('nameAr'),
            //   "description" => Tables\Columns\TextColumn::make('description'),
              "price" => Tables\Columns\TextColumn::make('price')
            ])
            ->filters([

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
