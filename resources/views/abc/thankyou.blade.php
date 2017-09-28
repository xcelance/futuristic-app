@extends('app')
@section('content')
	
<section class="thanks-success">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
				<div class="sign-up-form-outer">					
					@if(Session::has('success')) 
						<div class="alert success"> 
							{{Session::get('success')}}
						</div>					
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@endsection