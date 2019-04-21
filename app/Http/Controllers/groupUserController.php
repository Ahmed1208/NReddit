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
                            'user_id'=>$user,
                            'type'=>'join'
                                ]);


        $counter=Groupuser::where('group_id',$id)->where('type','join')->count();
        $update=Group::where('id',$id)->first();
        $update->users_number = $counter;
        $update->save();


            return redirect('/group/community/'.$id);
    }


    public function group_followUser($id){

        $user = auth()->user()->id;
        Groupuser::create([
            'group_id'=>$id,
            'user_id'=>$user,
            'type'=>'follow'
        ]);


        $counter=Groupuser::where('group_id',$id)->where('type','follow')->count();
        $update=Group::where('id',$id)->first();
        $update->followers_number = $counter;
        $update->save();


        return redirect('/group/community/'.$id);
    }


    public function switchToMember($id){

        $data =Groupuser::where('id',$id)->first();
        $data->type='join';
        $data->save();


        $data2=Group::where('id',$data->group_id)->first();
        $data2->followers_number = $data2->followers_number-1;
        $data2->users_number = $data2->users_number +1;
        $data2->save();



        return back();
    }


    public function unFollow($id = null)
    {
            $data = Groupuser::find($id);
            $data->delete();

        $counter1=Groupuser::where('group_id',$data->group_id)->where('type','follow')->count();
        $counter2=Groupuser::where('group_id',$data->group_id)->where('type','join')->count();
        $data2=Group::where('id',$data->group_id)->first();
        $data2->followers_number = $counter1;
        $data2->users_number = $counter2;
        $data2->save();

        return back();
    }



}
