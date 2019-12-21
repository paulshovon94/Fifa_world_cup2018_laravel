@extends('layouts.app')
@section('content')
	<a href="/players" class="btn"><button type="button" class="btn btn-default">Go Back</button></a>
	<h1>{{$player->country}}</h1>
	<img style="width: 100%" src="/storage/player_cover_images/{{$player->player_cover_image}}">
	<h3>{{$player->name}}</h3>
	<h5>Age: {{$player->age}}</h5>
	<hr>
	<small>Created on {{$player->created_at}} by {{$player->user->name}}</small>
	<hr>
	@if(!Auth::guest())
		@if(Auth::user()->id == $player->user_id)
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	            <div class="container">
	                <a href="/players/{{$player->id}}/edit" class="btn"><button type="button" class="btn btn-default">Edit</button></a>

	                <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                    <!-- Left Side Of Navbar -->
	                    <ul class="navbar-nav mr-auto">

	                    </ul>

	                      <ul class="navbar-nav mr-auto">
	                        <li class="nav-item "><a class="nav-link" href="/">Stadiums<span class="sr-only"></span></a></li>
	                        <li class="nav-item"><a class="nav-link" href="/players">Players<span class="sr-only"></span></a></li>
	                        <!--<li class="nav-item"><a class="nav-link" href="/services">Services</a></li>-->

	                      </ul>
	                      <!--<ul class="navbar-nav navbar-right">
	                        <li><a class="nav-link" href="/posts/create">Create Post</a></li>
	                      </ul>-->

	                    <!-- Right Side Of Navbar -->
	                    <ul class="navbar-nav ml-auto">
	    				<!-- Authentication Links -->
	    				{!! Form::open(['action'=>['PlayersController@destroy',$player->id],'method'=>'POST','class'=>'pull-right'])!!}
						{{Form::hidden('_method','DELETE')}}
						{{Form::submit('delete',['class'=>'btn btn-danger'])}}
						{!!Form::close()!!}
						</ul>
	                </div>
	            </div>
	        </nav>
        @endif
	@endif
	

@endsection