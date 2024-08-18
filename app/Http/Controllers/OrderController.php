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
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDet;
use App\Models\FishWeekly;
use App\Models\TestOrder;
use App\Events\OrderStatusChanged;
use App\Services\PHPMailerService;
use Illuminate\Support\Facades\Log;

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

    public function getorderitemdet($id) {
        
        $data = DB::table('tbl_order_det')
        ->select('tbl_order_det.fish_code','tbl_order_det.quantity', 'tbl_fish_variety.common_name')
        ->join('tbl_fish_variety', 'tbl_fish_variety.fish_code', '=', 'tbl_order_det.fish_code')
        ->where('tbl_order_det.id', $id)
        ->first();


        return response()->json([
            'data' => $data,
        ]);  
    }

    public function getorderhistory(Request $request)
    {
        // Retrieve the user ID from the session
        $userId = session()->get('userid');
    
        // Fetch user type from the database
        $userType = DB::table('tbl_users')
            ->where('id', $userId)
            ->value('tbl_usertype_id');
    
        // Start building the query
        $query = DB::table('tbl_order_mst')
            ->leftJoin('tbl_users as executives', 'tbl_order_mst.executive_id', '=', 'executives.id')
            ->select(
                'tbl_order_mst.created_at',
                'tbl_order_mst.order_no',
                'tbl_order_mst.customer_name',
                'executives.fname as executive_fname',
                'executives.lname as executive_lname',
                'tbl_order_mst.shipping_address',
                'tbl_order_mst.tot_orders',
                'tbl_order_mst.tot_bags',
                'tbl_order_mst.tot_boxes',
                'tbl_order_mst.delivery_date',
                'tbl_order_mst.discount_applied',
                'tbl_order_mst.order_total',
                'tbl_order_mst.status',
                'tbl_order_mst.id'
            );
    
        // Apply user-specific filters
        if ($userType == 5) { // Customer
            // Get the customer ID associated with the user
            $customerId = DB::table('tbl_customers')
                ->where('user_id', $userId)
                ->value('id');
    
            // Fetch orders only for the specific customer
            $query->where('tbl_order_mst.cus_id', $customerId);
        } elseif ($userType == 3) { // Executive
            $query->where('tbl_order_mst.executive_id', $userId);
        }
    
        // Apply date range filter if provided
        if ($request->has('from_date') && $request->has('to_date') && !empty($request->input('from_date')) && !empty($request->input('to_date'))) {
            $query->whereBetween('tbl_order_mst.created_at', [$request->input('from_date'), $request->input('to_date')]);
        }
    
        // Apply status filter if provided
        if ($request->has('status') && !empty($request->input('status'))) {
            $query->where('tbl_order_mst.status', $request->input('status'));
        }
    
        // Fetch the filtered or non-filtered orders
        $orders = $query->get();
    
        // Format the data for DataTables
        $formattedOrders = $orders->map(function ($order) {
            return [
                'created_at' => $order->created_at,
                'order_no' => $order->order_no,
                'customer' => $order->customer_name,
                'executive' => trim("{$order->executive_fname} {$order->executive_lname}"),
                'shipping_address' => $order->shipping_address,
                'total_orders' => $order->tot_orders,
                'total_bags' => $order->tot_bags,
                'total_boxes' => $order->tot_boxes,
                'delivery_date' => $order->delivery_date,
                'discount_applied' => $order->discount_applied,
                'order_total' => number_format($order->order_total, 2),
                'status' => $order->status,
                'id' => $order->id,
            ];
        });
    
        // Return the data as JSON
        return response()->json(['data' => $formattedOrders]);
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
        // Retrieve the order details by ID and join with tbl_fish_variety and tbl_size to get additional details
        $orderDetails = DB::table('tbl_order_det as od')
            ->select(
                'od.*',
                'fv.common_name',
                'fv.scientific_name',
                'fv.size_cm',
                'fv.size',
                'sz.name as size_name' // Add size name
            )
            ->join('tbl_fish_variety as fv', 'od.fish_code', '=', 'fv.fish_code')
            ->leftJoin('tbl_size as sz', 'fv.size_cm', '=', 'sz.id') // LEFT JOIN with tbl_size
            ->where('od.order_id', $id)
            ->get();
        
        // Return the data as JSON
        return response()->json($orderDetails);
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

    // Retrieve customer details
$customer = DB::table('tbl_customers')->where('user_id', $customerId)->first();
if (!$customer) {
    return response()->json(['status' => 'error', 'message' => 'Customer not found.']);
}

// Concatenate customer name
$customerName = trim(sprintf(
    "%s %s %s",
    $customer->title ?? '',
    $customer->fname ?? '',
    $customer->lname ?? ''
));

$customerrecid = DB::table('tbl_customers')->select('id')->where('user_id',$customerId)->first();

    // Insert the record into tbl_order_mst
    $orderMst = Order::create([
        'cus_id' => $customerrecid->id,
        'executive_id' => $executiveId,
        'tot_orders' => 0, // Placeholder, will update later
        'tot_bags' => 0,   // Placeholder, will update later
        'tot_boxes' => 0,  // Placeholder, will update later
        'tot_fish' => 0,  // Placeholder, will update later
        'shipping_address' => $request->input('shippingaddress'), // Provided shipping address
        'customer_name' => $customerName,
        'status' => 'pending',
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
    $totalFish = 0;

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

        // Check if requested quantity is available
        $requestedQuantity = $row[1];
        if ($fishWeekly->quantity < $requestedQuantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fish code ' . $row[0] . ' has only ' . $fishWeekly->quantity . ' available, but ' . $requestedQuantity . ' was requested.',
            ]);
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
            'quantity' => $quantity,
            'bags' => $numberOfBags,
            'approval_status' => 'pending',
        ]);

        // Update total orders and total bags
        $totalOrders += 1;
        $totalBags += $numberOfBags;
        $totalFish += $quantity;
    }

    // Calculate the total number of boxes
    $totalBoxes = (int)ceil($totalBags / 4); // 1 box holds 4 bags

    // Update the total counts in the tbl_order_mst
    $orderMst->update([
        'tot_orders' => $totalOrders,
        'tot_bags' => $totalBags,
        'tot_boxes' => $totalBoxes,
        'tot_fish' => $totalFish,
    ]);

    try {

        // Retrieve the user details
        $user = User::where('id', $customerId)->where('active_status', 1)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Active user not found']);
        }


        $subject = "Order Created";
        $body = 'Hi ' . $user->username . ',<br><br>Your order, order no ' .  $orderNo. ' is created.';
    
        DB::table('tbl_notifications')->insert([
            'user_id' => $user->id,
            'notification' => 'Order No ' .  $orderNo . ' Created',
            'seen_status' => 0,
            'created_at' => now(),
        ]);

        // Send email to each user
        try {
            $mailerService = new PHPMailerService();
            $mailerService->sendEmail($user->email, $subject, nl2br($body));
            Log::info('Email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
        }


    
    } catch (\Exception $e) {
        Log::error('Failed to send notifications and emails. Error: ' . $e->getMessage());
    }

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();


    // Return success response
    return response()->json(['status' => 'success', 'id' => $orderMst->id, 'message' => 'Order uploaded successfully.']);
}


public function orderuploadform(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'table_data' => 'required|array',
        'table_data.*.fish_code' => 'required|string',
        'table_data.*.quantity' => 'required|numeric|min:1',
        'shipping_address' => 'required|string',
    ]);

    // Retrieve customer ID from session
    $customerId = session()->get('userid');

    // Find the executive ID associated with this customer
    $executiveId = DB::table('tbl_customers')->where('user_id', $customerId)->value('executive_id');
    if (!$executiveId) {
        return response()->json(['status' => 'error', 'message' => 'Executive not found for the customer.']);
    }

        // Retrieve customer details
    $customer = DB::table('tbl_customers')->where('user_id', $customerId)->first();
    if (!$customer) {
        return response()->json(['status' => 'error', 'message' => 'Customer not found.']);
    }

    // Concatenate customer name
    $customerName = trim(sprintf(
        "%s %s %s",
        $customer->title ?? '',
        $customer->fname ?? '',
        $customer->lname ?? ''
    ));

    $customerrecid = DB::table('tbl_customers')->select('id')->where('user_id',$customerId)->first();

    // Insert the record into tbl_order_mst
    $orderMst = Order::create([
        'cus_id' => $customerrecid->id,
        'executive_id' => $executiveId,
        'tot_orders' => 0, // Placeholder, will update later
        'tot_bags' => 0,   // Placeholder, will update later
        'tot_boxes' => 0,  // Placeholder, will update later
        'tot_fish' => 0,  // Placeholder, will update later
        'shipping_address' => $request->input('shipping_address'), // Provided shipping address
        'customer_name' => $customerName,
        'status' => 'pending',
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
    $totalFish = 0;

    // Extract table data from the request
    $tableData = $request->input('table_data');

    foreach ($tableData as $data) {
        $fishCode = $data['fish_code'];
        $quantity = $data['quantity'];

        // Check if fish code exists in tbl_fishweekly
        $fishWeekly = DB::table('tbl_fishweekly')->where('fish_code', $fishCode)->first();
        if (!$fishWeekly) {
            return response()->json(['status' => 'error', 'message' => 'Fish code ' . $fishCode . ' not found in weekly list.']);
        }

        // Check if requested quantity is available
        $requestedQuantity = $quantity;
        if ($fishWeekly->quantity < $requestedQuantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fish code ' . $fishCode . ' has only ' . $fishWeekly->quantity . ' available, but ' . $requestedQuantity . ' was requested.',
            ]);
        }

        // Get qtyperbag from tbl_fish_variety
        $fishVariety = DB::table('tbl_fish_variety')->where('fish_code', $fishCode)->first();
        if (!$fishVariety) {
            return response()->json(['status' => 'error', 'message' => 'Fish code ' . $fishCode . ' not found in fish variety list.']);
        }

        // Calculate the number of bags
        $qtyPerBag = $fishVariety->qtyperbag;
        $numberOfBags = (int)ceil($quantity / $qtyPerBag);

        // Insert into tbl_order_det
        OrderDet::create([
            'order_id' => $orderMst->id, // Link to the order_mst entry
            'order_no' => $orderNo, // Use the newly generated order number
            'fish_code' => $fishCode,
            'quantity' => $quantity,
            'bags' => $numberOfBags,
            'approval_status' => 'pending',
        ]);

        // Update total orders and total bags
        $totalOrders += 1;
        $totalBags += $numberOfBags;
        $totalFish += $quantity;
    }

    // Calculate the total number of boxes
    $totalBoxes = (int)ceil($totalBags / 4); // 1 box holds 4 bags

    // Update the total counts in the tbl_order_mst
    $orderMst->update([
        'tot_orders' => $totalOrders,
        'tot_bags' => $totalBags,
        'tot_boxes' => $totalBoxes,
        'tot_fish' => $totalFish,
    ]);


    try {

        // Retrieve the user details
        $user = User::where('id', $customerId)->where('active_status', 1)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Active user not found']);
        }


        $subject = "Order Created";
        $body = 'Hi ' . $user->username . ',<br><br>Your order, order no ' .  $orderNo. ' is created.';
    
        DB::table('tbl_notifications')->insert([
            'user_id' => $user->id,
            'notification' => 'Order No ' .  $orderNo . 'Created',
            'seen_status' => 0,
            'created_at' => now(),
        ]);

        // Send email to each user
        try {
            $mailerService = new PHPMailerService();
            $mailerService->sendEmail($user->email, $subject, nl2br($body));
            Log::info('Email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
        }


    
    } catch (\Exception $e) {
        Log::error('Failed to send notifications and emails. Error: ' . $e->getMessage());
    }

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();
    

    // Return success response
    return response()->json(['status' => 'success', 'id' => $orderMst->id, 'message' => 'Order submitted successfully.']);
}



public function cancelorder(Request $request) {

    $id = $request->input('id');

    $order = DB::table('tbl_order_mst')->where('id', $id)->first();

    if (!$order) {
        return response()->json(['status' => 'error', 'message' => 'Order not found']);
    }

    if($order->status == 'pending') {
        DB::table('tbl_order_mst')->where('id',$id)->update(['status'=>'cancelled']);

        try {
        
            $cus_id = $order->cus_id;

            // Get customer details from tbl_customers using cus_id
            $customer = DB::table('tbl_customers')->where('id', $cus_id)->first();
            if (!$customer) {
                return response()->json(['status' => 'error', 'message' => 'Customer not found']);
            }
    
            // Get user_id from the customer record
            $user_id = $customer->user_id;
    
            // Retrieve the user details
            $user = User::where('id', $user_id)->where('active_status', 1)->first();
    
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Active user not found']);
            }
    
    
            $subject = "Order Cancelled";
            $body = 'Hi ' . $user->username . ',<br><br>Your order, order no ' . $id . ' is cancelled.';
        
            DB::table('tbl_notifications')->insert([
                'user_id' => $user->id,
                'notification' => 'Order No ' . $order->order_no . 'Cancelled',
                'seen_status' => 0,
                'created_at' => now(),
            ]);
    
            // Send email to each user
            try {
                $mailerService = new PHPMailerService();
                $mailerService->sendEmail($user->email, $subject, nl2br($body));
                Log::info('Email sent to: ' . $user->email);
            } catch (\Exception $e) {
                Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
            }
    
    
        
        } catch (\Exception $e) {
            Log::error('Failed to send notifications and emails. Error: ' . $e->getMessage());
        }

        

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();
        
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"order cancelled ",$username, "Order Cancelled");

        return response()->json(['status' => 'success', 'message' => 'Order cancelled successfully!']);


    }else if($order->status == 'cancelled') {
        return response()->json(['status' => 'error', 'message' => 'Order is already cancelled!']);

    }else{
        return response()->json(['status' => 'error', 'message' => 'Order is not in the pending state, cannot cancel!']);
    }



}


public function orderconfirm($id) 
{
    // Step 1: Fetch the current status of the order
    $orderconfirmstatus = DB::table('tbl_order_mst')->where('id', $id)->value('status');

    if ($orderconfirmstatus == 'confirmed' || $orderconfirmstatus == 'shipping' || $orderconfirmstatus == 'completed') {
        return response()->json(['status' => 'error', 'message' => 'This order is already confirmed']);
    } 



    // Step 3: Retrieve the order_det records for the relevant order_mst record
    $orderItems = DB::table('tbl_order_det')
        ->where('order_id', $id)
        ->get();

    // Step 4: Check inventory levels and prepare to update
    foreach ($orderItems as $item) {
        $fishCode = $item->fish_code;
        $orderedQuantity = $item->quantity;

        // Check current quantity in tbl_fishweekly
        $currentQuantity = DB::table('tbl_fishweekly')
            ->where('fish_code', $fishCode)
            ->value('quantity');

        if ($currentQuantity < $orderedQuantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient quantity available in inventory for fish code ' . $fishCode . '. Available quantity: ' . $currentQuantity
            ]);
        }
    }

    // All checks passed, proceed to confirm the order
    DB::table('tbl_order_mst')->where('id', $id)->update(['status' => 'confirmed']);

    // Step 5: Update inventory levels and check stock status
    foreach ($orderItems as $item) {
        $fishCode = $item->fish_code;
        $orderedQuantity = $item->quantity;

        

        // Deduct the ordered quantity from the tbl_fishweekly
        DB::table('tbl_fishweekly')
            ->where('fish_code', $fishCode)
            ->decrement('quantity', $orderedQuantity);

        // Check if the updated quantity is less than 100
        $currentQuantity = DB::table('tbl_fishweekly')
            ->where('fish_code', $fishCode)
            ->value('quantity');

        if ($currentQuantity < 10) {
            // Update stock status to out-of-stock
            DB::table('tbl_fishweekly')
                ->where('fish_code', $fishCode)
                ->update(['stock_status' => 'out-of-stock']);
        }
    }

        // Step 6: Retrieve the customer info for sending notifications and email
        $orderdetails = DB::table('tbl_order_mst')->select('*')->where('id', $id)->first();
        $customerId = $orderdetails->cus_id;
    
        $customer = DB::table('tbl_customers')->where('id', $customerId)->first();
        $userId = $customer->user_id;
        $userEmail = $customer->email;
    
        // Prepare notification and email
        $subject = "Order No " . $orderdetails->order_no . " Confirmed";
        $body = 'Hi ' . $orderdetails->customer_name . ',<br><br>Your order, order no ' . $orderdetails->order_no . 
                ' has been confirmed.<br><br>Thank you, BioWorld Holdings.';
    
        // Send notification
        DB::table('tbl_notifications')->insert([
            'user_id' => $userId,
            'notification' => 'Order No ' . $orderdetails->order_no . ' Confirmed',
            'seen_status' => 0,
            'created_at' => now(),
        ]);
    
        // Send email
        try {
            $mailerService = new PHPMailerService();
            $mailerService->sendEmail($userEmail, $subject, nl2br($body));
            Log::info('Confirmation email sent to: ' . $userEmail);
        } catch (\Exception $e) {
            Log::error('Email sending failed for ' . $userEmail . '. Error: ' . $e->getMessage());
        }

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();

    return response()->json([
        'status' => 'success',
        'message' => 'Order confirmed successfully!'
    ]);


}

public function orderconfirmstatuscheck($id) {

    $order = DB::table('tbl_order_mst')->select('status', 'tot_orders')->where('id',$id)->first();
    
    if($order->status == 'pending') {

        if($order->tot_orders > 0) {

            $response = $this->orderconfirm($id);

            $responseData = json_decode($response->getContent(), true);
                // Handle success case
            return response()->json(['status'=> $responseData['status'], 'message' => $responseData['message']]);

        }else{
            return response()->json(['status' => 'error', 'message' => 'Order doesnt have any order items!']);

        }

    }else{

        return response()->json(['status' => 'error', 'message' => 'Order is in ' .$order->status. ' state. Cannot confirm!']);

    }
}



public function editorderdet(Request $request) {
    $id = $request->input('editid');


    
    // Fetch the order detail record to be edited
    $orderDetail = OrderDet::find($id);
    if (!$orderDetail) {
        return response()->json(['status' => 'error', 'message' => 'Order detail not found.']);
    }

    // Fetch the order status
        $orderstatus = DB::table('tbl_order_mst')
            ->select('tbl_order_mst.status')
            ->where('tbl_order_mst.order_no', $orderDetail->order_no)
            ->first();

    if ($orderstatus->status != 'pending') {
        return response()->json(['status' => 'error', 'message' => 'Only pending order details can be updated.']);

    }

    // Get the new quantity from the request
    $newQuantity = $request->input('qty-edit');

    // Check if the new quantity is greater than 0
    if ($newQuantity <= 0) {
        return response()->json(['status' => 'error', 'message' => 'Quantity must be greater than 0.']);
    }

    // Fetch the related order master record using order_no
    $orderMst = Order::where('order_no', $orderDetail->order_no)->first();
    if (!$orderMst) {
        return response()->json(['status' => 'error', 'message' => 'Order master record not found.']);
    }

    // Fetch the fish code from the order detail
    $fishCode = $orderDetail->fish_code;

    // Check if fish code exists in tbl_fishweekly
    $fishWeekly = DB::table('tbl_fishweekly')->where('fish_code', $fishCode)->first();
    if (!$fishWeekly) {
        return response()->json(['status' => 'error', 'message' => 'Fish code ' . $fishCode . ' not found in weekly list.']);
    }

    // Check if the new quantity exceeds the available quantity
    $availableQuantity = $fishWeekly->quantity;
    if ($newQuantity > $availableQuantity) {
        return response()->json(['status' => 'error', 'message' => 'Quantity exceeds the available stock for fish code ' . $fishCode . '.']);
    }

    // Update the quantity in the order detail
    $orderDetail->quantity = $newQuantity;
    $orderDetail->save();

    // Recalculate totals based on the updated quantity
    $totalOrders = 0;
    $totalBags = 0;
    $totalFish = 0;

    // Fetch all order details related to this order_no
    $orderDetails = OrderDet::where('order_no', $orderMst->order_no)->get();

    foreach ($orderDetails as $detail) {
        $fishCode = $detail->fish_code;
        $quantity = $detail->quantity;

        // Get qtyperbag from tbl_fish_variety
        $fishVariety = DB::table('tbl_fish_variety')->where('fish_code', $fishCode)->first();
        if (!$fishVariety) {
            return response()->json(['status' => 'error', 'message' => 'Fish code ' . $fishCode . ' not found in fish variety list.']);
        }

        // Calculate the number of bags
        $qtyPerBag = $fishVariety->qtyperbag;
        $numberOfBags = (int)ceil($quantity / $qtyPerBag);

        // Update the bags field for each order detail
        $detail->bags = $numberOfBags;
        $detail->save();

        // Update total orders, total bags, and total fish
        $totalOrders += 1;
        $totalBags += $numberOfBags;
        $totalFish += $quantity;
    }

    // Calculate the total number of boxes
    $totalBoxes = (int)ceil($totalBags / 4); // Assuming 1 box holds 4 bags

    // Update the total counts in the tbl_order_mst
    $orderMst->update([
        'tot_orders' => $totalOrders,
        'tot_bags' => $totalBags,
        'tot_boxes' => $totalBoxes,
        'tot_fish' => $totalFish,
    ]);

    return response()->json(['status' => 'success', 'message' => 'Order details updated successfully.']);
}


public function deleteorderdet(Request $request) {
    $id = $request->input('id');
    $orderid = $request->input('orderid');

    // Fetch the order status
    $orderstatus = DB::table('tbl_order_mst')
        ->where('id', $orderid)
        ->value('status');

    if ($orderstatus == 'pending') {
        // Delete the order detail if the order is pending
        $deleted = DB::table('tbl_order_det')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Order item removed successfully!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to remove order item.']);
        }
    } else {
        return response()->json(['status' => 'error', 'message' => 'Cannot remove the item since the order is not in pending state!']);
    }
}



}
