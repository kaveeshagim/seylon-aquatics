<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;

class ReportController extends Controller
{


    public function getshipmentreport(Request $request)
    {
        $updateLastActivityTime = Util::updateLastActivityTime();
    
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
    
        if (Util::Privilege("Download Report_20") == 'LOGOUT') {
            return redirect('/');
        }
        if (Util::Privilege("Download Report_20") == 'DENIED') {
            return view('pages.accessdenied');
        }
    
        // Filter inputs
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $status = $request->input('status');

        // Query with filters
        $query = DB::table('tbl_shipment');

        if ($fromDate) {
            $query->whereDate('shipment_date', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('shipment_date', '<=', $toDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $shipments = $query->get();
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened shipping report page", $username, "View Shipping Report Page");
    
        return response()->json([
            'data' => $shipments
        ]);
    }
    
    
    public function getsalesreport(Request $request)
    {
        $updateLastActivityTime = Util::updateLastActivityTime();
    
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
    
        if (Util::Privilege("Download Report_9") == 'LOGOUT') {
            return redirect('/');
        }
        if (Util::Privilege("Download Report_9") == 'DENIED') {
            return view('pages.accessdenied');
        }
    
        $dateFilter = $request->input('date_filter');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        $query = DB::table('tbl_invoice_mst')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'),
                DB::raw('SUM(final_total) as total_final'),
                DB::raw('SUM(discount_total) as total_discounts')
            )
            ->where('payment_status', 'completed');
    
        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate])
                  ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'));
        } else {
            switch ($dateFilter) {
                case 'day':
                    $query->whereDate('created_at', Carbon::today())
                          ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'));
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                          ->groupBy(DB::raw('YEAR(created_at), WEEK(created_at)'))
                          ->select(
                              DB::raw('YEAR(created_at) as year'),
                              DB::raw('WEEK(created_at) as week'),
                              DB::raw('SUM(final_total) as total_final'),
                              DB::raw('SUM(discount_total) as total_discounts')
                          );
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                          ->select(
                              DB::raw('YEAR(created_at) as year'),
                              DB::raw('MONTH(created_at) as month'),
                              DB::raw('SUM(final_total) as total_final'),
                              DB::raw('SUM(discount_total) as total_discounts')
                          );
                    break;
                case 'year':
                    $query->whereYear('created_at', Carbon::now()->year)
                          ->groupBy(DB::raw('YEAR(created_at)'))
                          ->select(
                              DB::raw('YEAR(created_at) as year'),
                              DB::raw('SUM(final_total) as total_final'),
                              DB::raw('SUM(discount_total) as total_discounts')
                          );
                    break;
            }
        }
    
        $reportData = $query->get();
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened sales report page", $username, "View Sales Report Page");
    
        // Return data for the report
        return response()->json([
            'data' => $reportData
        ]);
    }
    

    public function getcustomerorderreport(Request $request)
    {
        // Check for user activity and privilege
        $updateLastActivityTime = Util::updateLastActivityTime();
        if ($updateLastActivityTime == 'false') {
            return redirect('/expired');
        } elseif ($updateLastActivityTime == 'invalid') {
            return redirect('/');
        }
    
        if (Util::Privilege("Download Report_8") == 'LOGOUT') {
            return redirect('/');
        }
        if (Util::Privilege("Download Report_8") == 'DENIED') {
            return view('pages.accessdenied');
        }
    
        // Get filter parameters
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $status = $request->input('status');
    
        // Query the tbl_order_mst table
        $query = DB::table('tbl_order_mst')
            ->leftJoin('tbl_users', 'tbl_order_mst.executive_id', '=', 'tbl_users.id')
            ->select(
                'tbl_order_mst.order_no',
                'tbl_order_mst.customer_name',
                'tbl_order_mst.cus_id',
                'tbl_order_mst.executive_id',
                DB::raw('CONCAT(tbl_users.fname, " ", tbl_users.lname) as executive_name'),
                'tbl_order_mst.status',
                'tbl_order_mst.shipping_address',
                DB::raw('DATE(tbl_order_mst.created_at) as order_date'),
                'tbl_order_mst.delivery_date',
                'tbl_order_mst.tot_orders',
                'tbl_order_mst.tot_bags',
                'tbl_order_mst.tot_boxes',
                'tbl_order_mst.tot_fish',
                'tbl_order_mst.order_total',
                'tbl_order_mst.discount_applied',
                'tbl_order_mst.remarks'
            );
    
        // Apply date filtering
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween(DB::raw('DATE(tbl_order_mst.created_at)'), [$from_date, $to_date]);
        }
    
        // Apply status filtering
        if (!empty($status)) {
            $query->where('tbl_order_mst.status', $status);
        }
    
        // Get the results
        $orders = $query->get();
    
        return response()->json($orders);
    }
    
    
    

    
}
