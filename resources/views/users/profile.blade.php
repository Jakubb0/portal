@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Profil<a class="badge badge-primary float-right" href="{{route('profile.edit')}}">Edytuj profil</a></h5>
        <div class="card-body">
          <div class="card-text">
            <div class="row">
              <div class="col">
              <h3>{{$user->name . ' ' . $user->surname}}</h3>
              <br>
              <h5>Dane:</h5>
              <p>Imię: {{$user->name}}</p>
              <p>Nazwisko: {{$user->surname}}</p>
              <p>Email: {{$user->email}}</p>
              <p>Nr albumu: {{$user->album}}</p>
              <br>
              @if(isset($groups[0]))
            </div>
              <div class="col-6">
              <div class="col-6">
              <h4><a href="{{route('groups')}}">Grupy</a></h4>
              <h5>Należysz do grup:</h5>
              <ul>
                @foreach($groups as $group)
                <li>{{ $group->name .  ' Instytut: ' . $group->institute . ' Rocznik:' . $group->year }}
                  @switch($group->type)
                    @case(1) Wykładowa @break
                    @case(2) Ćwiczeniowa @break
                    @case(3) Projektowa @break
                    @case(4) Laboratoryjna @break
                    @case(5) Seminaryjna @break
                    @case(6) Inna @break
                    @default Brak informacji @break
                  @endswitch 
                </li>
                @endforeach
              </ul>
              </div>
              @else
              <h5>Nie należy do żadnej grupy</h5>
              @endif
              <div class="col-6">

              @if(isset($ogroups[0]))
              <h5>Jesteś właścicielem grup:</h5>
              <ul>
                @foreach($ogroups as $ogroup)
                <li>{{ $ogroup->name .  ' Instytut: ' . $ogroup->institute . ' Rocznik:' . $ogroup->year }}
                  @switch($group->type)
                    @case(1) Wykładowa @break
                    @case(2) Ćwiczeniowa @break
                    @case(3) Projektowa @break
                    @case(4) Laboratoryjna @break
                    @case(5) Seminaryjna @break
                    @case(6) Inna @break
                    @default Brak informacji
                  @endswitch 
                </li>
                @endforeach
                </div>

              </ul>
              @endif
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection