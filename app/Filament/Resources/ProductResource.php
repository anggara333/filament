<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Produk')
                ->autocomplete('off')
                ->required(),
            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()
                      ->label('Nama Produk'),
                Tables\Columns\TextColumn::make('price')
                      ->formatStateUsing(fn ($state) => number_format($state, 2))
                      ->label('Harga'),
                Tables\Columns\TextColumn::make('stock')
                      ->label('Stok'),
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
            'index' => Pages\ListProducts::route('/'),
          //  'create' => Pages\CreateProduct::route('/create'),
         //   'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
