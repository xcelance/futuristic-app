@extends('app')
@section('content')
	<section class="reset-outer99">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
					<div class="sign-up-form-outer">
						<h1 class="heading1"><span class="back-btn"><a href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
						</span>Sign In</h1>
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul class="errors99">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="pwd">Email:</label>
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input id="password" type="password" class="form-control" name="password" required>
							</div>
							<div class="form-group">
								<a class="btn-link" href="{{ route('password.request') }}">
	                                Forgot Password?
	                            </a>
	                        </div>
                            <div class="form-group">								
			                    <div class="social-btn-001">
			                    	<div class="social-fb-001">
			                    		<a href="{{ url('social/facebook') }}" class="">
			                    			<img src="{{ URL::asset('public/images/facebook.png') }}">   
			                    		</a>
			                    	</div>  

			                    	<div class="google-fb-001">
			                    		<a href="{{ url('social/google') }}" class="">
			                    			<img class="google-btn-img" src="{{ URL::asset('public/images/google.png') }}">
			                    		</a>
			                    	</div>
			                    </div>
							</div>											
							<div class="form-sign-up901 custom902">								
								<button type="submit" class="btn btn-primary">
									Sign In
								</button>
							</div>
						</form>
					</div>
				</div>				
			</div>
		</div>
	</section>	

@endsection
