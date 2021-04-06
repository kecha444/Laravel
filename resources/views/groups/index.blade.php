@extends('layouts.main') <!-- Включение в главный шаблон -->

@section('content')
<div class="container mt-2">

    @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('/groups') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="control-label">Группа</label>
                            <input type="text" name="name" id="name" class="form-control"> 
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Добавить группу</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-header">Группы</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($groups as $group) 
                            <tr>
                                <td>
                                    <a href="{{ url('groups/'.$group->id) }}">{{ $group->name }}</a>
                                </td>
                                <td>
                                    <form id="groupform-{{ $group->id }}" action="{{ url('groups/'.$group->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                       <button type="button" onclick="clickDelButton(event, 'groupform-{{ $group->id }}')" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $groups->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection