@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktywuj użytkowników</h5>
        <div class="card-body">
          <div class="card-text">
            <div class="table-responsive">
                @if(isset($users[0]))
                <table class="table">
                <thead>
                  <th scope="col">Imię</th>
                  <th scope="col">Nazwisko</th>
                  <th scope="col">Nr album</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                @foreach($users as $user)
                @if($user->role==3)
                <tr class="highlight">
                @else
                <tr>
                @endif
                  <td class="uinfo" val="{{$user->id}}" data-toggle="modal" data-target="#uinfoModal">{{$user->name}}</td>
                  <td class="uinfo" val="{{$user->id}}" data-toggle="modal" data-target="#uinfoModal">{{$user->surname}}</td>
                  <td class="uinfo" val="{{$user->id}}" data-toggle="modal" data-target="#uinfoModal">{{$user->album}}</td>
                  <td><a href="{{route('user.activate', [1, $user->id])}}" class="badge badge-primary">Student</a></td>
                  <td><a href="{{route('user.activate', [2, $user->id])}}" class="badge badge-secondary">Prowadzący</a></td>
                </tr>
                @endforeach
                </tbody>  
                </table>
                @else
                Brak użytkowników
                @endif
            
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal smooth-transition" id="uinfoModal" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="loginModalLabel">Użytkownik</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="userinfo">
        
      </div>
    </div>
  </div>
</div>

@endsection