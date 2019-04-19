<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
class Event extends Model
{
    //

    protected $fillable=['event_name','start_date','end_date','room','description',
                         'creator_1','creator_2','creator_3','group_id_event'];


    public function group($id){
        $data = Group::where('id',$id)->first();
        return $data;
    }

}
