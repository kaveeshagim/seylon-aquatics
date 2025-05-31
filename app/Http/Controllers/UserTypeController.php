<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;

class UserTypeController extends Controller
{

    public function getusertypes() {

        $data = UserType::select('tbl_usertype.*', \DB::raw('COUNT(tbl_users.id) as userscount'))
                ->leftJoin('tbl_users', 'tbl_users.tbl_usertype_id', '=', 'tbl_usertype.id')
                ->groupBy('tbl_usertype.id')
                ->orderBy('tbl_usertype.id', 'ASC')
                ->get();
    
        return $data;
    
    
    }

    public function getusertype($id) {

        $data = DB::table('tbl_usertype')
            ->select('tbl_usertype.*')
            ->where('id', $id)
            ->first();

        return $data;    

    }

    public function getuserslist($id) {

        $data = DB::table('tbl_users')
            ->select('tbl_users.username')
            ->join('tbl_usertype', 'tbl_usertype.id', '=', 'tbl_users.tbl_usertype_id')
            ->where('tbl_usertype.id', $id)
            ->get();
    
        return response()->json($data); // Return as JSON
    }
    


    public function addusertype(Request $request) {
        $title = $request->input('title');
    
        // Check if a record with the same title (case insensitive) already exists
        $existingRecord = UserType::whereRaw('LOWER(title) = ?', [strtolower($title)])->first();
    
        if ($existingRecord) {
            // If a duplicate is found, return an error response
            return response()->json(['status' => 'error', 'message' => 'Title already exists. Please choose a different title.']);
        }
    
        // If no duplicate, proceed to create the new record
        UserType::create([
            'title' => $title,
        ]);
    
        // Log the addition of the new user type
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user type added", $username, "User Type Added");
    
        // Return a success response
        return response()->json(['status' => 'success', 'message' => 'User Type added successfully!']);
    }
    

    public function editusertype(Request $request) {
        $id = $request->input('editid');
        $title = $request->input('title-edit');

        // Check if there's any other record with the same title but a different ID (case-insensitive)
        $existingRecord = UserType::whereRaw('LOWER(title) = ?', [strtolower($title)])
                                    ->where('id', '!=', $id)
                                    ->first();
    
        if ($existingRecord) {
            return response()->json(['status' => 'error', 'message' => 'Title already exists. Please choose a different title.']);
        }
    
        // If no existing record, proceed to update
        $userType = UserType::find($id);
        $userType->title = $title;
        $userType->save();
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user type updated", $username, "User Type Updated");
    
        return response()->json(['status' => 'success', 'message' => 'User Type updated successfully!']);
    }
    



    public function deleteusertype(Request $request) {

        $id = $request->input('id');

        UserType::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user type deleted ",$username, "Usertype Deleted");

        return response()->json(['status' => 'success', 'message' => 'User Type deleted successfully!']);

    }
}
