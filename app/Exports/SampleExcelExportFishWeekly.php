<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class SampleExcelExportFishWeekly implements FromArray
{

    public function array(): array
    {
        return [
            ['fish_code', 'gross_price', 'quantity', 'special_offer', 'discount'], // Column headers
            ['CODE001', '100.00', '10', 'yes', '5'], // Example row
            ['CODE002', '150.00', '20', 'no', '10']
        ];
    }
}
