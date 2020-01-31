<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portal</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @if(Auth::check())
    <div id="app">
        <div class="conatiner">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="{{route('main')}}">Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php $msgcount = App\Message::where('to_id', Auth::id())->where('status', false)->count(); 
                        
                        $reply = App\Reply::where('to_id', Auth::id())->where('status', false)->count();
                        $msgcount = $msgcount + $reply;
                        $users = App\User::where('role', 0)->count();
                    ?>

                    <a class="nav-link" href="{{route('messages')}}">Wiadomości   @if($msgcount>0)<span class="badge badge-primary">{{$msgcount}}</span>@endif</a>
                    
                </li>        
                <li class="nav-item">
                    <a class="nav-link" href="{{route('groups')}}">Grupy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('files')}}">Pliki</a>
                </li>
                @if(Auth::user()->role>2)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users')}}">Użytkownicy</a>
                </li>
                @if($users>0)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('activateusers')}}">Aktywuj użytkowników<span class="badge badge-primary">{{$users}}</span></a>
                </li>
                @endif
                @endif
            </ul>
            <li class="nav nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name . ' ' . Auth::user()->surname}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile')}}">Profil</a>
                    <a class="dropdown-item" href="#">2</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}">Wyloguj</a>
                </div>
            </li> 
            </div>
        </nav>
        </div>
    @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
