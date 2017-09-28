@extends('app')
@section('content')
	
<section class="sign-up-outer99">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
				<div class="sign-up-form-outer">
					<h1 class="heading1">Sign Up </h1>
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
					<form class="form-horizontal" role="form" method="POST">					
						{{ csrf_field() }}
						
						<div class="form-group">
							<label for="usr">Name:</label>
							<input type="text" class="form-control" id="usr" name="name" value="{{ old('name') }}">
						</div>
						<div class="form-group">
							<label for="pwd">Email:</label>
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" name="password">
						</div>
						<div class="form-group">
							<label for="pwd">Confirm Password:</label>
							<input type="password" class="form-control" name="password_confirmation">
						</div>
						<div class="form-group">
							<label for="sel1">Plan:</label>
							<select class="form-control" id="sel1" name="plan">
								<option value="0">Free</option>
								<option value="1">Basic</option>
								<option value="2">Extended</option>
							</select>
						</div>
						<div class="form-sign-up901">
							<button type="submit" class="btn btn-primary">
								Sign Up
							</button>
						</div>
					</form>					
				</div>
			</div>
		</div>
	</div>
</section>
@endsection