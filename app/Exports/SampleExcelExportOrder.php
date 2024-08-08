<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class SampleExcelExportOrder implements FromArray
{
    public function array(): array
    {
        return [
            ['fish_code', 'quantity'], // Column headers
            ['CODE001', '10'], // Example row
            ['CODE002', '20']
        ];
    }
}
