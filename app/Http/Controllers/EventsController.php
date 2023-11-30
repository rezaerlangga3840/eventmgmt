<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\events;
use App\Models\bookings;
use App\Models\User;
use Carbon\carbon;

use Hash;
use Auth;
use File;

class EventsController extends Controller
{
    public function daftar(){
        if(Auth::user()->role=='user'){
            $events = events::join('users','users.id','events.created_by_user_id')->where('created_by_user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        }else{
            $events = events::orderBy('created_at','desc')->paginate(10);
        }
        return view('admin.pages.events.daftar',['events' => $events]);
    }
    public function mendatang(){
        $events = events::join('users','users.id','events.created_by_user_id')->where('date','>',now())->orderBy('created_at','desc')->paginate(10);
        return view('admin.pages.events.mendatang',['events' => $events]);
    }
    public function book($id, Request $request){
        $events=events::findOrFail($id);
        $user_id=Auth::user()->id;
        $event_id=$events->id;
        $booked_at=Carbon::now();
        if(bookings::where('user_id',Auth::user()->id)->where('event_id',$events->id)->count()==0){
            bookings::create([
                'user_id'=>$user_id,
                'event_id'=>$event_id,
                'booked_at'=>$booked_at,
            ]);
            return redirect()->route('admin.events.mendatang')->with('booked','Kursi telah dipesan');
        }else{
            return redirect()->route('admin.events.mendatang')->with('booked','Anda telah memesan kursi di event ini');
        }
        
    }
    public function save(Request $request){
        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
            'date'=>'required',
            'time'=>'required',
            'location'=>'required',
            'slots_available'=>'required',
        ]);
        $title=$request->input('title');
        $description=$request->input('description');
        $date=$request->input('date');
        $time=$request->input('time');
        $location=$request->input('location');
        $slots_available=$request->input('slots_available');
        $created_by_user_id=Auth::user()->id;
        events::create([
            'title'=>$title,
            'description'=>$description,
            'date'=>$date,
            'time'=>$time,
            'location'=>$location,
            'slots_available'=>$slots_available,
            'created_by_user_id'=>$created_by_user_id,
        ]);
        return redirect()->route('admin.events.daftar')->with('added','Event telah ditambahkan');
    }
    public function view($id){
        $events = events::findOrFail($id);
        if(Auth::user()->role=='admin'||$events->created_by_user_id==Auth::user()->id){
            $bookings=bookings::join('users','users.id','bookings.user_id')->select('bookings.*','name','email')->where('event_id',$events->id)->paginate(10);
            return view('admin.pages.events.view',['events'=>$events,'bookings'=>$bookings]);
        }else{
            return redirect()->back()->with('rejected','Akses ditolak');
        }
    }

    public function update($id, Request $request){
        $events = events::findOrFail($id);
        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
            'date'=>'required',
            'time'=>'required',
            'location'=>'required',
            'slots_available'=>'required',
        ]);
        $events->title = $request->input('title');
        $events->description = $request->input('description');
        $events->date = $request->input('date');
        $events->time = $request->input('time');
        $events->location = $request->input('location');
        $events->slots_available = $request->input('slots_available');
        $events->save();
        return redirect()->back()->with('updated','Event telah diupdate');
    }
    public function delete($id){
        $events = events::find($id);
        $events->delete();
        return redirect()->back()->with('deleted','Event telah dihapus');
    }
    public function upcomingEvents()
    {
        $upcomingEvents = events::join('users','users.id','events.created_by_user_id')->where('date', '>', now())->get();
        return response()->json($upcomingEvents);
    }
    public function getEventById($id)
    {
        $events = events::find($id);

        if (!$events) {
            return response()->json(['message' => 'Event tidak ditemukan'], 404);
        }

        return response()->json($events);
    }
}
