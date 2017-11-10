@extends('layouts.app')
@section('content')

<section class="signin_outer92">
    <div class="container">
            <div class="row">
            <div class="col-md-6">
                <div class="signin_left_side">
                    <div class="signin_box1">
                    <a href="{{url('signup')}}"><h5>Parents! Support your child's education with an individual subscription</h5></a>
                    </div>
                    <div class="signin_box1">
                        <a href="http://www.futuristicskills.com/futuristicblog"><h5>Top student profile</h5></a>
                    </div>
                    <div class="icon_outer">
                        <a href="https://www.facebook.com/FuturisticSkills/"><img class="facebook01" src="public/images/facebook-icon.png"></a>
                        <a href="https://www.instagram.com/futuristicskills/"><img class="facebook01" src="public/images/Instagram_icon.png"></a>
                        <a href="mailto:hello@futuristicskills.com"><i class="fa fa-envelope social_gmail01" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/company/18205820/"><img class="facebook01" src="public/images/square-linkedin-512.png"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="signin_right_side">
                    <h3>Sign in to Futuristic</h3>
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
                    <form name="loginFrm" method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="check_outer">
                            <span class="student_check"><input type="radio" name="role" value="0" checked>Student</span>
                            <span class="teacher_outer"><input type="radio" name="role" value="1">Teacher</span>
                        </div>
                        <div class="user_outer">                       
                            <input type="text" value="" class="user" placeholder="Username" name="email" required>
                             @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="password_outer">
                            <input type="password" value="" class="user" placeholder="Password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="terms">
                            <input type="checkbox" name="terms" value="1" required><a href="{{url('terms-and-conditions')}}"> I agree to the Terms and Conditions</a> to enter Futuristic
                        </div>
                        <div class="btn_outer101">
                            <button type="submit" class="btn btn-primary" name="login">Enter the platform</button>
                        </div> 
                    </form>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Reset Password</h4>
                          </div>
                          <div class="modal-body">
                          <div class="modal-filed">
                          <label>Email Address</label>
                            <input type="text" value="" name="">
                            </div>
                            <div class="modal_btn"><button type="button" class="btn btn-primary">Send</button></div>
                          </div>
                          <div class="modal-footer">
                            <h4>If you still need some help, contact <a href="">futuristic support</a> </h4>  
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="forgotten_outer">                        
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Forgotten your password?</a></div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection
