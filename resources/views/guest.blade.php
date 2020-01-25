@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktualności</h5>
        <div class="card-body">
          <div class="card-text">
            <h5>Witaj! Wszystkie funkcjonalności dostępne są po <a href="{{route('home')}}"> zalogowaniu.</a></h5> 
          
            @if(isset($posts))
            @foreach($posts as $post)
              <div class="card">
                @if(is_null($post->user_id))
                <span class="col text-danger">Użytkownik usunięty</span><span class="mr-3">Data: {{$post->date}}</span>
                @else
                <span class="col">Autor: {{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}}</span><span class="mr-3">Data: {{$post->date}}</span>
                @endif
                <div class="card-body"><div class="card-text">{{$post->content}}</div></div> 
                @if(isset($post->files[0]))
                <div class="card-footer">
                  <small class="text-muted">
                    @foreach($post->files as $file)
                      <a href="files/{{$file->name}}">{{$file->name}}</a>
                      <a href="{{$file->path}}">{{$file->name}}</a>
                    @endforeach
                  </small>
                </div>
                @endif
              </div>
              <br>
            @endforeach
            @else
            <br>
            <h6>Nie znaleziono publicznych postów</h6>

            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection