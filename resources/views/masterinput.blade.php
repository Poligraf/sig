<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--A track and trace application designed by Jovan Krstik "Poligraf" -->
<body OnLoad="document.getElementById('nhi').focus();">

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
   <script type="text/javascript" src="js/all.js"> </script> 
	</body>	
</html>
