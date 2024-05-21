<?php

namespace App\Http\Controllers;

use App\Services\PHPMailerService;
use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ResetPasswordReq;
use App\Models\ResetPassword;
use App\Models\User;

class PasswordController extends Controller
{

    public function getpasswordreq() {

        $data = ResetPasswordReq::select('tbl_reset_password_req.*', 'tbl_users.username')
                ->join('tbl_users', 'tbl_reset_password_req.user_id', '=', 'tbl_users.id')
                ->where('status', 'pending')
                ->get();

        return $data;    

    }

    public function addpasswordresetreq(Request $request) {

        $username = $request->input('username-reset');

        $user = User::where('username', $username)->first();

        ResetPasswordReq::insert([
            'user_id' => $user->id,
            'reason' => $request->input('reason'),
            'cur_password' => $user->password,
            'cre_datetime' => now(),
            'status' => 'pending',
        ]);


        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user added a password reset request ",$username, "Add Password Reset Request");

        return "success";

    }

    public function editnewpassword(Request $request) {

        ResetPassword::create([
            'psws_reqid' => $request->req_id, 
            'user_id' => $request->user_id,
            'username' => $request->username,
            'old_password' => $request->oldpswd,
            'new_password' => $request->newpswd,
            'updated_by' => session()->get('userid'),
            'cre_datetime' => now()
        ]);
        
        ResetPasswordReq::where('id', $request->id)->update(['status' => 'completed']);
        
        $user = User::find($request->user_id);
        $email = $user->email;

        $subject = "Password Change Request";

        $body = 'Hi'. $request->username . ',\n\n';
        $body += 'New Password'. $request->newpswd;

        PHPMailerService::sendEmail($to, $subject, $body);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user updated a password ",$username, "Update User Password");

    }

   
}
