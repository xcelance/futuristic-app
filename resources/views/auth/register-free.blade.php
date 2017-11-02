@extends('layouts.app')
@section('content')
<section class="sign_up_outer">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
            <div class="singup_left_outer">
                <h3>Signup</h3>
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

                @if (isset($stype) && $stype != '')
                <form class="form-horizontal" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="first_outer01">                                                
                        <input type="hidden" name="utype" value="teacher">
                    </div>
                    <div class="first_outer01">
                        <input type="hidden" name="stype" value="f">
                        <input class="fname" type="text" value="" name="firstname" placeholder="First Name" required="">
                        <input class="lname" type="text" value="" name="lastname" placeholder="Last Name" required="">
                    </div>
                    <div class="first_outer02">
                        <input type="text" value="" name="school_name" placeholder="School Name" class="school_name" required="">
                        <input type="email" value="" name="email" placeholder="Email Address" class="email_add" required="">
                        <input type="text" value="" name="dob" placeholder="Date of Birth: (DD/MM/YYYY)" class="dob" required="">
                    </div>
                    <div class="drop_outer">
                        <select class="custom_select" name="yearinschool" required="">
                            <option value="">Year in School</option>
                            <option value="7">Year 7</option>
                            <option value="8">Year 8</option>
                            <option value="9">Year 9</option>
                            <option value="10">Year 10</option>
                            <option value="11">Year 11</option>
                            <option value="12">Year 12</option>                 
                        </select>
                        <input type="password" value="" name="password" class="custom_password" placeholder="Set your password" required="">
                    </div>
                    <div class="drop_outer">
                        <select class="custom_select02" name="reference" required="">
                            <option value="">How did you find out about us?</option>
                            <option value="google">Google</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="school">My school</option>
                            <option value="parent">Parent</option>
                            <option value="friend">Friend</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="drop_outer">
                        <select class="custom_select02" name="maingoal" required="">
                            <option value="">What's your main goal of using Futuristic?</option>
                            <option value="job">Get a job</option>
                            <option value="internship">Get an internship</option>
                            <option value="scholarship">Scholarship</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="first_outer02">                        
                        <div class="btn_outer101">
                            <button type="submit" name="signup" value="register" class="btn btn-primary">Start your account</button>
                        </div>
                        <div class="term_condition">
                            <a href="#"><span class="terms">Terms of use</span></a>
                            <a href="#"><span class="terms">Privacy policy</span></a>
                            <span class="terms">&copy; Futuristic Skills and Capabilities 2017. All Right Reserved</span>
                        </div> 
                    </div>
                </form>
                @else
                    <div class="alert alert-danger">
                        <h2> You are not allowed to signup</h2>
                    </div>

                @endif
            </div>
            </div>
            <div id="carousel" class="col-md-4 col-sm-4">
            <div class=" singup_right_outer">
                <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
                  </ol>
                  <!-- Carousel items -->
                  <div class="carousel-inner">
                    <div class="active item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/circle.jpg')}}"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                     <div class="item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/circle2.jpg')}}"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                     <div class="item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/circle3.jpg')}}"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                  </div>
                </div>
                <div class="about_outer">
                    <h3>Futuristicskills About</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
