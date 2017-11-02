@extends('layouts.app')
@section('content')
 <section class="Futuristic_Skills">
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
        <li><a href="http://futuristicskillscommunity.org/futuristics">Futuristic Skills</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="http://futuristicskillscommunity.org/membership">Membership</a></li>
<!--         <li><a href="#">Impact</a></li>
        <li><a href="#">Blog</a></li> -->
        <li><a href="http://futuristicskillscommunity.org/contact-us">Contact</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav></div>
		<div class="overlap_text">
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
					<h3>hello@futuristicskills.com</h3>
				</div>
			</div>
		</div>
		<div class="center_banner">
			<img src="public/images/contact_center.jpg">
			</div>
			<div class="contact_section">
				<h1>Online Message Service</h1>
			</div>
			<div class="filed_outer">
				 <form>
	<div class="form-group">
    <input type="name" class="form-control" id="name" placeholder="Name">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" id="email" placeholder="email">
  </div>
   <div class="form-group">
    <input type="number" class="form-control" id="phone" placeholder="Phone">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="sub" placeholder="Subject">
  </div>
  <div class="form-group">
   <textarea type="text" class="form-control" id="msg" placeholder="Message"></textarea>
  </div>
  <div class="send_btn_outer">  
  <button type="submit" class="btn btn-default">Send</button>
  </div>
</form> 
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
					<div class="member">
						<i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</div>
					<div class="membership_option">
					<h1>HAVE YOU SEEN OUR BLOG?</h1>
					</div>
				</div>
			</div>
	</div>
</section>
@endsection
