<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function adduser(Request $request){

        // dd($request->all());

        $username = $request->input('username');

        $users = DB::table('tbl_users')
            ->select('tbl_users.username')
            ->get();

        $found = false;
        $result = "";

            foreach ($users as $user) {
                if ($user->username === $username) {
                    $found = true;
                    break;
                }
            }

            
            if ($found) {

                $result = "failed";

            }else{

                $queryid =  DB::table('tbl_users')
                ->insert([
                    'user_type' => $request->input('usertype'),
                    'username' => $request->input('username'),
                    'fname' => $request->input('firstname'),
                    'lname' => $request->input('lastname'),
                    'password' => $request->input('password'),
                    'active_status' => $request->input('inline-radio-group'),
                    'company' => $request->input('company'),
                    'email' => $request->input('email'),
                    'primary_contact' => $request->input('primary_contact'),
                    'secondary_contact' => $request->input('secondary_contact'),
                ]);

                $result = "success";
            }

            return $result;
    }
}
