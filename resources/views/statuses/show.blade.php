@extends('layouts.main') <!-- Включение в главный шаблон -->

@section('content')
<div class="container mt-2">

    @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('status/'.$status->id) }}" method="POST">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="name" class="control-label">Статус</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $status->name }}"> 
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <a href="{{ url('status') }}" class="btn btn-light">Назад</a>
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