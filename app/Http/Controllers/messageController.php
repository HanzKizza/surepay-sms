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
        // $message->save();
        // DB::insert("insert into queue values (DEFAULT, {$message->id})");
        // Encode the message object as JSON
    $jsonMessage = json_encode($message);

    // Set the URL of the external API
    $url = 'https://api.example.com/send-message';

    // Initialize curl
    $ch = curl_init();

    // Set curl options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonMessage);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the curl request
    $response = curl_exec($ch);

    // Close curl
    curl_close($ch);

    // Handle the response
    if ($response === false) {
        // Handle error
    } else {
        // Process response
        // return $response;
    }

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
