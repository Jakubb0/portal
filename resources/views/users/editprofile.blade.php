@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Profil</h5>
            <div class="card-body">
                <div class="card-text">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="modal-body form-group">
                        <form method="post" action="{{route('profile.save')}}">
                            @csrf
                            <div class="form-group text-left font-weight-bold">
                                <label for="email">E-mail</label>
                                    <input class="form-control" name="email" id="email" type="email" value="{{$user->email}}">
                                <label for="name">Imię</label>
                                    <input class="form-control" name="name" id="name" type="text" value="{{$user->name}}">
                                <label for="surname">Naziwsko</label>
                                    <input class="form-control" name="surname" id="surname" type="text" value="{{$user->surname}}">
                                @if($user->role==1)
                                <label for="album">Numer albumu</label>
                                    <input class="form-control" name="album" id="album" type="number" value="{{$user->album}}">
                                @endif
                                <label for="login">Login</label>
                                    <input class="form-control" name="login" id="login" type="text" value="{{$user->login}}">
                                <label for="check">Powiadamiaj mnie mailowo</label>
                                <br>
                                <input id="check" name="check" type="checkbox" checked>
                                <br>
                                <label for="password">Hasło</label>
                                    <input class="form-control" name="password" id="password" type="password">

                                <button type="submit" class="btn btn-primary">Zapisz</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection