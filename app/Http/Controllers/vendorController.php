<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vendorController extends Controller
{
    function verifyUser(Request $request){
        return "We are here";
    }

    function newVendor(Request $request){
        //Extract data
        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        $password =$request->password;

         // validate the form data
         $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:vendors|max:255',
            'password' => 'required|confirmed',
        ]);

         // create a new Vendor object with the validated data
         $vendor = new Vendor;
        $vendor->name = $validatedData['name'];
        $vendor->email = $validatedData['email'];   
        $vendor->password = bcrypt($validatedData['password']); // hash the password
    
      
       
        
        return $name;
    }
}
