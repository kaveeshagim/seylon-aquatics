<?php

namespace App\Http\Controllers;

use App\Services\PHPMailerService;
use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasswordController extends Controller
{

    public function getpasswordreq() {

        $data = DB::table('tbl_reset_password_req')
            ->select('tbl_reset_password_req.*', 'tbl_users.username')
            ->join('tbl_users', 'tbl_reset_password_req.user_id', '=', 'tbl_users.id')
            ->where('status', '=', 'pending')
            ->get();

        return $data;    

    }

    public function addpasswordresetreq(Request $request) {

        $username = $request->input('username-reset');

        $cur_password = DB::table('tbl_users')->select('tbl_users.password', 'tbl_users.id')->where('username', $username)->first();

        DB::table('tbl_reset_password_req')
        ->insert([
            'user_id'=> $cur_password->id,
            'reason' => $request->input('reason'),
            'cur_password' => $cur_password->password,
            'cre_datetime' => NOW(),
            'status' => 'pending',
        ]);


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user added a password reset request ",$username, "Add Password Reset Request");

        return "success";

    }

    public function editnewpassword(Request $request) {

        DB::table('tbl_reset_password')
        ->insert([
            'psws_reqid' => $request->req_id, 
            'user_id' => $request->user_id,
            'username' => $request->username,
            'old_password' => $request->oldpswd,
            'new_password' => $request->newpswd,
            'updated_by' => session()->get('userid'),
            'cre_datetime' => NOW()
         ]);

        DB::table('tbl_reset_password_req')
        ->where('id', $request->id)
        ->update(['status' => 'completed']);

        $email = DB::table('tbl_users')->select('tbl_users.email')->where('tbl_users.id', '=', $request->user_id)->first();

        $to = $email->email;

        $subject = "Password Change Request";

        $body = 'Hi'. $request->username . ',\n\n';
        $body += 'New Password'. $request->newpswd;

        PHPMailerService::sendEmail($to, $subject, $body);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user updated a password ",$username, "Update User Password");

    }

   
}
