@section('content')
    
	<div class="content-div">

		<div class="product_div">

            <div class="pull-left" style="margin: 0 0 10px 0;">
                <a href="products/new" id="addUser" data-toggle="modal" class="btn btn-primary btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add Product
                </a>
                <button type="button" data-toggle="modal" class="btn btn-danger btn-sm delete_selected" table="products">
                    <i class="glyphicon glyphicon-minus"></i> Delete Selected
                </button>
            </div>

            <div class="clearfix"></div>

            <!-- working with messages / success message when redirect -->
            <div id="display_message">
                @if(Session::has('message'))
                    {{ Session::get('message') }}
                @endif
            </div>
            
            <div style="margin: 20px 0 0 0;"></div>

            <table id="userTable" class="table table-bordered simple_datatable delete_enable_tbl" width="100%" cellspacing="0"> 
                <thead>
                    <tr>
                    	<th>Product ID</th>
                    	<th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Dimensions</th>
                        <th>Colors</th>
                        <th>Cost</th>
                        <th>Stock</th>
                        <th>Customizable</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach( $products as $product )
                        <?php $customizable = $product->customizable == '1' ? 'Yes' : 'No'; ?>
                        <?php $low_stock = $product->stock >= 10 ? '' : '#ff8080' ?>

                        <tr style="background-color: {{ $low_stock }};" id="{{ $product->product_id }}">
                            <td>{{ str_pad($product->product_id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $product->name }}</td>
                            <td class="text-left">{{ $product->description }}</td>
                            <td class="text-left">{{ $product->category_name }}</td>
                            <td class="text-left">{{ $product->dimensions }}</td>
                            <td class="text-center">
                                    
                                   @if( $product->colors != '' )
                                        {{ $product->colors }}
                                   @else
                                        -
                                   @endif 

                            </td>
                            <td class="text-left">{{ number_format($product->cost, 2, '.', ',') }}</td>
                            <td class="text-center">{{ $product->stock }}</td>
                            <td>{{ $customizable }}</td>
                            <td>
                                <a href="products/edit/{{ $product->product_id }}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
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