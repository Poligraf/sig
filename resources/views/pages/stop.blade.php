@extends('masterinput')


@section('title')

	{{ $recieved }}

@stop

@section('body')
@include('pages.partials.navigationbar')
<h1> Welcome to Silence is Golden (Sig) </h1>
	<h2> {{ $recieved }} </h2>
	
	{!! Form::open( ['method' => 'POST','action' => 'PagesController@updateNhi', 'class' => 'trackClass']) !!}
		@include ('pages.partials.form',['submitButtonText' => 'Update NHI with completed Time'])
	{!! Form::close() !!}

@stop

@section('script')
 <script type="text/javascript" src="js/all.js"> </script> 
 @stop