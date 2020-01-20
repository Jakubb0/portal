@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Wiadomości<a class="badge badge-primary float-right" href="{{route('message.create')}}">Nowa wiadomość</a></h5>
            <div class="card-body">
                    <div class="card-text">
                        <button class="recieved" val="1">Odebrane</button>
                        <button class="recieved" val="2">Wysłane</button>
                        <div id="messagebox">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection