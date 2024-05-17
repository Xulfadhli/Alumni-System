<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\File;

class EventRegisterController extends Controller
{
    //
    public function getEventList(){

        $events = Event::all();
        return view('user.event-list', compact('events'));

    }

    public function getRegistrationForm(string $id){

        $event = Event::find($id);
        return view('user.registration-form', compact('event'));

    }

    public function postRegisterEvent(Request $request){

        $eventRegistration = new EventRegistration();
        $user = auth()->user();
        $userId = auth()->user()->id;
        $this->validate($request, [
            'event_id' => 'required|exists:events,id',
            'proofofpayment' => 'required|mimes:jpeg,jpg,png,pdf|max:10000',

        ]);

        $eventRegistration->user_id = $user->id;
        $eventRegistration->event_id = $request['event_id'];

        if($request->hasFile('proofofpayment')){
          
            $proof_name = $request->file('proofofpayment');
            $filename = 'proof_'.$userId.'_'.time().'.'.$proof_name->getClientOriginalExtension();

            // Ensure the directory exists
            $path = public_path('uploads/proof');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            $file = $request['proofofpayment'];
            $file->move($path, $filename);
            $eventRegistration->proofofpayment = $filename;
        }

        

        $eventRegistration->save();

        Session()->flash('message', 'Your registration is successfully submitted');

        return redirect()->route('user.event-list');

    }

    public function getRegisteredEvent(){

        $user = auth()->user(); // Retrieve the authenticated user
        // SELECT * FROM training_registrations WHERE user_id = ?
        $eventRegistrations = EventRegistration::where('user_id', $user->id)->get();
        // Pass the trainings to the dashboard view
        return view('user.user-dashboard', compact('eventRegistrations')); 

    }
}
