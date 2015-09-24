@section('content')

	<div id="home-content">

		<div id="login_header">
			{{ HTML::image('assets/img/logo.png', 'logo', array('width' => "400px")) }}
		</div>

		<div id="login_content">

			<div id="loginForm">

				<div class="login_label"><span class="glyphicon glyphicon-lock"></span> Admin Log in</div>

				<!-- working with messages / success message when redirect -->
			    <div id="error_message" style="margin:0px auto;">
			        @if(Session::has('message'))
			            {{ Session::get('message') }}
			        @endif

			        @if( $errors->any() )
			        	<div class="alert alert-danger text-left" role="alert">
			        		<div><b>Errors found:</b></div>
			        		<ul>
					        	@foreach( $errors->all() as $error_mess )
					        		<li>{{ $error_mess }}</li>
					        	@endforeach
					        </ul>
			        	</div>
			        @endif
			    </div>

				

				{{ Form::open(array('url'=>'admin/login')) }}

				<div class="input-group" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Username">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					{{ Form::text('username', '', array("placeholder" => "Username", "class" => "login_formInputs form-control")) }}
				</div>

				<div class="input-group" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Password">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					{{ Form::password('password', array("placeholder" => "Password", "class" => "login_formInputs form-control")) }}
				</div>

				<div class="loginButton">
					{{ Form::submit('Login', array("class" => "btn btn-info", "style" => "width: 100px;")) }}
				</div>

				<div class="clearfix"></div>

				{{ Form::close() }}
				
			</div>

		</div>

		<div id="login_header" style="margin: 20px 0 0 0;">
			{{ HTML::image('assets/img/logo2.png', 'logo', array('width' => "400px")) }}
		</div>

	</div>



@stop 