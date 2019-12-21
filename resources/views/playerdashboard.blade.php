@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/players/create" ><button type="button" class="btn btn-default">Create New</button></a><br>
                    <br><hr><br>
                    @if(count($players)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Player Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($players as $player)
                                <tr>
                                <td>{{$player->name}}</td>
                                <td><a href="/players/{{$player->id}}/edit" class="btn"><button type="button" class="btn btn-default">Edit</button></a></td>
                                <td>
                                    {!! Form::open(['action'=>['PlayersController@destroy',$player->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no players</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
