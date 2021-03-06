@extends('layouts.app')
@section('content')
 <section class="banner custom_banner">
    <div class="container">
        <div class="row">
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
            <div class="col-md-8 col-md-offset-2">
    
                <div class="overlap_content">
                    <h1>Futuristic Skills</h1>
                    <p>Futuristic is a web app designed to help high school students develop critical skills and capabilities for the future workforce.</p>
                    <p>Futuristic specialises in teaching Gen Z students through visual material.  Our platform predominantly consists of educational videos, games and quizzes.</p>
                    <p>Our innovative app currently consists of 2 modules which address 2 critical skills for the future.</p>
                    <div class="btn_outer">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='signup'">Get Started</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </section>
@endsection
