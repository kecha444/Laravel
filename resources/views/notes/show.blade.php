@extends('layouts.main') <!-- Включение в главный шаблон -->


@section('content')
<div class="container mt-2">

    @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('note/'.$note->id) }}" method="POST">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="name" class="control-label">Заметка</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $note->name }}"> 
                        </div>

                        <div class="form-group"> <!-- Привязка статуса к заметке -->
                            <label for="status" class="control-label">Статус заметки</label>
                            <select class="form-control custom-select" name="status" id="status">
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}" @if($status->id == $note->status['id']) selected='select' @endif >
                                    {{$status->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <a href="{{ url('note') }}" class="btn btn-light">Назад</a>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection