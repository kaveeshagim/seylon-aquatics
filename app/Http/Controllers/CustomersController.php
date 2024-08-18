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
        $data = Customer::with('executive')->get();
    
        $data = $data->map(function ($customer) {
            return [
                'fullname' => $customer->fname . ' ' . $customer->lname,
                'company' => $customer->company,
                'country' => $customer->country,
                'executive' => $customer->executive ? $customer->executive->username : null,
                'id' => $customer->id,
            ];
        });
    
        return response()->json($data);
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
            'cususer' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'inline-radio-group' => 'required|boolean',
            'email' => 'required|email|max:255|unique:tbl_customers,email',
            'primary_contact' => [
                    'required',
                    'string',
                    'max:15',
                    'regex:/^\+?[0-9]{7,15}$/'
                ],
                'secondary_contact' => [
                    'nullable',
                    'string',
                    'max:15',
                    'regex:/^\+?[0-9]{7,15}$/'
                ],
            'executive' => 'required|integer',
        ]);
    
        try {
            // Create a new customer record
            Customer::create([
                'title' => $validatedData['title'],
                'user_id' => $validatedData['cususer'],
                'fname' => $validatedData['first_name'],
                'lname' => $validatedData['last_name'] ?? null,
                'company' => $validatedData['company'] ?? null,
                'country' => $validatedData['country'],
                'address' => $validatedData['address'],
                'active_status' => $validatedData['inline-radio-group'],
                'email' => $validatedData['email'],
                'primary_contact' => $validatedData['primary_contact'],
                'secondary_contact' => $validatedData['secondary_contact'] ?? null,
                'executive_id' => $validatedData['executive'],
            ]);
    
            // Log the user's action
            $ipaddress = Util::get_client_ip();
            $username = session()->get('username');
            Util::user_auth_log($ipaddress, "customer added", $username, "Customer Added");
    
            // Return success response
            return response()->json(['status' => 'success', 'message' => 'Customer added successfully!']);
    
        } catch (\Exception $e) {
            // Return error response with the exception message
            return response()->json(['status' => 'error', 'message' => 'Error! '. $e->getMessage()]);
        }
    }
    


    public function editcustomer(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'cus_id' => 'required|exists:tbl_customers,id', // Ensure customer ID exists
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'inline-radio-group' => 'required|boolean',
            'email' => 'required|email|max:255|unique:tbl_customers,email,' . $request->cus_id,
            'primary_contact' => [
                    'required',
                    'string',
                    'max:15',
                    'regex:/^\+?[0-9]{7,15}$/'
                ],
                'secondary_contact' => [
                    'nullable',
                    'string',
                    'max:15',
                    'regex:/^\+?[0-9]{7,15}$/'
                ],
            'executive' => 'required|integer',
            'cususer' => 'required|integer',
        ]);

    
        try {
            // Find the customer by cus_id
            $customer = Customer::findOrFail($validatedData['cus_id']);
    
            // Update the customer record
            $customer->update([
                'title' => $validatedData['title'],
                'fname' => $validatedData['first_name'],
                'lname' => $validatedData['last_name'] ?? null,
                'company' => $validatedData['company'] ?? null,
                'country' => $validatedData['country'],
                'address' => $validatedData['address'],
                'acive_status' => $validatedData['inline-radio-group'],
                'email' => $validatedData['email'],
                'primary_contact' => $validatedData['primary_contact'],
                'secondary_contact' => $validatedData['secondary_contact'] ?? null,
                'executive_id' => $validatedData['executive'],
                'user_id' => $validatedData['cususer'],
            ]);
    
            // Log the user's action
            $ipaddress = Util::get_client_ip();
            $username = session()->get('username');
            Util::user_auth_log($ipaddress, "customer edited", $username, "Customer Edited");
    
            // Return success response
            return response()->json(['status' => 'success', 'message' => 'Customer updated successfully!']);
    
        } catch (\Exception $e) {
            // Return error response with the exception message
            return response()->json(['status' => 'error', 'message' => 'Error! '. $e->getMessage()]);
        }
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

    public function deletecustomer(Request $request) {

        $id = $request->input('id');

        $customer = Customer::with('order')->find($id);

        if ($customer && $customer->order->isNotEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete Customer because it has related orders!']);
        }
    
        Customer::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"customer deleted ",$username, "Customer Deleted");

        return response()->json(['status' => 'success', 'message' => 'Customer deleted successfully!']);

    }
}
