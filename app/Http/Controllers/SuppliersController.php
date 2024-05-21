<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

class SuppliersController extends Controller
{

    public function getsuppliers() {

        $data = Supplier::all();

        return $data;    

    }

    public function addsuppliers(Request $request){


        Supplier::create([
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
