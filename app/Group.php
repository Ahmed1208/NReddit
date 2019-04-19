<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Question;
use App\Event;
class Group extends Model
{
    //
    protected $fillable=['groupname','description','type','image','creator_id','users_number'];


    public function comments(){
        return $this->hasMany('App\Comment','group_id_comment')->orderBy('created_at','desc');
    }

    public function questions(){
        return $this->hasMany('App\Question','group_id_question')->orderBy('created_at','desc');
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'group_id_event')->orderBy('created_at', 'desc');
    }
}
