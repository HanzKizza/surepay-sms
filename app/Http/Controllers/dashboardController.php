<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\message;


class dashboardController extends Controller
{
    //
    function populate(Request $request){
        return view($request->page);
    }

    function loadOutBox(Request $request){
        $clientId = $request->clientId;
        $messages = DB::select("SELECT * FROM messages WHERE clientId = {$clientId} ORDER BY created_at DESC");
        return view("outbox", ['messages' => $messages, 'clientId' => $clientId]); 
    }
}
