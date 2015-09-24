@section('content')
	
    @if(Session::has('message'))
        {{ Session::get('message') }}
    @endif
    
	<div class="view_product">

		<div style="margin: 0 0 20px 0;"> 
            <div class="pull-left">
                <h5>Order no: <b>{{ str_pad($order['order_info']['order_id'], 4, '0', STR_PAD_LEFT) }}</b></h5>
                Status: <b>@if( $order['order_info']['status'] == 'New' ) Pending @else {{ $order['order_info']['status'] }} @endif </b>
            </div>
            <div class="text-right">
                <a href="{{ URL::to('order/list') }}">My orders</a> | 
                @if( $order['order_info']['status'] == 'Canceled' )
                    <a class="btn btn-danger btn-sm" disabled="disabled">Order Canceled</a>
                @else
                    <a href="#cancelOrderForm" id="cancelOrder" order_id="{{ $order['order_info']['order_id'] }}" data-toggle="modal" class="btn btn-danger btn-sm">Cancel Order</a>
                @endif
            </div>
		</div>

        <div class="clearfix" style="padding: 30px 10px;">

            <div class="row">
                <h5><i class="glyphicon glyphicon-user"></i> &nbsp;&nbsp;Personal Information</h5>
                <hr>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Name:</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['lastname'] }}, {{ $order['order_info']['firstname'] }} 
                </div>
            </div> 

            <br>

            <div class="row">
                <h5><i class="glyphicon glyphicon-phone-alt"></i> &nbsp;&nbsp;Contact Information</h5>
                <hr>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Mobile Number</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['mobile'] }}
                </div>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Landline Number:</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['landline'] }}
                </div>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">E-mail Address:</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['email'] }}
                </div>
            </div>

            <br>

            <div class="row">
                <h5><i class="glyphicon glyphicon-plane"></i> &nbsp;&nbsp;Delivery Information</h5>
                <hr>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Deliver On:</div>
                </div>
                <div class="col-sm-6">
                    {{ CustomHelpers::format_date($order['order_info']['delivery_date']) }}
                </div>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Deliver to:</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['lastname'] }}, {{ $order['order_info']['firstname'] }} 
                </div>
            </div>

            <div class="row">
                <div class="pull-left" style="width: 150px;">
                    <div class="label_text">Deliver at:</div>
                </div>
                <div class="col-sm-6">
                    {{ $order['order_info']['house_no'] }} {{ $order['order_info']['street'] }} {{ $order['order_info']['brgy'] }} {{ $order['order_info']['city'] }}<br>
                    {{ $order['order_info']['province'] }}, Philippines<br>
                    {{ $order['order_info']['zip_code'] }}
                </div>
            </div>


            <br>

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

                @foreach( $order['items'] as $order_id => $order )

                    <tr>    
                        <td>{{ $order['prod_name'] }} @if( $order['color'] != NULL ) ( {{$order['color']}} ) @endif </td>
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
                    </tr>

            </table>

        </div>

	</div>


    <div class="modal fade" id="cancelOrderForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            <form action="{{ URL::to('order/cancel') }}" method="post">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="myModalLabel">Cancel Order</h4>
                </div>

                <div class="modal-body text-center">

                    <div class="addEditForm-width">

                        {{ Form::hidden('cancel_order_id', '') }}

                        <div class="form-group clearfix">
                           <div class="edit_label">Reason for cancelation:</div>
                            <div class="edit_field">
                                {{ Form::textarea('cancelation_reason', '', array('class' => 'formInputs form-control')) }}
                            </div>
                        </div>

                        <div class="form-group clearfix">
                           <div class="edit_label">&nbsp;</div>
                            <div class="edit_field">
                                <p style="color: gray; text-align: right; font-style: italic; font-size: 10px;">Maximum of 150 characters.</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div id="error_div" class='pull-left text-danger'></div>
                    {{ Form::button('Close', array('class' => 'btn', 'data-dismiss' => 'modal', 'aria-hidden' => 'true')) }}
                    <button type="button" class="btn btn-primary cancel_order_btn" data-loading-text="Canceling...">Proceed</button>
                </div>

            </form>

            </div>
        </div>
    </div>

@stop