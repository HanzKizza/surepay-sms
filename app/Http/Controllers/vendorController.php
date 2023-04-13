<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    function verifyUser(Request $request){
        $email = $request->email;
        $password = $request->password;
        $user = DB::select("select * from user  left join vendor on(user.vendorId = vendor.vendorId) where user.email = ? and user.pwd = ?", [$email, $password]);
        var_dump($user);
        if($user){
            session(['user'=> $user]);
            return redirect("/user/home");
        }else{
            return view("/user/login", ['error' => true]);
        }
        // return "We are here ".$email;
    }
}
