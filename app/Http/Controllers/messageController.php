<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\message;

class messageController extends Controller
{
    //
    function sendMessage(Request $request){
        $message = new message();
        $message->messageId = 1;
        $message->phoneNumber = $request->phoneNumber;
        $message->message = $request->message;
        $message->clientId = $request->clientId;
        $message->sender = $request->sender;
        // $message->save();
        // DB::insert("insert into queue values (DEFAULT, {$message->id})");
        // Encode the message object as JSON
        return $this->postMessage($message);
    }



    function sendBulkMessage(Request $request){
        $receipients = json_decode($request->phoneNumbers);
        $messageText = $request->message;
        $clientId = $request->clientId;
        $sender = $request->sender;
        $messages = array();
        foreach($receipients as $receipient){
            $message = new message();
            $message->messageId = 1;
            $message->phoneNumber = $receipient;
            $message->message = $messageText;
            $message->clientId = $clientId;
            $message->sender = $sender;
            array_push($messages, $message);
            // var_dump($message);
            // $message->save();
            // DB::insert("insert into queue values (DEFAULT, {$message->id})");
            // echo $this->postMessage($message);
        }
        echo $this->postBulkMessage($messages);
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


    function postMessage(Message $message){
        // Set the request URL
        $url = "http://localhost:8090/messages/publish";

        // Set the request headers
        $headers = array(
            "Content-Type: application/json"
        );

        $data = json_encode($message);

        // Initialize a new cURL session
        $curl = curl_init();

        // Set the cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers
        ));

        // Execute the cURL request
        $response = curl_exec($curl);  

        if(curl_errno($curl)) {
            $error_msg = curl_error($curl);
            return $error_msg;
        }else{
            return("Messasge sent to queue");
        }
        // Close the cURL session
        curl_close($curl);
    }


    function postBulkMessage($message){
        // Set the request URL
        $url = "http://localhost:8090/messages/publishBulk";

        // Set the request headers
        $headers = array(
            "Content-Type: application/json"
        );

        $data = json_encode($message);

        // Initialize a new cURL session
        $curl = curl_init();

        // Set the cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers
        ));

        // Execute the cURL request
        $response = curl_exec($curl);  

        if(curl_errno($curl)) {
            $error_msg = curl_error($curl);
            return $error_msg;
        }else{
            return("Messasge sent to queue");
        }
        // Close the cURL session
        curl_close($curl);
    }
}
