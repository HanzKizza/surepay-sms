<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class adminController extends Controller
{
    function verifyAdmin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $admin = DB::select("select * from  admin where email = ? and pwd = ?", [$email, $password]);
        if($admin){
            session(['admin'=> $admin]);
            if(strcasecmp("maker", $admin[0]->role) == 0){
                return redirect("/admin/vendors");
            }
            else if(strcasecmp("checker", $admin[0]->role) == 0){
                return redirect("/admin/vendors");
            }
            return redirect("/admin/home");
        }else{
            return view("/admin/login", ['error' => true]);
        }
    }



    function home(){
        $admin = session("admin");
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return redirect("/admin/maker/home");
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return redirect("/admin/checker/home");
        }
        return redirect("/admin/home");
    }



    function signout(){
        session()->forget('user');
        return redirect("/admin/login");
    }



    function getVendors(){
        $admin = session("admin");
        $vendors = DB::select("SELECT * FROM  vendor where status = 'active' ");
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return view("admin.maker.vendors", ['vendors' => $vendors]);
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return view("admin.checker.vendors", ['vendors' => $vendors]);
        }
        return view("admin.vendors", ['vendors' => $vendors]);
    }



    function initiateVendorTopUp(Request $request){
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
            DB::insert("insert into transaction values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$vendorId, '0', $transRef, $transType, $amount, '', '', $details, 'pending', now(), now()]);
            //DB::update("update vendor set credits = ?, updated_at = ? where vendorId = ?", [$creditsAfter, now(), $vendorId]);
            return "Suceess";
        }
        catch(Exception $e){
            return "There was an error updating, ".$e->getMessage();
        }
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


    function getTransactions(){
        $admin = session("admin");
        // $transactions = new Paginator(transaction::all(), 10);
        $transactions = $transactions = transaction::orderByDesc('created_at')->paginate(10);
        // echo $admin[0]->role;
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return view("/admin/maker/transactions", ['transactions' => $transactions]);
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return view("/admin/checker/transactions", ['transactions' => $transactions]);
        }
        return view("/admin/maker/transactions", ['transactions' => $transactions]);
    }



    function getPendingTransactions(){
        $admin = session("admin");
        $transactions = DB::select("select * from transaction where status = ? ORDER BY created_at DESC", ["pending"]);
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return view("/admin/maker/transactions", ['transactions' => $transactions]);
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return view("/admin/checker/pendingTransactions", ['transactions' => $transactions]);
        }
        return view("/admin/maker/transactions", ['transactions' => $transactions]);
    }



    function getSuccessfullTransactions(){
        $admin = session("admin");
        $transactions = DB::select("select * from transaction where status = ? ORDER BY created_at DESC", ["success"]);
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return view("/admin/maker/transactions", ['transactions' => $transactions]);
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return view("/admin/checker/transactions", ['transactions' => $transactions]);
        }
        return view("/admin/maker/transactions", ['transactions' => $transactions]);
    }



    function getRejectedTransactions(){
        $admin = session("admin");
        $transactions = DB::select("select * from transaction where status = ? ORDER BY created_at DESC", ["rejected"]);
        if(strcasecmp("maker", $admin[0]->role) == 0){
            return view("/admin/maker/transactions", ['transactions' => $transactions]);
        }
        else if(strcasecmp("checker", $admin[0]->role) == 0){
            return view("/admin/checker/rejectedTransactions", ['transactions' => $transactions]);
        }
        return view("/admin/maker/transactions", ['transactions' => $transactions]);
    }



    function approveTransaction(Request $request){
        try{
            $transactionId = $request->transactionId;
            $transaction = DB::select("select * from transaction where transaction_id = ?", [$transactionId]);
            $vendorId = $transaction[0]->vendorId;
            $vendor = DB::select("select * from vendor where vendorId = ?", [$vendorId]);
            $credits = $vendor[0]->credits;
            $rate = $vendor[0]->rate;
            $amount = $transaction[0]->amount;
            $creditsToAdd = ceil(intval($amount) / intval($rate));
            $creditsAfter = intval($credits) + intval($creditsToAdd);
            DB::update("update vendor set credits = ?, updated_at = ? where vendorId = ?", [$creditsAfter, now(), $vendorId]);
            DB::update("update transaction set status = ?, creditsBefore = ?, creditsAfter = ? where transaction_id =?", ["approved", $credits, $creditsAfter, $transactionId]);
            echo "Transaction approved successfully";
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }



    function rejectTransaction(Request $request){
        try{
            $transactionId = $request->transactionId;

            DB::update("update transaction set status ='rejected' where transaction_id =?", [$transactionId]);
            echo "Transaction rejected successfully";
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
