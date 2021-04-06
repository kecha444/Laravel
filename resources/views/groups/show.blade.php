@extends('layouts.main') 

@section('content')
<div class="container mt-2">

    @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('groups/'.$group->id) }}" method="POST">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="name" class="control-label">Группа</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $group->name }}"> 
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <a href="{{ url('groups') }}" class="btn btn-light">Назад</a>
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