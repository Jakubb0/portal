@if(!empty($messages[0]))
<div id="messages">
@foreach($messages as $message)
<?php $type = get_class($message)=='App\\Message'?1:2 ?>
@if($message->to_id==Auth::id() && $message->status==true )
<article class="show_message recieved" type="{{$type}}" val="{{$message->id}}">
@else
<article class="show_message" val="{{$message->id}}" type="{{$type}}">
@endif
    <p class="d-flex justify-content-between">
    <span class="col">
        @if($id==1)
            @if(is_null($message->from_id))
            Od: <span class="text-danger">Użytkownika usniętego</span>
            @else
            Od: {{App\User::find($message->from_id)->name .' '. App\User::find($message->from_id)->surname }}
            @endif
        @else
            @if(is_null($message->to_id))
            Do: <span class="text-danger">Użytkownika usniętego</span>
            @else
            Do: {{App\User::find($message->to_id)->name .' '. App\User::find($message->to_id)->surname }}
            @endif
        @endif
    </span>
    <span class="col">Tytuł: {{$message->title}}</span>
    <span class="col text-right text-muted mr-auto">{{$message->date}}</span>
    @if($message->from_id==Auth::id())<a href="{{route('message.delete', $message->id)}}" class="badge badge-danger">X</a>@endif
    </p>
    <div id="message_content{{$type}}_{{$message->id}}" class="d-none">
        <p class="col">{{$message->content}}</p>          
    @if($id==1 && $message->from_id!==null)<div class="text-right"><a href="{{route('reply',[$type, $message->id])}}" class="badge badge-primary">Odpisz</a></div>@endif 
    @if(isset($message->files[0]))   
      <small class="text-muted">
        @foreach($message->files as $file)
        <a href="files/{{$file->name}}">{{$file->name}}</a>
        @endforeach
      </small>
    @endif
    @if(isset($message->replies[0]))
        <br><h4>Odpowiedzi: </h4>  
        @foreach($message->replies->sortByDesc('date') as $reply)
        <hr>
        <p class="d-inline">{{$reply->title}}</p>
        <p class="d-inline">{{$reply->date}}</p>
        <p class="d-block">{{$reply->content}}</p>  
            @if(isset($reply->files[0]))   
            <small class="text-muted">
                @foreach($reply->files as $file)
                    <a href="files/{{$file->name}}">{{$file->name}}</a>
                @endforeach
            </small>
            @endif
        @endforeach
    @endif
    </div>
</article>
@endforeach   
</div>
@else
    Brak wiadomości
@endif