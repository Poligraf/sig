<!DOCTYPE html>
<!--A track and trace application designed by Jovan Krstik "Poligraf" -->


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>
		@yield('title')
	</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/all.css" rel="stylesheet">
</head>
	<body>
		@yield('body')
	@if(Session::get('error'))
		<p class="alert alert-info">{{Session::get('error')}} </p>
	@endif	

	@if ($errors->any())
		
			@foreach ($errors->all() as $error)
			<p class="alert alert-info"> {{$error}} </p>
			@endforeach
		 
	@endif
  	<!--Ajax Call -->
  	<div>
		<p id="info" class="alert alert-info" style="display: none;"> </p>
	</div>
	
	</body>	
	@yield('script')
	<!--<script type="text/javascript" src="js/all.js"> </script> -->
</html>
