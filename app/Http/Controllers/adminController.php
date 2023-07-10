<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function admin(Request $request){

       // $request->user()->authorizeRoles(['admin']);
        
        return view('admin.home');
    }
}
