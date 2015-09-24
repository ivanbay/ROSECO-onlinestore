@section('content')
	
    <div class="view_product">

		<div style="margin: 0 0 20px 0;"> 
			<h5><a href="{{ URL::to('home')}}">Products</a> > <b>Order Form</b></h5>
		</div>

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


		{{ Form::open(array('url'=>'order/save', 'class' => 'form-horizontal', 'files' => true)) }}

            <div style="padding: 10px;">

                <div class="row">
                    <h5><i class="glyphicon glyphicon-user"></i> &nbsp;&nbsp;Personal Information</h5>
                    <hr>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left">
                                <div class="label_text">Last Name: <span class="text-danger">*</span></div>
                            </div>
                            <div class="col-sm-8">
                                {{ Form::text('last_name', $user->lname, array('class' => 'formInputs form-control', 'id' => 'last_name')) }}
                            </div>
                        </div> 

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left">
                                <div class="label_text">First Name: <span class="text-danger">*</span></div>
                            </div>
                            <div class="col-sm-8">
                                {{ Form::text('first_name', $user->lname, array('class' => 'formInputs form-control', 'id' => 'first_name')) }}
                            </div>
                        </div>

                    </div>

                </div>

                
                <div style="margin: 0 0 40px 0;"></div>

                <div class="row">
                    <h5><i class="glyphicon glyphicon-phone-alt"></i> &nbsp;&nbsp;Contact Information</h5>
                    <hr>
                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Mobile Number: <span class="text-danger">*</span></div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('mobile', '', array('class' => 'formInputs form-control', 'id' => 'mobile')) }}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Landline Number: <span class="text-danger"></span></div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('landline', '', array('class' => 'formInputs form-control', 'id' => 'landline', 'placeholder' => 'Area code + number')) }}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">E-mail Address: <span class="text-danger">*</span></div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('email', $user->email, array('class' => 'formInputs form-control', 'id' => 'email')) }}
                            </div>
                        </div>

                    </div>

                </div>

                
                <div style="margin: 0 0 40px 0;"></div>

                <div class="row">
                    <h5><i class="glyphicon glyphicon-plane"></i> &nbsp;&nbsp;Delivery Information</h5>
                    <hr>
                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Delivery Date:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('delivery_date', '', array('class' => 'formInputs form-control datepicker', 'id' => 'mobile')) }}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">House No:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('house_no', '', array('class' => 'formInputs form-control', 'id' => 'mobile')) }}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Street Address:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('street', '', array('class' => 'formInputs form-control', 'id' => 'landline')) }}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Brgy:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('house_no', '', array('class' => 'formInputs form-control', 'id' => 'mobile')) }}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">City</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('city', '', array('class' => 'formInputs form-control', 'id' => 'landline')) }}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Province:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('province', '', array('class' => 'formInputs form-control', 'id' => 'mobile')) }}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="pull-left" style="width: 150px;">
                                <div class="label_text">Postal/Zip Code:</div>
                            </div>
                            <div class="col-sm-6">
                                {{ Form::text('zip_code', '', array('class' => 'formInputs form-control', 'id' => 'landline')) }}
                            </div>
                        </div>

                    </div>

                </div>


                <div style="margin: 0 0 40px 0;"></div>
                

                <div class="row">
                    <h5><i class="glyphicon glyphicon-credit-card"></i> &nbsp;&nbsp;Payment method</h5>
                    <hr>
                </div>

                <p>Cash on delivery</p>


                <div style="margin: 0 0 40px 0;"></div>


                <div class="row">
                    <h5><i class="glyphicon glyphicon-shopping-cart"></i> &nbsp;&nbsp;Items on your cart</h5>
                    <hr>
                </div>

                <table border='0' width="700px;" id="tbl_order_list">
                    <tr>
                        <th>Product(s)</th>
                        <th class="text-center">Quantity</th>
                        <th>Price</th>
                        <th></th>
                        <th>Total</th>
                    </tr>
                    <tr><td>&nbsp;</td></tr>

                    <?php $total = array(); ?>

                    @foreach( App::make('CartController')->listItems() as $order_id => $order )

                        <tr>    
                            <td>{{ $order['prod_name'] }}</td>
                            <td class="text-center">{{ $order['qty'] }}</td>
                            <td width="100px">Php <div class="pull-right">{{ number_format($order['price'], 2, '.', ',') }}</div></td>
                            <td></td>
                            <td width="100px">Php <div class="pull-right">{{ number_format($order['qty'] * $order['price'], 2, '.', ',') }}</div></td>
                        </tr>

                        @if( !empty($order['part_name']) )

                            @foreach( $order['part_name'] as $part_name => $part_attr )
                                
                                @if( $part_name != NULL )
                                    <tr>
                                        <td style="padding: 0 0 0 20px;"><i class="glyphicon glyphicon-play"></i> {{ $part_name }} ({{ $part_attr['choice_name'] }})</td>
                                        <td class="text-center">1</td>
                                        <td>Php <div class="pull-right">{{ number_format($part_attr['choice_cost'], 2, '.', ',') }}</div></td>
                                        <td></td>
                                        <td>Php <div class="pull-right">{{ number_format($part_attr['choice_cost'], 2, '.', ',') }}</div></td>
                                    </tr>
                                @endif

                                <?php $total[] = $part_attr['choice_cost'];  ?>

                            @endforeach

                        @endif

                        <?php $total[] = $order['qty'] * $order['price']; ?>

                    @endforeach

                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="4"style="text-align: right;"><b>Total: &nbsp;</b> </td>
                            <td>Php <div class="pull-right">{{ number_format(array_sum($total), 2, '.', ',') }}</div></td>
                            {{ Form::hidden('total', array_sum($total)) }}
                        </tr>

                </table>

                <div class="row">
                    <div  style="margin: 20px 0 0 0;">
                        {{ Form::submit('Checkout', array('class' => 'btn btn-success btn-sm')) }}
                        <a href="{{ URL::to('cart') }}" class="btn btn-danger btn-sm">Cancel</a>
                    </div>
                </div>

            </div>

		{{ Form::close() }}

	</div>

@stop