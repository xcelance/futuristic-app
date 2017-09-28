<header>
	<div class="container">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="logo-outer"><a class="navbar-brand" href="{{ url('/') }}">Neuraloop </a></div>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		      	@if(isset(Auth::user()->id))
		      		@if(Auth::user()->role == '1')		      				      		
			      		<li><a href="{{ url('myvideos') }}">Videos</a></li>
			      		<li><a href="{{ url('mymusic') }}">Music</a></li>
			      		<li><a href="{{ url('mypictures') }}">Pictures</a></li>
			      		<li><a href="{{ url('myfaces') }}">Faces</a></li>
			      		<li><a href="#">Hi, {{Auth::user()->firstName}}</a></li>
			      		<li class="dropdown menu-dropdown-01">
						    <button class="btn carret-btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
						    <span class="caret"></span></button>
						    <ul class="dropdown-menu">
						    	<li><a href="{{ url('profile') }}">Profile</a></li>
						      	<li><a href="{{ url('logout') }}">Logout</a></li>					      
						    </ul>
						</li>
					@elseif(Auth::user()->role == '2')
						<li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
						<li><a href="{{ url('/admin/audios') }}">Music</a></li>
			      		<li><a href="{{ url('/admin/pictures') }}">Pictures</a></li>
			      		<li><a href="{{ url('/admin/users') }}">Users</a></li>
						<li><a href="{{ url('/admin/videos') }}">Videos</a></li>
			      		<li><a href="{{ url('logout') }}">Logout</a></li>
					@endif
		      	@else
		      		@if(Request::path() == 'admin/login')		      				      		
		      			<li><a href="{{ url('admin/login') }}">Sign in </a></li>
		      		@else
		      			<li><a href="{{ url('signup') }}">Sign up </a></li>
		      			<li><a href="{{ url('login') }}">Sign in </a></li>
		      		@endif
				@endif
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</header>