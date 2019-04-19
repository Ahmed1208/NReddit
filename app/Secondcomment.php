<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Secondcomment extends Model
{
    //
    protected $fillable=['second_comment','comment_id','user_id_second_comment'];


    public function user($id){
        $data = User::where('id',$id)->first();
        return $data;

    }

}
