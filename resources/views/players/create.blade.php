@extends('layouts.app')

@section('content')
	<h1>Create Player</h1>
	{!! Form::open(['action' => 'PlayersController@store','method'=>'POST','enctype'=> 'multipart/form-data']) !!}
    	<div class="form-group">
    		{{Form::label('name','Name')}}
    		{{Form::text('name','',['class'=>'form-control','placeholder'=>'Enter Name'])}}
    	</div>
    	<div class="form-group">
    		{{Form::label('country','Country')}}
    		{{Form::text('country','',['class'=>'form-control','placeholder'=>'Country'])}}
    	</div>
    	<div class="form-group">
    		{{Form::label('age','Age')}}
    		{{Form::text('age','',['class'=>'form-control','placeholder'=>'Age'])}}
    	</div>
        <div class="form-group">
            {{Form::file('player_cover_image')}}
        </div>
    	{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
	{!! Form::close() !!}
	
	

@endsection