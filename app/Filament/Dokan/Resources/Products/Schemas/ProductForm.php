<?php

namespace App\Filament\Dokan\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Product Details')
               ->schema([
                 TextInput::make('name')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('slug')
                    ->hiddenOn('create')
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->multiple()
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs.'),
                TextInput::make('discount')
                ->suffix("%")
                    ->required()
                    ->numeric()
                    ->default(0),
               ])->columnSpanFull()->columns(2),

            ]);
    }
}
