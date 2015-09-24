<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="description" content="Delsa Enterprises">
	<meta name="build_date" content="July 8, 2014">
	<meta name="author" content="Ivan Paul Bay">
	<title>ROSECO Marketing Venture</title>

    {{ HTML::style('assets/bootstrap3/css/bootstrap.css') }}
	{{ HTML::style('assets/jquery.datatables/css/jquery.dataTables.css') }}
    {{ HTML::style('assets/datatables.bootstrap/css/dataTables.bootstrap.css') }}
	{{ HTML::style('assets/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('assets/jquery.datetimepicker/css/jquery.datetimepicker.css') }}
    {{ HTML::style('assets/bootstrap-select/css/bootstrap-select.css') }}
    {{ HTML::style('assets/iCheck/skins/square/blue.css') }}

	{{ HTML::style('assets/custom_style/css/style.css') }} <!-- common style -->

	{{ HTML::script('assets/jquery/jquery-2.1.1.min.js') }}
	{{ HTML::script('assets/jquery.datatables/js/jquery.dataTables.js') }}
	{{ HTML::script('assets/bootstrap3/js/bootstrap.js') }}
    {{ HTML::script('assets/datatables.bootstrap/js/dataTables.bootstrap.js') }}
    {{ HTML::script('assets/datatables.bootstrap/js/jquery-DT-pagination.js') }}
    {{ HTML::script('assets/bootbox/js/bootbox.min.js') }}
	{{ HTML::script('assets/custom_style/js/myscripts.js') }}
    {{ HTML::script('assets/jquery.datetimepicker/js/jquery.datetimepicker.js') }}
    {{ HTML::script('assets/bootstrap-select/js/bootstrap-select.js') }}
    {{ HTML::script('assets/iCheck/js/icheck.js') }}

    

	<script type = "text/javascript" >

		// uncomment this function to prevent back button going inside the system after lougout

	   /*function preventBack(){window.history.forward();}

	    setTimeout("preventBack()", 0);

	    window.onunload=function(){null};*/

	</script>


</head>


<body>

	<div class="container">
		
		<div id="header">
		
			@include('layouts.header')

		</div>


		<div id="left_navigation">
		
			@include('layouts.left_nav')

		</div>

		<div id="main_content">

			@yield('content')

		</div>
	
	</div>
    

</body>


</html>
