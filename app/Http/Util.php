<?php

namespace App\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\FishHabitat;
use App\Models\FishVariety;
use App\Models\FishFamily;
use App\Models\FishSpecies;
use App\Models\FishWeekly;
use App\Models\Size;


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
        $user_type = session('user_type');
        $user_token = session('user_token');


        if(!$user_id){
            return 'LOGOUT';
        }

        if($user_token){

            $get_token = DB::table('tbl_users')
                ->select('token')
                ->where('token','=',$user_token)
                ->first();

            if($get_token){

                $privilege = DB::table('tbl_privilege_mst')
                    ->select('permission')
                    ->where('permission', '=', '1')
                    ->where('tbl_privilege_mst.route_name', '=', $route_name)
                    ->where('tbl_privilege_mst.user_type', '=', $user_type)
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

    public static function generateFishCode($speciesId, $sizeId = null, $sizeCm = null) {
        // Fetch the species and related data
        $species = FishSpecies::find($speciesId);
    
        // Retrieve the related fish family and habitat
        $fishFamily = $species->family;
        $fishHabitat = $fishFamily->habitat->name;
    
        $habitatInitial = strtoupper(substr($fishHabitat, 0, 1)); // Get first letter and make it uppercase
        $speciesInitials = strtoupper(substr($species->name, 0, 2));
    
        // Retrieve the size name if a size ID is provided
        $sizePart = null;
        if ($sizeId) {
            $size = Size::find($sizeId);
            $sizePart = strtoupper($size->name); // Use size name
        } else {
            $sizePart = strtoupper($sizeCm);
        }
    
        // Prepare the query to get the last value for this species and size combination
        $query = FishVariety::where('species_id', $speciesId);
    
        if ($sizeId) {
            $query->where('size', $sizeId); // Use size_id instead of size
        } else {
            $query->where('size_cm', strtoupper($sizeCm));
        }
    
        $lastFishVariety = $query->orderBy('id', 'desc')->first();
    
        $lastValue = 1;
        if ($lastFishVariety) {
            $lastCode = $lastFishVariety->fish_code;
            $lastValue = intval(substr($lastCode, strrpos($lastCode, '-') + 1)) + 1;
        }
    
        // Generate fish code
        $fishCode = $habitatInitial . $sizePart . '-' . $speciesInitials . $speciesId . '-' . $lastValue;
    
        return $fishCode;
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