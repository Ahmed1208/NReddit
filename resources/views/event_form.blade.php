@extends('layouts.app')

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Make An Event  </div>

                    <div class="card-body">


                        {!! Form::open(['url'=>'/add/event/'.app('request')->input('group_id')]) !!}
                        {!! Form::text('event_name','',['placeholder'=>'Event Name']) !!}<br><br>
                        {!! Form::textarea('description','',['placeholder'=>'Add Description','rows'=>'5','cols'=>'50'])!!}<br><br>
                        {!! Form::input('datetime-local','start_date') !!}<br><br>
                        {!! Form::input('datetime-local','end_date') !!}<br><br>
                        {!! Form::select('room',['300'=>'300','301'=>'301','302'=>'302']) !!}<br><br>
                        Creator 1: {{auth()->user()->name}}<br><br>
                        {!! Form::text('creator_2','',['placeholder'=>'Creator 2']) !!}<br><br>
                        {!! Form::text('creator_3','',['placeholder'=>'Creator 3']) !!}<br><br>
                        {!! Form::submit('Create') !!}
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
                </div>


@endsection


