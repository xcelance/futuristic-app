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
                        <input type="number" class="yearsinschool2" name="whatyearinschool" placeholder="How many years have you been teaching for" required="">
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
                            <a href="{{url('terms-and-conditions')}}"><span class="terms">Terms of use</span></a>
                            <a href="{{url('privacy-policy')}}"><span class="terms">Privacy policy</span></a>
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
                <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="5000">
                  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="3"></li>
                  </ol>
                  <!-- Carousel items -->
                  <div class="carousel-inner">
                    <div class="active item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/P6250526.jpg')}}"></div>
                            <p>"I would like to work in commerce or psychology after school. I don’t think emotional intelligence or creative thinking are included enough at school because they aren’t as directly related to the curriculum but they are essential in the workforce. That is why Futuristic is such a great help for me!" <br /><strong>Stella</strong>, 16 <br /><a href="https://www.instagram.com/stellamclaughlin/"><img class="testimonialimg" src="public/images/Instagram_icon.png">@stellamclaughlin</a></p>
                    </div>
                     <div class="item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/P6250528.jpg')}}"></div>
                            <p>"I would like to work in the aviation industry as a pilot. I believe schools don’t teach us basic life skills and things we need to integrate into the ‘real’ world out of school! Futuristic has helped a great deal with better understanding this transition."
                            <br /><strong>Jake</strong>, 16 <br /><a href="https://www.instagram.com/jakemun/"><img class="testimonialimg" src="public/images/Instagram_icon.png">@jakemun</a> </p>
                    </div>
                    <div class="item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/P6250520.jpg')}}"></div>
                            <p>"Currently, I am quite unsure as to what I would like to pursue as a career, however I am interested in the finance sector. I believe that students are not provided much information regarding university and other post-school career pathways. Futuristic has really helped me prepare for life after school with their practical advice."<br />
                            <b>Nisha</b>, 16 <br /><a href="https://www.instagram.com/nisha_bhasin/"><img class="testimonialimg" src="public/images/Instagram_icon.png">@nisha_bhasin</a></p>
                    </div>
                    <div class="item">
                    <div class="custom_heading"><h3>student testimonial</h3> </div>
                    <div class="profile-circle"><img class="circle" src="{{url('/public/images/P6250532.jpg')}}"></div>
                            <p>"Most students aren't exactly sure what degree they want to study after school but Futuristic has helped me better prepare for life after school with its practical tips and advice."<br /><strong>Sam</strong>, 16 <br /><a href="https://www.instagram.com/sam.mcghee/"><img class="testimonialimg" src="public/images/Instagram_icon.png">@sam.mcghee</a></p>
                    </div>
                  </div>
                </div>
                <div class="about_outer">
                    <h3>About Futuristic Skills</h3>
                    <p>Futuristic is a web app designed to help high school students develop critical skills and capabilities for the future workforce. Our platform predominantly consists of educational videos, games and quizzes.</p>
                </div>
                </div>
                
            </div>
        </div>
    </div>
  </section>
@endsection
