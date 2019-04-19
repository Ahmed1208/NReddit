<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable=['answer','question_id','user_id_answer'];

    public function user($id){
        $data = User::where('id',$id)->first();
        return $data;

    }

}
