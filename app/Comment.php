<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Secondcomment;

class Comment extends Model
{
    //
    protected $fillable=['comment','group_id_comment','user_id_comment'];


    public function second_comment(){
        return $this->hasMany('App\Secondcomment','comment_id')->orderBy('created_at','desc');
    }


}
