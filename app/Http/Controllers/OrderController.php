<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use App\Models\OrderDet;
use App\Models\TestOrder;
use App\Events\OrderStatusChanged;

class OrderController extends Controller
{

    public function getorders() {

        $data = Order::all();

                $data = Fish::with(['habitat', 'variety', 'size'])->get();
        $data = $data->map(function ($fish) {
            return [
                'fish_code' => $fish->fish_code,
                'scientific_name' => $fish->scientific_name,
                'common_name' => $fish->common_name,
                'fishhabitat' => $fish->habitat->name,
                'fishvariety' => $fish->variety->name,
                'fishsize' => $fish->size->name,
                'id' => $fish->id,
            ];
        });

        // Return the data, you can return it as JSON or to a view, depending on your requirements
        return response()->json($data);
    }

    public function orderupload(Request $request){
        $file = $request->file('excel_file');

        $rows = Excel::toArray([], $file);

        // Remove the first row (header row)
        array_shift($rows[0]);

        foreach ($rows[0] as $row) {
            // Assuming your Excel columns are in the order: id, name, month
            DB::table('tbl_order_det')->insert([
                'fish_code' => $row[0],
                'size' => $row[1],
                'per_bag' => $row[2],
                'orders' => $row[3],
            ]);
        }

        return redirect()->back()->with('success', 'Excel file uploaded successfully.');
    }
    
    public function count()
    {
        $today = Carbon::today()->toDateString();
        $pending = TestOrder::where('status', 'pending')->whereDate('created_at', $today)->count();
        $completed = TestOrder::where('status', 'completed')->whereDate('created_at', $today)->count();

        return response()->json([
            'pending' => $pending,
            'completed' => $completed,
        ]);
    }

public function updateStatus()
{
    // Fetch updated order counts from the database
    $pendingOrders = 20; // Get pending orders count
    $inProgressOrders = 10; // Get in-progress orders count
    $shippedOrders = 10; // Get shipped orders count
    $completedOrders = 10; // Get completed orders count

    // Send data to Node.js server
    Http::post('http://localhost:6050/updateOrders', [
        'pendingOrders' => $pendingOrders,
        'inProgressOrders' => $inProgressOrders,
        'shippedOrders' => $shippedOrders,
        'completedOrders' => $completedOrders,
    ]);

    return response()->json(['status' => 'Order status updated']);
}

}
