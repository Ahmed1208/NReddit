<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class notificationController extends Controller
{
    //

        public function readmark($id,$x){


            auth()->user()->unreadNotifications()->find($id)->markAsRead();

            return redirect('/group/community/'.$x);

        }
}
