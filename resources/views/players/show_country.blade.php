@extends('layouts.app')

@section('content')
	<h1>{{$player->country}}</h1>
	
	@extends('layouts.app')

@section('content')
	<h1>Player list</h1>
	
	@if (count($players)>0)
		<ul class="list-group">
		@foreach ($players as $player)
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-8 col-sm-8">
						<h3><a href="/players/{{$player->id}}">{{ $player->name}}</a></h3>
						
					</div>
				</div>
				
			</li>
		@endforeach
		
		</ul>
	@else
		<p>No posts found</p>
	@endif

@endsection

@endsection