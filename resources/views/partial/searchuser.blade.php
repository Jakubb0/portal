<table>
<thead>
	<th>#</th>
	<th>Imie</th>
	<th>Naziwsko</th>
	<th></th>
</thead>
<tbody>
@foreach($users as $i=>$user)   
  <tr>
    <td>{{$i+1}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->surname}}</td>
    @if($user->id != Auth::id())<td><p class="adduser badge badge-primary" name="userid" type="submit" val="{{$user->id}}">Dodaj</p></td>@endif
  </tr>
@endforeach
</tbody>
</table>  
