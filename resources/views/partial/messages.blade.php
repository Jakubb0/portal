@if(!empty($messages[0]))
<div id="messages">
@foreach($messages as $message)
@if($message->to_id==Auth::id() && $message->status==true)
<article class="show_message recieved" val="{{$message->id}}">
@else
<article class="show_message" val="{{$message->id}}">
@endif
    <p class="d-inline">
        @if($id==1)
        Od: {{App\User::find($message->from_id)->name .' '. App\User::find($message->from_id)->surname }}
        @else
        Do: {{App\User::find($message->to_id)->name .' '. App\User::find($message->to_id)->surname }}
        @endif
    </p>
    <p class="d-inline">Tytuł: {{$message->title}}</p>
    <p class="d-inline">{{$message->date}}</p>
    <div id="message_content{{$message->id}}" class="d-none">
        <p class="d-block">{{$message->content}}</p>          
    @if($message->from_id!=Auth::id() || $message->from_id==Auth::id() && isset($message->files[0]))<a href="{{route('reply',$message->id)}}" class="badge badge-primary float-right">Odpisz</a>@endif 
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