<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailSender extends Controller
{
    //


    public function sendEmailTest(){
        $details = [

            'title' => 'Mail from fitEnergym.es',
    
            'body' => 'This is for testing email using smtp'
    
        ];
    
       
    
        \Mail::to('huelvana1994@gmail.com')->send(new \App\Mail\MyTestMail($details));
    
    
        dd("Email is Sent.");
    }

}
