@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Grupy</h5>
        <div class="card-body">
          <div class="card-text">
            @if(isset($groups))
            <h4>Twoje grupy</h4>
            @if(Auth::user()->role>2)
              <a class="btn btn-primary" href="{{route('groups.create')}}">Utwórz grupę</a>
            @endif
            <br/>
            <br/>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nazwa</th>
                  <th scope="col">Instytut</th>
                  <th scope="col">Rok rozpoczęcia</th>
                  <th scope="col">Typ grupy</th>
                </tr>
              </thead>
              <tbody>
                @foreach($groups as $i=>$gr)
                <tr>
                  <td>{{$i+1}}</td>
                  <td>{{$gr->name}}</td>
                  <td>{{$gr->institute}}</td>
                  <td>{{$gr->year}}</td>
                  <td>
                    @switch($gr->type)
                      @case(1) Wykładowa @break
                      @case(2) Ćwiczeniowa @break
                      @case(3) Projektowa @break
                      @case(4) Laboratoryna @break
                      @case(5) Seminaryjna @break
                      @case(6) Inna @break
                    @endswitch
                  </td>
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
    </div>
  </div>
</div>
@endsection