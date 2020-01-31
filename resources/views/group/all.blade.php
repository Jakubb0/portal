@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Grupy
            @if(Auth::user()->role>=2)
              <a class="float-right badge badge-primary" href="{{route('groups.create')}}">Utwórz grupę</a>
            @endif
        </h5>
        <div class="card-body">
          <div class="card-text">
            @if(isset($groups))
            <h4>Twoje grupy</h4>
            <br/>
            <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nazwa</th>
                  <th scope="col">Instytut</th>
                  <th scope="col">Rok rozpoczęcia</th>
                  <th scope="col">Typ grupy</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($groups as $i=>$gr)
                <tr>
                  <td data-toggle="modal" data-target="#groupModal" val="{{$gr->id}}" class="xxx">{{$i+1}}</td>
                  <td data-toggle="modal" data-target="#groupModal" val="{{$gr->id}}" class="xxx">{{$gr->name}}</td>
                  <td data-toggle="modal" data-target="#groupModal" val="{{$gr->id}}" class="xxx">{{$gr->institute}}</td>
                  <td data-toggle="modal" data-target="#groupModal" val="{{$gr->id}}" class="xxx">{{$gr->year}}</td>
                  <td data-toggle="modal" data-target="#groupModal" val="{{$gr->id}}" class="xxx">
                    @switch($gr->type)
                      @case(1) Wykładowa @break
                      @case(2) Ćwiczeniowa @break
                      @case(3) Projektowa @break
                      @case(4) Laboratoryna @break
                      @case(5) Seminaryjna @break
                      @case(6) Inna @break
                    @endswitch
                  </td>
                  @if(Auth::user()->role>=2)
                  <td><a class="badge badge-primary" href="{{route('groups.add', $gr->id)}}">Dodaj do grupy</a></td>
                  <td><a class="badge badge-danger" onclick="return confirm('Usunąć: {{$gr->name}} {{$gr->institute}} {{$gr->year}}?');" href="{{route('groups.delete', $gr->id)}}">Usuń grupę</a></td>
                  @endif
                </tr>
                @endforeach
            @else
                  Nie należysz do żadnej grupy
            @endif
              </tbody>     
            </table>
          </div>
          </div>
        </div>
      </div>,
    </div>
  </div>
</div>

<div class="modal smooth-transition" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="loginModalLabel">Członkowie grupy</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table class="table responsive">
      <thead>
        <th>#</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        @if(Auth::user()->role>=2)<th>Nr albumu</th>@endif
        <th></th>
      </thead>
      <tbody id="test" >
      </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection