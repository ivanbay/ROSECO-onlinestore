@section('content')

	<div class="content-div">

		{{ Form::open(array('url' => 'admin/report/download')) }}

			{{ Form::hidden('date_from', Input::get('date_from')) }}
			{{ Form::hidden('date_to', Input::get('date_to')) }}
			<button style="background-color: none; border: none;" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Download PDF">{{ HTML::image('assets/img/pdf.png', 'logo', array('width' => "30px")) }}</button>

		{{ Form::close() }}

		<div class="row text-center" style="margin: 0 0 50px 0;">
			{{ HTML::image('assets/img/logo.png', 'logo', array('width' => "200px")) }}
			<h4> ROSECO Marketing Venture</h4>
			Report range: <b>{{ date("M d, Y", strtotime(Input::get('date_from'))) }}</b> to <b>{{ date("M d, Y", strtotime(Input::get('date_to'))) }}</b>
		</div>

		<table border="0" cellpadding="2" class="table table-bordered">
			
			@if( !empty($report) )

				<tr>
					<th rowspan="2" class="text-center">Product Name</th>
					<th colspan="{{ count(array_unique($report['date'])) }}" class="text-center">Total</th>
				</tr>
				<tr>
					@foreach( array_unique($report['date']) as $date )

						<th class="text-center">{{ date("M d, Y", strtotime($date)) }}</th>

					@endforeach
				</tr>

				<?php $totals = array(); ?>

				@foreach( $report['main_record'] as $value)

					<tr>
						<td class="text-left">{{ $value->prod_name }}</td>
					
					@foreach( array_unique($report['date']) as $date )
					
						@if( $date == $value->date_order )
							<td class="text-left">Php {{ number_format($value->total, 2, '.', ',') }}</td>
							<?php $totals[$date][] = $value->total; ?>
						@else
						 	<td>&nbsp;</td>
						@endif

					@endforeach
					</tr>

				@endforeach

				<tr>
					<td class="text-left">
						<b>Total:</b>
					</td>

					@foreach( array_unique($report['date']) as $date )

						<td class="text-left">Php {{ number_format(array_sum($totals[$date]), 2, '.', ',') }}</td>

					@endforeach

				</tr>

			@else

				<div class="alert alert-danger text-center">No records found. Please try to modify your filter.</div>

			@endif

		</table>

		<div class="row text-center" style="margin: 50px 0 0px 0;">
			{{ HTML::image('assets/img/logo2.png', 'logo', array('width' => "300px")) }}
		</div>

	</div>

@stop