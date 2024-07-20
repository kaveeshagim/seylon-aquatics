<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    // public function upload(Request $request)
    // {
    //     $file = $request->file('excel_file');

    //     $rows = Excel::toArray([], $file);

    //     foreach ($rows[0] as $row) {
    //         // Assuming your Excel columns are in the order: id, name, month
    //         DB::table('tbl_fish_variety')->insert([
    //             'id' => $row[0],
    //             'code' => $row[1],
    //             'habitat_id' => $row[2],
    //             'name' => $row[3],
    //             'scientific_name' => $row[4],
    //             'created_at' => $row[5],
    //             'updated_at' => $row[6],
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Excel file uploaded successfully.');
    // }

    public function upload(Request $request)
{
    $file = $request->file('excel_file');

    $rows = Excel::toArray([], $file);

    // Remove the first row (header row)
    array_shift($rows[0]);

    foreach ($rows[0] as $row) {
        // Assuming your Excel columns are in the order: id, name, month
        DB::table('tbl_fish_variety')->insert([
            'id' => $row[0],
            'code' => $row[1],
            'habitat_id' => $row[2],
            'name' => $row[3],
            'scientific_name' => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6],
        ]);
    }

    return redirect()->back()->with('success', 'Excel file uploaded successfully.');
}

}
