<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\message;

class messageController extends Controller
{
    //
    function sendMessage(Request $request){
        $message = new message();
        $message->phoneNumber = $request->phoneNumber;
        $message->message = $request->message;
        $message->clientId = $request->clientId;
        $message->sender = $request->sender;
        $message->save();
        DB::insert("insert into queue values (DEFAULT, {$message->id})");
        return json_encode($message);
    }
}
