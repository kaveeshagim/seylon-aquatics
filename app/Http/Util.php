<?php

namespace App\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;
use App\Models\User;
use App\Models\UserAuthLog;

class Util
{

    public static function user_auth_log($ip,$des,$username,$event){

        $insert = UserAuthLog::create([
            'ip_address' => $ip,
            'user_id' => Session::get('userid'),
            'username' => $username,
            'description' => $des,
            'event' => $event,
        ]);

            if($insert){
                return 'SAVE';
            }else{
                return 'ERROR';
            }
    }

    public static function user_auth_header($user_type_id)
    {
        $mainmenuaccess = UserType::where('id', $user_type_id)->first();
    
        if ($mainmenuaccess) {
            return json_decode($mainmenuaccess->main_menu_access);
        } else {
            return null;
        }
    }
    

    public static function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function Privilege($route_name){

        $user_id = session('userid');
        $user_token = session('user_token');

        if(!$user_id){
            return 'LOGOUT';
        }

        if($user_token){

            $get_token = DB::table('user_master')
                ->select('token')
                ->where('token','=',$user_token)
                ->first();

            if($get_token){

                $privilege = DB::table('tbl_prev_mst')
                    ->select('permission')
                    ->join('tbl_prev_sec_mst', 'tbl_prev_sec_mst.id', '=', 'tbl_prev_mst.sec_id')
                    ->join('user_master', 'user_master.user_type_id', '=', 'tbl_prev_mst.user_type_id')
                    ->where('permission', '=', '1')
                    ->where('tbl_prev_sec_mst.route_name', '=', $route_name)
                    ->where('user_master.id', '=', $user_id)
                    ->first();

                if($privilege){
                    return "GRANTED";
                }
                return "DENIED";

            }else{
                return 'LOGOUT';
            }
        }else{
            return 'LOGOUT';
        }
    }

     public static function getNextVarietyCode($lastCode) {
        $alphabet = range('A', 'Z');
        $length = strlen($lastCode);
        $nextCode = '';

        $carry = 1; // We start with a carry of 1 to increment

        for ($i = $length - 1; $i >= 0; $i--) {
            $currentChar = $lastCode[$i];
            $currentIndex = array_search($currentChar, $alphabet);

            if ($currentIndex === false) {
                throw new Exception('Invalid character in variety code');
            }

            $newIndex = $currentIndex + $carry;

            if ($newIndex >= count($alphabet)) {
                $nextCode = $alphabet[0] . $nextCode; // Reset to 'A'
                $carry = 1; // Carry over to the next significant digit
            } else {
                $nextCode = $alphabet[$newIndex] . $nextCode;
                $carry = 0; // No more carry over needed
            }
        }

        // If carry is still 1, it means we have gone past 'ZZ', and need to add a new significant digit
        if ($carry == 1) {
            $nextCode = 'A' . $nextCode;
        }

        return $nextCode;
    }

    public static function updateLastActivityTime() {

        if (session()->has('userid')) { 
            $userId = session()->get('userid');
            $user = User::find($userId);

            if ($user) {
                $lastActivity = session()->get('last_activity_time');

                if ($lastActivity && now()->diffInMinutes($lastActivity) > 60) {
                    $user->token = '';
                    $user->save();

                    session()->flush();

                    DB::table('test')->insert(['message'=>"false", 'created_at'=>now(), 'last_activity'=>$lastActivity]);

                    return "false";
                    // return redirect('/expired');
                }

                // Update last activity time
                session()->put('last_activity_time', now());
                DB::table('test')->insert(['message'=>"false", 'created_at'=>now(), 'last_activity'=>$lastActivity]);
                return "true";
            }
        }else{
            DB::table('test')->insert(['message'=>"invalid", 'created_at'=>now()]);
             return "invalid";
            //  return redirect('/login');
        }

    }
    
}