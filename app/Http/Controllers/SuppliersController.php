<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{

    public function getsuppliers() {

        $data = DB::table('tbl_suppliers')
            ->select('*')
            ->get();

        return $data;    

    }

    public function addsuppliers(Request $request){


        DB::table('tbl_suppliers')
            ->insert([
                'title' => $request->input('title'),
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
