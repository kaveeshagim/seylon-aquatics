<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;

class UsertypeController extends Controller
{

    public function getusertypes() {

        $data = UserType::select('tbl_usertype.*', \DB::raw('COUNT(tbl_users.id) as userscount'))
                ->leftJoin('tbl_users', 'tbl_users.user_type', '=', 'tbl_usertype.id')
                ->groupBy('tbl_usertype.id')
                ->orderBy('tbl_usertype.id', 'ASC')
                ->get();
    
        return $data;
    
    
    }

    public function addusertype(Request $request){

        $title = $request->input('title');

        UserType::create([
            'title' => $title,
        ]);

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user type added ",$username, "User type Added");

        $result = "success";

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user type added ",$username, "User Type Added");

        return $result;
    }

    public function editusertype(Request $request) {

        $id = $request->input('usertypeid');
        $title = $request->input('title');

        $userType = UserType::find($id);
        $userType->title = $title;
        $userType->save();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user type updated ",$username, "User Type Updated");

        return "success";
    }



    public function deleteusertype(Request $request) {

        $id = session()->get('id');

        UserType::where('id', $request->input('id'))->delete();

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user type deleted ",$username, "Usertype Deleted");

        return "deleted";

    }
}
