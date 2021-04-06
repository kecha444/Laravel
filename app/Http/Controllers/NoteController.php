<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Status;
use Validator;

class NoteController extends Controller
{
     public function index(){ $notes = Note::all();
    	
        return view('notes.index', ['notes'=>$notes]);
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()) {
            return redirect('note/')->withInput()->withErrors($validator);
        }

    	$note = new Note;
    	$note->name = $request->name;
        $note->status_id = 11;
    	$note->save();
    	return redirect('/note'); 
    }

    public function delete(Note $note){
    	$note->delete();
    	return redirect('/note');
    }
    
    public function show(Request $request, Note $note) {

        $statuses = Status::all();
        return view('notes.show', ['note'=>$note, 'statuses'=>$statuses]);
    }

    public function update(Request $request, Note $note){

        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()) {
            return redirect('note/'.$note->id)->withInput()->withErrors($validator);
            }

    	$note->update(['name'=>$request->name, 'status_id' => $request->status]);
    	
        return redirect('/note');
    }
}
