@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Group</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
{{--

                        <form method="post" action="{{url('/make/group')}}" enctype="multipart/form-data">

                           <input type="hidden" name="_token"   value="{{csrf_token()}}">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">/</span>
                                </div>
                                <input type="text" name="groupname" value="{{old('groupname')}}" class="form-control" placeholder="Group Name" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                           <textarea name="description" rows="5" cols="50" placeholder="Add Description"></textarea>
                           <br><br>
                           <select name="type">
                               <option value="mixed">/Mixed</option>
                               <option value="guys">/Guys</option>
                               <option value="girls">/Girls</option>
                           </select>
                           <br><br>
                           <input type="file" name="image" placeholder="Image">
                           <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                           <br><br>
                           <input type="submit" value="Make A Group">

                       </form>
                            <br><br><br><br>
                            <a href="{{url('/home')}}"><<<<<<<-----Back</a>
--}}

                        {!!  Form::open(['url'=>'/make/group','files'=>'true'])!!}
                        {!!Form::text('groupname',old('groupname'),['placeholder'=>'Group Name'])!!}
                            <br><br>
                        {!!Form::textarea('description',old('description'),['placeholder'=>'Add Description','rows'=>'5','cols'=>'50'])!!}
                            <br><br>

                         @if(auth()->user()->gender == 'Male')

                        {!!Form::select('type',[
                            '/Mixed'=>'Mixed',
                            '/Guys'=>'Guys'])!!}
                            <br><br>

                            @endif


                            @if(auth()->user()->gender == 'Female')

                                {!!Form::select('type',[
                                    '/Mixed'=>'Mixed',
                                    '/Girls'=>'Girls'])!!}
                                <br><br>

                            @endif




                        {!! Form::file('image')!!}
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>

                            <br><br>
                        {!! Form::submit('submit')!!}
                        {!! Form::close() !!}
                            <a href="{{url('/home')}}"><<<<<<<-----Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
