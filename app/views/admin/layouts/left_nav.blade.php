<!-- sidebar -->
<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
  
  	<ul class="nav">
			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
	</ul>
   
    <ul class="nav hidden-xs" id="lg-menu">
        <li><a href="#featured"><i class="glyphicon glyphicon-list-alt"></i> Featured</a></li>
        <li @if( Request::is('admin/dashboard') ) class="active" @endif><a href="{{ URL::to('admin/dashboard') }}"><i class="glyphicon glyphicon-th-large"></i> &nbsp; Dashboard</a></li>
        <li @if( Request::is('admin/users') ) class="active" @endif><a href="{{ URL::to('admin/users') }}"><i class="glyphicon glyphicon-user"></i> &nbsp; Users</a></li>
        <li @if( Request::is('admin/products') || Request::is('admin/products/*') ) class="active" @endif><a href="{{ URL::to('admin/products') }}"><i class="glyphicon glyphicon-tags"></i> &nbsp; Products</a></li>
        <li @if( Request::is('admin/orders/list') || Request::is('admin/orders/*/*') ) class="active" @endif><a href="{{ URL::to('admin/orders/list/new') }}"><i class="glyphicon glyphicon-tasks"></i> &nbsp; Orders @if( App::make('commonController')->countNewOrders() != 0 ) <span class="badge pull-right" style="background-color: #d58512;">{{ App::make('commonController')->countNewOrders() }}</span> @endif</a></li>
        <li @if( Request::is('admin/report') || Request::is('admin/report/*') ) class="active" @endif><a href="{{ URL::to('admin/report/graph') }}"><i class="glyphicon glyphicon-folder-open"></i> &nbsp; Reports</a></li>
    </ul>
  
    <ul class="list-unstyled hidden-xs" id="sidebar-footer">
        <li>
          {{ HTML::image('assets/img/logo.png', 'logo', array('width' => "200px")) }}
        </li>
    </ul>

</div>
<!-- /sidebar -->
          



        