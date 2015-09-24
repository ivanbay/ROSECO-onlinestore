<!-- MENU NAVIGATION -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">

    <div class="navbar-header">
      <a class="navbar-brand">ROSECO Marketing Venture</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

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

