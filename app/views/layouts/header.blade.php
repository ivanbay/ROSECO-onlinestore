<div id="header_logo">

	{{ HTML::image('assets/img/logo2.png', '...', array('width' => '600px')) }}
	{{ HTML::image('assets/img/logo.png', '...', array('width' => '500px')) }}

</div>

<div class="pull-right">

	<a href="{{ URL::to('cart') }}" style="color: black;" rel="tooltip" data-toggle="tooltip" data-placement="top" title="My Cart" >
		<i class="glyphicon glyphicon-shopping-cart" style="font-size: 20px;"></i>
		Item(s) : <b>{{ App::make('OrderController')->countOrders() }}</b>
	</a>

</div>

<div class="clearfix"></div>

<hr>

