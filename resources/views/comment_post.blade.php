@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comment</div>
                    <div class="card-body">

                    @foreach($comment as $x)
                        {{$x->comment}}<br>
                        replied at: {{$x->created_at}}<br>


                        @foreach($x->userComment($x->user_id_comment) as $zz)
                            replied by:  {{$zz->name}}
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

                    @endforeach

                    </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
