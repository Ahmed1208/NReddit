<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NewLessonNotification;
use App\User;
use App\Lesson;


class lessonController extends Controller
{

    public function newLesson(){

        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
        $lesson->title = 'Laravel Notification';
        $lesson->body ='this is the lesson we learn about notifications';
        $lesson->save();

        $user=User::where('id','!=',auth()->user()->id)->get();

        if(\Notification::send($user,new NewLessonNotification(Lesson::latest('id')->first())))
        {
            return back();
        }
    }
}
