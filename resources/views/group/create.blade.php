@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
            <h5 class="card-header">Grupy</h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="modal-body form-group">
                        <form method="post" action="{{route('groups.new')}}">
                            @csrf
                            <div class="form-group text-left font-weight-bold">
                                <label for="name">Nazwa grupy</label>
                                    <input class="form-control" name="name" type="text">
                                <label for="institute">Instytut</label>
                                    <input class="form-control" name="institute" type="text">
                                <label for="year">Rok</label>
                                    <input class="form-control" name="year" type="number">
                                <label for="type">Typ grupy</label>
                                    <select class="form-control" name="type">
                                        <option value="1">Wykładowa</option>
                                        <option value="2">Ćwiczeniowa</option>
                                        <option value="3">Projektowa</option>
                                        <option value="4">Laboratoryjna</option>
                                        <option value="5">Seminaryjna</option>
                                        <option value="6">Inna</option>
                                    </select>
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