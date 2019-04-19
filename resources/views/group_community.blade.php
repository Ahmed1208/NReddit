@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Details</div>

                    <div class="card-body">


                        @foreach($details as $data)

              <div style="background-color: lightblue;">

             <img class="rounded-circle" width="120" src="/uploads/groups/{{$data->image}}" style="vertical-align:middle"/>
               <br><br>
             <strong>{{$data->type}}{{$data->groupname}} </strong>
               <br><br>
               <p>
            {{$data->description}}
                  </p>

                      <br><br>
                    Users : {{$data->users_number}}<br>
                    Created at:  {{$data->created_at}}

              </div>

                        @endforeach

                            <br>

                       @foreach($details as $y)

                                @if(($y->type == '/Girls') && (auth()->user()->gender != 'Female'))
                                    <strong>Girls only </strong>
                                    <br><br>
                            @else

                        @if($joinchecker1 < 1)        {{--this to show "join" button if not Joined yet--}}
                        @foreach($details as $x)
                        <br>
                        {!! Form::open(['url'=>'/group/joinUser/'.$x->id]) !!}
                        {!! Form::submit('Join') !!}
                        {!! Form::close() !!}
                        @endforeach
                        @endif

                            @endif

                          @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>




    @foreach($details as $x)
    {!! Form::open(['url'=>'/create/event?group_id='.$x->id]) !!}
    {!! Form::submit('Make An Event') !!}
    {!! Form::close() !!}
    @endforeach


    {{--////////////////////////////////////////////////////////////////////////--}}


<br>

    @if($joinchecker1 >= 1)


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Discussion</div>

                    <div class="card-body">
                        @foreach($details as $x)  {{-- $details-->carry line of this group from groups table --}}
                        {!! Form::open(['url'=>'/add/comment/'.$x->id]) !!}
                        {!! Form::textarea('comment',old('comment'),['placeholder'=>'Say Something','cols'=>90,'rows'=>3]) !!}
                        {!! Form::submit('Add') !!}
                        {!! Form::close() !!}
                            @endforeach
                        <br>



                            @if($comment_checker == 1)


                        @foreach($comments as $x)   {{-- $comments carry lines of comments of this group from comments table --}}
                            <div>


                                {{$x->comment}}<br>
                               replied at: {{$x->created_at}}<br>
                                @foreach($comment_maker as $y)

                                replied by:    {{$y->name}}

                                    @endforeach


                                {!! Form::open(['url'=>'/add/second/comment/'.$x->id]) !!}
                                {!! Form::textarea('second_comment',old('second_comment'),['placeholder'=>'reply on comment','cols'=>60,'rows'=>1]) !!}
                                {!! Form::submit('reply') !!}
                                {!! Form::close() !!}

                                @foreach($x->second_comment as $z)   {{-- ($x->second_comment) function of hasMany to get comments belong to one comment --}}

                                    {{$z->second_comment}}<br>
                                By:{{$z->user($z->user_id_second_comment)->name}}<br>
                                <br><br>
                                    @endforeach

                            </div>
                            <br><br><br>

                            @endforeach


                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    {{--////////////////////////////////////////////////////////////////////////--}}

<br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Requests</div>

                    <div class="card-body">

                        @if($joinchecker1 < 1)

                        @foreach($details as $x)  {{-- $details-->carry line of this group from groups table --}}
                        {!! Form::open(['url'=>'/add/question/'.$x->id]) !!}
                        {!! Form::textarea('question',old('question'),['placeholder'=>'Have A Question?','cols'=>80,'rows'=>1]) !!}
                        {!! Form::submit('Add') !!}
                        {!! Form::close() !!}
                        @endforeach

                        @endif

                        <br>


                        @if($question_checker == 1)
                            @foreach($question as $x)
                           Question: {{$x->question}}   <br>
                           Time:{{$x->created_at}}<br>
                           user: {{$x->user($x->user_id_question)->name}}<br>

                                    @if($joinchecker1 >= 1)

                                    {!! Form::open(['url'=>'/add/question/answer/'.$x->id]) !!}
                                    {!! Form::textarea('answer',old('answer'),['placeholder'=>'Answer request','cols'=>60,'rows'=>1]) !!}
                                    {!! Form::submit('answer') !!}
                                    {!! Form::close() !!}

                                    @endif

                                    <br><br>
                                    @foreach($x->answers as $z)   {{-- ($x->answer) function of hasMany to get answers belong to one question --}}

                                    {{$z->answer}}<br>
                                    By:{{$z->user($z->user_id_answer)->name}}<br>

                                    @endforeach


                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



    <br><br>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events</div>

                    <div class="card-body">

                        @if($event_checker > 1)

                        @foreach($event as $x)
                            <div>
        <p>
                        <strong>Event Name: <a href="{{url('/event/details/'.$x->id)}}">{{$x->event_name}}</a> </strong>
            <br><br>
                                 Room:{{$x->room}}
            <br>
            Starting at : {{$x->start_date}}
            <br>
            Ending at : {{$x->end_date}}
            <br>
                                 Creator 1: {{$x->creator_1}}
            <br>
                                 Creator 2: {{$x->creator_3}}
            <br>
                                Creator 3: {{$x->creator_3}}
            <br>
        </p>
                            </div>
                            @endforeach

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection


