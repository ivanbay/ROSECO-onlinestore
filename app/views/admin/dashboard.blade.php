@section('content')
	
	<div class="content-div">

		<div id="highcharts_container" class="pull-left" style="height: 400px; width: 500px; margin: 0 10px 0 0;"></div>

		<div style="margin: 0 0 0 50px; padding: 0px;">

			<h5><b>New orders</b></h5>
			<hr>
			
			<table border="1" class="table table-bordered" style="width:500px" align="center" style="text-align: center;">

				<tr>
					<th class="text-center">Order No.</th>
					<th class="text-center">Date Ordered</th>
					<th class="text-center">Delivery Date</th>
					<th class="text-center">Total</th>
				</tr>

			@foreach( $new_orders as $order )

				<tr>
					<td><a href='{{ URL::to("admin/orders/view") }}/{{ $order->id }}' rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to view order" style="color: blue; cursor: pointer;">{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</a></td>
					<td>{{ CustomHelpers::format_date($order->date_ordered) }}</td>
					<td>{{ CustomHelpers::format_date($order->delivery_date) }}</td>
					<td>Php {{ number_format($order->total, 2, '.', ',') }}</td>
				</tr>

			@endforeach

			</table>

		</div>

	</div>

@stop