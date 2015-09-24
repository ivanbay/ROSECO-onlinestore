<!-- MENU NAVIGATION -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">

    <div class="navbar-header">
      <a class="navbar-brand">Value Crops Incorporated</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li @if(Request::is('supplies/*')) {{ "class='active'" }} @endif ><a href="{{ URL::to('supplies/stock') }}">Supplies/Stocks</a></li>
            <li @if(Request::is('delivery') || Request::is('returned') || Request::is('delivery/*')) {{ "class='active'" }} @endif ><a href="{{ URL::to('delivery/') }}">Delivery</a></li>
            
            
              <li @if(Request::is('report') || Request::is('report/*')) {{ "class='active'" }} @endif ><a href="#report_gen_form" data-toggle="modal">Delivery Report</a></li>

            <li @if(Request::is('products') || Request::is('products/*')) {{ "class='active'" }} @endif ><a href="{{ URL::to('products/') }}">Products</a></li>
            
            @if( Auth::user()->usertype == 1 )
              <li @if(Request::is('users') || Request::is('users/*')) {{ "class='active'" }} @endif ><a href="{{ URL::to('users') }}">Manage Users/Stores</a></li>
              <li @if(Request::is('logs') || Request::is('logs/*')) {{ "class='active'" }} @endif ><a href="{{ URL::to('logs') }}">Activities/History</a></li>
            @endif
            
        </ul>
        
        @if(Auth::check())
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome {{ Auth::user()->username }}! <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('logout') }}">Log out</a></li>
                </ul>
            </li>
          </ul>
        @endif
        
    </div>
  </div>
</nav> 







<div class="modal fade" id="report_gen_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delivery Report Range</h4>
      </div>

      {{ Form::open(array('name' => 'report_form', 'url' => 'delivery/report', 'method' => 'post' )) }}

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