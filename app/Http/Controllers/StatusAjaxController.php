<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

use Validator;

class StatusAjaxController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	return view('statusajax.index');
    }

    public function statuses_list(Request $request){
    	$status_from_controller = $request->user()->status()->orderBy('created_at', 'desc')->get();

    	return $statuses_from_controller;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 201);
    }

    $status = $request->user()->statuses()->create(['name'=> $request->name, 'status_id' => 1]);
    		return $status;
	}

	public function delete(Status $status){
        $status->delete();

        return response()->json(['message' => 'Запись удалена'], 200);
    }
}
















