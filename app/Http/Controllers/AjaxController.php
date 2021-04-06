<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

use Validator;
class AjaxController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	return view('ajax.index');
    }

    public function tasks_list(Request $request){
    	$tasks_from_controller = $request->user()->tasks()->orderBy('created_at', 'desc')->get();

    	return $tasks_from_controller;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 201);//если запрос не прошел валидацию - возвращаем json со всеми ошибками и пишем любой статус крому 200, который будет говорить о возникновении ошибки
        }

        // $task = new Task;//если запрос прошёл - создаём новый таск
        // $task->name = $request->name;
        // $task->status_id = 1;
        // $task->save();

        $task = $request->user()->tasks()->create(['name'=> $request->name, 'status_id' => 1]);//если запрос прошёл - создаём новый таск, у данного авторизированного пользователя

        return $task;// и возвращаем новый таск
    }

    public function delete(Task $task){
        $task->delete();

        return response()->json(['message' => 'Запись удалена'], 200);
    }
}
