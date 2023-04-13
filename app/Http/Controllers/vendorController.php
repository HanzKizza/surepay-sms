<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\message;

class vendorController extends Controller
{
    function verifyUser(Request $request){
        $email = $request->email;
        $password = $request->password;
        $user = DB::select("select * from user  left join vendor on(user.vendorId = vendor.vendorId) where user.email = ? and user.pwd = ?", [$email, $password]);
        // var_dump($user);
        if($user){
            session(['user'=> $user]);
            return redirect("/user/home");
        }else{
            return view("/user/login", ['error' => true]);
        }
    }

    function loadOutBox(){
        $clientId = session('user')[0]->userId;
        $messages = DB::select("SELECT * FROM messages WHERE clientId = $clientId ORDER BY created_at DESC");
        return view("user.outbox", ['messages' => $messages, 'clientId' => $clientId]); 
        return "We hee";
    }

    function signout(){
        session()->forget('user');
        return redirect("/user/login");
    }
}
