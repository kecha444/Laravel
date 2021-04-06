@extends('layouts.main') <!-- Включение в главный шаблон -->

@section('content')
<div class="container mt-2">

     @include('common.errors')
    
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                        {{ csrf_field() }} <!-- csrf_field() - хелпер который подставить ключ безопасности в запрос (это обязательно!) -->

                        <div class="form-group">
                            <label for="name" class="control-label">Задача</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}"> 
                        </div>

                          <div class="form-group"> <!-- Привязка статуса к задаче -->
                            <label for="status" class="control-label">Статус задачи</label>
                            <select class="form-control custom-select" name="status" id="status">
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}" @if($status->id == $task->status['id']) selected='select' @endif >
                                    {{$status->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <a href="{{ url('/') }}" class="btn btn-light">Назад</a>
                                <button type="submit" class="btn btn-primary">Сохранить задачу</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <span class="float-left">Группы исполнителей</span>
                    <span class="float-right">
                        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#addModal">Добавить</button>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                               <td>{{ $group->name }}</td> 
                               <td>
                                   <form action="{{ url('task/'.$task->id.'/delgroup/'.$group->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <form action="{{ url('task/'.$task->id.'/addgroup') }}" method="POST">
                <div class="modal" id="addModal">
                    <div class="modal-dialog modal-dialog-centered">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5>Добавить группу</h5>
                                <div class="form-group">
                                    <select class="form-control custom-select" name="group" id="group">
                                        @foreach($allgroups as $onegroup)
                                        <option value="{{ $onegroup->id }}">
                                            {{ $onegroup->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection