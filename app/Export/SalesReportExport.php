<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\SalesReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SalesReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithChunkReading
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SalesReport::select(
            'company', 'sales_order', 'po_number', 'so_date', 'invoice', 'external_invoice', 'invoice_date', 'due_date', 'invoice_account', 'name', 'address_group', 'packslip_date', 'packing_slip', 'external_packing_slip','sales',
        )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Company',
            'Sales Order',
            'PO Number',
            'SO Date',
            'Invoice',
            'External Invoice',
            'Invoice Date',
            'Due Date',
            'Invoice Account',
            'Name',
            'Address Group',
            'Packslip Date',
            'Packing Slip',
            'External Packing Slip',
            'Sales',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
