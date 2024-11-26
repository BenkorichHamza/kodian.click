<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiscountResource\Pages;
use App\Filament\Resources\DiscountResource\RelationManagers;
use App\Models\Discount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                    Forms\Components\TextInput::make('titleAr')
                    ->label('ArabicTitle')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->label('Description'),
                    Forms\Components\TextInput::make('descriptionAr')
                    ->label('Arabic Description'),
                Forms\Components\DateTimePicker::make('startAt')
                    ->label('Start at')
                    ->required(),
                Forms\Components\DateTimePicker::make('endAt')
                    ->label('End at')
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->required()

                    ->numeric()
                    ->maxLength(100),
                Forms\Components\TextInput::make('percent')
                    ->label('Percent')
                    ->required()

                    ->numeric()
                    ->maxLength(100),
                Forms\Components\Select::make('products')
                    ->multiple()
                    ->relationship('products', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title'),
                    Tables\Columns\TextColumn::make('titleAr')
                    ->label('Arabic Title'),
                    Tables\Columns\TextColumn::make('percent')
                    ->label('Percent'),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount'),
                Tables\Columns\TextColumn::make('startAt')
                    ->label('Start At')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('endAt')
                    ->label('End At')
                    ->dateTime(),
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
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
