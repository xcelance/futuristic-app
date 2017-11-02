<header>

	<div class="container">

		<div class="row">

			<div class="col-md-3 col-sm-3">

				<div class="logo_outer">

					<a class="navbar-brand" href="{{ url('/') }}"><h1>Futuristic</h1></a>

				</div>

			</div>

			<div class="col-md-9 col-sm-9">

				<div class="right_side_nav">

					<ul>
						@if(isset(Auth::user()->id))
		      				@if(Auth::user()->role == '0')
		      					@if(Auth::user()->payment_status != '0')
		      						<li class="custom_sign"><a href="{{url('modules')}}">My Modules</a></li>
		      					@endif
								<li class="custom_sign"><a href="{{url('profile')}}">My Profile</a></li>
								<li class="custom_sign"><a href="{{url('logout')}}">Logout</a></li>
							@endif
							@if(Auth::user()->role == '1')
								<li class="custom_sign"><a href="{{url('students')}}">Students</a></li>
								<li class="custom_sign"><a href="{{url('modules')}}">My Modules</a></li>
								<li class="custom_sign"><a href="{{url('profile')}}">My Profile</a></li>
								<li class="custom_sign"><a href="{{url('logout')}}">Logout</a></li>
							@endif
							@if(Auth::user()->role == '2')
								<li class="custom_sign"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
								<li class="custom_sign"><a href="{{url('admin/students')}}">Students</a></li>
								<li class="custom_sign"><a href="{{url('admin/teachers')}}">Teachers</a></li>
								<li class="custom_sign"><a href="{{url('admin/modules')}}">Modules</a></li>
								<li class="custom_sign"><a href="{{url('logout')}}">Logout</a></li>
							@endif
		      			@else
		      				<li class="custom_sign"><a href="{{url('signup')}}">Sign Up</a></li>
							<li class="custom_login"><a href="{{url('login')}}">Login</a></li>
		      			@endif

					</ul>

				</div>

			</div>

		</div>

	</div>

  </header>