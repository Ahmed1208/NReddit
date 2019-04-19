@extends('layouts.app')

@section('content')


    {{--///////////////////////////////////////////////////////--}}


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                    Name: {{auth()->user()->name}}
                        <br>
                    Email: {{auth()->user()->email}}
                        <br>
                        <img class="rounded-circle" src="/uploads/profiles/{{ auth()->user()->profile_image }}" />

                        <br>


                        <form action="/user/profile/image" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="profile_image" id="avatarFile" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    {{--//////////////////////////////////////////////////////--}}




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Groups</div>

                    <div class="card-body">


                            @foreach($group as $data)
                                <div style="background-color: lightblue;">
                                    <img class="rounded-circle" width="120" src="/uploads/groups/{{$data->image}}" style="vertical-align:middle"/>
                                    <br>
                                    <strong>Group Name: <a href="{{url('/group/community/'.$data->id)}}">{{$data->type}}{{$data->groupname}}</a> </strong>
                                    <br>
                                    Users: {{$data->users_number}}
                                </div>
                                <br>
                            @endforeach
                        {{$group->links()}}

                    </div>
                </div>
            </div>


        </div>
                </div>





@endsection




