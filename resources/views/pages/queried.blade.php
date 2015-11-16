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

	<h3 class="text-justify"><small>  To <mark>query </mark> a chart please enter <mark>q</mark> 
		and scan barcode of queried chart.<br>
		To <mark>resolve</mark> a query please enter <mark>r</mark> and scan barcode of queried chart.</small> </h3>
	{!! Form::open( ['method' => 'POST','action' => 'PagesController@queryChart', 'class' => 'trackClass']) !!}
		@include ('pages.partials.form',['submitButtonText' => 'Query The NHI'])
	{!! Form::close() !!}

@stop

