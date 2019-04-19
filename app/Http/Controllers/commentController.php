<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Secondcomment;

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

        return back();

    }



}
