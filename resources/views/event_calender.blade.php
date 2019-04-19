<!DOCTYPE html>
<html lang='en'>

<head>

     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
    <link rel="stylesheet" type="text/css" href="../../../../public/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>




</head>

<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Reddit
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{url('/user/profile')}}">
                                    My Profile
                                </a>

                                <a class="dropdown-item" href="{{url('/showGroup')}}">
                                    Show All Groups
                                </a>

                                <a class="dropdown-item" href="{{url('/createGroup')}}">
                                    Create New Group
                                </a>

                                <a class="dropdown-item" href="{{url('/create/event')}}">
                                    Create An Event
                                </a>

                                <a class="dropdown-item" href="{{url('/events/calender')}}">
                                    Events Schedule
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
    </nav>


<br><br>

    <main class="py-4">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Laravel Full Calendar Tutorial</h2>
        </div>
        <div class="panel-body" >

            <div id='calendar'>


                @if($counter > 0)

                {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}

                @endif


            </div>
        </div>
    </div>
    </div>
    </main>
</div>

{{--///////////////////////////////////--}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events</div>

                    <div class="card-body">

                        @if($counter > 0)

                        @foreach($events as $data)
                            <div style="background-color: lightblue;">


                                <strong>Event Name: <a href="{{url('/event/details/'.$data->id)}}">{{$data->event_name}}</a> </strong>
                                <br>
                               Room:{{$data->room}}
                                <br>
                                Starting at : {{$data->start_date}}
                                <br>
                                Ending at : {{$data->end_date}}
                                <br><br>
                            </div>
                            <br>
                        @endforeach

                        {{ $events->links() }}

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

{{--///////////////////////////////////--}}




</body>
</html>

