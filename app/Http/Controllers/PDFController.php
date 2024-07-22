<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function downloadPDF()
    {

        $pdf = PDF::loadView('ordersoverview');

        return $pdf->download('ordersoverview.pdf');
    }
}
