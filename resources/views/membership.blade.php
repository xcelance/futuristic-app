@extends('layouts.app')
@section('content')
 <section class="banner Futuristic_Skills inner-page">
	<div class="container">
	<div class="custom_nav"><nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{url('/')}}">Futuristic Skills</a></li>
        <li><a href="{{url('services')}}">Services</a></li>
        <li><a href="{{url('membership')}}">Membership</a></li>
<!--         <li><a href="#">Impact</a></li>
        <li><a href="#">Blog</a></li> -->
        <li><a href="{{url('contact-us')}}">Contact</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav></div>
		<div class="overlap_text">
			<h2>MEMBERSHIP</h2>
			<p>Become a member and gain access to the Futuristic Web App.</p>
			<p>Please select from either a school or individual membership option.</p>
		</div>
	</div>
</section>
<section class="membership_outer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-md-offset-2">
				<div class="border96 school">
				<img src="public/images/home.png">  
				</div>
				<div class="text_gry">
					
					<div class="school">
					<a href="#">SCHOOL</a></div>
				<div class="school"><a href="#"> MEMBERSHIP</a></div>
					<div class="plus_outer">
						<i class="fa fa-plus" aria-hidden="true"></i>

					</div>
					
				</div>
			</div>
			<div class="col-md-4 col-sm-6 indiviual_membership">
				<div class="border96 individual">
				<img src="public/images/girl.png">  
				</div>
				<div class="text_gry">
					
					<div class="school">
					<a href="#">INDIVIDUAL</a></div>
				<div class="school"><a href="#"> MEMBERSHIP</a></div>
					<div class="plus_outer">
						<i class="fa fa-plus" aria-hidden="true"></i>

					</div>   
					
				</div>
			</div>
		</div>
		<div class="">
			<div class="col-md-6 col-sm-12 col-md-offset-3 ">
				<a href="{{url('signup')}}">
					<div class="member">
						<i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</div>
					<div class="membership_option">
						<h1>SEE FUTURISTIC WEB APP</h1>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>
@endsection
