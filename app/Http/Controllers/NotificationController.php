<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserType;
use App\Models\User;

class NotificationController extends Controller
{

    public function getnotificationcount()
{
    // Retrieve the logged-in user's ID from the session
    $userId = session('userid');

    // Get the count of unseen notifications
    $unseenCount = DB::table('tbl_notifications')
        ->where('user_id', $userId)
        ->where('seen_status', 0)
        ->count();

    // Return the count as a JSON response (or pass it to the view)
    return response()->json(['unseenCount' => $unseenCount]);
}

    public function removenotif(Request $request) {
        
        $id = $request->input('id');

        DB::table('tbl_notifications')->where('id', $id)->update(['seen_status'=>1]);

        return response()->json(['status' => 'success']);


    }



}
