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
            $events = events::where('created_by_user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        }else{
            $events = events::orderBy('created_at','desc')->get();
        }
        return view('admin.pages.events.daftar',['events' => $events]);
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
}