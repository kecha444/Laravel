@extends('layouts.main')

@section('content')

<div class="container mt-2">
   
   @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100 mt-4">
                <div class="card-header">
                    <span class="float-left">Текущие задачи</span>
                    <span class="float-right">
                        <button class="btn btn-sm btn-dark" onclick="getTasks()">Показать</button>
                        <button class="btn btn-sm btn-primary ml-4" data-toggle="modal" data-target="#addTaskModal">Добавить</button>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody id="tasksListDiv"></tbody>
                    </table>
                </div>

                <div class="modal" id="addTaskModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5>Добавить задачу</h5>
                                <div class="form-group">
                                    <input type="text" name="name" id="taskName" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" data-dismiss="modal">Отмена</button>
                                <button class="btn btn-success" onclick="createTask()">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
             </div>

             <div class="modal" id="addTaskModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5>Ошибки</h5>
                        </div>
                        <div class="modal-body">
                            <span id="errorModalText"></span>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" data-dismiss="modal">Закрыть</button><!-- data-dismiss встроенный bootstrap метод по закрытию модального окна -->
                        </div>
                    </div>
                </div>
            </div>

            <script>//необходимо выносить скрипт отдельно, в рамках обучения мы напишем так

            document.addEventListener("DOMContentLoaded", getTasks);//обработчик события на загрузку страницы, когда стр. загрузилась подружается автоматически getTasks с помощью ajax 

                function renderTask(taskId, taskName){
                    let cElementTr = document.createElement('tr');
                    cElementTr.id = `task-${taskId}`;
                    document.getElementById('tasksListDiv').appendChild(cElementTr);

                    let cElement = document.createElement('td');
                    cElement.innerText = taskId;
                    cElementTr.appendChild(cElement);

                    cElement = document.createElement('td');
                    cElement.innerText = taskName;
                    cElementTr.appendChild(cElement);

                    //Ниже скриптом дописали кнопку удалить  элементам task на стр ajax

                    cElement = document.createElement('td');
                    cClickButton = document.createElement('button');
                    cClickButton.innerText = 'Удалить';
                    cClickButton.className = 'btn btn-danger btn-sm';
                    cClickButton.id = `delButton-${taskId}`;//делаем id кнопке из слова delButton - и id задачи и потом привязываем к ней метод для удвления
                    cElement.appendChild(cClickButton);
                    cElementTr.appendChild(cElement);

                    //Обращаемся к кнопке по id и говорим что на click вызываем метод deleteTask
                    document.getElementById(`delButton-${taskId}`).addEventListener('click', function(){deleteTask(taskId);
                    })
                }

                function deleteTask(delId){
                    let request = new XMLHttpRequest();
                    let data = "task="+encodeURIComponent(delId);

                    request.onreadystatechange = function(){
                        if (request.readyState == 4 && request.status == 200){
                            document.getElementById('tasksListDiv').removeChild(
                                document.getElementById(`task-${delId}`)//Берём div list где у нас все задачи, и удаляем у дочернего по id конкретную задачу 
                            );
                        }
                    }

                    request.open('delete', `/ajax/${delId}`, true);
                    request.responseType = 'json';

                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//это отправка формы которую мы эмулируем прописываем сам запрос в ручную
                    request.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}');

                    request.send(data);


                }

                function getTasks(){
                    let request = new XMLHttpRequest();

                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            let tasksList = request.response;

                            document.getElementById('tasksListDiv').innerHTML = '';
                            
                            for(oneTask of tasksList){
                                renderTask(oneTask.id, oneTask.name);//Функция для отрисовки, если захотим добавляем передоваемые ей данные и дополняем её
                            }
                        }
                    }

                    request.open('GET', '/ajax/tasks', true);
                    request.responseType = 'json';
                    request.send();
                }

                function createTask(){
                    let request = new XMLHttpRequest();
                    let data = "name="+encodeURIComponent(document.getElementById('taskName').value);

                    request.onreadystatechange = function(){
                        if(request.readyState == 4){
                            if(request.status == 200){
                                let newTask = request.response;
                                if(newTask) {
                                    renderTask(newTask.id, newTask.name);//при помощи метода renderTask мы дорисовываем задачу

                                    $('#addTaskModal').modal('hide');//Этим методом закрываем любое модальное окно
                                    document.getElementById('taskName').value = '';
                                }
                            } else {
                                let errorsText = '<p>При добавлении задачи возникли следующие ошибки: </p><ul class ="mb-0">';
                                for(err of request.response.errors){
                                    errorsText += '<li>' + err + '</li>';
                                }
                                errorsText += '</ul>';
                                document.getElementById('errorModalText').innerHTML = errorsText;

                                $('#addTaskModal').modal('hide');
                                $('#errorModal').modal('show');
                            }
                        }
                    }

                    request.open('POST', '{{ url("/ajax") }}', true);
                    request.responseType = 'json';

                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');//это отправка формы которую мы эмулируем прописываем сам запрос в ручную
                    request.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}');

                    request.send(data);
                }

            </script>

        </div>
    </div>
</div>
@endsection