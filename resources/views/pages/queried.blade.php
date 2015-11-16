@extends('masterinput')

@section ('onload')
document.getElementById('nhi').focus();
@stop

@section('title')

	{{ $queried }}

@stop

@section('body')
@include('pages.partials.navigationbar')
<h1> Welcome to Silence is Golden (Sig) </h1>
	<h2> {{ $queried }} </h2>

	<h3 class="text-justify"><small>  To query a chart please enter a valid NHI followed by comma and  
		the letter q. (Example:<mark>abc1234,q</mark>).<br>To resolve a query please enter NHI followed 
		by comma and  the letter r. (Example:<mark>abc1234,r</mark>).   </small> </h3>
	{!! Form::open( ['method' => 'POST','action' => 'PagesController@queryChart', 'class' => 'trackClass']) !!}
		@include ('pages.partials.form',['submitButtonText' => 'Query The NHI'])
	{!! Form::close() !!}

@stop

