<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\User;
class Question extends Model
{
    //
    protected $fillable=['question','group_id_question','user_id_question'];

    public function user($id){
        $data = User::where('id',$id)->first();
        return $data;

    }

    public function answers(){
        return $this->hasMany('App\Answer','question_id')->orderBy('created_at','desc');
    }

}
