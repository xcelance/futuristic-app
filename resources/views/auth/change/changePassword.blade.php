@extends('layouts.app')
@section('content')
    <section class="changepassword">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                    <div class="sign-up-form-outer">
                        <h1 class="heading1">Change Password</h1>               
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('setpassword') }}">
                            {{ csrf_field() }}
                          
                            <input id="email" type="hidden" class="form-control" name="email" value="{{Auth::user()->email}}" required >  

                            <div class="form-group">
                                <label for="cur_password">Current Password</label>
                                <input id="cur_password" type="password" class="form-control" name="cur_password" required>                        
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input id="new_password" type="password" class="form-control" name="new_password" required>                        
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Confirm New Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>  
                            </div>

                            <div class="form-sign-up901 custom902">                             
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                    </form>               
                </div>
            </div>
        </div>
    </div>
	</section>
@endsection
