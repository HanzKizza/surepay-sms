<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    function populate(Request $request){
        return view($request->page);
    }

    function loadOutBox(Request $request){
        return view("outbox");
    }
}
