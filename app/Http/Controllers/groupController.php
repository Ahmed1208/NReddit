<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Image;
use App\Groupuser;
use App\User;

class groupController extends Controller
{
    //
        public function make_group(){

            $data1 = $this->validate(request(),[
                'groupname'=>'required',
                'type'=>'required',
                'description'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);


            $count=Group::all()->count();
            if($count > 0) {
                $latest = Group::all()->last()->id;    //make it comment for first time only to make a group
                $bvb = $latest + 1;                      //make it comment for first time only to make a group
            }else {
                $bvb=1;        // write this first time only to make a group then make it comment
            }
            $ext = request()->file('image')->getClientOriginalExtension();
            $photoname =$bvb.'_'. time() . '.' . $ext;

            $image=  request()->file('image');
            Image::make($image)->resize(300, 300)->save( public_path('/uploads/groups/' . $photoname ) );

            $data1['image']=$photoname;
            $data1['creator_id']=auth()->user()->id;
            $data1['groupname']='/'.request('groupname');

            $data1['users_number']=0;

            Group::create($data1);

            return redirect ('group/joinUser/'.$bvb);
         //   return redirect ('home');
        }


        public function showGroups(){

            $data=Group::orderby('created_at','desc')->paginate(2);

            $x=['group'=>$data];

            return view('group_show',$x);
        }


        public function group_community($id){

            $data = Group::where('id',$id)->get();

            $join_button_checker1 =Groupuser::where('user_id',auth()->user()->id)->where('group_id',$id)->count();
            //this line check if user have joined the group before or no by counting


            $comment1=Group::where('id',$id)->first();


                $comment2 = $comment1->comments;


            if( count($comment2) > 0 ) {
                $comment_checker=1;
                $comment3 = $comment1->comments->pluck('user_id_comment');
                $comment_maker = User::where('id', $comment3)->get();
            }
            else{
                $comment_checker=0;
                $comment_maker=[];
                }

                $question1=$comment1->questions;

            if( count($question1) > 0 ) {
                $question_checker=1;
            }
            else{
                $question_checker=0;
            }

            $event1=$comment1->events;
            $event_checker=$comment1->events->count();

            $x=['details'=>$data,'joinchecker1'=>$join_button_checker1,'comments'=>$comment2,'comment_maker'=>$comment_maker,'comment_checker'=>$comment_checker,
                'question_checker'=>$question_checker,'question'=>$question1,'event'=>$event1,'event_checker'=>$event_checker];


            return view ('group_community', $x);

        }
}
