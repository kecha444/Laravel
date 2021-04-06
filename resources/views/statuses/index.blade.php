@extends('layouts.main') <!-- Включение в главный шаблон -->

@section('content')
<div class="container mt-2">

    @include('common.errors')

    <div class="row">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ url('status') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }} <!-- csrf_field() - хелпер который подставить ключ безопасности в запрос (это обязательно!) -->

                        <div class="form-group">
                            <label for="name" class="control-label">Статус</label>
                            <input type="text" name="name" id="name" class="form-control"> 
                        </div>

                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/jpeg,image/png">
                            <label for="image" class="custom-file-label">Выберите изображение</label>
                        </div>

                        <div class="form-group mb-0">
                            <div class="w-100">
                                <button type="submit" class="btn btn-primary">Добавить статус</button>
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
                <div class="card-header">Текущие статусы</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($statuses as $status) <!-- в $tasks лежат все поля таблицы и пройдясь под $tasks с помощью foreach мы выводим все данные из таблицы $tasks, то есть все $task -->
                            <tr>
                                  <td>
                                        @if($status->image)
                                        <img src="{{ asset(url($status->image)) }}" width="80">
                                        @endif
                                    </td>
                                <td>
                                    <a href="{{ url('status/'.$status->id) }}">{{ $status->name }}</a>
                                </td>
                                <td>
                                    <form id="statusform-{{ $status->id }}" action="{{ url('status/'.$status->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                       <button type="button" onclick="clickDelButton(event, 'statusform-{{ $status->id }}')" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $statuses->links('vendor.pagination.bootstrap-4') }} <!-- Переход на стр 2,3 и тд с помощью метода Paginate в контроллере и links во view
                    В скобках в методе links прописали vender который создали через консоль этот вендер имеет в себе вьюхи по умолчанию здесь мы обратились к стандартной бустрапосвкой вьюхе -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection