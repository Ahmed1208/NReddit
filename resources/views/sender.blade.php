
{{Form::open(['url'=>'/send'])}}
{{Form::text('text',old('text'),['placeholder'=>'enter text'])}}
{{Form::submit('send')}}
{{Form::close()}}
