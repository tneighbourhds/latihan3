<?php

// namespace App\Filament\Resources\UserResource\Pages;

// use App\Filament\Resources\UserResource;
// use Filament\Actions;
// use Filament\Resources\Pages\EditRecord;

// class EditUser extends EditRecord
// {

//     protected function getRedirectUrl(): string
// {
//     return $this->getResource()->getUrl('index');
// }

//     protected static string $resource = UserResource::class;

//     protected function getHeaderActions(): array
//     {
//         return [
//             Actions\ViewAction::make(),
//             Actions\DeleteAction::make(),
//         ];
//     }
// }
namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}