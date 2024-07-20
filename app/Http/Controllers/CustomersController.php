<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\SubCustomer;

class CustomersController extends Controller
{

    public function getcustomers() {

        $data = Customer::all();

        return $data;    

    }

    public function getsubcustomers() {

        $data = SubCustomer::select('tbl_subcustomers.*', \DB::raw("CONCAT(tbl_customers.title, ' ', tbl_customers.fname, ' ', tbl_customers.lname) AS maincustomer"))
                ->join('tbl_customers', 'tbl_customers.id','=','tbl_subcustomers.cus_id')
                ->get();

        return $data;    

    }

public function addcustomers(Request $request) {
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'firstname' => 'required|string|max:255',
        'lastname' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'country' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:customers,email',
        'primary_contact' => 'required|string|max:15',
        'secondary_contact' => 'nullable|string|max:15',
        'executive' => 'required|string|max:255',
    ]);

    try {
        Customer::create([
            'title' => $validatedData['title'],
            'fname' => $validatedData['firstname'],
            'lname' => $validatedData['lastname'],
            'company' => $validatedData['company'],
            'country' => $validatedData['country'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'primary_contact' => $validatedData['primary_contact'],
            'secondary_contact' => $validatedData['secondary_contact'],
            'executive' => $validatedData['executive'],
        ]);

        $result = "success";
        $ipaddress = Util::get_client_ip();

        // Assuming $username is retrieved from the authenticated user
        $username = auth()->user()->username;
        Util::user_auth_log($ipaddress, "customer added", $username, "Customer Added");

    } catch (\Exception $e) {
        // Handle the exception and set the result to failure
        // $result = "failure: " . $e->getMessage();
        $result = "failed";
    }

    return $result;
}


    public function addsubcustomers(Request $request){

        SubCustomer::create([
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
