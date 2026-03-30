<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\ExportAction;
use App\Filament\Exports\OrderExporter;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exporter(OrderExporter::class),
            CreateAction::make(),
        ];
    }
}
