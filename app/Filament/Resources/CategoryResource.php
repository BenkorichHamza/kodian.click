<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nameAr')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(1024),
                    Forms\Components\TextInput::make('descriptionAr')
                    ->required()
                    ->maxLength(1024),
                    Forms\Components\TextInput::make('order')->required()
                    ->integer(),
                    Forms\Components\Select::make('parentId')
                        ->relationship('parent', 'name'),

                FileUpload::make('img')
                    ->image()
                    ->disk("public")
                    ->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                "img" => Tables\Columns\ImageColumn::make('img'),
              "name" => Tables\Columns\TextColumn::make('name')->searchable(),
            //   "order" => Tables\Columns\TextColumn::make('order')->sortable(),
              "order" => Tables\Columns\TextInputColumn::make('order'),
              "namAr" => Tables\Columns\TextColumn::make('nameAr'),
              "parentName" => Tables\Columns\TextColumn::make('parent.name')->searchable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
