@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event Details</div>

                    <div class="card-body">


                        @foreach($details as $x)

                            Event Name:{{$x->event_name}}
                            <br><br>

                            Event By :<a href="{{url('/group/community/'.$x->group_id_event)}}">{{$x->group($x->group_id_event)->groupname}}</a>
                            <br><br>
                            Room :{{$x->room}}
                            <br><br>
                            Description : {{$x->description}}
                            <br><br>
                            Starting at : {{$x->start_date}}
                            <br>
                            Ending at : {{$x->end_date}}
                            <br><br>
                            Creator 1: {{$x->creator_1}}
                            <br>
                            Creator 2: {{$x->creator_3}}
                            <br>
                            Creator 3: {{$x->creator_3}}
                            <br>


                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
