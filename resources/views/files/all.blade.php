@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Pliki</h5>
            <div class="card-body">
                @if(!Auth::check()) <h5><a href="{{route('guest')}}">Wróć do wpisów</a></h5>@endif
                    <div class="card-text">
                        <ul>
                        @foreach($files as $file)
                            <li><a href="files/{{$file->name}}">{{$file->name}}</a></li>
                        @endforeach         
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection