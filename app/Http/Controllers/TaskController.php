<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Status;// чтобы работать с табл статусов
use App\Group;// чтобы работать с табл групп

use App\Mail\TaskMail;// подключили наш мейлер
use Illuminate\Support\Facades\Mail;// подключили возможность использовать почту

use Validator;// встроенный валидатор(проверяет на ошибки заполнение форм)

class TaskController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	//$tasks_from_controller = Task::all(); // с помощью all и этой записи выводим все записи из БД 
        
        //Выводим по другому (с помощью created_at(время создания) и desc мы выводим в обратном порядке, чтобы более свежие записи выводились с верху)
        // Аналогично SELECT ... ORDER BY...
        
        //$tasks_from_controller = Task::orderBy('created_at', 'desc')->get();

        $tasks_from_controller = $request->user()->tasks()->orderBy('created_at', 'desc')->Paginate(5);
    	
        return view('tasks.index', ['tasks'=>$tasks_from_controller]);
    }

    public function create(Request $request) { 

        $validator = Validator::make($request->all(), ['name'=>'required|max:255']);//Проверка на заполненность и на максимальную длину

        if($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);// Если условия валидатора не выполнены возвращаем главную стр с нашим написанным методом вывода сообщения и саму переменную $validator в которой описана сама ошибка
        }

        $filename="";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $store_filename = time().'-'.$file->getClientOriginalName();

            $file->move(public_path().'/uploads/', $store_filename);

            $filename = '/uploads/'.$store_filename;
        }

    	// $task = new Task; // создаём новый экземпляр задачи
    	// $task->name = $request->name; // говорим что новая задача будет называться так, как будет передано в запросе чперез форму 
     //    $task->status_id = 11;//Присваиваем задаче id статуса(при создании задачи ей будет присвоин статус 'новая')
    	// $task->save(); // сохранили новую задачу

        $request->user()->tasks()->create(['name'=> $request->name, 'image' => $filename, 'status_id' => 1]);// Создаём задачу через текущего пользователя, чтобы у кождого юзера были видны его персональные задачи

        // $data = (['task_name' => $request->name]);
        // Mail::to("kecha444@yandex.ru")->send(new TaskMail($data));//функция отправки почты

    	return redirect('/');// вернули на главную стр
    }

    public function delete(Request $request, Task $task) {
        //$task->delete();// У task мы вызываем метод delete, который его удалит 

        if($request->user()->tasks()->find($task->id)){
            $task->delete();//метод файнд ищет задачу под выбранным id если она есть удаляет персонально у авторизованного пользователя
        }

        return redirect('/');// И возвращаем главную стр
    }

    public function show(Request $request, Task $task) {

        $statuses = Status::all();
        $allgroups = Group::all();// Передаём группы во вью через метод show

        if($request->user()->tasks()->find($task->id)){
            $groups = $task->groups;


            return view('tasks.show', ['task'=>$task, 'statuses'=>$statuses, 'allgroups'=>$allgroups, 'groups'=>$groups]);
           } else {
            return redirect('/');
           }
// Возвращаем вьюху в которой выводится содержится тот task который вы брали и он как параметр пришел в метод show 
    }

    public function update(Request $request, Task $task) {

        if($request->user()->tasks()->find($task->id)){
        
            $validator = Validator::make($request->all(), ['name'=>'required|max:255']);

            if($validator->fails()) {
                return redirect('task/'.$task->id)->withInput()->withErrors($validator);
                }

            $task->update(['name' => $request->name, 'status_id' => $request->status]);

    }

        return redirect('/');
    }

     public function add_group(Request $request, Task $task){
        if($request->user()->tasks()->find($task->id)){//проверяем принадлежит ли данная задачу пользователю
            if($group = Group::find($request->group)){//проверяем существует ли такая группа
                if(!$task->groups->has($group->id)){//проверяем есть данная группа у этой задачи, чтобы не добавлять её повторно
                    $task->groups()->attach([$group->id]);//attach присоединяет - устанавлявает связь между task и groups
                }

            }

        }
        return redirect('task/'.$task->id);
     }

      public function del_group(Request $request, Task $task, Group $group){
        if($request->user()->tasks()->find($task->id)){// так же проверка на пользователя
            //if($task->groups->has($group->id)){
                $task->groups()->detach([$group->id]);// проверяем существует ли связь, если да - то detach разорвёт её и удалит связь
            //}
        }

        return redirect('task/'.$task->id);

      }
}

