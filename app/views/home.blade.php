@section('content')
	
	@foreach( $products as $category => $arr_values )
	
		<div id="category_div">

			<div class="alert alert-info">
				<b>{{ $category }}</b> <div class="pull-right">({{ count($arr_values) }} items)</div>
			</div>

			@foreach( $arr_values as $product_id => $value )
				
				<div id="prod_image">
					<div class="image">
						<a href="product/view/{{$product_id}}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to view product"> 
							{{ HTML::image('product_images/' . $value['product_image'], '...', array('class' => 'img-thumbnail', 'width' => '300px')) }}
						</a>
					</div>
					<div class="desc text-center">
						<b>{{ $value['name'] }}</b><br>
						<b>Php {{ number_format($value['cost'], 2, '.', ',') }}</b>
					</div>
				</div>

			@endforeach

			<div class="clearfix"></div>

		</div>


	@endforeach

@stop