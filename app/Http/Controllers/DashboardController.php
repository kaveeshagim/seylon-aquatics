<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDet;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    public function updateStatus()
{

    $pendingorders = DB::table('tbl_order_mst')->where('status','pending')->count();
    $confirmedorders = DB::table('tbl_order_mst')->where('status','confirmed')->count();
    $shippedorders = DB::table('tbl_order_mst')->where('status','shipping')->count();
    $cancelledorders = DB::table('tbl_order_mst')->where('status','cancelled')->count();
    $completedorders = DB::table('tbl_order_mst')->where('status','completed')->count();
    $totalorders = DB::table('tbl_order_mst')->count();

    $pendinginvoices = DB::table('tbl_invoice_mst')->where('invoice_status','pending')->count();
    $completedinvoices = DB::table('tbl_invoice_mst')->where('invoice_status','completed')->count();

    $pendingshipments = DB::table('tbl_shipment')->where('status','pending')->count();
    $intransitshipments = DB::table('tbl_shipment')->where('status','in-transit')->count();

    $fishvarietycount = DB::table('tbl_fish_variety')->count();
    $fishspeciescount = DB::table('tbl_fish_species')->count();
    $fishfamilycount = DB::table('tbl_fish_family')->count();
    $fishhabitatcount = DB::table('tbl_fishhabitat')->count();

    // Send data to Node.js server
    Http::post('http://localhost:6050/updateOrders', [
        'pendingorders' => $pendingorders,
        'confirmedorders' => $confirmedorders,
        'shippedorders' => $shippedorders,
        'cancelledorders' => $cancelledorders,
        'completedorders' => $completedorders,
        'totalorders' => $totalorders,

        'pendinginvoices' => $pendinginvoices,
        'completedinvoices' => $completedinvoices,

        'pendingshipments' => $pendingshipments,
        'intransitshipments' => $intransitshipments,

        'fishvarietycount' => $fishvarietycount,
        'fishspeciescount' => $fishspeciescount,
        'fishfamilycount' => $fishfamilycount,
        'fishhabitatcount' => $fishhabitatcount,
    ]);

    return response()->json(['status' => 'Order status updated']);
}

public function updateStatusCustomer()
{

    $userid = session()->get('userid');
    $cusid = DB::table('tbl_customers')->select('id')->where('user_id', $userid)->first();
    $cus_id = $cusid->id;

    $pendingorders = DB::table('tbl_order_mst')->where('status','pending')->where('cus_id',$cus_id)->count();
    $confirmedorders = DB::table('tbl_order_mst')->where('status','confirmed')->where('cus_id',$cus_id)->count();
    $shippedorders = DB::table('tbl_order_mst')->where('status','shipping')->where('cus_id',$cus_id)->count();
    $cancelledorders = DB::table('tbl_order_mst')->where('status','cancelled')->where('cus_id',$cus_id)->count();
    $completedorders = DB::table('tbl_order_mst')->where('status','completed')->where('cus_id',$cus_id)->count();
    $totalorders = DB::table('tbl_order_mst')->where('cus_id',$cus_id)->count();

    $pendinginvoices = DB::table('tbl_invoice_mst')
                    ->join('tbl_order_mst', 'tbl_invoice_mst.order_id', '=', 'tbl_order_mst.id')
                    ->where('tbl_invoice_mst.invoice_status', 'pending')
                    ->where('tbl_order_mst.cus_id', $cus_id)
                    ->count();
    $completedinvoices = DB::table('tbl_invoice_mst')
                    ->join('tbl_order_mst', 'tbl_invoice_mst.order_id', '=', 'tbl_order_mst.id')
                    ->where('tbl_invoice_mst.invoice_status', 'completed')
                    ->where('tbl_order_mst.cus_id', $cus_id)
                    ->count();

                        
    $pendingshipments = DB::table('tbl_shipment')
                        ->join('tbl_order_mst', 'tbl_shipment.order_id', '=', 'tbl_order_mst.id')
                        ->where('tbl_shipment.status','pending')
                        ->where('tbl_order_mst.cus_id', $cus_id)
                        ->count();

    $intransitshipments = DB::table('tbl_shipment')
                        ->join('tbl_order_mst', 'tbl_shipment.order_id', '=', 'tbl_order_mst.id')
                        ->where('tbl_shipment.status','in-transit')
                        ->where('tbl_order_mst.cus_id', $cus_id)
                        ->count();


    $fishvarietycount = DB::table('tbl_fish_variety')->count();
    $fishspeciescount = DB::table('tbl_fish_species')->count();
    $fishfamilycount = DB::table('tbl_fish_family')->count();
    $fishhabitatcount = DB::table('tbl_fishhabitat')->count();

    // Send data to Node.js server
    Http::post('http://localhost:6050/updateOrdersCustomer', [
        'pendingorders' => $pendingorders,
        'confirmedorders' => $confirmedorders,
        'shippedorders' => $shippedorders,
        'cancelledorders' => $cancelledorders,
        'completedorders' => $completedorders,
        'totalorders' => $totalorders,

        'pendinginvoices' => $pendinginvoices,
        'completedinvoices' => $completedinvoices,

        'pendingshipments' => $pendingshipments,
        'intransitshipments' => $intransitshipments,

        'fishvarietycount' => $fishvarietycount,
        'fishspeciescount' => $fishspeciescount,
        'fishfamilycount' => $fishfamilycount,
        'fishhabitatcount' => $fishhabitatcount,
    ]);

    return response()->json(['status' => 'Order status updated']);
}


public function getOrderStats()
    {
        // Get the current date
        $now = Carbon::now();

        // Find the start and end of the current week
        $startOfWeek = $now->startOfWeek()->format('Y-m-d 00:00:00');
        $endOfWeek = $now->endOfWeek()->format('Y-m-d 23:59:59');

        // Get the order counts for the current week
        $pending = Order::where('status', 'pending')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $confirmed = Order::where('status', 'confirmed')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $cancelled = Order::where('status', 'cancelled')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $completed = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        return response()->json([
            'pending' => $pending,
            'confirmed' => $confirmed,
            'cancelled' => $cancelled,
            'completed' => $completed,
        ]);
    }


    public function getTopFishVarieties() {
        // Get the current week start and end dates with time included
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d 23:59:59');
    
        // Fetch the top 5 fish varieties based on quantity for the current week
        $topFishVarieties = DB::table('tbl_order_det')
            ->join('tbl_fish_variety', 'tbl_order_det.fish_code', '=', 'tbl_fish_variety.fish_code')
            ->select('tbl_fish_variety.common_name', DB::raw('SUM(tbl_order_det.quantity) as total_quantity'))
            ->whereBetween('tbl_order_det.created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('tbl_fish_variety.common_name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();
    
        return response()->json($topFishVarieties);
    }
    


}
