<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\YourEventName;

class BroadcastController extends Controller
{
   public function broadcastMessage()
    {
        // Trigger the event
        event(new YourEventName('This is a broadcast message'));

        return response()->json(['message' => 'Event has been broadcasted!']);
    }
}
