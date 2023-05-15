<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    function verifyAdmin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $admin = DB::select("select * from  admin where email = ? and pwd = ?", [$email, $password]);
        if($admin){
            session(['admin'=> $admin]);
            return redirect("/admin/home");
        }else{
            return view("/admin/login", ['error' => true]);
        }
    }

    function signout(){
        session()->forget('user');
        return redirect("/admin/login");
    }



    function getVendors(){
        $vendors = DB::select("SELECT * FROM  vendor where status = 'active' ");
        return view("admin.vendors", ['vendors' => $vendors]); 
    }


    function vendorCreditTopup(Request $request){
        $vendorId = $request->vendorId;
        $vendorName = $request->vendorName;
        $transRef = $request->transRef;
        $transType = $request->transType;
        $creditsBefore = $request->creditsBefore;
        $details = $request->details;
        $rate = $request->rate;
        $amount = $request->amount;
        $creditsAfter = $creditsBefore;
        try{
            $creditsAfter = ceil(intval($amount) / intval($rate));
            $creditsAfter += intval($creditsBefore);
            $creditsAfter = strval($creditsAfter);
            $admin = DB::insert("insert into transaction values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$vendorId, '0', $transRef, $transType, $amount, $creditsBefore, $creditsAfter, $details, 'success', now(), now()]);
            DB::update("update vendor set credits = ?, updated_at = ? where vendorId = ?", [$creditsAfter, now(), $vendorId]);
            return "Suceess";
        }
        catch(Exception $e){
            return "There was an error updating, ".$e->getMessage();
        }
    }

    function vendorEdit(Request $request){
        $vendorId = $request->vendorId;
        $vendorName = $request->vendorName;
        $rate = $request->rate;
        $email = $request->email;
        try{
            $affected = DB::table('vendor')->where('vendorId', $vendorId)->update(['rate' => $rate]);
        }
        catch(Exception $e){
            return "There was an error updating, ".$e->getMessage();
        }
    }
}
