<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contactus;

class contactusController extends Controller
{
    //

    public function send_contactUs(){

        $this->validate(request(),
            [
                'name'=>'required',
                'email'=>'required|email',
                'subject'=>'required',
                'body'=>'required'

            ]);


        $name=request('name');
        $email=request('email');
        $subject=request('subject');
        $body=request('body');

        Mail::to('ahmedhoss14@yahoo.com')
              ->send(new Contactus($name,$email,$subject,$body));



        return back();

    }
}
