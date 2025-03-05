<?php

namespace App\Filament\Resources\TicketPaymentResource\Pages;

use App\Filament\Resources\TicketPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketPayments extends ListRecords
{
    protected static string $resource = TicketPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
