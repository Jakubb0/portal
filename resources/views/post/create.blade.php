@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Post</h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="modal-body form-group">
                        <form method="post" action="{{route('addpost')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-left font-weight-bold">
                                <label for="title">Temat</label>
                                    <input class="form-control" name="title" type="text">
                                <label for="content">Treść</label>
                                    <textarea class="form-control" name="content" type="text"></textarea>
                                <label for="content">Tekst</label>
                                    <input class="form-control" name="content" type="text">
                                <label for="recievers">Odbiorcy</label>
                                <br>
                                    <div class="custom-radio custom-control">
                                        <input id="ypublic" class="custom-control-input" type="radio" name="public" value="true">
                                        <label class="custom-control-label" for="ypublic">Publiczny</label> 
                                    </div>
                                    <div class="custom-radio custom-control">
                                        <input id="npublic" class="custom-control-input" type="radio" name="public" value="false">
                                        <label class="custom-control-label" for="npublic">Grupy</label>
                                    </div>
                                    <select id="selectgroup" class="form-control" id="recievers" name="recievers[]" multiple>
                                        @foreach(Auth::user()->groups as $group)
                                            <option class="multi-option" value="{{$group->id}}">Grupa: {{$group->name}} Instytut: {{$group->institute}}</option>
                                        @endforeach
                                    </select>
                                    <br>
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