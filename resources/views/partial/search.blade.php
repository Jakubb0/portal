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
    @if($user->id != Auth::id())<td><button class="zxc badge badge-primary" name="userid" val="{{$user->id}}">Dodaj</button></td>@endif
  </tr>
@endforeach
</tbody>
</table>  
