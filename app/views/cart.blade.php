@section('content')
	
	@if(Session::has('message'))
        {{ Session::get('message') }}
    @endif

	<div class="view_product">

		<div class="pull-right">
			<a href="{{ URL::to('home') }}">Continue shopping</a>  or 

			@if( !Auth::check() )
				Log in to proceed to order form
			@else

				@if( App::make('OrderController')->countOrders() != 0 )

					<a href="{{ URL::to('order/form') }}" class="btn btn-info btn-sm">Proceed to Order form</a>

				@else

					<span rel="tooltip" data-toggle="tooltip" data-placement="top" title="Empty cart. Unable to proceed."><button class="btn btn-info btn-sm" disabled="disabled">Proceed</button></span>

				@endif

			@endif

		</div>

		<h5><b>Items on your cart:</b></h5>

		<hr>

		{{ Form::open(array('url' => 'cart/delete')) }}

		<table border='0' width="700px;" id="tbl_order_list">
			<tr>
				<th style="text-align: center;">
					<button type="submit" style="background-color: #f6f6f6; border: none;" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to delete selected order(s)">
						<i class="glyphicon glyphicon-remove delete_order"></i>
					</button>
				</th>
				<th>Product(s)</th>
				<th class="text-center">Quantity</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
			<tr><td>&nbsp;</td></tr>

			<?php $total = array(); ?>

			@foreach( $orders as $order_id => $order )

				<tr>	
					<td style="text-align: center;">
						{{ Form::checkbox('delete_order[]', $order_id) }}
					</td>
					<td>{{ $order['prod_name'] }} @if( $order['color'] != NULL ) ( {{$order['color']}} ) @endif</td>
					<td class="text-center">{{ $order['qty'] }}</td>
					<td width="100px">Php <div class="pull-right">{{ number_format($order['price'], 2, '.', ',') }}</div></td>
					<td width="100px">Php <div class="pull-right">{{ number_format($order['qty'] * $order['price'], 2, '.', ',') }}</div></td>
				</tr>

				@if( !empty($order['part_name']) )

					@foreach( $order['part_name'] as $part_name => $part_attr )
						
						@if( $part_name != NULL )
							<tr>
								<td></td>
								<td style="padding: 0 0 0 20px;"><i class="glyphicon glyphicon-play"></i> {{ $part_name }} ({{ $part_attr['choice_name'] }})</td>
								<td class="text-center">1</td>
								<td>Php <div class="pull-right">{{ number_format($part_attr['choice_cost'], 2, '.', ',') }}</div></td>
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

		{{ Form::close() }}

	</div>

@stop