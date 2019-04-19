<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupuser;
use App\Group;

class groupUserController extends Controller
{
    //

    public function group_joinUser($id){
            $user = auth()->user()->id;
                Groupuser::create([
                            'group_id'=>$id,
                            'user_id'=>$user
                                ]);


        $counter=Groupuser::where('group_id',$id)->count();
        $update=Group::where('id',$id)->first();
        $update->users_number = $counter;
        $update->save();


            return redirect('/group/community/'.$id);
        //return view('group_community');
    }


}
