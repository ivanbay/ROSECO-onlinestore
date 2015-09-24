<div id="login_form">

	@if( Auth::check() )
		
		<div style="margin: 0 0 20px 0;">
			Welcome <b>{{ Auth::user()->username }}</b>!
		</div>

		<a href="{{ URL::to('home') }}">Home</a><br>
		<a href="{{ URL::to('cart') }}">My cart</a><br>
		<a href="{{ URL::to('order/list') }}">My Orders</a><br>
		<a href="{{ URL::to('logout') }}">Logout</a>

	@else

		<label>Customer Login:</label>

		@if( Session::has('login_error') )
			{{ Session::get('login_error') }}
		@endif


		{{ Form::Open(array('url' => 'login')) }}

			<div class="form-group">
				{{ Form::text('username', '', array("placeholder" => "Username", "class" => "login_formInputs form-control")) }}
			</div>

			<div class="form-group">
				{{ Form::password('password', array("placeholder" => "Password", "class" => "login_formInputs form-control")) }}
			</div>

			<a href="{{ URL::to('user/register') }}">Register</a>

			<div class="form-group pull-right">
			 	{{ Form::submit('Login', array('class' => 'btn btn-info btn-sm')) }}
			</div>

		{{ Form::close() }}

		<div class="clearfix"></div>

		<hr>

	@endif

</div>
