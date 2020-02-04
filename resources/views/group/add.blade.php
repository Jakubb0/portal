@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Grupy</h5>
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
                    <label for="name">Wyszukaj użytkownika</label>
                    <input id="search" class="form-control" name="search" type="text" val="{{$id}}">
                    <div id="tezt"></div>
                    <div class="form-group">
                    <form method="post" action="{{route('groups.postadd', $id)}}">
                        @csrf
                        <div class="form-group text-left font-weight-bold">
                        <div id="userstoadd">
                            
                        @if(!empty($users))
                            <label for="users[]">Użytkownicy do dodania (zaznaczeni na niebiesko)</label>
                            <p class="badge badge-primary" id="clearusers" val="{{$id}}">Wyczyść</p>
                            <select class="form-control multi-option" multiple name="users[]">
                                @foreach($users as $user)
                                    <option class="multi-option" value="{{$user->id}}" selected>{{$user->name}} {{$user->surname}} Album: {{$user->album}}</option>
                                @endforeach  
                            </select>          
                        @endif
                        </div>
                            <input class="btn btn-primary" type="submit" value="Dodaj użtkowników">
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection