@if(isset($users[0]))
<table class="table">
<thead>
  <th scope="col">Imię</th>
  <th scope="col">Nazwisko</th>
  <th scope="col">Nr album</th>
  <th scope="col"></th>
</thead>
<tbody id="usersbox">
  @foreach($users as $user)
@if($user->role==3)
<tr class="uinfo highlight" val="{{$user->id}}" data-toggle="modal" data-target="#uinfoModal">
@else
<tr class="uinfo" val="{{$user->id}}" data-toggle="modal" data-target="#uinfoModal">
@endif
  <td>{{$user->name}}</td>
  <td>{{$user->surname}}</td>
  <td>{{$user->album}}</td>
  <td><a href="{{route('user.delete', $user->id)}}" class="badge badge-danger" onclick="return confirm('Usunąć: {{$user->name . $user->surname . $user->album}}?');">Usuń</a></td>
</tr>
@endforeach
</tbody>  
</table>
@else
Brak wyników wyszukiwania
@endif
