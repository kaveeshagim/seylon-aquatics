<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{

    public function getinvoices() {

        $usertype = session()->get('usertype_id');
        $userid = session()->get('userid');

        $isExecutive = DB::table('tbl_usertype')
                    ->select('title')
                    ->where('id', $usertype)
                    ->first();

        

        $data = DB::table('tbl_invoice_mst')
            ->select('tbl_invoice_mst.*', 'tbl_usertype.title AS usertype')
            ->join('tbl_usertype', 'tbl_usertype.id','=','tbl_users.user_type')
            ->get();

            // dd($users);

        return $data;    

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
}
