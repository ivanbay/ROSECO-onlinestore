@section('content')
	

    @if(Session::has('message'))
        {{ Session::get('message') }}
    @endif


	{{ Form::open(array('url' => 'order/new')) }}

	<div class="view_product">

		<div class="clearfix"></div>

		<div class="alert alert-warning" style="margin: 20px 0 20px 0;">
			<b>{{ $products['name'] }}</b>

			<div class="pull-right">

				@if( $products['stock'] != 0 )

					<span class="text-success">{{ $products['stock'] }} stock(s) available.</span>

				@else

					<span class="text-danger">No stock(s) available.</span>

				@endif

			</div>

		</div>

		<div class="pull-left" style="margin: 0 20px 0 0;">
			
				<h4></h4>
				<h5>{{ $products['dimensions'] }}</h5>
				<h5>{{ $products['description'] }}</h5>
				
				<span class="text-danger">
					<h4><b>Php {{ number_format($products['cost'], 2, '.', ',') }}</b></h4>
				</span>

				{{ Form::hidden('product_id', $products['product_id']) }}
				{{ Form::hidden('name', $products['name']) }}
				{{ Form::hidden('price', $products['cost']) }}
				{{ Form::hidden('stocks', $products['stock']) }}

				{{ Form::text('qty', '', array('style' => 'width:30px;', 'placeholder' => 'Qty'))}}

				@if( $products['colors'] != '' )

					<?php $colors = array(); ?>

					@foreach( explode(";", $products['colors']) as $color )

						<?php $colors[$color] = $color; ?>

					@endforeach

					{{ Form::select('color', $colors) }}

				@endif

				@if( $products['stock'] != 0 )
					{{ Form::submit('Add to cart', array('class' => 'btn btn-warning btn-xs')) }}
				@else
					{{ Form::button('Add to cart', array('class' => 'btn btn-warning btn-xs', 'rel' => 'tooltip', 'rel' => 'tooltip', 'data-toggle' => 'tooltip',  'data-placement' => 'top', 'title' => 'Unable to add. No stocks available.')) }}
				@endif

			</div>

		@foreach( $products['product_img'] as $prod_img )

			<div id="prod_image" style="margin: 0 10px 50px 0;">
				<div class="image">
					{{ HTML::image('product_images/' . $prod_img, '...', array('class' => 'img-thumbnail', 'width' => '150px')) }}
				</div>
			</div>

		@endforeach


		<div class="clearfix"></div>

		@if( isset($products['parts']) )

			<div class="alert alert-warning">
				<b>Customize your own</b>
			</div>

			@foreach( $products['parts'] as $part_id => $parts )

				@foreach( $parts as $part_name => $part_images )

					<div class="alert alert-info">{{ $part_name }}</div>

					@foreach( $part_images as $choice_id => $choice_attr )

						<div style="position: relative; float: left; margin: 0 0 10px 10px;"> 
                            {{ HTML::image('choices_images/' . $choice_attr['filename'], '...', array('class' => 'img-thumbnail', 'width' => '100px')) }}
                            {{ Form::radio('parts['.$part_id.']', $choice_id, false, array('style' => 'position: absolute; left: 0;')) }}
                            <div class="text-center"><b>{{ $choice_attr['name'] }}</b></div>
                            <div class="text-center">Php {{ number_format($choice_attr['cost'], 2, '.', ',') }}</div>
                        </div>

					@endforeach

					<div class="clearfix"></div>

				@endforeach

			@endforeach


		@endif


	</div>

	{{ Form::close() }}

@stop