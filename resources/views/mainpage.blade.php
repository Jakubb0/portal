@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktualności
          @if(Auth::user()->role>1)
          <a class="badge badge-primary float-right" href="{{route('createpost')}}">Dodaj wpis</a>
          @endif
        </h5>
        <div class="card-body">
          <div class="card-text">
            <h4>Witaj {{Auth::user()->name . ' ' . Auth::user()->surname}}</h4>
            @if(Auth::user()->role==0)
              <h5>Poczekaj na aktywację konta</h5>
            @else
            @if(isset($posts[0]))
            <button id="filterposts_show" class="btn btn-secondary">Filtruj posty</button>
            <div class="col" id="filterposts_box">
              <br>
              <div class="form-group row">
                <label for="filtercond">Grupa:</label>
                <div class="col-8">
                <select class="form-control" id="filtercond">
                  <option value="all">Wszystkie</option>
                @foreach(Auth::user()->groups as $group)
                  <option value="{{$group->id}}">{{$group->name}} {{$group->institute}} {{$group->year}}</option>
                @endforeach           
                </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="filterdate">Od:</label>
                <div class="col-8">
                  <input class="form-control" type="date" id="filterdate_from">
                </div>
              </div>  
              <div class="form-group row">
                <label for="filterdate">Do:</label>
                <div class="col-8">
                  <input class="form-control" type="date" id="filterdate_to">
                </div>
              </div>   
              <button id="filterposts" class="btn btn-primary">Zastosuj</button>
            </div>
            <div id="posts">
            @foreach($posts as $post)
            <article>
              <div class="posthead">
              <p class="row justify-content-between">
                @if(is_null($post->user_id))
                <span class="col text-danger">Użytkownik usunięty</span><span class="text-right text-muted">{{$post->date}}</span>
                @else
                <span class="col">Autor: {{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}}</span><span class="text-right text-muted">{{$post->date}}</span>
                @endif
                @if(Auth::id()==$post->user_id)<a href="{{route('deletepost', $post->id)}}" class="mr-3 ml-3 badge badge-danger">X</a>@endif
              </p>
              <p>Tytuł: {{htmlspecialchars_decode($post->title)}}</p>
              </div>
              <div class="singlepost">
                {{htmlspecialchars_decode($post->content)}}
              </div>
              @if(isset($post->files[0]))
              <hr>
              <div class="files">
              Załączone pliki:
              <small class="text-muted">
                @foreach($post->files as $file)
                  <a href="files/{{$file->name}}">{{$file->name}}</a>
                @endforeach
              </small>
              </div>
              @endif
            </article>
            @endforeach
            @else
            <br>
            <h6>Nie znaleziono postów</h6>

            @endif
            @endif
          </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection