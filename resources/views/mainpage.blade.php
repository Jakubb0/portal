@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktualności</h5>
        <div class="card-body">
          <div class="card-text">
            <h4>Witaj {{Auth::user()->name . ' ' . Auth::user()->surname}}</h4>
            

            @if(isset($posts))

            @foreach($posts as $post)
              <div class="card">
              <div class="card-header"> Napisał: {{$post->title}} <p>{{$post->date}}</p></div>                 
              <div class="card-body"><div class="card-text">{{$post->content}}</div></div> 
              </div>
              <br>
            @endforeach
            @else
            <br>
            <h6>Nie znaleziono postów</h6>

            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection