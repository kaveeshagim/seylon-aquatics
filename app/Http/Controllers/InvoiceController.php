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

    public function getinvoices() 
    {
        // Retrieve invoice data along with customer details
        // $invoices = DB::table('tbl_invoice_mst as im')
        //     ->select(
        //         'im.*', 
        //         DB::raw("CONCAT(c.title, ' ', c.fname, ' ', IFNULL(c.lname, '')) as customer_name")
        //     )
        //     ->join('tbl_order_mst as om', 'om.id', '=', 'im.order_id') 
        //     ->join('tbl_customers as c', 'c.id', '=', 'om.cus_id')
        //     ->get();

            $invoices = DB::table('tbl_invoice_mst  as im')
            ->select(
                'im.*', 'om.*'
                // DB::raw("CONCAT(c.title, ' ', c.fname, ' ', IFNULL(c.lname, '')) as customer_name")
            )
            ->join('tbl_order_mst as om', 'om.id', '=', 'im.order_id') 
            // ->join('tbl_customers as c', 'c.id', '=', 'om.cus_id')
            ->get();
    
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
    
        // Debug: Check the retrieved items
        if ($orderItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No items found for this order.']);
        }
    
        $grossTotal = 0;
        $finalTotal = 0;
        $invoiceDetails = [];
    
        foreach ($orderItems as $item) {
            $fishCode = $item->fish_code;
            $quantity = $item->orders;
    
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
    
            // Prepare entry for tbl_invoice_det
            $invoiceDetails[] = [
                'order_id' => $orderId,
                'orderdet_id' => $item->id,
                'quantity' => $quantity,
                'discount' => $discount,
                'unit_price' => $grossPrice,
                'total_price' => $discountedPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $discountapplied = $grossTotal - $finalTotal;
    
        // Insert the summary into tbl_invoice_mst and retrieve the invoice_id
        $invoiceId = DB::table('tbl_invoice_mst')->insertGetId([
            'order_id' => $orderId,
            'gross_total' => $grossTotal,
            'discount_total' => $discountapplied,
            'final_total' => $finalTotal,
            'payment_status' => 'pending',
            'invoice_status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        DB::table('tbl_order_mst')->where('id',$orderId)->update(['order_total'=>$finalTotal, 'discount_applied'=>$discountapplied]);
    
        // Add the retrieved invoice_id to each invoice detail
        foreach ($invoiceDetails as &$detail) {
            $detail['invoice_id'] = $invoiceId;
        }
    
        // Insert all invoice details in one go
        DB::table('tbl_invoice_det')->insert($invoiceDetails);
    
        return response()->json(['status' => 'success', 'message' => 'Invoice generated successfully.']);
    }

    public function updateinvoice(Request $request) {
        $invoiceid = $request->input('invoiceid');
        $orderid = $request->input('orderid');
        $orderno = $request->input('orderno');
        $paymentstatus = $request->input('paymentstatus');

        $orderdetails = DB::table('tbl_order_mst')->select('*')->where('id', $orderid)->first();
    
        // Calculate the shipment date as 5 days from today
        $shipmentDate = now()->addDays(5);
    
        DB::table('tbl_invoice_mst')
            ->where('id', $invoiceid)
            ->update([
                'payment_status' => $paymentstatus, 
                'invoice_status' => 'completed',
                'shipment_date' => $shipmentDate
            ]);

        DB::table('tbl_shipment')
        ->insert([
            'order_id'=> $orderid, 
            'order_no'=> $orderno, 
            'customer_name'=> $orderdetails->customer_name, 
            'status'=>'pending', 
            'shipment_date' => $shipmentDate, 
            'shipped_by'=> 'Bio World Holdings (Pvt) Ltd', 
            'shipped_to'=>$orderdetails->shipping_address,
            'tot_boxes'=>$orderdetails->tot_boxes,
            'tot_fish'=>$orderdetails->tot_fish,
            'created_at' =>now()
        ]);    
    
        return response()->json(['status' => 'success', 'message' => 'Payment Status and Shipment Date updated successfully.']);
    }
    
    
    
}
