<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class questionController extends Controller
{
    //
    public function add_question($id){

        $data=$this->validate(request(),[
            'question'=>'required'
        ]);

        $data['group_id_question']=$id;
        $data['user_id_question']=auth()->user()->id;

        Question::create($data);
        return redirect('/group/community/'.$id);
    }


    public function add_answer($id){

        $data=$this->validate(request(),[
            'answer'=>'required'
        ]);

        $data['question_id']=$id;
        $data['user_id_answer']=auth()->user()->id;

        Answer::create($data);

        return back();

    }


}
