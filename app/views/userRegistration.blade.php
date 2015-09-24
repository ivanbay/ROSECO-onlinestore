@section('content')
	
    <!-- working with messages / success message when redirect -->
    <div id="display_message">
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif

       @if( $errors->any() )
            <div class="alert alert-danger">
                <b>Error(s) encounter:</b> 
                <ul>
                @foreach( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>
    
	<div class="view_product">


		{{ Form::open(array('url'=>'user/new', 'class' => 'form-horizontal', 'files' => true)) }}

            <div style="padding: 10px;">

                <div class="row">
                    <h5><i class="glyphicon glyphicon-user"></i> &nbsp;&nbsp;User Registration</h5>
                    <hr>
                </div>

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Last Name: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('lastname', '', array('class' => 'formInputs form-control', 'id' => 'lname')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">First Name: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('firstname', '', array('class' => 'formInputs form-control', 'id' => 'fname')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Middle Name: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('middlename', '', array('class' => 'formInputs form-control', 'id' => 'mname')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Email: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('email', '', array('class' => 'formInputs form-control', 'id' => 'email')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Username: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text('username', '', array('class' => 'formInputs form-control', 'id' => 'username')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Password: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::password('password', array('class' => 'formInputs form-control', 'id' => 'password')) }}
                    </div>
                </div> 

                <div class="row">
                    <div class="pull-left" style="width: 150px;">
                        <div class="label_text">Re-type Password: <span class="text-danger">*</span></div>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::password('password_confirmation', array('class' => 'formInputs form-control', 'id' => 'password')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="pull-left text-right" style="width: 150px;">
                        {{ Form::checkbox('newsletter_chk') }}
                    </div>
                    <div class="col-sm-6">
                        Send me updates and newsletters.
                    </div>
                </div>

                <div class="row">
                    <div class="pull-left text-right" style="width: 150px;">
                        {{ Form::checkbox('read_terms') }}
                    </div>
                    <div class="col-sm-6">
                        I have read and understood <a href="{{ URL::to('user/terms') }}">ROSECO Marketing Venture Terms</a> and <a href="{{ URL::to('user/terms') }}">Privacy Policy</a>
                    </div>
                </div>

                <div class="row">
                	{{ Form::submit('Register', array('class' => 'btn btn-success btn-sm register_btn', 'disabled' => 'disabled')) }}
                </div>

            </div>

		{{ Form::close() }}

	</div>

@stop