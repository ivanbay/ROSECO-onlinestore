@section('content')
	
	@if(Session::has('message'))
        {{ Session::get('message') }}
    @endif

	<div class="view_product">

		<h5><b>My Orders:</b></h5>

		<hr>

		<table border='0' width="700px;" id="tbl_order_list">

			<tr>
				<th>Order No.</th>
				<th>Date ordered</th>
				<th>Delivery Date</th>
				<th>Total</th>
				<th>Status</th>
				<th class="text-center">Action</th>
			</tr>

			@foreach( $orders as $order )

				<?php 
					$status = $order->status == 'New' ? 'Pending' : $order->status;
				?>

				<tr>
					<td>{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
					<td>{{ CustomHelpers::format_date($order->date_ordered) }}</td>
					<td>{{ CustomHelpers::format_date($order->delivery_date) }}</td>
					<td>Php {{ number_format($order->total, 2, '.', ',') }}</td>
					<td>{{ $status }}</td>
					<td class="text-center"><a href='{{ URL::to("order/view") }}/{{ $order->id }}'>View order</a>  					
				</tr>

			@endforeach

		</table>


	</div>

@stop