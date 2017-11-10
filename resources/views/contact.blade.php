@extends('layouts.app')
@section('content')
 <section class="banner Futuristic_Skills inner-page contact">
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
		<div class="overlap_text contact-us">
			<h2>CONTACT</h2>
			<p>Please send us a message.</p>
			<p>We will get in touch very shortly.</p>
			<p>We have phone, email and online message services available.</p>
			<p>Phone: 0412 384 459</p>
			<p>Email: hello@futuristicskills.com</p>
		</div>
	</div>
</section>
<section class="phone_outer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<div class="phone">
					<h4>PHONE</h4>
					<h3>0412 384 459</h3>
				</div>
			</div>
			<div class="col-md-8 col-sm-8">
				<div class="phone">
					<h4>EMAIL</h4>
					<a href="mailto:hello@futuristicskills.com"><h3>hello@futuristicskills.com</h3></a>
				</div>
			</div>
		</div>
		<div class="center_banner">
			<img src="public/images/contact_center.jpg">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12 col-md-offset-3 ">
					<a href="http://www.futuristicskills.com/futuristicblog">
						<div class="member">
							<i class="fa fa-angle-double-right" aria-hidden="true"></i>
						</div>
						<div class="membership_option">
							<h1>HAVE YOU SEEN OUR BLOG?</h1>
						</div>
					</a>
				</div>
			</div>
	</div>
</section>
@endsection
