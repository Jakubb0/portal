@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Wiadomość</h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="modal-body form-group">
                        <form method="post" action="{{route('message.postadd')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-left font-weight-bold">
                                <label for="title">Temat</label>
                                    <input class="form-control" name="title" type="text">
                                <label for="content">Tekst</label>
                                    <input class="form-control" name="content" type="text">
                                <label for="reciever">Odbiorca</label>
                                    <input id="searchuser" class="form-control" name="reciever" type="text">
                                <div id="user">
                                    @if(isset($user))
                                    {{$user->name}} {{$user->surname}} {{$user->album}}
                                    <a href="" id="changeuser">Zmień użytkownika</a>
                                    @endif
                                </div>
                                <div id="tezt"></div>
                                <label for="files">Załączniki</label>
                                <div class="custom-file">
                                    <input class="custom-file-input" id="files" multiple name="files[]" type="file">
                                    <label class="custom-file-label" for="files">Wybierz plik</label>
                                    <div class="custom-file-uploaded">
                                        
                                    </div>
                                </div>
                                <br>
                                <br>
                                <input class="btn btn-primary" type="submit"> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection