@extends('layouts.app')
@section('content')   
	
	<section class="modules_list adminstudent">
        <div class="container">
            <div class="row border">
                @if(isset($sid))
                       
                    <div class="col-md-9 col-md-9">
					<h2>{{$studentData->firstname}} {{$studentData->lastname}}</h2>
                        <div class="_left_side">                            
                            <div class="">                                
                                <div class="student"><b>Email : </b> {{$studentData->email}}</div>
                                <div class="school_name"><b>School Name :</b> {{$studentData->school_name}}</div>
                                <div class="dob"><b>Dob  :  </b>{{$studentData->dob}}</div>
                                <div class="year_school"><b>Year in school :</b>{{$studentData->year_in_school}}</div>
                                <div class="payment_mode"><b>Payment mode :</b>{{$studentData->payment_mode}}</div>
                                <div class="payment"><b>Payment :</b>{{$studentData->payment_mode}}</div>
                                <div class="payment"><b>Video Reviews :</b>{{$studentData->video_reviews}}</div>
                            </div> 

                            @foreach($responseData as $key => $response)   
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
                        </div>
                    </div>
                @else   
                    <h2>Student List</h2>
                    <div class="table-responsive">                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Payment Method</th>                                    
                                    <th>Video Review count</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentList as $student)
                                    <tr class="user_{{$student->id}}">
                                        <td><a href="{{url('admin/students/?sid=')}}{{$student->id}}">{{$student->firstname}} {{$student->lastname}}</a></td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->payment_mode == 'R' ? 'Monthly' : ($student->payment_mode == 'O' ? 'Onetime' : 'Pending') }}</td>  
                                        <td>{{$student->video_reviews}}</td>                                      
                                        <td><a href="{{url('admin/students/?sid=')}}{{$student->id}}"><span><i class="fa fa-eye" aria-hidden="true"></i></span></a><a href="javascript:void(0);"  data-id="{{$student->id}}" class="deluser"><span class="edit delete"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
                                    </tr>
                                @endforeach                             
                            </tbody>
                        </table>
                        </div>                  
                @endif
                
            </div>
        </div>
  </section>
@endsection