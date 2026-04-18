<?php

namespace App\Filament\Dokan\Resources\Products\Pages;

use App\Filament\Dokan\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['dokan_id'] = Auth::guard("dokan")->user()->id;
          $data['slug'] = str::slug($data['name']);
        return parent::mutateFormDataBeforeCreate($data);
    }
}
