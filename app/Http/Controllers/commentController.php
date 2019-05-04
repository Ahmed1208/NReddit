<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
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

        if(auth()->user()->id != User::find($comment->user_id_comment)->id)
        {
            User::find($comment->user_id_comment)->notify(new NotifyCommentOwner($secondComment));
        }

//        event(new Noti($secondComment));   //////this command relates to 'app->Events->Noti.php' , Not used yet


        return back();

    }


    public function commentShow($id){

        $data= Comment::where('id',$id)->get();
        $x=['comment'=>$data];

        return view('comment_post',$x);
    }



    public function second_comment_vue($id){

        $data=$this->validate(request(),[
            'second_comment'=>'required'
        ]);

        $data['comment_id']=$id;
        $data['user_id_second_comment']=auth()->user()->id;

        SecondComment::create($data);

        $secondComment=SecondComment::all()->last();
        $comment = Comment::find($id);

        if(auth()->user()->id != User::find($comment->user_id_comment)->id)
        {
            User::find($comment->user_id_comment)->notify(new NotifyCommentOwner($secondComment));
        }

        broadcast(new NewComment($secondComment));
    }

    public function show_comments_vue($id){
        $get_comments=Secondcomment::where('comment_id',$id)->orderBy('created_at','desc')->get();
        $comments=[];
        foreach ($get_comments as $comment){
           //$comments[] =$comment->user($comment->user_id_second_comment).$comment;
            $data = User::where('id',$comment->user_id_second_comment)->select('name')->first();
            $comments[] = array_merge($comment->toArray(), $data->toArray());


        }

        return $comments;

    }


}
