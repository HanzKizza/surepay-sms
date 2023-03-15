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



    function sendBulkMessage(Request $request){
        $receipients = json_decode($request->phoneNumbers);
        $messageText = $request->message;
        $clientId = $request->clientId;
        $sender = $request->sender;
        foreach($receipients as $receipient){
            $message = new message();
            $message->phoneNumber = $receipient;
            $message->message = $messageText;
            $message->clientId = $clientId;
            $message->sender = $sender;
            // var_dump($message);
            $message->save();
            DB::insert("insert into queue values (DEFAULT, {$message->id})");
        }
        return "Messages sent";
    }


    function sendCustomMessage(Request $request){
        $clientId = $request->clientId;
        $sender = $request->sender;
        $messages = json_decode($request->messages);
        foreach($messages as $data){
            $message = new message();
            $message->phoneNumber = $data[0];
            $message->message = $data[1];
            $message->clientId = $clientId;
            $message->sender = $sender;
            echo $message->message;
            $message->save();
            DB::insert("insert into queue values (DEFAULT, {$message->id})");
        }
        // echo "Messages saved";
    }
}
