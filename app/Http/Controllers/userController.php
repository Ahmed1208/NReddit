<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Auth;
use Image;

class userController extends Controller
{
    //

    public function show_mygroups(){

        $data_of_user = auth()->user();

        $number_of_groups = $data_of_user->mygroups->where('type','join')->pluck('group_id') ; // first we got lines from groupusers by function 'mygroups'
                                                                         // as one user hasMany lines in groupusers.
                                                                         //then we got specific column 'group_id

        $data_of_groups=Group::whereIn('id',$number_of_groups)->orderby('created_at','desc')->paginate(4);  //selected lines from groups table (array)


        $number_of_groups_following = $data_of_user->mygroups->where('type','follow')->pluck('group_id') ; // first we got lines from groupusers by function 'mygroups'
        // as one user hasMany lines in groupusers.
        //then we got specific column 'group_id

        $data_of_groups_following=Group::whereIn('id',$number_of_groups_following)->orderby('created_at','desc')->paginate(4);  //selected lines from groups ta


        $x=['group'=>$data_of_groups,'group_following'=>$data_of_groups_following];

        return view('user_page',$x);
    }




    public function edit_profile_image(){

        request()->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $user = Auth::user();

        $Image_Name = $user->id.time().'.'.request()->profile_image->getClientOriginalExtension();

        $image=request()->file('profile_image');

        Image::make($image)->resize(400,400)->save( public_path('/uploads/profiles/' . $Image_Name) );

        $user->profile_image = $Image_Name;

        $user->save();

        return redirect('/user/profile');

    }

}
