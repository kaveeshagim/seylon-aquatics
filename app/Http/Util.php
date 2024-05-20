<?php

namespace App\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Util
{
    // public static function isAuthorized($formname){

    //     if(!session('userid')){
    //         return 'LOGGEDOUT';
    //     }

    //     $privilege = DB::table('user_privilege')
    //         ->join('section', 'section_id', '=', 'section.id')
    //         ->select('user_privilege.*')
    //         ->where('user_privilege.user_type_id', '=', $usertypeid=session('usertypeid'))
    //         ->where(function($query) use ($formname)
    //             {
    //                 $query->where('section.section', '=', $formname)
    //                     ->orWhere('section.form_name', '=', $formname);
    //             })
    //         ->first();

    //     if($privilege){
    //         if($privilege->view){
    //             return "GRANTED";
    //         }
    //     }
    //     return "DENIED";
    // }

    // public static function Privilege($route_name){

    //     $user_id = session('userid');
    //     $user_token = session('user_token');

    //     if(!$user_id){
    //         return 'LOGOUT';
    //     }

    //     if($user_token){

    //         $get_token = DB::table('user_master')
    //             ->select('token')
    //             ->where('token','=',$user_token)
    //             ->first();

    //         if($get_token){

    //             $privilege = DB::table('tbl_prev_mst')
    //                 ->select('permission')
    //                 ->join('tbl_prev_sec_mst', 'tbl_prev_sec_mst.id', '=', 'tbl_prev_mst.sec_id')
    //                 ->join('user_master', 'user_master.user_type_id', '=', 'tbl_prev_mst.user_type_id')
    //                 ->where('permission', '=', '1')
    //                 ->where('tbl_prev_sec_mst.route_name', '=', $route_name)
    //                 ->where('user_master.id', '=', $user_id)
    //                 ->first();

    //             if($privilege){
    //                 return "GRANTED";
    //             }
    //             return "DENIED";

    //         }else{
    //             return 'LOGOUT';
    //         }
    //     }else{
    //         return 'LOGOUT';
    //     }
    // }

    // public static function Information_Access($route_name, $agent_id){

    //     $user_id = session('userid');
    //     $get_com_id  = DB::table('user_master')
    //         ->where('id',$user_id)
    //         ->first();
    //     $com_id = $get_com_id->com_id;

    //     if(Util::Privilege($route_name) == 'GRANTED' && $agent_id == 'All'){

    //         $users = DB::table('user_master')
    //             ->select('user_master.id', 'user_master.username', 'user_type_list.title', 'user_master.emp_no', 'user_master.fname', 'user_master.lname')
    //             ->join('user_type_list','user_master.user_type_id','=','user_type_list.id')
    //             ->where('user_master.com_id','=',$com_id)
    //             ->orderby('username','ASC')
    //             ->get();

    //     }elseif(Util::Privilege($route_name) == 'GRANTED' && $agent_id != 'All'){

    //         $users = DB::table('user_master')
    //             ->select('user_master.id', 'user_master.username', 'user_type_list.title', 'user_master.emp_no', 'user_master.fname', 'user_master.lname')
    //             ->join('user_type_list','user_master.user_type_id','=','user_type_list.id')
    //             ->where('user_master.com_id','=',$com_id)
    //             ->where('user_master.id','=',$agent_id)
    //             ->orderby('username','ASC')
    //             ->get();

    //     }else{

    //         $users = DB::table('user_master')
    //             ->select('user_master.id', 'user_master.username', 'user_type_list.title', 'user_master.emp_no', 'user_master.fname', 'user_master.lname')
    //             ->join('user_type_list','user_master.user_type_id','=','user_type_list.id')
    //             ->where('user_master.com_id','=',$com_id)
    //             ->where('user_master.id','=',$user_id)
    //             ->orderby('username','ASC')
    //             ->get();
    //     }

    //     return $users;
    // }



    // public static function startpart_agent_event_log($start_event,$agnt_sipid,$desc){
	// 	$cre_datetime = date("Y-m-d H:i:s");
	// 	$date = date("Y-m-d");

    //     $user_id = session('userid');
    //     $datetime = date('YmdHis');
    //     $token = $user_id.'_'.$datetime;

    //     if($start_event=="Log In Time")
    //     {
    //         $partone_id =  DB::table("tbl_agnt_evnt")
    //             ->insertGetId(
    //                 [   'agnt_event' => $start_event,
    //                     'date' => $date,
    //                     'agnt_userid' => session('userid'),
    //                     'agnt_sipid' => $agnt_sipid,
    //                     'cre_datetime' => $cre_datetime,
    //                     'agnt_desc' => $desc,
    //                     'token' => $token
    //                 ]
    //             );

    //     DB::table("tbl_agnt_evnt")
    //         ->insert(
    //             [
    //                 'agnt_event' => "Log Out Time",
    //                 'date' => $date,
    //                 'agnt_userid' => session('userid'),
    //                 'agnt_sipid' => $agnt_sipid,
    //                 'cre_datetime' => date("Y-m-d 23:59:00"),
    //                 'evnt_min_count' => 0,
    //                 'id_of_prtone' => $partone_id,
    //                 'agnt_desc' => $desc,
    //                 'token' => $token
    //             ]
    //         );

    //     }elseif($start_event == "Outbound On")
    //     {

    //         $breakstartevent = DB::table('tbl_agnt_evnt')
    //                         ->select('*')
    //                         ->where('agnt_event','Break Start')
    //                         ->where('agnt_userid',session('userid'))
    //                         ->where('agnt_sipid',$agnt_sipid)
    //                         ->where('date', $date)
    //                         ->orderBy('cre_datetime', 'desc')
    //                         ->first();

    //         if(!empty($breakstartevent)){
    //             $breakstarteventid = $breakstartevent->id;
    //             $breakstarteventdesc = $breakstartevent->agnt_desc;
    //             $breakstarteventstarttime = $breakstartevent->cre_datetime;

    //             $breakendevent = DB::table('tbl_agnt_evnt')
    //                         ->select('*')   
    //                         ->where('agnt_event','Break End')
    //                         ->where('id_of_prtone', $breakstarteventid)
    //                         ->orderBy('cre_datetime', 'desc')
    //                         ->first();

    //             if(empty($breakendevent)){

    //                 $starttime = strtotime($breakstarteventstarttime);
    //                 $endtime = strtotime($cre_datetime);

    //                 $evnt_min_count =  round(abs($endtime - $starttime),2). " minute";

    //                 DB::table('tbl_agnt_evnt')
    //                     ->insert(
    //                         [
    //                             'agnt_event' => 'Break End',
    //                             'date' =>  $date,
    //                             'agnt_userid' => session('userid'),
    //                             'agnt_sipid' => $agnt_sipid,
    //                             'cre_datetime' => $cre_datetime,
    //                             'id_of_prtone' => $breakstarteventid,
    //                             'evnt_min_count' => $evnt_min_count,
    //                             'agnt_desc' => $breakstarteventdesc
    //                         ]
    //                         );
    
    //                 $newcre_datetime = date("Y-m-d H:i:s", strtotime($cre_datetime . " +1 second"));
    
    //                 DB::table("tbl_agnt_evnt")
    //                     ->insert(
    //                         [   'agnt_event' => $start_event,
    //                             'date' => $date,
    //                             'agnt_userid' => session('userid'),
    //                             'agnt_sipid' => $agnt_sipid,
    //                             'cre_datetime' => $newcre_datetime,
    //                             'agnt_desc' => $desc
    //                         ]
    //                     );
    //             }else{

    //                 DB::table("tbl_agnt_evnt")
    //                 ->insert(
    //                     [   'agnt_event' => $start_event,
    //                         'date' => $date,
    //                         'agnt_userid' => session('userid'),
    //                         'agnt_sipid' => $agnt_sipid,
    //                         'cre_datetime' => $cre_datetime,
    //                         'agnt_desc' => $desc
    //                     ]
    //                 );

    //             }
    //         }else{

    //             DB::table("tbl_agnt_evnt")
    //             ->insert(
    //                 [   'agnt_event' => $start_event,
    //                     'date' => $date,
    //                     'agnt_userid' => session('userid'),
    //                     'agnt_sipid' => $agnt_sipid,
    //                     'cre_datetime' => $cre_datetime,
    //                     'agnt_desc' => $desc
    //                 ]
    //             );

    //         }                
            

        
            
    //     }elseif($start_event == "Break Start"){


    //         $outboundonevent = DB::table('tbl_agnt_evnt')
    //                         ->select('*')
    //                         ->where('agnt_event','Outbound On')
    //                         ->where('agnt_userid',session('userid'))
    //                         ->where('agnt_sipid',$agnt_sipid)
    //                         ->where('date', $date)
    //                         ->orderBy('cre_datetime', 'desc')
    //                         ->first();

                        

    //         if(!empty($outboundonevent)){
    //             $outboundoneventid = $outboundonevent->id;
    //             $outboundoneventstarttime = $outboundonevent->cre_datetime;
    //             $outboundoneventdesc = $outboundonevent->agnt_desc;

    //             $outboundoffevent = DB::table('tbl_agnt_evnt')
    //                         ->select('*')   
    //                         ->where('agnt_event','Outbound Off')
    //                         ->where('id_of_prtone', $outboundoneventid)
    //                         ->first();

    //             if(empty($outboundoffevent)){

    //                 $starttime = strtotime($outboundoneventstarttime);
    //                 $endtime = strtotime($cre_datetime);

    //                 $evnt_min_count =  round(abs($endtime - $starttime),2). " minute";

    //                 DB::table('tbl_agnt_evnt')
    //                     ->insert(
    //                         [
    //                             'agnt_event' => 'Outbound Off',
    //                             'date' =>  $date,
    //                             'agnt_userid' => session('userid'),
    //                             'agnt_sipid' => $agnt_sipid,
    //                             'cre_datetime' => $cre_datetime,
    //                             'id_of_prtone' => $outboundoneventid,
    //                             'evnt_min_count' => $evnt_min_count,
    //                             'agnt_desc' => $outboundoneventdesc
    //                         ]
    //                         );
    
    //                 $new_cre_datetime = date("Y-m-d H:i:s", strtotime($cre_datetime . " +1 second"));
    
    //                 DB::table("tbl_agnt_evnt")
    //                     ->insert(
    //                         [   'agnt_event' => $start_event,
    //                             'date' => $date,
    //                             'agnt_userid' => session('userid'),
    //                             'agnt_sipid' => $agnt_sipid,
    //                             'cre_datetime' => $new_cre_datetime,
    //                             'agnt_desc' => $desc
    //                         ]
    //                     );
    //             }else{

    //                 DB::table("tbl_agnt_evnt")
    //                 ->insert(
    //                     [   'agnt_event' => $start_event,
    //                         'date' => $date,
    //                         'agnt_userid' => session('userid'),
    //                         'agnt_sipid' => $agnt_sipid,
    //                         'cre_datetime' => $cre_datetime,
    //                         'agnt_desc' => $desc
    //                     ]
    //             );

    //             }
    //         }else{

    //             DB::table("tbl_agnt_evnt")
    //             ->insert(
    //                 [   'agnt_event' => $start_event,
    //                     'date' => $date,
    //                     'agnt_userid' => session('userid'),
    //                     'agnt_sipid' => $agnt_sipid,
    //                     'cre_datetime' => $cre_datetime,
    //                     'agnt_desc' => $desc
    //                 ]
    //             );

    //         }    
            

                            
        // }else{


        //     DB::table("tbl_agnt_evnt")
        //     ->insert(
        //         [   'agnt_event' => $start_event,
        //             'date' => $date,
        //             'agnt_userid' => session('userid'),
        //             'agnt_sipid' => $agnt_sipid,
        //             'cre_datetime' => $cre_datetime,
        //             'agnt_desc' => $desc
		// 		]
        //     );
        // }
         


	// }
	// public static function endpart_agent_event_log($start_event,$end_event,$agnt_sipid,$desc){
	// 	$cre_datetime = date("Y-m-d H:i:s");
	// 	$date = date("Y-m-d");

    //     $agnt_userid = session("userid");

	// 	$get_startpart = DB::table('tbl_agnt_evnt')
    //         ->select('tbl_agnt_evnt.*')
    //         // ->where('tbl_agnt_evnt.date', '=', $date)
    //         ->where('tbl_agnt_evnt.agnt_sipid', '=',$agnt_sipid)
    //         ->where('tbl_agnt_evnt.agnt_userid', '=',$agnt_userid)
    //         ->where('tbl_agnt_evnt.agnt_event', '=',$start_event)
    //         ->orderBy('tbl_agnt_evnt.id', 'desc')
    //         ->first();
    //     $start_datetime = strtotime($get_startpart->cre_datetime);
    //     $endtime = strtotime(date("Y-m-d H:i:s"));
    //      $evnt_min_count =  round(abs($endtime - $start_datetime),2). " minute";
       
    //     $check_softphone_rec = DB::table('tbl_agnt_evnt')
    //                 ->select('tbl_agnt_evnt.id')
    //                 ->where('tbl_agnt_evnt.id_of_prtone', '=', $get_startpart->id)
    //                 ->where('tbl_agnt_evnt.agnt_event', '=',$end_event)
    //                 ->orderBy('tbl_agnt_evnt.id', 'desc')
    //                 ->first();

    //     if($desc=="")
    //     {
    //         $desc = $get_startpart->agnt_desc;
    //     }
    //     //dd($check_softphone_rec);
    //     if(!empty($check_softphone_rec))
    //     {
    //         DB::table('tbl_agnt_evnt')
    //             ->where('id',$check_softphone_rec->id)
    //         ->update([
    //                     'cre_datetime' => $cre_datetime,
    //                     'evnt_min_count' => $evnt_min_count,
    //                     'agnt_desc' => $desc]);
    //     }else
    //     {
    //         DB::table("tbl_agnt_evnt")
    //         ->insert(
    //             [   
    //                 'agnt_event' => $end_event,
    //                 'date' => $date,
    //                 'agnt_userid' => session('userid'),
    //                 'agnt_sipid' => $agnt_sipid,
    //                 'cre_datetime' => $cre_datetime,
    //                 'evnt_min_count' => $evnt_min_count,
    //                 'id_of_prtone' => $get_startpart->id,
    //                 'agnt_desc' => $desc
	// 			]
    //         );
            
    //     }
        
    // }

    public static function user_auth_log($ip,$des,$username,$event){

       $insert=DB::table("tbl_user_auth_log")
            ->insert(
                [   'ip_address' => $ip,
                    'user_id' => session('userid'),
                    'username' => $username,
                    'cre_datetime' => Carbon::now(),
                    'description' => $des,
                    'event' => $event]
            );
            if($insert){
                return 'SAVE';
            }else{
                return 'ERROR';
            }
    }

    public static function user_auth_header($user_type_id){

        $mainmenuaccess  = DB::table('tbl_usertype') 
                                ->where('id', $user_type_id)
                                ->first();

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
    
    // public static function log($form, $event){
    //     if(!empty(session('usertypeid')))
    //     {
    //         DB::table("csp_event_log")
    //         ->insert(
    //             ['user_id' => session('userid'),
    //                 'user_type' => DB::table('user_type_list')->where('id', session('usertypeid'))->first()->title,
    //                 'time' => Carbon::now(),
    //                 'form' => $form,
    //                 'event' => $event]
    //         );
    //     }
       
    // }

    // public static function log_all($ip,$event,$data){


    //     DB::table("all_event_log")
    //         ->insert(
    //             ['user_id' => session('userid'),
    //                 'time' => Carbon::now(),
    //                 'ip' => $ip,
    //                 'event' => $event,
    //                 'data' => $data]
    //         );
    // }
  
    // public static function get_com_id_by_user($user_id){

        //     $com_id = DB::table('phonikip_db.user_master')
        //         ->select('com_id')
        //         ->where('user_master.id', '=', $user_id)
        //         ->first();
        //     return $com_id->com_id;
        // }


    // public static function SendSMS($number,$message){

    //     if(strlen($number) >= 9) {
    //             $number=  substr($number, -9);
    //     }

    //     date_default_timezone_set('Asia/Colombo');
    //     $now = date("Y-m-d H:i:s");
    //     $username = "iphonik_user";
    //     $password = "611b43f10ca30";
    //     $digest=md5($password);
    //     $body = '{
    //         "messages": [
    //         {
    //         "clientRef": "12544",
    //         "number": "94'.$number.'",
    //         "mask": "iPhonik",
    //         "text": "'.$message.'",
    //         "campaignName":"IPHONIK"
    //         }
    //         ]}';
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,"https://richcommunication.dialog.lk/api/sms/send");
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS,$body); //Post Fields
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $headers = [
    //      'Content-Type: application/json',
    //      'USER: '.$username,
    //      'DIGEST: '.$digest,
    //      'CREATED: '.$now
    //     ];
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     $server_output = curl_exec ($ch);
    //     curl_close ($ch);
    //     // var_dump($server_output);
    //     return $server_output;
    // }
}