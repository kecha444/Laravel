<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
    <body>

        <div class="container">
            <div class="navbar navbar-expand-sm">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Главная</a>
                    </li>

                    @if(Auth::check()) <!-- Проверка на авторизацию, если не авторизован ре видит эти пункты меню -->
                    <li class="nav-item">
                        <a href="{{ url('/status') }}" class="nav-link">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/note') }}" class="nav-link">Заметки</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/groups') }}" class="nav-link">Группы</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/ajax') }}" class="nav-link">Ajax</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/statusajax') }}" class="nav-link">StatusAjax</a>
                    </li>
                    @endif
                </ul>

                <ul class="navbar-nav ml-auto">
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выход</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @else
                     <li class="nav-item">
                        <a href="{{ url('/register') }}" class="nav-link btn btn-outline-primary btn-sm px-4 mr-2">Регистрация</a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ url('/login') }}" class="nav-link btn btn-outline-dark btn-sm px-4">Войти</a>
                    </li>
                @endif
                </ul>
            </div>
        </div>

        @yield('content')  <!-- Выводит секцию контент из файла index -->
       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="{{ asset(url('js/scripts.js')) }}"></script> <!-- с помощью методов ларавела подключили созданный нами файл js в папке js (подключается так) -->
    </body>
</html>
