<?php

namespace App\Http\Controllers;

use App\Services\PHPMailerService;
use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ResetPasswordReq;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class PasswordController extends Controller
{

    public function getpasswordreq() {

        $data = DB::table('tbl_reset_password_req')
        ->select('tbl_reset_password_req.*', 'tbl_users.username')
        ->join('tbl_users', 'tbl_reset_password_req.user_id', '=', 'tbl_users.id')
        ->where('tbl_reset_password_req.status', 'pending')
        ->get();

        return $data;    

    }

    public function addpasswordresetreq(Request $request) {
        $username = $request->input('username-reset');
        $user = User::where('username', $username)->first();
        
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found']);
        }
    // dd($user->password);
        ResetPasswordReq::create([
            'user_id' => $user->id,
            'reason' => $request->input('reason'),
            'status' => 'pending',
        ]);
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user added a password reset request", $username, "Add Password Reset Request");
    
        return response()->json(['status' => 'success', 'message' => 'Password Change request successfull!']);
    }
    


    public function rejectpasswordrequest(Request $request) {
        $id = $request->input('id');

        ResetPasswordReq::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user deleted a password request ",$username, "Delete password request");

        return response()->json(['status' => 'success', 'message' => 'Password Request Rejected successfully!']);

    }

    public function approvepasswordrequest(Request $request) {

        try {
            // Validate the input
            $validated =  $request->validate([
                'editid' => 'required|exists:tbl_reset_password_req,id',
                'newpassword' => [
                    'required',
                    'string',
                    'min:8',  // Minimum length of 8 characters
                    'regex:/[A-Z]/',  // At least one uppercase letter
                    'regex:/[!@#$%^&*(),.?":{}|<>]/',  // At least one symbol
                    'regex:/[0-9]/',  // At least one number
                ],
            ]);

            $id = $validated['editid'];
            $newpassword = $validated['newpassword'];
            
            // Hash the new password
            $hashedPassword = Hash::make($newpassword);
        
            // Find the password request record
            $passwordRequest = ResetPasswordReq::find($id);
        
            if (!$passwordRequest) {
                return response()->json(['status' => 'error', 'message' => 'Password Request not found']);
            }
        
            // Update the password request status
            $passwordRequest->update([
                'status' => 'approved',
                'new_password' => $hashedPassword,
                'updated_by' => session()->get('userid'),
            ]);
        
            // Find the associated user
            $user = User::find($passwordRequest->user_id);
        
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found']);
            }

            $user->password = $hashedPassword;
            $user->save();

            DB::table('tbl_notifications')->insert(['user_id'=> $passwordRequest->user_id, 'notification' => 'Password Changed', 'seen_status' => 0, 'created_at'=> NOW()]);
        
            $username = $user->username;
            $email = $user->email;

            $subject = "Password Change Request";
            $body = 'Hi ' . $username . ',<br><br>';
            $body .= 'New Password: ' . $newpassword;
        
            // Send the email
            try {
                $mailerService = new PHPMailerService();
                $mailerService->sendEmail($email, $subject, nl2br($body));
                Log::info('Email sent to: ' . $email);
                $passwordRequest->update([
                    'email_status' => 'sent'
                ]);


            } catch (\Exception $e) {
                Log::error('Email sending failed. Error: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => 'Password update successful. Failed to send email']);
            }
        


            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "User approved a password request", $username, "Approved a password request");

            return response()->json(['status' => 'success', 'message' => 'Password request approved successfully']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, return custom error response
            return response()->json([
                'status' => 'error',
                'message' => 'Password format incorrect',
                'errors' => $e->errors(), // Return the specific validation errors
            ], 422); // 422 Unprocessable Entity status code
        }
        

    }

    public function resetpassword(Request $request)
    {
        // Validate the password input
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',  // Minimum length of 8 characters
                'regex:/[A-Z]/',  // At least one uppercase letter
                'regex:/[!@#$%^&*(),.?":{}|<>]/',  // At least one symbol
                'regex:/[0-9]/',  // At least one number
            ],
        ]);

    
        // Retrieve the new password from the request
        $newPassword = $validated['password'];
    
        // Get the user ID from the session
        $userId = session()->get('userid');
    
        // Find the user by ID
        $user = User::find($userId);
    
        // Check if the user exists
        if ($user) {
            // Hash the new password
            $hashedPassword = Hash::make($newPassword);
    
            // Update the user's password
            $user->password = $hashedPassword;
    
            // Save the changes to the database
            $user->save();
    
            return response()->json(['status' => 'success', 'message'=>'Password has been reset successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message'=>'User Not Found']);
        }
    }
    
   
}
