@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Groups</div>

                    <div class="card-body">


                        @foreach($group as $data)
                            <div style="background-color: lightblue;">

                                    <img class="rounded-circle" width="120" src="/uploads/groups/{{$data->image}}" style="vertical-align:middle"/>
                                    <br>
                                    <strong>Group Name: <a href="{{url('/group/community/'.$data->id)}}">{{$data->type}}{{$data->groupname}}</a> </strong>
                                    <br>

                                <p>
                                    {{$data->description}}
                                </p>
                                   Users: {{$data->users_number}}
                            </div>
                            <br>
                        @endforeach

                            {{ $group->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
