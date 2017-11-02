@extends('layouts.app')
@section('content')
	
	<section class="profile-banner-section front_profile">  
			<div class="container">				
				<div class="row">
						<div class="col-md-12 col-sm-12">
							<h3 class="my-video-heading">Profile</h3>
                            @if(isset($message) && $message != '')
                             <div class="custom-alerts alert alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {!! $message !!}
                             </div>  
                            @endif 
							<div class="row profile-border">
								<div class="col-md-9 col-sm-9">
									<div class="profile-left-side border">
										<h4 class="profile01"><b>Name: </b><span class="custom_p">{{$userData->firstname}} {{$userData->lastname}}</span> </h4>
										<h4 class="profile01"><b>Email:</b><span class="custom_p"> {{$userData->email}}</span> </h4>
										<h4 class="profile01"><b>User Type:</b> <span class="custom_p">{{$userData->role == '0'?'Student': ($userData->role == '1'?'Teacher': 'Admin')}}</span></h4>

                                        @if(Auth::user()->role == '0')
                                            <h4 class="profile01"><b>School Name: </b><span class="custom_p"> {{$userData->school_name}}</span> </h4>
                                            <h4 class="profile01"><b>Dob: </b><span class="custom_p"> {{$userData->dob}}</span> </h4>
                                            <h4 class="profile01"><b>Year in school: </b><span class="custom_p"> {{$userData->year_in_school}}</span> </h4>
                                            <h4 class="profile01"><b>Video Reviews: </b><span class="custom_p"> {{$userData->video_reviews}}</span> </h4>

                                            @if(count($responseData) > 0)
                                                @foreach($responseData as $response)   
                                                <div class="border">
                                                    <h4>{{$response->quiz}}</h4> 
                                                    @php
                                                        $quizresponse = json_decode($response->response);
                                                    @endphp
                                                     <div class="">                                
                                                        <div class="student"><b>Name: </b> @if(isset($quizresponse->fname)){{$quizresponse->fname}}@endif  @if(isset($quizresponse->lname)){{$quizresponse->lname}}@endif</div> 
                                                        @if(isset($quizresponse->sex))
                                                            <div class="student"><b>Sex: </b> {{$quizresponse->sex}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->age))
                                                            <div class="student"><b>Age: </b> {{$quizresponse->age}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->year))
                                                            <div class="student"><b>Year: </b> {{$quizresponse->year}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->school))
                                                            <div class="student"><b>School: </b> {{$quizresponse->school}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->teamup))
                                                            <div class="student"><b>Team Up: </b> {{$quizresponse->teamup}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->finding_why))
                                                            <div class="student"><b>Finding Why : </b> {{$quizresponse->finding_why}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->situations))
                                                            <div class="student"><b>Situations : </b> {{$quizresponse->situations}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->how_strong))
                                                            <div class="student"><b>How Strong : </b> {{$quizresponse->how_strong}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->dimensions))
                                                            <div class="student"><b>Dimensions : </b> {{$quizresponse->dimensions}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->person_greatei))
                                                            <div class="student"><b>Person Great : </b> {{$quizresponse->person_greatei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->person_belowaei))
                                                            <div class="student"><b>Person Below About e i : </b> {{$quizresponse->person_belowaei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->goal))
                                                            <div class="student"><b>Goal : </b> {{$quizresponse->goal}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->weekdays))
                                                            <div class="student"><b>Weekdays : </b> {{$quizresponse->weekdays}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->weekend))
                                                            <div class="student"><b>Weekend : </b> {{$quizresponse->weekend}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smapp))
                                                            <div class="student"><b>Social Media App : </b> {{$quizresponse->smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smapp_most))
                                                            <div class="student"><b>Social Media App Most: </b> {{$quizresponse->smapp_most}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->snapchat))
                                                            <div class="student"><b>Snapchat: </b> {{$quizresponse->snapchat}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->instagram))
                                                            <div class="student"><b>Instagram: </b> {{$quizresponse->instagram}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->facebook))
                                                            <div class="student"><b>Facebook: </b> {{$quizresponse->facebook}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->likeabout_smapp))
                                                            <div class="student"><b>Like about social media app: </b> {{$quizresponse->likeabout_smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improved_smapp))
                                                            <div class="student"><b>Improved social media app: </b> {{$quizresponse->improved_smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->perfect_smapp))
                                                            <div class="student"><b>Perfect social media app: </b> {{$quizresponse->perfect_smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->activefbuser))
                                                            <div class="student"><b>Active FB User: </b> {{$quizresponse->activefbuser}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->activeinstauser))
                                                            <div class="student"><b>Active Instagram User: </b> {{$quizresponse->activeinstauser}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->snapchatusers))
                                                            <div class="student"><b>Snapchat User: </b> {{$quizresponse->snapchatusers}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->defsmb))
                                                            <div class="student"><b>Defination of Social Media Branding: </b> {{$quizresponse->defsmb}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smforjob))
                                                            <div class="student"><b>Social Media for jobs: </b> {{$quizresponse->smforjob}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->strongonline))
                                                            <div class="student"><b>Strong Online: </b> {{$quizresponse->strongonline}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->instagenerate))
                                                            <div class="student"><b>Instagram Generate: </b> {{$quizresponse->instagenerate}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improve_smi))
                                                            <div class="student"><b>Improved Social Media Intelligence : </b> {{$quizresponse->improve_smi}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->sm_agencies))
                                                            <div class="student"><b>Social Media agencies : </b> {{$quizresponse->sm_agencies}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->sm_marketing))
                                                            <div class="student"><b>Social Media marketing : </b> {{$quizresponse->sm_marketing}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->true_statement))
                                                            <div class="student"><b>True Statement : </b> {{$quizresponse->true_statement}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->find_quiz))
                                                            <div class="student"><b>Finding Quiz : </b> {{$quizresponse->find_quiz}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->fav_smapp))
                                                            <div class="student"><b>Favourite Social Media Application : </b> {{$quizresponse->fav_smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smbrand))
                                                            <div class="student"><b>Social Media Branding : </b> {{$quizresponse->smbrand}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smpersonal_brand))
                                                            <div class="student"><b>Social Media Personal Branding : </b> {{$quizresponse->smpersonal_brand}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->own_smapp))
                                                            <div class="student"><b>Own Social Media Application : </b> {{$quizresponse->own_smapp}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->sm_page))
                                                            <div class="student"><b>Social Media Page : </b> {{$quizresponse->sm_page}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->sm_tools))
                                                            <div class="student"><b>Social Media Tools : </b> {{$quizresponse->sm_tools}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->google_result))
                                                            <div class="student"><b>Google Search result : </b> {{$quizresponse->google_result}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->image_beneficial))
                                                            <div class="student"><b>Image Beneficial : </b> {{$quizresponse->image_beneficial}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->privacy))
                                                            <div class="student"><b>Privacy : </b> {{$quizresponse->privacy}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->friends_setting))
                                                            <div class="student"><b>Friends Settings : </b> {{$quizresponse->friends_setting}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->timeline_tagging))
                                                            <div class="student"><b>Timeline and Tagging : </b> {{$quizresponse->timeline_tagging}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->options))
                                                            <div class="student"><b>Option : </b> {{$quizresponse->options}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->review_post))
                                                            <div class="student"><b>Review Post : </b> {{$quizresponse->review_post}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->google_search))
                                                            <div class="student"><b>Google Search : </b> {{$quizresponse->google_search}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->search_linkedin))
                                                            <div class="student"><b>Search Linkedin: </b> {{$quizresponse->search_linkedin}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->active_snapchat))
                                                            <div class="student"><b>Active snapchat: </b> {{$quizresponse->active_snapchat}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->def_smb))
                                                            <div class="student"><b>Defination of Social media branding: </b> {{$quizresponse->def_smb}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smb_job))
                                                            <div class="student"><b>Social media branding for job: </b> {{$quizresponse->smb_job}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->smb_job))
                                                            <div class="student"><b>Social media branding for job: </b> {{$quizresponse->smb_job}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->strong_online))
                                                            <div class="student"><b>Strong Online: </b> {{$quizresponse->strong_online}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->insta_generate))
                                                            <div class="student"><b>Instagram Generate: </b> {{$quizresponse->insta_generate}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->insta_generate))
                                                            <div class="student"><b>Instagram Generate: </b> {{$quizresponse->insta_generate}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->which_challenge))
                                                            <div class="student"><b>Instagram Generate: </b> {{$quizresponse->which_challenge}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_module))
                                                            <div class="student"><b>Rate of module: </b> {{$quizresponse->rate_module}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_quiz))
                                                            <div class="student"><b>Rate of quiz: </b> {{$quizresponse->rate_quiz}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_video))
                                                            <div class="student"><b>Rate of Video: </b> {{$quizresponse->rate_video}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_discussion))
                                                            <div class="student"><b>Rate of discussion: </b> {{$quizresponse->rate_discussion}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_action))
                                                            <div class="student"><b>Rate of action: </b> {{$quizresponse->rate_action}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate_teacher))
                                                            <div class="student"><b>Rate of teacher: </b> {{$quizresponse->rate_teacher}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->like_module))
                                                            <div class="student"><b>Like module: </b> {{$quizresponse->like_module}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improve_module))
                                                            <div class="student"><b>Improved module: </b> {{$quizresponse->improve_module}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->about_app))
                                                            <div class="student"><b>About application: </b> {{$quizresponse->about_app}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improve_content))
                                                            <div class="student"><b>Improved content: </b> {{$quizresponse->improve_content}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improve_app))
                                                            <div class="student"><b>Improved application: </b> {{$quizresponse->improve_app}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->job_skills))
                                                            <div class="student"><b>Job skills: </b> {{$quizresponse->job_skills}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->recommend))
                                                            <div class="student"><b>Recommended: </b> {{$quizresponse->recommend}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->heard_ei))
                                                            <div class="student"><b>Heard emotional intelligence: </b> {{$quizresponse->heard_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->discuss_ei))
                                                            <div class="student"><b>Discuss emotional intelligence: </b> {{$quizresponse->discuss_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->describe_ei))
                                                            <div class="student"><b>Describe emotional intelligence: </b> {{$quizresponse->describe_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->ei_forjob))
                                                            <div class="student"><b>Emotional intelligence for jobs: </b> {{$quizresponse->ei_forjob}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->more_impforjob))
                                                            <div class="student"><b>Emotional intelligence more important for jobs: </b> {{$quizresponse->more_impforjob}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->about_ei))
                                                            <div class="student"><b>About Emotional intelligence: </b> {{$quizresponse->about_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->self_awareness))
                                                            <div class="student"><b>Self awareness: </b> {{$quizresponse->self_awareness}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->def_ei))
                                                            <div class="student"><b>Defination of emotional intelligence: </b> {{$quizresponse->def_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->imp_jobsuccess))
                                                            <div class="student"><b>Importance of job success: </b> {{$quizresponse->imp_jobsuccess}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->ei6))
                                                            <div class="student"><b>Emotional Intelligence: </b> {{$quizresponse->ei6}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->dimenstion_ei))
                                                            <div class="student"><b>Dimensions of emotional intelligence: </b> {{$quizresponse->dimenstion_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->situation_ei))
                                                            <div class="student"><b>Situations of emotional intelligence: </b> {{$quizresponse->situation_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->improve_ei))
                                                            <div class="student"><b>Improved emotional intelligence: </b> {{$quizresponse->improve_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->app_ei))
                                                            <div class="student"><b>Application emotional intelligence: </b> {{$quizresponse->app_ei}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->mentor))
                                                            <div class="student"><b>Mentor: </b> {{$quizresponse->mentor}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->empathy))
                                                            <div class="student"><b>Empathy: </b> {{$quizresponse->empathy}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->challenge))
                                                            <div class="student"><b>Challenge: </b> {{$quizresponse->challenge}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->rate))
                                                            <div class="student"><b>Rate: </b> {{$quizresponse->rate}}</div>
                                                        @endif
                                                        @if(isset($quizresponse->about_module))
                                                            <div class="student"><b>About Module: </b> {{$quizresponse->about_module}}</div>
                                                        @endif                                        

                                                    </div>                                
                                                </div>
                                                @endforeach   
                                            @endif

                                        @endif
									</div>
								</div>	

                                <div class="col-md-3 col-sm-3 border">
                                    <div class="profile-right-side">
                                        @if(Auth::user()->role == '0' && count($paymentData)>0)

                                            <h4 class="profile01">
                                            @if(Auth::user()->payment_mode == 'R' && $paymentData->status != 'canceled')
                                                <a class="btn-link" href="{{ url('cancelplan') }}">Cancel Subscription</a>
                                            @endif
                                            @if(Auth::user()->payment_mode == 'R' && $paymentData->status == 'canceled' && isset($paymentData->pending_amount))
                                                <a class="btn-link" href="#myModal" data-toggle="modal" data-target="#myModal">Click to pay pending amount </a>
                                            @endif
                                            </h4>
                                        @endif
                                                                        
                                        <h4 class="profile01"><a class="btn-link" href="{{ url('/change/password') }}">
                                            Change Password ?
                                        </a></h4>
                                    </div>
                                </div>
							</div>
						</div>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						      </div>
						      <div class="modal-body">
							 <div class="panel panel-default">
                @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif
                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{{url('fullpayment')}}" >
                        {{ csrf_field() }}                        

                        <div class="form-group{{ $errors->has('card_no') ? ' has-error' : '' }}">            
                            <div class="col-md-6">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
                                <input type="hidden" name="payment" value="O"> 
                                <input type="hidden" name="amount" value="{{$paymentData->pending_amount}}">
                                <input type="hidden" name="customer" value="{{$paymentData->customer_id}}">
                                <input type="hidden" name="pid" value="{{$paymentData->id}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('card_no') ? ' has-error' : '' }}">
                            <label for="card_no" class="col-md-4 control-label">Card No</label>
                            <div class="col-md-6">
                                <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus required="">
                                @if ($errors->has('card_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                            <label for="ccExpiryMonth" class="col-md-4 control-label">Expiry Month</label>
                            <div class="col-md-6">
                                <input id="ccExpiryMonth" type="text" size="2" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" autofocus required="">
                                @if ($errors->has('ccExpiryMonth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                            <label for="ccExpiryYear" class="col-md-4 control-label">Expiry Year</label>
                            <div class="col-md-6">
                                <input id="ccExpiryYear" type="text" size="4" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus required="">
                                @if ($errors->has('ccExpiryYear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                            <label for="cvvNumber" class="col-md-4 control-label">CVV No.</label>
                            <div class="col-md-6">
                                <input id="cvvNumber" type="text" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus required="">
                                @if ($errors->has('cvvNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cvvNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                       
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Pay ${{$paymentData->pending_amount}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
						      </div>						   
						    </div>
						  </div>
						</div>
	
				</div>
			</div>
		</section>
@endsection