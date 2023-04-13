<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // import the DB facade

class vendorController extends Controller
{
    function verifyUser(Request $request){
        return "We are here";
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
        'pwd' => bcrypt($validatedData['password']),
        'status' => 'active', // set default status to active
        'credits' => 0, // set default credits to 0
        'created_at' => now(),  
        'updated_at' => now(),
    ]);

    // redirect to the thank-you page
    return redirect('/thank-you');
    }
}