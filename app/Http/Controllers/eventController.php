<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Event;


class eventController extends Controller
{
    //

    public function index(){

        $events = [];
        $data = Event::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(

                    $value->event_name.','.' Room number:'.$value->room,
                    false,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date),
                   null,
                    // Add color and link on event
                   [
                       // 'color' => '#f05050',
                        'url' => '/event/details/'.$value->id,
                         //$value->room,
                    ]
                );
            }
        }

        $calendar = Calendar::addEvents($events);

        $data=Event::orderby('created_at','desc')->paginate(2);

        $counter=Event::all()->count();

        $x=['calendar'=>$calendar,'events'=>$data,'counter'=>$counter];

        return view('event_calender', $x);

    }




    public function add_event($id =null){

        $data= $this->validate(request(),[
            'event_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'room'=>'required',
            'description'=>'required',
            'creator_2'=>'required',
            'creator_3'=>'required',
        ]);

        $data['creator_1']=auth()->user()->name;
        $data['group_id_event']=$id;


        Event::create($data);

        return redirect('/events/calender');

    }



    public function event_details($id)
    {

        $data = Event::where('id',$id)->get();
        $x=['details'=>$data];


        return view ('event_details', $x);

    }

}
