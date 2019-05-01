<?php

namespace App\Http\Controllers;

use App\Notifications\NotifyCommentOwner;
use App\User;
use Illuminate\Http\Request;
use App\Comment;
use App\Secondcomment;
use App\Notification;
use App\Events\Noti;

class commentController extends Controller
{
    //

    public function add_comment($id){

        $data=$this->validate(request(),[
            'comment'=>'required'
        ]);

        $data['group_id_comment']=$id;
        $data['user_id_comment']=auth()->user()->id;

        Comment::create($data);
        return redirect('/group/community/'.$id);
    }


    public function add_second_comment($id){

        $data=$this->validate(request(),[
            'second_comment'=>'required'
        ]);

        $data['comment_id']=$id;
        $data['user_id_second_comment']=auth()->user()->id;

        SecondComment::create($data);

        $secondComment=SecondComment::all()->last();
        $comment = Comment::find($id);
        User::find($comment->user_id_comment)->notify(new NotifyCommentOwner($secondComment));

//        event(new Noti($secondComment));   //////this command relates to 'app->Events->Noti.php' , Not used yet


        return back();

    }


    public function commentShow($id){

        $data= Comment::where('id',$id)->get();
        $x=['comment'=>$data];

        return view('comment_post',$x);
    }

}
