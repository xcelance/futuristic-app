<header>

	<div class="container">

		<div class="row">

			<div class="col-md-4 col-sm-4">

				<div class="logo_outer">

					<a class="navbar-brand" href="{{ url('/') }}"><h1>Futuristic</h1></a>

				</div>

			</div>

			<div class="col-md-8 col-sm-8">

				<div class="right_side_nav">

					<ul>
						@if(isset(Auth::user()->id))
		      				@if(Auth::user()->role == '0')
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