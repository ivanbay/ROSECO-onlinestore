@section('content')

	<div class="content-div">

	<div style="margin: 0 0 20px 0;">
		<a href="#report_gen_form" data-toggle="modal" class="btn btn-info btn-sm">Generate report</a>
	</div>

	<div id="report_graph" style="height: 400px"></div>

	</div>


	<div class="modal fade" id="report_gen_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Choose Data Range</h4>
	      </div>

	      {{ Form::open(array('name' => 'report_form', 'url' => 'admin/report', 'method' => 'post' )) }}

	          <div class="modal-body">

	            <div class="row">
	                <div class="col-xs-6">
	                    {{ Form::text('date_from', '', array('class' => 'form-control datepicker', 'placeholder' => 'Date From', 'id' => 'date_from')) }}
	                </div>
	                <div class="col-xs-6">
	                    {{ Form::text('date_to', '', array('class' => 'form-control datepicker', 'placeholder' => 'Date To', 'id' => 'date_to')) }}
	                </div>
	            </div>

	          </div>
	          <div class="modal-footer">
	            <span class="text-danger pull-left" id="error_msg"></span>
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	            <button type="submit" class="btn btn-primary gen_report_btn">Generate Report</button>
	          </div>

	      {{ Form::close() }}

	    </div>
	  </div>
	</div>

@stop