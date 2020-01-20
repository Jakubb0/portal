@foreach($posts as $post)
<article>
  <p class="row justify-content-between">
    <span class="col">Autor: {{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}}</span><span class="mr-3">Data: {{$post->date}}</span>
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