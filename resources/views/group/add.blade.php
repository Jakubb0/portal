@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Grupy</h5>
            <div class="card-body">
                <div class="card-text">
                            <label for="name">Wyszukaj użytkownika</label>
                            <input id="search" class="form-control" name="search" type="text">
                            <div id="tezt"></div>
                    <div class="form-group">
                    <form method="post" action="{{route('groups.postadd', $id)}}">
                        @csrf
                        <div class="form-group text-left font-weight-bold">
                        @if(!empty($users))
                            <label for="users[]">Użytkownicy do dodania</label>
                            <select class="form-control" multiple id="x" name="users[]">
                                @foreach($users as $user)
                                    <option class="multi-option" value="{{$user->id}}" selected>{{$user->name}} {{$user->surname}} Album: {{$user->album}}</option>
                                @endforeach  
                            </select>          
                        @endif
                            <input class="btn btn-primary" type="submit">
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection