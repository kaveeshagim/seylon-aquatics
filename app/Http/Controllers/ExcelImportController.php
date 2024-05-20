<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('excel_file');

        $rows = Excel::toArray([], $file);

        foreach ($rows[0] as $row) {
            // Assuming your Excel columns are in the order: id, name, month
            DB::table('tbl_excel')->insert([
                'id' => $row[0],
                'name' => $row[1],
                'month' => $row[2],
            ]);
        }

        return redirect()->back()->with('success', 'Excel file uploaded successfully.');
    }
}
