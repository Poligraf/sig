<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--A track and trace application designed by Jovan Krstik "Poligraf" -->
<body OnLoad="@yield('onload')">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="15" >
	<title>
		{{ $notification }}
	</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/all.css" rel="stylesheet">
<style>
.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
  background-color: #337ab7;
  color:#000000;
}

 </style>

</head>




<body>

<table class="table table-striped table-bordered table-hover table-condensed ">
<th colspan="6" class="text-center">{{ $notification }}<br> Ward:{{App\Http\Utilities\Ward::getwardname(\Input::get('ward'))}}</th>
	<tr > 
		<td class="text-center col-md-2"> NHI </td> 
		<td class="text-center col-md-2"> Ward </td> 
		<td class="text-center col-md-2"> Last Status Update </td> 
		<td class="text-center col-md-2"> Chart Received <br>
			<form>
				<select name="ward">
			@foreach (App\Http\Utilities\Ward::all() as $code => $wardname)
				
				<option value="{{$code }}" >{{ $wardname}} </option>
			@endforeach
			</select>
  			<input type="submit" value="Filter By Ward" >
			</form>
		</td> 
		<td class="text-center col-md-2"> Chart Completed</td>
		<td class="text-center col-md-2"> Query</td>
	</tr>
	 @foreach ($fields as $field)
<tr class="{{$field->chart_query ? 'danger': ''}}"> <td class="text-left col-md-2"> {{ $field-> nhi}} </td>
	 <td class="text-right col-md-2"> {{ $field-> ward}} </td>
	 <td class="text-right col-md-2"> {{ $field-> status}} {{ $field-> updated_at-> diffForHumans() }}</td>
	 <td class="text-right col-md-2"> {{ $field-> receival_time-> format('H:i')}} </td>
 	 <td class="text-right col-md-2"> 
 	 	@if(!empty($field-> completed_time))
			{{$field-> completed_time-> format('H:i')}}
		@else
			In Progress	
		@endif 
	</td>
	<td class="text-right col-md-2"> {{ $field-> chart_query ? 'Chart Queried' : 'No Issues'}} </td>


	
</tr>
@endforeach
</table>
    <script type="text/javascript" src="js/status.js"></script>
	</body>	
</html>




