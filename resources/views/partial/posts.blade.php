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