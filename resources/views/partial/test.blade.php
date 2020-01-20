  @foreach($users as $i=>$user)   
  <tr>

	@if($user->id == $owner)
		<td class="highlight">{{$i+1}}</td>
		<td class="highlight">{{$user->name}}</td>
		<td class="highlight">{{$user->surname}}</td>
		<td class="highlight"></td>
	@else
	    <td>{{$i+1}}</td>
	    <td>{{$user->name}}</td>
	    <td>{{$user->surname}}</td>
	@endif
    @if(Auth::user()->role>2 && Auth::id()!=$owner)<td><a class="badge badge-danger" href="{{route('main')}}">Usuń</a></td>@else<td></td>@endif
  </tr>
  @endforeach
