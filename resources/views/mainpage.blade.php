@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktualności<a class="badge badge-primary float-right" href="{{route('createpost')}}">Dodaj wpis</a></h5>
        <div class="card-body">
          <div class="card-text">
            <h4>Witaj {{Auth::user()->name . ' ' . Auth::user()->surname}}</h4>
            <div>
            Filtruj posty:
            <br>
            Grupa:
            <select id="filtercond">
              <option value="all">Wszystkie</option>
            @foreach(Auth::user()->groups as $group)
              <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach           
            </select>   
            <button id="filterposts">Filtruj</button>
            </div>
            @if(isset($posts))
            <div id="posts">
            @foreach($posts as $post)
            <article>
              <p class="row justify-content-between">
                @if(is_null($post->user_id))
                <span class="col text-danger">Użytkownik usunięty</span><span class="mr-3">Data: {{$post->date}}</span>
                @else
                <span class="col">Autor: {{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}}</span><span class="mr-3">Data: {{$post->date}}</span>
                @endif
              </p>
              <p>Tytuł: {{$post->title}}</p>
              <div>
                {{$post->content}}
              </div>
              @if(isset($post->files[0]))
              <hr>
              Załączone pliki:
              <small class="text-muted">
                @foreach($post->files as $file)
                  <a href="files/{{$file->name}}">{{$file->name}}</a>
                @endforeach
              </small>
              @endif
              <hr>
            </article>
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
</div>
@endsection