  @foreach($users as $i=>$user)   
  <tr>
    <td>{{$i+1}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->surname}}</td>
    <td><a class="badge badge-danger" href="{{route('main')}}">Usuń</a></td>
  </tr>
  @endforeach
  
