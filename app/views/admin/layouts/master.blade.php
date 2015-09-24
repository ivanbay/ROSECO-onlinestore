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

	@if(Request::is('*/login')) 
		{{ HTML::style('assets/custom_style/css/login_style.css') }} <!-- Login style -->
	@else
		{{ HTML::style('assets/custom_style/css/style.css') }} <!-- common style -->
		{{ HTML::style('assets/custom_style/css/left_nav.css') }} <!-- common style -->
	@endif

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

    {{-- HIGHCHARTS --}}
    {{ HTML::script('assets/highcharts/highcharts.js') }}
    {{ HTML::script('assets/highcharts/highcharts-3d.js') }}
    {{ HTML::script('assets/highcharts/modules/exporting.js') }}
    

	<script type = "text/javascript" >


	</script>


</head>


<body>


	@if( Request::is('admin/login') )

		@yield('content')

	@else

		@include('admin.layouts.header')
		
		<div class="box">
        	<div class="row row-offcanvas row-offcanvas-left">

        		@include('admin.layouts.left_nav')

        		<!-- main right col -->
				<div class="column col-sm-10 col-xs-11" id="main">
				    
				    <div style="margin: 50px 0 0 0;">
						@yield('content')
					</div>

				</div>
				<!-- /main -->

        	</div>
        </div>

	@endif

    
    

</body>


</html>
