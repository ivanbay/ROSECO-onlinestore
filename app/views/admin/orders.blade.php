@section('content')
    
    <div id="display_message" style="min-height: 45px;">
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif
    </div>

	<div class="content-div">

		<div class="product_div">

            <ul class="nav nav-tabs" role="tablist">
                <li @if( Request::is('admin/orders/list/new') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/new') }}">New</a></li>
                <li @if( Request::is('admin/orders/list/canceled') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/canceled') }}">Canceled</a></li>
                <li @if( Request::is('admin/orders/list/approved') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/approved') }}">Approved</a></li>
                <li @if( Request::is('admin/orders/list/disapproved') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/disapproved') }}">Disapproved</a></li>
                <li @if( Request::is('admin/orders/list/delivered') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/delivered') }}">Delivered</a></li>
                <li @if( Request::is('admin/orders/list/deleted') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/deleted') }}">Deleted/Trash</a></li>
            </ul>

            <div class="clearfix"></div>

            <!-- working with messages / success message when redirect -->
            {{-- <div id="display_message">
                @if(Session::has('message'))
                    {{ Session::get('message') }}
                @endif
            </div> --}}
            
            <div style="margin: 20px 0 0 0;"></div>

            <table id="userTable" class="table table-bordered simple_datatable" width="100%" cellspacing="0"> 
                <thead>
                    <tr>
                    	<th>Order No.</th>
                    	<th>Customer</th>
                        <th>Date Ordered</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach( $orders as $order )  

                        <tr id="{{ $order->id }}">
                            <td><a href='{{ URL::to("admin/orders/view") }}/{{ $order->id }}' rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to view order" style="color: blue; cursor: pointer;">{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</a></td>
                            <td>{{ $order->lastname }}, {{ $order->firstname . " " . $order->middlename }}</td>
                            <td>{{ customHelpers::format_datetime($order->date_ordered) }}</td>
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
                    <h4 id="myModalLabel">Add new product</h4>
                </div>

                <div class="modal-body text-center">

                    <div class="addEditForm-width">

                    	<div class="form-group clearfix">
                           <div class="edit_label">Product Name <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('fname', '', array('class' => 'formInputs form-control', 'id' => 'fname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                           <div class="edit_label">Product Description <span class="text-danger"></span></div>
                            <div class="edit_field">
                                {{ Form::text('mname', '', array('class' => 'formInputs form-control', 'id' => 'mname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                           <div class="edit_label">Unit Price <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('mname', '', array('class' => 'formInputs form-control', 'id' => 'mname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                           <div class="edit_label">Quantity <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('lname', '', array('class' => 'formInputs form-control', 'id' => 'lname')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                           <div class="edit_label">Stocks Available <span class="text-danger">*</span></div>
                            <div class="edit_field">
                                {{ Form::text('username', '', array('class' => 'formInputs form-control', 'id' => 'username')) }}
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