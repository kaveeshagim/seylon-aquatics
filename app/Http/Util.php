<?php

namespace App\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;
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
    
}