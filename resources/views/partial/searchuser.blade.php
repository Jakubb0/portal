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
    @if($user->id != Auth::id())<td><a class="adduser badge badge-primary" name="userid" val="{{$user->id}}">Dodaj</a></td>@endif
  </tr>
@endforeach
</tbody>
</table>  
