<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

use Validator;

class GroupsController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){ 
        $groups = Group::orderBy('name', 'asc')->Paginate(15);

        return view('groups.index', ['groups'=>$groups]);
    }

    public function create(Request $request){

         $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()) {
            return redirect('groups/')->withInput()->withErrors($validator);
    }

    	$group = new Group;
    	$group->name = $request->name;
    	$group->save();
    	return redirect('/groups'); 
    }

    public function delete(Group $group){
    	$group->delete();
    	return redirect('/groups');
    }

     public function show(Group $group){
    	return view('groups.show', ['group'=>$group]);
    }
    public function update(Request $request, Group $group){

        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()) {
            return redirect('groups/'.$group->id)->withInput()->withErrors($validator);
            }

    	$group->update(['name'=>$request->name]);
    	return redirect('/groups');
    }
}
