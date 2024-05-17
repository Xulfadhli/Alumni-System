<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\File; // to handle files and directories
//use Image; // for image manipulation 
use Faker\Provider\Image;
 //use Intervention\Image\Facades\Image; // Make sure this is correctly imported

class EventController extends Controller
{

public function getEventList(){
    $events = Event::all(); 
    return view('admin.event-list', compact('events')); 
}

public function getEventForm(){
    return view('admin.event-form');
}

//<--new code-->
public function postAddEvent(Request $request){

    $userId = auth()->user()->id;
    $events = new Event();
    
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'trainer' => 'required|string|max:255',
        'photo' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        'price' => 'required|numeric|min:0',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'place' => 'required|string|max:255',
        'capacity' => 'required|integer|min:0',
        'duration' => 'required|integer|min:0',
        'status' => 'required|string|max:255',
    ]);

    //save photo
    if($request->hasFile('photo')){
        $image = $request->file('photo');
        $filename = 'event_'.$userId.'_'.time().'.'.$image->getClientOriginalExtension();

        // Ensure the directory exists
        $path = public_path('images/events');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($image)->resize(300,300)->save($path.'/'.$filename);
        $events->photo = $filename;

    }

    $events->name = $request['name'];
    $events->description = $request['description'];
    $events->trainer = $request['trainer'];
    $events->price = $request['price'];
    $events->date = $request['date'];
    $events->time = $request['time'];
    $events->place = $request['place'];
    $events->capacity = $request['capacity'];
    $events->duration = $request['duration'];
    $events->status = $request['status'];
    $events->save();

    Session()->flash('message', 'Event successfully added');
    
    return redirect()->route('admin.event-list');

} 


public function getEditEventForm(string $id){

    $event = Event::find($id); // equivalent to select * from trainings where id = ?
    return view('admin.edit-event-form',compact('event'));

}

public function putEditEvent(Request $request, string $id) {

    $userId = auth()->user()->id;
    $event = Event::find($id);
    
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'trainer' => 'required|string|max:255',
        'photo' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        'price' => 'required|numeric|min:0',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'place' => 'required|string|max:255',
        'capacity' => 'required|integer|min:0',
        'duration' => 'required|integer|min:0',
        'status' => 'required|string|max:255',
    ]);

    //save photo
    if($request->hasFile('photo')){
        $image = $request->file('photo');
        $filename = 'event_'.$userId.'_'.time().'.'.$image->getClientOriginalExtension();

        // Ensure the directory exists
        $path = public_path('images/events');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($image)->resize(300,300)->save($path.'/'.$filename);
        $event ->photo = $filename;

    }

    $event->name = $request['name'];
    $event->description = $request['description'];
    $event->trainer = $request['trainer'];
    $event->price = $request['price'];
    $event->date = $request['date'];
    $event->time = $request['time'];
    $event->place = $request['place'];
    $event->capacity = $request['capacity'];
    $event->duration = $request['duration'];
    $event->status = $request['status'];
    $event->save();

    Session()->flash('message', 'Event has been successfully updated');
    
    return redirect()->route('admin.event-list');

}

public function deleteEvent(string $id) {

    $event = Event::find($id);
    $event->delete();
    Session()->flash('message', 'Event has been successfully deleted');
    return redirect()->route('admin.event-list');

} 

}


