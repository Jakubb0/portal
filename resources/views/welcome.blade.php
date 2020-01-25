<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal wspomagający komunikację ze studentami</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lilita+One&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script> 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="title m-b-md">
                    Portal wspomagający komunikację ze studentami
                </div>

                <div class="links">
                    <a href="#" data-toggle="modal" data-target="#loginModal">Zaloguj się</a>
                    <a href="#" data-toggle="modal" data-target="#registerModal">Utwórz konto</a><br>
                    <a href="{{route('guest')}}"><small class="text-muted">Bez logowania</small></a>
                </div>  


                <!-- Modal -->
                <div class="modal smooth-transition" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="registerModalLabel">Utwórz konto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body form-group">
                                <form method="post" action="{{route('register')}}">
                                    @csrf
                                    <div class="form-group text-left font-weight-bold">
                                        <label for="email">E-mail</label>
                                            <input class="form-control" name="email" id="email" type="email">
                                        <label for="name">Imię</label>
                                            <input class="form-control" name="name" id="name" type="text">
                                        <label for="surname">Naziwsko</label>
                                            <input class="form-control" name="surname" id="surname" type="text">
                                        <label for="album">Numer albumu</label>
                                            <input class="form-control" name="album" id="album" type="number">
                                        <label for="login">Login</label>
                                            <input class="form-control" name="login" id="login" type="text">
                                        <label for="password">Hasło</label>
                                            <input class="form-control" name="password" id="password" type="password">
                                        <label for="group">Grupa</label>
                                        <select class="form-control" name="group" id="group">
                                            @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}/{{$group->year}}/{{$group->institute}}</option>
                                            @endforeach
                                        </select>
                                        <label for="check">Powiadamiaj mnie mailowo</label>
                                        <br>
                                        <input id="check" name="check" type="checkbox" checked>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                            <button type="submit" class="btn btn-primary">Utwórz konto</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal smooth-transition" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body form-group">
                                <form method="post" action="{{route('login')}}">
                                    @csrf
                                    <div class="form-group text-left font-weight-bold">
                                        <label for="login">Login</label>
                                            <input class="form-control" name="login" type="text">
                                        <label for="password">Hasło</label>
                                            <input class="form-control" name="password" type="password">
                                        <br>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                            <button type="submit" class="btn btn-primary">Zaloguj</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
        
    </body>
</html>