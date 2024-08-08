<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\UserType;
use App\Models\User;

class UsersController extends Controller
{

public function getusers() {
    // Retrieve users along with their user types
    $users = User::with('userType')->get();

    $formattedUsers = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'usertype' => $user->userType->title,
            'token' => $user->token,
            'active_status' => $user->active_status,
        ];
    });

    return response()->json($formattedUsers);
}

public function getexecutives() {
    // Retrieve users along with their user types
    $users = User::with('userType')->get();

    $formattedUsers = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'usertype' => $user->userType->title,
            'token' => $user->token,
            'active_status' => $user->active_status,
        ];
    });

    return response()->json($formattedUsers);
}


    public function adduser(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'usertype' => 'required',
            'username' => 'required|unique:tbl_users,username',
            'firstname' => 'required',
            'lastname' => 'nullable',
            'password' => 'required',
            'inline-radio-group' => 'required|boolean',
            'company' => 'nullable',
            'email' => 'nullable|email',
            'primary_contact' => 'required',
            'secondary_contact' => 'nullable',
            'avatar' => 'nullable|file|max:2048',
        ]);

    
        $username = $validatedData['username'];
        $hashedPassword = Hash::make($validatedData['password']);
    
        // Check if the username already exists
        $found = User::where('username', $username)->exists();

        if ($found) {
            return response()->json(['status' => 'error', 'message' => 'Username already exists']);

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
        $user->tbl_usertype_id = $validatedData['usertype'];
        $user->username = $validatedData['username'];
        $user->fname = $validatedData['firstname'];
        $user->lname = $validatedData['lastname'];
        $user->password = $hashedPassword;
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
    
        return response()->json(['status' => 'success', 'message' => 'User added successfully!']);
    }

    public function edituser(Request $request) {
        // Validate the form data
        $validatedData = $request->validate([
            'usertype' => 'required',
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'nullable',
            'password' => 'required',
            'inline-radio-group' => 'required|boolean',
            'company' => 'nullable',
            'email' => 'nullable|email',
            'primary_contact' => 'required',
            'secondary_contact' => 'nullable',
            'avatar' => 'nullable|file|max:2048',
        ]);
    
        $username = $validatedData['username'];
        $id = $request->input('userid');
        $hashedPassword = Hash::make($validatedData['password']);
    
        // Check if there are other records with the same username
        $existingUser = User::where('username', $username)->where('id', '!=', $id)->first();
        if ($existingUser) {
            return response()->json(['status' => 'error', 'message' => 'Username already exists']);

        }
    
        // Handle the file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $originalExtension = $avatar->getClientOriginalExtension(); // Get the original file extension
    
            // Generate a new filename using the username and current date/time
            $newFileName = $username . '-' . now()->format('Y-m-d-H-i-s') . '.' . $originalExtension;
    
            // Check if the file already exists in the storage
            if (!Storage::disk('public')->exists('avatars/' . $newFileName)) {
                $avatarPath = $avatar->storeAs('avatars', $newFileName, 'public');
            } else {
                // If the file exists, use the existing path
                $avatarPath = 'avatars/' . $newFileName;
            }
        }
    
        // Insert the user data into the database
        $user = User::find($id);
    
        // Update user attributes
        $user->tbl_usertype_id = $validatedData['usertype'];
        $user->username = $validatedData['username'];
        $user->fname = $validatedData['firstname'];
        $user->lname = $validatedData['lastname'];
        $user->password = $hashedPassword; // Encrypt the password before saving
        $user->active_status = $validatedData['inline-radio-group'];
        $user->company = $validatedData['company'];
        $user->email = $validatedData['email'];
        $user->primary_contact = $validatedData['primary_contact'];
        $user->secondary_contact = $validatedData['secondary_contact'];
        if ($avatarPath) {
            $user->avatar = $avatarPath;
        }
        
        // Save the changes
        $user->save();
    
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user edited", $username, "User Edited");
    
        return response()->json(['status' => 'success', 'message' => 'User updated successfully!']);

    }

    public function deleteuser(Request $request) {
        $userId = $request->input('id');
        
        // Check if the user is associated with any related data
        $isAssociated = User::find($userId)
            ->customer()
            ->exists() || 
            User::find($userId)
            ->notification()
            ->exists() ||
            User::find($userId)
            ->passwordreq()
            ->exists() ||
            User::find($userId)
            ->passwordreqrec()
            ->exists() ||
            User::find($userId)
            ->order()
            ->exists();
        
        if ($isAssociated) {
            return response()->json([
                'status' => 'error',
                'message' => 'User cannot be deleted because they are associated with other data.'
            ]);
        }
    
        // Proceed with deletion if no associations are found
        User::destroy($userId);
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "user deleted", $username, "User Deleted");
    
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully!'
        ]);
    }
    

    public function userdetails(Request $request) {

        $id = $request->input('id');

        
    }
}