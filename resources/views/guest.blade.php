@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <h5 class="card-header">Aktualności</h5>
        <div class="card-body">
          <div class="card-text">
            <h4>Witaj, żeby korzystać ze wszystkich funkcjanolności zaloguj się</h4> 
          
            @if(isset($posts))

            @foreach($posts as $post)
              <div class="card">
                <div class="card-header">{{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}} napisał: <br>{{$post->title}} <br>{{$post->date}}</div>   
                <div class="card-body"><div class="card-text">{{$post->content}}</div></div> 
                @if(isset($post->files[0]))
                <div class="card-footer">
                  <small class="text-muted">
                    @foreach($post->files as $file)
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