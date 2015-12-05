@extends('masterinput')



@section('title')

	{{ $notification }}

@stop
 

@section('body')
@include('pages.partials.navigationbar')
<h1> Welcome to Silence is Golden (Sig) </h1>
	<h2> {{ $notification }} </h2>
    
	{!! Form::open(['class' => 'trackClass'])!!}
		@include ('pages.partials.form',['submitButtonText' => 'Insert NHI to Database'])
	{!! Form::close() !!}

@stop

