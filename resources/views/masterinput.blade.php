<!DOCTYPE html>
<!--A track and trace application designed by Jovan Krstik "Poligraf" -->


<html lang="en">
<head>
	<!--[if lte IE 9]>
<meta HTTP-EQUIV="REFRESH" content="0; url=/outdatedbrowser">
<![endif]-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>
		@yield('title')
	</title> 

	<link href="css/all.css" rel="stylesheet">
</head>

<body>
	@yield('body')

	<!--Ajax Call -->
	<div>
	<p id="info" class="alert alert-info" style="display: none;"> </p>
	</div>
	<script type="text/javascript" src="js/all.js"> </script> 

</body>	

</html>
