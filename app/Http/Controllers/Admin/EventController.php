<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class EventController extends BaseController
{
    public function index(){
        $events = Event::get();
        $this->setPageTitle('events', 'events');
        return view('admin.events.index', compact('events'));
    }
    public function create(){
        $this->setPageTitle('events ', 'Create event');
        return view('admin.events.create');
    }

    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required|not_in:0',
            'time'      =>  'required',
            'date'      =>  'required',
            'location'      =>  'required',
            'fee'      =>  'required',
            'total_slots'      =>  'required',
        ]);


        $collection = $request->except('_token');

        try {
            $event = new Event($collection);
            $event->save();

            return $this->responseRedirect('admin.events.index', 'event added successfully' ,'success',false, false);

        } catch (QueryException $exception) {
            dd($exception);
            return $this->responseRedirectBack('Error occurred while creating event.', 'error', true, true);
        }

    }
    public function edit($id){
        try {
            $targetevent = Event::find($id);
            $this->setPageTitle('event', 'Edit event ');
            return view('admin.events.edit', compact('targetevent'));

        } catch (ModelNotFoundException $e) {

            return $this->responseRedirectBack('Error.', '', true, true);
        }
    }



    public function update(Request $request){

        $this->validate($request, [
            'title'      =>  'required',
            'details' =>  'required|not_in:0',
            'time'      =>  'required',
            'date'      =>  'required',
            'location'      =>  'required',
            'fee'      =>  'required',
            'total_slots'      =>  'required',
        ]);

        $collection = $request->except('_token');

        try {


            $event = Event::find($request->id);

            $event['title'] = $collection['title'];
            $event['location'] = $collection['location'];
            $event['fee'] = $collection['fee'];
            $event['time'] = $collection['time'];
            $event['date'] = $collection['date'];
            $event['details'] = $collection['details'];
            $event['total_slots'] = $collection['total_slots'];
            $event->save();



            return $this->responseRedirectBack('Update sucessfully.', 'sucess', false, false);

        } catch (QueryException $exception) {
            return $this->responseRedirectBack('Error occurred while updating event.', 'error', true, true);
        }

        // if (!$event) {
        //     return $this->responseRedirectBack('Error occurred while creating event.', 'error', true, true);
        // }



    }



    public function disable($id){
        try{
        $event = Event::find($id);
        if($event['status']=='1'){
            $event['status']='0';
        }
        else{
            $event['status']='1';
        }

        $event->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status event.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $event = Event::find($id);

            $event->delete();
            return "success";

    } catch (QueryException $exception) {
        return "error";
    }

    }
}
