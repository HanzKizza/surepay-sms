<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\message;

class vendorController extends Controller
{
    function refreshVendor(){
        $vendor = DB::select("select * from vendor where vendorId = ?", [session('vendor')[0]->vendorId]);
        session(['vendor'=> $vendor]);
    }

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


    function verifyVendor(Request $request){
        $email = $request->email;
        $password = $request->password;
        $vendor = DB::select("select * from vendor where email = ? and pwd = ?", [$email, $password]);
        // var_dump($user);
        if($vendor){
            session(['vendor'=> $vendor]);
            return redirect("/vendor/home");
        }else{
            return view("/vendor/login", ['error' => true]);
        }
    }



    function loadOutBox(){
        $clientId = session('user')[0]->userId;
        $messages = DB::select("SELECT * FROM messages WHERE clientId = $clientId ORDER BY created_at DESC");
        return view("user.outbox", ['messages' => $messages, 'clientId' => $clientId]); 
    }


    function signout(){
        session()->forget('user');
        return redirect("/user/login");
    }

    function vendorSignout(){
        session()->forget('vendor');
        return redirect("/vendor/login");
    }


    function autoCreditTopup(Request $request){
        $vendorId = $request->vendorId;
        $userId = $request->userId;
        $telecom = $request->telecom;
        $amount = $request->amount;
        $creditsBefore = $request->creditsBefore;
        $phoneNumber = $request->phoneNumber;
        // make call to mommo api
        return json_encode(array(true, 'transaction initiated'));
    }


    function newVendor(Request $request){
      // validate the form data
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:vendor|max:255',
        'password' => 'required|confirmed',
        'contact' => 'required'
        ]);
        

        // insert the form data into the database using the DB facade
        DB::table('vendor')->insert([
            'name' => $validatedData['name'],
            'contact' =>$validatedData['contact'],
            'email' => $validatedData['email'],
            'rate' => 40,
            'type' => "independent",
            'referorId' => 0,
            'pwd' => $validatedData['password'],
            'status' => 'active', // set default status to active
            'credits' => 0, // set default credits to 0
            'created_at' => now(),  
            'updated_at' => now(),
        ]);
        // redirect to the thank-you page
        return redirect('/vendor/login');
    }


    function getTransactions(){
        $this->refreshVendor();
        $transactions = DB::select("select * from transaction where vendorId = ?", [session('vendor')[0]->vendorId]);
        return view("/vendor/transactions", ['transactions' => $transactions]);
    }

    function getUsers(){
        $this->refreshVendor();
        $users = DB::select("select * from user where vendorId = ?", [session('vendor')[0]->vendorId]);
        return view("/vendor/users", ['users' => $users]);
    }

    function saveUser(Request $request){
        $this->refreshVendor();
        $email = $request->email;
        $contact = $request->contact;
        $username = $request->username;

        DB::insert("insert into user values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)", [session('vendor')[0]->vendorId, $username, $contact, $email, 'sure', 'active', now(), now()]);
        return redirect('/vendor/users');
    }

    function manageUser(Request $request){
        $userId = $request->userId;
        $user = DB::select("select * from user where userId = ?", [$userId]);
        $transactions = DB::select("select * from transaction where userId = ? & vendorId = ?", [$userId, session("vendor")[0]->vendorId]);
        $messages = DB::select("select * from messages where clientId = ? limit 20", [$userId]);
        return view("/vendor/manageUser", ["user"=>$user, "transactions"=>$transactions, "messages"=>$messages]);


    }
}