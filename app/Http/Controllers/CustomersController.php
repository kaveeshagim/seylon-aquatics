<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{

    public function getcustomers() {

        $data = DB::table('tbl_customers')
            ->select('*')
            ->get();

        return $data;    

    }

    public function getsubcustomers() {

        $data = DB::table('tbl_subcustomers')
                ->select('tbl_subcustomers.*', DB::raw("CONCAT(tbl_customers.title, ' ', tbl_customers.fname, ' ', tbl_customers.lname) AS maincustomer"))
                ->join('tbl_customers', 'tbl_customers.id','=','tbl_subcustomers.cus_id')
                ->get();
    

        return $data;    

    }

    public function addcustomers(Request $request){

        DB::table('tbl_customers')
        ->insert([
            'title' => $request->input('title'),
            'fname' => $request->input('firstname'),
            'lname' => $request->input('lastname'),
            'company' => $request->input('company'),
            'country' => $request->input('country'),
            'email' => $request->input('email'),
            'primary_contact' => $request->input('primary_contact'),
            'secondary_contact' => $request->input('secondary_contact'),
            'executive' => $request->input('executive'),
        ]);

        $result = "success";

        return $result;
    }

    public function addsubcustomers(Request $request){

        DB::table('tbl_subcustomers')
        ->insert([
            'title' => $request->input('title'),
            'cus_id' => $request->input('maincustomer'),
            'fname' => $request->input('firstname'),
            'lname' => $request->input('lastname'),
            'company' => $request->input('company'),
            'country' => $request->input('country'),
            'email' => $request->input('email'),
            'primary_contact' => $request->input('primary_contact'),
            'secondary_contact' => $request->input('secondary_contact'),
        ]);

        $result = "success";

        return $result;
    }
}
