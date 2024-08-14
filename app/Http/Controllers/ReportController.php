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
    
        // Filter by date if provided
        $dateFilter = $request->input('date_filter');
        $query = DB::table('tbl_shipment');
    
        switch ($dateFilter) {
            case 'day':
                $query->whereDate('created_at', now()->toDateString());
                $dateFormat = 'Date';
                break;
            case 'week':
                $startOfWeek = now()->startOfWeek(); // Assuming week starts on Monday
                $endOfWeek = now()->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $dateFormat = 'Week: ' . $startOfWeek->format('Y-m-d') . ' to ' . $endOfWeek->format('Y-m-d');
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                $dateFormat = 'Month: ' . now()->format('F Y');
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                $dateFormat = 'Year: ' . now()->year;
                break;
            default:
                $dateFormat = 'All Time';
                break;
        }
    
        // Retrieve total shipment count
        $totalShipments = $query->count();
    
        // Retrieve the data for the report
        $data = $query->select(
            'status',
            DB::raw('COUNT(*) as no_of_shipments')
        )
        ->groupBy('status')
        ->get()
        ->map(function ($item) use ($dateFormat) {
            $item->date_time = $dateFormat;
            return $item;
        });
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened shipping report page", $username, "View Shipping Report Page");
    
        // Return both data and total shipment count
        return response()->json([
            'data' => $data,
            'total_shipments' => $totalShipments
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
        $query = DB::table('tbl_invoice_mst');
    
        // Define the date range based on the selected filter
        switch ($dateFilter) {
            case 'day':
                $query->whereDate('created_at', now()->toDateString());
                break;
            case 'week':
                $startOfWeek = now()->startOfWeek(); // Assuming week starts on Monday
                $endOfWeek = now()->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }
    
        // Retrieve total sales and discounts
        $totals = $query->select(
                DB::raw('SUM(CAST(gross_total AS DECIMAL(10, 2))) - SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_discounts'),
                DB::raw('SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_sales')
            )->first();
    
        // Retrieve detailed data for the report based on date filter
        switch ($dateFilter) {
            case 'day':
                $detailedData = $query->select(
                        DB::raw('DATE(created_at) AS date_time'),
                        DB::raw('SUM(CAST(gross_total AS DECIMAL(10, 2))) AS total_gross'),
                        DB::raw('SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_final')
                    )
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->get();
                break;
            case 'week':
                $detailedData = $query->select(
                        DB::raw('YEAR(created_at) AS year'),
                        DB::raw('WEEK(created_at) AS week_number'),
                        DB::raw('SUM(CAST(gross_total AS DECIMAL(10, 2))) AS total_gross'),
                        DB::raw('SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_final')
                    )
                    ->groupBy(DB::raw('YEAR(created_at), WEEK(created_at)'))
                    ->get()
                    ->map(function ($item) {
                        $startOfWeek = \Carbon\Carbon::now()->setISODate($item->year, $item->week_number)->startOfWeek();
                        $endOfWeek = \Carbon\Carbon::now()->setISODate($item->year, $item->week_number)->endOfWeek();
                        $item->date_time = $startOfWeek->format('Y-m-d') . ' to ' . $endOfWeek->format('Y-m-d');
                        return $item;
                    });
                break;
            case 'month':
                $detailedData = $query->select(
                        DB::raw('YEAR(created_at) AS year'),
                        DB::raw('MONTH(created_at) AS month'),
                        DB::raw('SUM(CAST(gross_total AS DECIMAL(10, 2))) AS total_gross'),
                        DB::raw('SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_final')
                    )
                    ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                    ->get()
                    ->map(function ($item) {
                        $monthName = \Carbon\Carbon::create()->month($item->month)->format('F');
                        $item->date_time = $monthName . ' ' . $item->year;
                        return $item;
                    });
                break;
            case 'year':
                $detailedData = $query->select(
                        DB::raw('YEAR(created_at) AS year'),
                        DB::raw('SUM(CAST(gross_total AS DECIMAL(10, 2))) AS total_gross'),
                        DB::raw('SUM(CAST(final_total AS DECIMAL(10, 2))) AS total_final')
                    )
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->get()
                    ->map(function ($item) {
                        $item->date_time = $item->year;
                        return $item;
                    });
                break;
        }
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user opened sales report page", $username, "View Sales Report Page");
    
        // Return data for the report
        return response()->json([
            'total_sales' => $totals->total_sales,
            'total_discounts' => $totals->total_discounts,
            'data' => $detailedData
        ]);
    }

    public function getcustomerorderreport(Request $request)
    {
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
    
        // Get the date range from the request
        $fromDate = $request->input('from_date', now()->startOfMonth()->toDateString()); // Default to the start of the current month
        $toDate = $request->input('to_date', now()->endOfMonth()->toDateString()); // Default to the end of the current month
    
        // Retrieve the orders within the date range
        $orders = DB::table('tbl_order_mst')
            ->select(
                'order_no',
                'customer_name',
                'cus_id',
                'executive_id',
                'status',
                'advanced_payment',
                'shipping_address',
                'tot_orders',
                'tot_bags',
                'tot_boxes',
                'created_at',
                'delivery_date',
                'order_total',
                'discount_applied',
                'remarks'
            )
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->get();
    
        return response()->json($orders);
    }
    
    

    
}
