@section('content')

<div class="content-div">

    <div class="product_div">

        <!-- working with messages / success message when redirect -->
        <div id="display_message">
            @if(Session::has('message'))
            {{ Session::get('message') }}
            @endif

            @if( $errors->any() )
            <div class="alert alert-danger">
                <b>Error(s) encounter:</b> 

                @if($errors->has('password') && !$errors->has('fname'))
                Either password is empty or mismatch.
                @else
                Field indicated with (*) is required.
                @endif

            </div>
            @endif
        </div>

        <div class="pull-left" style="margin: 0 0 10px 0;">
            <a href="#addUserForm" id="addUser" data-toggle="modal" class="btn btn-primary btn-sm">
                <i class="glyphicon glyphicon-plus"></i> New User
            </a>
            <button type="button" data-toggle="modal" class="btn btn-danger btn-sm delete_selected" table="users">
                <i class="glyphicon glyphicon-minus"></i> Delete Selected
            </button>
        </div>

        <div style="margin: 20px 0 0 0;"></div>

        <table id="userTable" class="table table-bordered delete_enable_tbl simple_datatable" width="100%" cellspacing="0"> 
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Date joined</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($list as $key => $value)

                <tr class="user_row" id="{{ $value->id }}">
                    <td class="text-left">{{ ucwords($value->lname) . ", " . ucwords($value->fname) . " " .  ucwords(substr($value->mname, 0, 1)) }}.</td>
                    <td>{{ $value->address }}</td>
                    <td>{{ $value->username }}</td>
                    <td class="text-center">{{ CustomHelpers::format_date($value->created_at) }}</td>
                    <td>
                        @if( $value->user_role == 1 )
                        Admin
                        @else
                        User
                        @endif                                
                    </td>
                    <td>
                        <a href="#" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> | 
                        <a href="#" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Change Password"><i class="glyphicon glyphicon-lock"></i></a>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>


<!-- modal forms -->

<div class="modal fade" id="addUserForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="users/new" method="post" id="addUserForm">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="myModalLabel">New User</h4>
                </div>

                <div class="modal-body text-center">

                    <div class="addEditForm-width">

                        <div class="form-group clearfix">
                            <div class="edit_label">First Name <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('fname', '', array('class' => 'formInputs form-control', 'id' => 'fname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">Middle Name <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('mname', '', array('class' => 'formInputs form-control', 'id' => 'mname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">Last Name <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('lname', '', array('class' => 'formInputs form-control', 'id' => 'lname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">Username <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('username', '', array('class' => 'formInputs form-control', 'id' => 'username')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">Password <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::password('password', array('class' => 'formInputs form-control', 'id' => 'password')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">Re-type Password <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::password('password_confirmation', array('class' => 'formInputs form-control', 'id' => 're_password')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="edit_label">User Type <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                <select name="usertype" id="usertype" class="selectpicker" data-width="100%">
                                    <option value="">Select</option>
                                    <option value="1">Admin</option>
                                    <option value="0">Customer</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div id="error_div" class='pull-left'></div>
                    {{ Form::button('Close', array('class' => 'btn', 'data-dismiss' => 'modal', 'aria-hidden' => 'true')) }}
                    <button type="button" class="btn btn-primary save_button" data-loading-text="Saving...">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>


@stop