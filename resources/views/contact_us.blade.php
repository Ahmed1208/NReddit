@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contact Us</div>

                    <div class="card-body">
                {!! Form::open(['url'=>'/send/contactUs']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('name',old('name'),['class' => 'form-control', 'placeholder' => 'Enter your Name']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::email('email',old('email'), ['class' => 'form-control', 'placeholder' => 'Enter your Email']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('subject', 'Subject:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('subject',old('subject'), ['class' => 'form-control', 'placeholder' => 'Subject of Email']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('body', 'Message:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::textarea('body',old('body'), ['class' => 'form-control', 'placeholder' => 'Subject your Message']) !!}
                            </div>
                        </div>

                        {!! Form::submit('Send your email') !!}

                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
