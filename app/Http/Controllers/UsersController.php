<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;

class UsersController extends Controller
{

    public function getusers() {

        $data = User::with('userType')->get();

            // dd($users);

        return $data;    

    }

    // public function adduser(Request $request){

    //     dd($request->all());

    //     $username = $request->input('username');
    //     $avatar = $request->file('avatar');

    //     $users = DB::table('tbl_users')
    //         ->select('tbl_users.username')
    //         ->get();

    //         dd($avatar);

    //     $found = false;
    //     $result = "";

    //         foreach ($users as $user) {
    //             if ($user->username === $username) {
    //                 $found = true;
    //                 break;
    //             }
    //         }

            
    //         if ($found) {

    //             $result = "failed";

    //         }else{

    //             // $path = $avatar->store('avatars', 'public');

    //             if ($avatar) {
    //                 // Store the uploaded file in storage and get the path
    //                 $path = $avatar->store('avatars');
    //                 // $path = $avatar->store('avatars', 'public');
                    

    //                 DB::table('tbl_users')
    //                 ->insert([
    //                     'user_type' => $request->input('usertype'),
    //                     'username' => $request->input('username'),
    //                     'fname' => $request->input('firstname'),
    //                     'lname' => $request->input('lastname'),
    //                     'password' => $request->input('password'),
    //                     'active_status' => $request->input('inline-radio-group'),
    //                     'company' => $request->input('company'),
    //                     'email' => $request->input('email'),
    //                     'primary_contact' => $request->input('primary_contact'),
    //                     'secondary_contact' => $request->input('secondary_contact'),
    //                     'avatar' => $path,
    //                 ]);

    //                 $ipaddress = Util::get_client_ip();
    //                 Util::user_auth_log($ipaddress,"user added ",$username, "User Added");

    //                 $result = "success";

    //             }
    //         }

    //         return $result;
    // }

    public function adduser(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'usertype' => 'required',
            'username' => 'required|unique:tbl_users,username',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'password' => 'required',
            'inline-radio-group' => 'required|boolean',
            'company' => 'nullable',
            'email' => 'nullable|email',
            'primary_contact' => 'nullable',
            'secondary_contact' => 'nullable',
            'avatar' => 'nullable|file|max:2048',
        ]);
    
        $username = $validatedData['username'];
    
        // Check if the username already exists
        $found = User::where('username', $username)->exists();

        if ($found) {
            return 'failed';
        }
    
        // Handle the file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $originalExtension = $avatar->getClientOriginalExtension(); // Get the original file extension
    
            // Generate a new filename using the username and current date/time
            $newFileName = $username . '-' . now()->format('Y-m-d-H-i-s') . '.' . $originalExtension;
    
            $avatarPath = $avatar->storeAs('avatars', $newFileName, 'public');
        }
    
        // Insert the user data into the database
        $user = new User();
        $user->user_type = $validatedData['usertype'];
        $user->username = $validatedData['username'];
        $user->fname = $validatedData['firstname'];
        $user->lname = $validatedData['lastname'];
        $user->password = $validatedData['password'];
        $user->active_status = $validatedData['inline-radio-group'];
        $user->company = $validatedData['company'];
        $user->email = $validatedData['email'];
        $user->primary_contact = $validatedData['primary_contact'];
        $user->secondary_contact = $validatedData['secondary_contact'];
        $user->avatar = $avatarPath; // Assuming $avatarPath is the path to the user's avatar image

        // Save the user to the database
        $user->save();
    
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user added ", $username, "User Added");
    
        return 'success';
    }

    public function edituser(Request $request) {

        // Validate the form data
        $validatedData = $request->validate([
            'usertype' => 'required',
            'username' => 'required|unique:tbl_users,username',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'password' => 'required',
            'inline-radio-group' => 'required|boolean',
            'company' => 'nullable',
            'email' => 'nullable|email',
            'primary_contact' => 'nullable',
            'secondary_contact' => 'nullable',
            'avatar' => 'nullable|file|max:2048',
        ]);
    
        $username = $validatedData['username'];

        $id = $request->input('userid');
    
        // Check if the username already exists
        // $found = DB::table('tbl_users')
        // ->where('username', $username)
        // ->whereNotIn('id', [$id])
        // ->exists();

    
        // if ($found) {
        //     return 'failed';
        // }
    
        // Handle the file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $originalExtension = $avatar->getClientOriginalExtension(); // Get the original file extension
    
            // Generate a new filename using the username and current date/time
            $newFileName = $username . '-' . now()->format('Y-m-d-H-i-s') . '.' . $originalExtension;
    
            $avatarPath = $avatar->storeAs('avatars', $newFileName, 'public');
        }
    
        // Insert the user data into the database
        $user = User::find($id);

        // Update user attributes
        $user->user_type = $validatedData['usertype'];
        $user->username = $validatedData['username'];
        $user->fname = $validatedData['firstname'];
        $user->lname = $validatedData['lastname'];
        $user->password = $validatedData['password'];
        $user->active_status = $validatedData['inline-radio-group'];
        $user->company = $validatedData['company'];
        $user->email = $validatedData['email'];
        $user->primary_contact = $validatedData['primary_contact'];
        $user->secondary_contact = $validatedData['secondary_contact'];
        $user->avatar = $avatarPath;
        
        // Save the changes
        $user->save();
    
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user edited ",$username, "User Edited");

        return 'success';
    }

    public function deleteuser(Request $request) {


        User::destroy($request->input('id'));

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"user deleted ",$username, "User Deleted");

        return "deleted";

    }

    public function userdetails(Request $request) {

        $id = $request->input('id');

        
    }
}
