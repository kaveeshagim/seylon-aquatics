<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\PHPMailerService;

class InvoiceController extends Controller
{

    public function getinvoices(Request $request) 
    {
        $usertype = session()->get('user_type');
        $userid = session()->get('userid');
        
        // Start building the query
        $query = DB::table('tbl_invoice_mst')
                    ->leftJoin('tbl_order_mst', 'tbl_invoice_mst.order_id', '=', 'tbl_order_mst.id')
                    ->leftJoin('tbl_users', 'tbl_order_mst.executive_id', '=', 'tbl_users.id')
                    ->leftJoin('tbl_shipment', 'tbl_invoice_mst.invoice_no', '=', 'tbl_shipment.invoice_no')
                    ->select(
                        'tbl_invoice_mst.*', 
                        'tbl_order_mst.customer_name', // Include customer_name
                        'tbl_users.fname as executive_fname',
                        'tbl_users.lname as executive_lname',
                        'tbl_shipment.status as shipment_status',
                        'tbl_shipment.delivered_date as delivered_date'
                    );
    
        // Check if date range filters are applied
        if ($request->has('from-date') && $request->has('to-date')) {
            $fromDate = $request->input('from-date');
            $toDate = $request->input('to-date');
            $query->whereBetween('tbl_invoice_mst.created_at', [$fromDate, $toDate]);
        }
    
        // Check if status filter is applied
        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('tbl_invoice_mst.invoice_status', $status);
        }
    
        // User type check
        if ($usertype == 1) {
            // Retrieve all records for usertype 1
            $invoices = $query->get();
        } elseif ($usertype == 3) {
            // Filter based on executive_id for usertype 3
            $invoices = $query->where('tbl_order_mst.executive_id', $userid)->get();
        }else if ($usertype == 5){
            // Filter based on customer ID for usertype 5
                $invoices = $query->join('tbl_customers', 'tbl_order_mst.cus_id', '=', 'tbl_customers.id')
                ->where('tbl_customers.user_id', $userid)
                ->get();
        } else {
            // Default case for other user types (if any)
            $invoices = $query->get();
        }
    
        // Map the executive name to a single field
        $invoices = $invoices->map(function($invoice) {
            $invoice->executive_name = trim("{$invoice->executive_fname} {$invoice->executive_lname}");
            $invoice->shipment_status = $invoice->shipment_status ?? 'Not Shipped'; // Provide default value
            $invoice->delivered_date = $invoice->delivered_date ?? 'N/A'; // Provide default value
            return $invoice;
        });
    
        // Return the data as JSON
        return response()->json($invoices);
    }
    
    
    
    


    public function deleteinvoice(Request $request) {


        DB::table('tbl_invoice_mst')
        ->where('id', $request->input('id'))
        ->delete();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"invoice deleted ",$username, "Invoice Deleted");

        return "deleted";

    }

    public function generateinvoice($orderId)
    {
        // Retrieve the order items
        $orderItems = DB::table('tbl_order_det')->where('order_id', $orderId)->get();
        $orderno = DB::table('tbl_order_mst')->select('order_no', 'tot_boxes')->where('id', $orderId)->first();
    
        // Debug: Check the retrieved items
        if ($orderItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No items found for this order.']);
        }
    
        // Generate the invoice number by replacing 'O' with 'I'
        $invoiceNo = str_replace('O', 'I', $orderno->order_no);
    
        $grossTotal = 0;
        $finalTotal = 0;
        $discountTotal = 0;
        $invoiceDetails = [];
    
        foreach ($orderItems as $item) {
            $fishCode = $item->fish_code;
            $quantity = $item->quantity;
    
            // Retrieve pricing details from tbl_fishweekly
            $fishDetails = DB::table('tbl_fishweekly')->where('fish_code', $fishCode)->first();
            if (!$fishDetails) {
                return response()->json(['status' => 'error', 'message' => "Fish details not found for fish code: $fishCode"]);
            }
    
            $grossPrice = $fishDetails->gross_price;
            $discount = 0;
    
            if ($fishDetails->special_offer === 'yes') {
                $discount = $fishDetails->discount;
            }
    
            $totalPrice = $grossPrice * $quantity;
            $discountedPrice = $totalPrice - ($totalPrice * ($discount / 100));
    
            $grossTotal += $totalPrice;
            $finalTotal += $discountedPrice;
            $discountTotal += ($totalPrice - $discountedPrice);
    
            // Prepare entry for tbl_invoice_det
            $invoiceDetails[] = [
                'order_id' => $orderId,
                'invoice_no' => $invoiceNo,
                'orderdet_id' => $item->id,
                'quantity' => $quantity,
                'discount' => $discount,
                'unit_price' => $grossPrice,
                'sub_total' => $totalPrice, // Price without any discount
                'total_price' => $discountedPrice, // Final price after discount
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Retrieve packaging and handling fees from tbl_company
        $companyDetails = DB::table('tbl_company')->first();
        $perBoxCost = $companyDetails->perbox_cost;
        $handlingFee = $companyDetails->document_fee;
    
        // Get total number of boxes from tbl_order_mst
        $totalBoxes = $orderno->tot_boxes;
    
        // Calculate packaging charges
        $packagingCharges = $perBoxCost * $totalBoxes;
    
        // Add packaging charges and handling fee to final total
        $finalTotal += $packagingCharges + $handlingFee;
    
        // Insert the summary into tbl_invoice_mst and retrieve the invoice_id
        $invoiceId = DB::table('tbl_invoice_mst')->insertGetId([
            'order_id' => $orderId,
            'order_no' => $orderno->order_no,
            'invoice_no' => $invoiceNo,
            'gross_total' => $grossTotal,
            'discount_total' => $discountTotal,
            'final_total' => $finalTotal,
            'handling_fee' => $handlingFee,
            'packaging_fee' => $packagingCharges,
            'payment_status' => 'pending',
            'invoice_status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Update the order with final total and discount applied
        DB::table('tbl_order_mst')->where('id', $orderId)->update([
            'order_total' => $finalTotal,
            'discount_applied' => $discountTotal
        ]);
    
        // Add the retrieved invoice_id to each invoice detail
        foreach ($invoiceDetails as &$detail) {
            $detail['invoice_id'] = $invoiceId;
        }
    
        // Insert all invoice details in one go
        DB::table('tbl_invoice_det')->insert($invoiceDetails);

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();
    
        return response()->json(['status' => 'success', 'message' => 'Invoice generated successfully.']);
    }
    
    
    
    public function updateinvoice(Request $request) {
        $invoiceid = $request->input('invoiceid');
        $orderid = $request->input('orderid');
        $orderno = $request->input('orderno');
        $paymentstatus = $request->input('paymentstatus');
    
        // Fetch order details
        $orderdetails = DB::table('tbl_order_mst')->select('*')->where('id', $orderid)->first();
    
        // Calculate the shipment date as 5 days from today
        $shipmentDate = now()->addDays(5);
    
        // Update the invoice
        DB::table('tbl_invoice_mst')
            ->where('id', $invoiceid)
            ->update([
                'payment_status' => $paymentstatus, 
                'invoice_status' => 'completed',
                'shipment_date' => $shipmentDate
            ]);
    
        // Get invoice number
        $invoice_no = DB::table('tbl_invoice_mst')->where('id', $invoiceid)->select('invoice_no')->first();
    
        // Insert shipment details
        DB::table('tbl_shipment')
            ->insert([
                'order_id' => $orderid, 
                'order_no' => $orderno, 
                'invoice_no' => $invoice_no->invoice_no, 
                'customer_name' => $orderdetails->customer_name, 
                'status' => 'pending', 
                'shipment_date' => $shipmentDate, 
                'shipped_by' => 'Bio World Holdings (Pvt) Ltd', 
                'shipped_to' => $orderdetails->shipping_address,
                'tot_boxes' => $orderdetails->tot_boxes,
                'tot_fish' => $orderdetails->tot_fish,
                'created_at' => now()
            ]);
    
        // Get customer ID and user ID for notification and email
        $cus_id = $orderdetails->cus_id;
        $user = DB::table('tbl_customers')
                  ->join('tbl_users', 'tbl_customers.user_id', '=', 'tbl_users.id')
                  ->where('tbl_customers.id', $cus_id)
                  ->select('tbl_users.id', 'tbl_users.username', 'tbl_users.email')
                  ->first();
    
        // Prepare notification and email
        $subject = "Invoice Completed & Shipment Scheduled";
        $body = 'Hi ' . $orderdetails->customer_name . ',<br><br>Your invoice, invoice no ' . $invoice_no->invoice_no . 
                ' has been completed and your order, order no ' . $orderno . 
                ' is scheduled to be shipped on ' . $shipmentDate->format('Y-m-d') . '.<br><br>' .
                'Please find the invoice details below:<br>' .
                'Order No: ' . $orderno . '<br>' .
                'Invoice No: ' . $invoice_no->invoice_no . '<br>' .
                'Payment Status: ' . $paymentstatus . '<br><br>Thank you, Seylon Aquatics Pvt Ltd';
    
        DB::table('tbl_notifications')->insert([
            'user_id' => $user->id,
            'notification' => 'Invoice No ' . $invoice_no->invoice_no . ' completed. Order No ' . $orderno . ' scheduled for shipment.',
            'seen_status' => 0,
            'created_at' => now(),
        ]);
    
        // Send email to the user
        try {
            $mailerService = new PHPMailerService();
            $mailerService->sendEmail($user->email, $subject, nl2br($body));
            Log::info('Email sent to: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
        }

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();
    
        return response()->json(['status' => 'success', 'message' => 'Payment Status and Shipment Date updated successfully.']);
    }
    
    public function updateshipment(Request $request) {
        // Validate the incoming request
        $request->validate([
            'editid' => 'required|integer',
            'status' => 'required|string',
        ]);
    
        // Retrieve the invoice ID from the request
        $invoiceId = $request->input('editid');
        $status = $request->input('status');

        // Get the invoice number from tbl_invoice_mst using the invoice ID
        $invoice = DB::table('tbl_invoice_mst')->where('id', $invoiceId)->first();
    
        if (!$invoice) {
            return response()->json(['status' => 'error', 'message' => 'Invoice not found.']);
        }

        $customer = DB::table('tbl_order_mst')->select('cus_id', 'customer_name')->where('id', $invoice->order_id)->first();
    
         // Get customer ID and user ID for notification and email
         $cus_id = $customer->cus_id;

         $user = DB::table('tbl_customers')
                   ->join('tbl_users', 'tbl_customers.user_id', '=', 'tbl_users.id')
                   ->where('tbl_customers.id', $cus_id)
                   ->select('tbl_users.id', 'tbl_users.username', 'tbl_users.email')
                   ->first();
     



        // Find the corresponding record in tbl_Shipment using the invoice number
        $shipment = DB::table('tbl_shipment')->where('invoice_no', $invoice->invoice_no)->first();
    
        if (!$shipment) {
            return response()->json(['status' => 'error', 'message' => 'Shipment record not found.']);
        }
    
        // Update the shipment status based on the selected dropdown value
        if ($status == 'in-transit') {
            if ($shipment->status == 'pending') {
                DB::transaction(function () use ($shipment, $invoice) {
                    // Update the shipment record
                    DB::table('tbl_shipment')->where('id', $shipment->id)->update([
                        'status' => 'in-transit',
                        'shipment_date' => now(), // Set shipment_date to current time
                        'updated_at' => now(),
                    ]);
    
                    // Update the invoice record
                    DB::table('tbl_invoice_mst')->where('id', $invoice->id)->update([
                        'shipment_date' => now(), // Set shipment_date to current time
                    ]);
                });

                
                // Prepare notification and email
                $subject = "Shipment In-Transit";
                $body = 'Hi ' . $customer->customer_name . ',<br><br>Your order with invoice no ' . $invoice->invoice_no .
                ' is now in-transit. The shipment was scheduled to be shipped on ' . now()->format('Y-m-d') . '.<br><br>';
        
                    DB::table('tbl_notifications')->insert([
                        'user_id' => $user->id,
                        'notification' => 'Order with Invoice No ' . $invoice->invoice_no . ' is now in-transit. Scheduled to be shipped on ' . now()->format('Y-m-d') . '.',
                        'seen_status' => 0,
                        'created_at' => now(),
                    ]);
        
                    // Send email to the user
                    try {
                        $mailerService = new PHPMailerService();
                        $mailerService->sendEmail($user->email, $subject, nl2br($body));
                        Log::info('Email sent to: ' . $user->email);
                    } catch (\Exception $e) {
                        Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
                    }

                // Optionally, trigger any dashboard update or other necessary actions
                $dashboardController = new \App\Http\Controllers\DashboardController();
                $dashboardController->updateStatus();
    
                return response()->json(['status' => 'success', 'message' => 'Shipment status updated to in-transit.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Shipment status is not pending.']);
            }
        } elseif ($status == 'completed') {
            if ($shipment->status == 'in-transit') {
                DB::transaction(function () use ($shipment, $invoice) {
                    // Update the shipment record
                    DB::table('tbl_shipment')->where('id', $shipment->id)->update([
                        'status' => 'completed',
                        'delivered_date' => now(), // Set delivered_date to current time
                        'updated_at' => now(),
                    ]);
    
                    // Update the invoice record
                    DB::table('tbl_invoice_mst')->where('id', $invoice->id)->update([
                        'shipment_date' => now(), // Set shipment_date to current time
                    ]);
    
                    // Update the order status
                    DB::table('tbl_order_mst')->where('id', $invoice->order_id)->update([
                        'status' => 'completed',
                    ]);
                });

                
                // Prepare notification and email
                $subject = "Shipment Completed";
                $body = 'Hi ' . $customer->customer_name . ',<br><br>Your order with invoice no ' . $invoice->invoice_no .
                        ' has been completed. The shipment was delivered on ' . now()->format('Y-m-d') . '.<br><br>' .
                        'Please find the invoice details below:<br>' .
                        'Order No: ' . $invoice->order_id . '<br>' .
                        'Invoice No: ' . $invoice->invoice_no . '<br>' .
                        'Payment Status: ' . ($invoice->payment_status ?? 'Not Available') . '<br><br>Thank you, Seylon Aquatics Pvt Ltd';

                // Insert notification into the database
                DB::table('tbl_notifications')->insert([
                    'user_id' => $user->id,
                    'notification' => 'Order with Invoice No ' . $invoice->invoice_no . ' has been completed. The shipment was delivered on ' . now()->format('Y-m-d') . '.',
                    'seen_status' => 0,
                    'created_at' => now(),
                ]);

                // Send email to the user
                try {
                    $mailerService = new PHPMailerService();
                    $mailerService->sendEmail($user->email, $subject, nl2br($body));
                    Log::info('Email sent to: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
                }

    
                // Optionally, trigger any dashboard update or other necessary actions
                $dashboardController = new \App\Http\Controllers\DashboardController();
                $dashboardController->updateStatus();
    
                return response()->json(['status' => 'success', 'message' => 'Shipment status updated to completed.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Shipment status is not in-transit.']);
            }
        }
    
        return response()->json(['status' => 'error', 'message' => 'Invalid status update.']);
    }
    
    
    
}
