<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserType;
use App\Models\User;

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

        $user = User::where('username', $username)->first();

        if($user){
            $user_password_hashed = $user->password;
            $user_id = $user->id;
            $user_token = $user->token;
            $user_usertype = $user->tbl_usertype_id;
            $active_status = $user->active_status;
            $avatar = $user->avatar;

            $usertypetitle = DB::table('tbl_usertype')->select('title')->where('id', $user_usertype)->first();

            if($active_status == 0) {

                return response()->json(['status' => 'error', 'message' => 'User account inactive. Contact Administrator to activate your account']);

            }else{

                if (Hash::check($password, $user_password_hashed)) {

                    if($user_token !== ''){
    
                        $user->token = '';
                        $user->save();
    
                        $datetime = now()->format('YmdHis');
                        $token = $user->id . '_' . $datetime;
                        $user->token = $token;
                        $user->save();
    
                        session()->put('userid',$user_id);
                        session()->put('user_token',$token);
                        session()->put('username',$username);
                        session()->put('user_type',$user_usertype);
                        session()->put('user_type_title',$usertypetitle->title);
                        session()->put('avatar',$avatar);
        
                        $ipaddress = Util::get_client_ip();
                        Util::user_auth_log($ipaddress,"user logged in successfully",$username,"User Logged In");
    
                        return response()->json(['status' => 'success', 'message' => 'Login successfull!', 'usertype'=>$user_usertype]);

    
                    }else{
    
                        $datetime = now()->format('YmdHis');
                        $token = $user->id . '_' . $datetime;
    
                        $user->token = $token;
                        $user->save();
                        session()->put('last_activity_time', Carbon::now());
                        session()->put('userid',$user_id);
                        session()->put('user_token',$token);
                        session()->put('username',$username);
                        session()->put('user_type',$user_usertype);
                        session()->put('user_type_title',$usertypetitle->title);
                        session()->put('avatar',$avatar);
        
                        $ipaddress = Util::get_client_ip();
                        Util::user_auth_log($ipaddress,"user logged in successfully",$username,"User Logged In");
    
                        return response()->json(['status' => 'success', 'message' => 'Login successfull!', 'usertype'=>$user_usertype]);

    
                    }
                    
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Incorrect password']);

                }

            }

        }else{

            return response()->json(['status' => 'error', 'message' => 'User not found']);


        }

    }

    public function logout(Request $request)
    {

        if (!session()->has('userid') || !session()->has('username')) {
            return redirect('/expired');
        }

        $userid = session()->get('userid');
        $username=session()->get('username');

        $user = User::find($userid);

        $user->token = '';
        $user->save();

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user logged out successfully",$username,"User Logged Out");

        session()->flush();

        return redirect('/');
    }

    
}