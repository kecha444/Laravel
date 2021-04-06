@extends('layouts.main')

@section('content')
<div class="container mt-2">
     @include('common.errors')
    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('note') }}" method="POST">
                        {{ csrf_field() }} 

                        <div class="form-group">
                            <label for="name" class="control-label">Заметка</label>
                            <input type="text" name="name" id="name" class="form-control"> 
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Добавить заметку</button>
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
                <div class="card-header">Текущие заметки</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($notes as $note)
                            <tr>
                                <td>
                                    <a href="{{ url('note/'.$note->id) }}">{{ $note->name }}</a>
                                </td>

                                 <td>{{ $note->status['name'] }}</td>

                                <td>
                                    <form action="{{ url('note/'.$note->id) }}" method="POST">
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
        </div>
    </div>
</div>
@endsection