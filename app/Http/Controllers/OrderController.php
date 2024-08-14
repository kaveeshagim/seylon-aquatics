<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SampleExcelExportOrder;
use App\Models\Order;
use App\Models\OrderDet;
use App\Models\FishWeekly;
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

    public function getorderhistory() 
    {
        // Eager load the related customer data
        $orders = Order::with('customer:id,fname')->get();
    
        // Return the data as JSON
        return response()->json($orders);
    }

    public function getcustomerorders() 
    {
        // Retrieve orders with customer and executive details
        $orders = DB::table('tbl_order_mst as om')
            ->select(
                'om.*', // All columns from the tbl_order_mst table
                DB::raw("CONCAT(c.title, ' ', c.fname, ' ', IFNULL(c.lname, '')) as customer_name"),
                'u.fname as executive_fname'
            )
            ->join('tbl_customers as c', 'c.user_id', '=', 'om.cus_id') // Join tbl_customers to get customer details
            ->join('tbl_users as u', 'u.id', '=', 'om.executive_id') // Join tbl_users to get executive details
            ->whereNotNull('om.status') // Ensure status is not null
            ->get();
    
        // Return the data as JSON
        return response()->json($orders);
    }
    

    public function getcusorderdetail($id) 
    {
        // Retrieve the order details by ID and join with tbl_fish_variety to get additional fish details
        $orderDetails = DB::table('tbl_order_det as od')
            ->select(
                'od.*',
                'fv.common_name',
                'fv.scientific_name',
                'fv.size_cm',
                'fv.size'
            )
            ->join('tbl_fish_variety as fv', 'od.fish_code', '=', 'fv.fish_code')
            ->where('od.order_id', $id)
            ->get();
    
        // Return the data as JSON
        return response()->json($orderDetails);
    }
    
    
    

    public function addorderexcel(Request $request) {
        // Validate the incoming request
        $request->validate([
            'excel_input' => 'required|file|mimes:xlsx,xls,csv',
        ]);
    
        // Get the uploaded file
        $file = $request->file('excel_input');
    
        try {
            // Load the file into an array
            $rows = Excel::toArray([], $file);
    
            // Remove the first row (header row)
            array_shift($rows[0]);
    
            // Get user ID from session
            $cus_id = session()->get('userid');
    
            // Insert a new record into tbl_order_mst
            $order_id = DB::table('tbl_order_mst')->insertGetId([
                'cus_id' => $cus_id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Insert data into the database
            foreach ($rows[0] as $row) {
                DB::table('tbl_order_det')->insert([
                    'order_id' => $order_id,
                    'fish_code' => $row[0] ?? null,
                    'year' => null,
                    'month' => null,
                    'week' => null,
                    'gross_price' => $row[1] ?? null,
                    'quantity' => $row[2] ?? null,
                    'special_offer' => $row[3] ?? null,
                    'discount' => $row[4] ?? null,
                    'stock_status' => 'in stock',
                ]);
            }
    
            // Return a JSON response for AJAX success
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            // Handle the exception and return a JSON response for AJAX error
            return response()->json(['success' => false, 'message' => 'An error occurred while processing the file: ' . $e->getMessage()]);
        }
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

    $pendingOrders = DB::table('tbl_order_mst')->select('id')->where('status','pending')->count();
    $totalOrders = DB::table('tbl_order_mst')->select('id')->count();
    $pendinginvoices = DB::table('tbl_invoice_mst')->select('id')->where('invoice_status','pending')->count();
    $shippedOrders = DB::table('tbl_shipment')->select('id')->where('status','completed')->count();
    $inTransitOrders = DB::table('tbl_shipment')->select('id')->where('status','in-transit')->count();
    $completedOrders = DB::table('tbl_order_mst')->select('id')->where('status','completed')->count();

    // Send data to Node.js server
    Http::post('http://localhost:6050/updateOrders', [
        'pendingOrders' => $pendingOrders,
        'totalOrders' => $totalOrders,
        'pendingInvoices' => $pendinginvoices,
        'shippedOrders' => $shippedOrders,
        'inTransitOrders' => $inTransitOrders,
        'completedOrders' => $completedOrders,
    ]);

    return response()->json(['status' => 'Order status updated']);
}

public function getorderdetail($id) {

    $data = DB::table('tbl_order_mst')
              ->select('*')
              ->where('cus_id', $id)
              ->get();

    return response()->json($data);
}

public function downloadSampleOrderExcel()
{
    $filename = 'order_upload_template.xlsx';

    return Excel::download(new SampleExcelExportOrder, $filename);
}

public function fetchfishweeklydata(Request $request) {
    // Validate the request to ensure fish_codes is an array and required
    $request->validate([
        'fish_codes' => 'required|array|min:1',
        'fish_codes.*' => 'string'
    ]);

    $fishCodes = $request->input('fish_codes');
    $errors = [];

    // Iterate over each fish code to check stock status
    foreach ($fishCodes as $index => $fishCode) {
        $fishRecord = FishWeekly::where('fish_code', $fishCode)->first(['fish_code', 'stock_status']);
        
        if (!$fishRecord) {
            $errors[] = "Fish code {$fishCode} at line " . ($index + 2) . " has no record in this week's fish list.";
            return response()->json(['status' => 'error', 'message' => "Fish code {$fishCode} at line " . ($index + 2) . " has no record in this week's fish list."]);
        } elseif ($fishRecord->stock_status !== 'in-stock') {
            $errors[] = "Fish code {$fishCode} at line " . ($index + 2) . " is out of stock.";
            return response()->json(['status' => 'error', 'message' => "Fish code {$fishCode} at line " . ($index + 2) . " is out of stock."]);

        }
    }

    // If everything is fine, return a success response
    return response()->json(['status' => 'success', 'message' => 'All fish codes are valid and in stock.']);
}



public function orderuploadexcel(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'excel_input' => 'required|file|mimes:xlsx,xls|max:5120', // 5MB Max
    ]);

    // Load the Excel file
    $file = $request->file('excel_input');
    $data = Excel::toArray([], $file)[0]; // Assuming data is in the first sheet

    // Retrieve customer ID from session
    $customerId = session()->get('userid');

    // Find the executive ID associated with this customer
    $executiveId = DB::table('tbl_customers')->where('user_id', $customerId)->value('executive_id');
    if (!$executiveId) {
        return response()->json(['status' => 'error', 'message' => 'Executive not found for the customer.']);
    }

    // Insert the record into tbl_order_mst
    $orderMst = Order::create([
        'cus_id' => $customerId,
        'executive_id' => $executiveId,
        'advanced_payment' => 'no',
        'tot_orders' => 0, // Placeholder, will update later
        'tot_bags' => 0,   // Placeholder, will update later
        'tot_boxes' => 0,  // Placeholder, will update later
        'shipping_address' => $request->input('shippingaddress'), // Provided shipping address
    ]);

    // Fetch the current date
    $currentDate = now();
    $day = $currentDate->format('d');
    $month = $currentDate->format('m');

    // Generate the order number using the order ID
    $orderId = $orderMst->id;
    $orderNo = sprintf("#O%s%s%04d", $day, $month, $orderId);

    // Update the order with the generated order number
    $orderMst->update(['order_no' => $orderNo]);

    // Initialize counters for total orders, bags, and boxes
    $totalOrders = 0;
    $totalBags = 0;

    // Insert each row from the Excel file into tbl_order_det
    foreach ($data as $index => $row) {
        if ($index == 0) {
            // Skip the header row
            continue;
        }

        // Check if fish code exists in tbl_fishweekly
        $fishWeekly = DB::table('tbl_fishweekly')->where('fish_code', $row[0])->first();
        if (!$fishWeekly) {
            return response()->json(['status' => 'error', 'message' => 'Fish code ' . $row[0] . ' not found in weekly list.']);
        }

        // Get qtyperbag from tbl_fish_variety
        $fishVariety = DB::table('tbl_fish_variety')->where('fish_code', $row[0])->first();
        if (!$fishVariety) {
            return response()->json(['status' => 'error', 'message' => 'Fish code ' . $row[0] . ' not found in fish variety list.']);
        }

        // Calculate the number of bags
        $qtyPerBag = $fishVariety->qtyperbag;
        $quantity = $row[1];
        $numberOfBags = (int)ceil($quantity / $qtyPerBag);

        // Insert into tbl_order_det
        OrderDet::create([
            'order_id' => $orderMst->id, // Link to the order_mst entry
            'order_no' => $orderNo, // Use the newly generated order number
            'fish_code' => $row[0],
            'orders' => $quantity,
            'quantity' => $quantity,
            'bags' => $numberOfBags,
            'approval_status' => 'pending',
        ]);

        // Update total orders and total bags
        $totalOrders += 1;
        $totalBags += $numberOfBags;
    }

    // Calculate the total number of boxes
    $totalBoxes = (int)ceil($totalBags / 4); // 1 box holds 4 bags

    // Update the total counts in the tbl_order_mst
    $orderMst->update([
        'tot_orders' => $totalOrders,
        'tot_bags' => $totalBags,
        'tot_boxes' => $totalBoxes,
    ]);

    // Return success response
    return response()->json(['status' => 'success', 'id' => $orderMst->id, 'message' => 'Order uploaded successfully.']);
}




}
