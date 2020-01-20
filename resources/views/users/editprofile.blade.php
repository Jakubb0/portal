@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Profil</h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="modal-body form-group">
                        <form method="post" action="#">
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
                                <button type="submit" class="btn btn-primary">Utwórz konto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection