<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Events\NewPost;
use App\Group;
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



    public function add_second_comment_vue($id){

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
        $get_comments=Secondcomment::where('comment_id',$id)->orderBy('created_at','asc')->get();
        $comments=[];
        foreach ($get_comments as $comment){
           //$comments[] =$comment->user($comment->user_id_second_comment).$comment;
            $data = User::where('id',$comment->user_id_second_comment)->select('name')->first();
            $comments[] = array_merge($comment->toArray(), $data->toArray());


        }

        return $comments;

    }


    public function discussion_show_vue($id){

        $data1=Group::where('id',$id)->first()->comments;

        $posts=[];                             //we are not returning any value from posts[], but
        foreach($data1 as $comment){           //they are responsible for getting array of second_comments in each row of a comment
          $posts[]=$comment->second_comment;   //without doing anything else,they are sent automatically
        }                                      //no reason know yet

        return $data1;

    }

    public function add_comment_vue($id){

        $data=$this->validate(request(),[
            'comment'=>'required'
        ]);

        $data['group_id_comment']=$id;
        $data['user_id_comment']=auth()->user()->id;

        Comment::create($data);

        $comment=Comment::all()->last();

        broadcast(new NewPost($comment));

    }

}
