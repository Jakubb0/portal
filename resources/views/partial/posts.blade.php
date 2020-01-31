@foreach($posts as $post)
<article>
  <div class="posthead">
    <p class="row justify-content-between">
      <span class="col">Autor: {{App\User::Where('id',$post->user_id)->pluck('name')[0] .' ' . App\User::Where('id',$post->user_id)->pluck('surname')[0]}}</span><span class="mr-3">Data: {{$post->date}}</span>
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
  <hr>
</article>
@endforeach
