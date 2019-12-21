@extends('layouts.app')

@section('content')
	<h1>Player list</h1>
	
	@if (count($players)>0)
		<ul class="list-group">
		@foreach ($players as $player)
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<img style="width: 100%" src="/storage/player_cover_images/{{$player->player_cover_image}}">
					</div>
					<div class="col-md-8 col-sm-8">
						<h3><a href="/players/{{$player->id}}">{{ $player->name}}</a></h3>
						<small>Created on {{$player->created_at}} by {{$player->user->name}}</small>
					</div>
				</div>
				
			</li>
		@endforeach
		
		</ul>
	@else
		<p>No posts found</p>
	@endif

@endsection