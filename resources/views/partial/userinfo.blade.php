<div>
	<h3>{{$user->name . ' ' . $user->surname}}</h3>
	<h5>Dane:</h5>
	<p>Imię: {{$user->name}}</p>
	<p>Nazwisko: {{$user->surname}}</p>
	<p>Email: {{$user->email}}</p>
	<p>Nr albumu: {{$user->album}}</p>

	@if(Auth::user()->role==3)
	<form method="post" action="{{route('changerole', $user->id)}}">
		@csrf
		<label for="role">Zmień rolę</label>
		<select name="role">
			<option value="3">Administrator</option>
			<option value="2">Prowadzący</option>
			<option value="1">Student</option>
		</select>
		<button class="badge badge-primary" type="submit">Zmień</button>
	</form>
	@endif

	@if(isset($groups[0]))
	<h5>Należy do grup:</h5>
	<ul>
		@foreach($groups as $group)
		<li>{{ $group->name .  ' Instytut: ' . $group->institute . ' Rocznik:' . $group->year }}
			@switch($group->type)
				@case(1) Wykładowa @break
				@case(2) Ćwiczeniowa @break
				@case(3) Projektowa @break
				@case(4) Laboratoryjna @break
				@case(5) Seminaryjna @break
				@case(6) Inna @break
				@default Brak informacji
			@endswitch 
		</li>
		@endforeach
	</ul>
	@else
	<h5>Nie należy do żadnej grupy</h5>
	@endif
</div>