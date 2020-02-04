  @foreach($users as $i=>$user)   
  <tr>

	@if($user->id == $owner)
		<td class="highlight">{{$i+1}}</td>
		<td class="highlight">{{$user->name}}</td>
		<td class="highlight">{{$user->surname}}</td>
		<td class="highlight"></td>
		<td class="highlight"></td>
	@else
	    <td>{{$i+1}}</td>
	    <td>{{$user->name}}</td>
	    <td>{{$user->surname}}</td>
	    @if(Auth::user()->role>=2)<td>{{$user->album}}</td>@endif
	@endif
    @if(Auth::user()->role>=2 && $user->id!=$owner)<td><form method="post" action="{{route('groups.deletefrom',[$gid,$user->id])}}">@csrf <input type="submit" class="btn btn-danger" value="Usuń"></form></td>@else<td></td>@endif
  </tr>
  @endforeach
