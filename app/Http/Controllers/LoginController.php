<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');
        $result = '';

        $user = DB::table('tbl_users')
            ->select('*')
            ->where('username', '=', $username)
            ->first();

        if($user){
            $user_password = $user->password;
            $user_id = $user->id;
            $user_token = $user->token;
            $user_usertype = $user->user_type;


            if ($user_password === $password) {

                if($user_token !== ''){

                    DB::table('tbl_users')
                    ->where('id', $user->id)
                    ->update(['token' => '']);

                    $datetime = date('YmdHis');
                    $token = $user->id.'_'.$datetime;

                    DB::table('tbl_users')
                        ->where('id', $user->id)
                        ->update(['token' => $token]);

                    session()->put('userid',$user_id);
                    session()->put('user_token',$token);
                    session()->put('username',$username);
                    session()->put('user_type',$user_usertype);
    
                    $ipaddress = Util::get_client_ip();
                    Util::user_auth_log($ipaddress,"user logged in successfully",$username,"User Logged In");

                    $result = 'correct';

                }else{

                    $datetime = date('YmdHis');
                    $token = $user->id.'_'.$datetime;

                    DB::table('tbl_users')
                        ->where('id', $user->id)
                        ->update(['token' => $token]);

                    session()->put('userid',$user_id);
                    session()->put('user_token',$token);
                    session()->put('username',$username);
                    session()->put('user_type',$user_usertype);
    
                    $ipaddress = Util::get_client_ip();
                    Util::user_auth_log($ipaddress,"user logged in successfully",$username,"User Logged In");

                    $result = 'correct';

                }
                
            } else {
                $result = 'incorrect';
            }

        }else{

            $result = 'incorrect';

        }


        return $result;
    }

    public function logout(Request $request)
    {

        $userid = session()->get('userid');
        $username=session()->get('username');

        DB::table('tbl_users')
            ->where('id', $userid)
            ->update(['token' => '']);

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user logged out successfully",$username,"User Logged Out");


        session()->forget('userid');
        session()->forget('username');
        session()->forget('user_type');
        session()->forget('user_token');

        return redirect('/');
    }

    
}
