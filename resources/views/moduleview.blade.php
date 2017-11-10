@extends('layouts.app')
@section('content')	
	<section class="student_modules01">
    <div class="container">
        <div class="row"> 
            <div class="col-md-8 col-md-offset-2">
                <div class="error_msg">
                    <p>You already filled this form.</p>
                    <button type="button" class="close closebtn" data-dismiss="modal">&times;</button>
                </div>

                <div class="student_middle_outer">
                    <h3>About {{$moduleName}}</h3>
                    @if(Auth::user()->role == '1')
						<div class="teacher_btn_planouter">
							<div class="less_plan_outer">                                
								<a href="public/lessons/{{$lesson_text}}" download="Lesson for {{$moduleName}}" class="btn btn-primary">Lesson Plan</a>
							</div>
							<!-- <div class="less_plan_videoouter">
								<button type="button" class="btn btn-primary">Lesson Plan</button>
							</div>  -->             
						</div>  
					@endif
                    @foreach($quizlist as $quiz)                        
						  {!!html_entity_decode($quiz->content)!!}
                          <input type="hidden" name="smid" id="smid" value="{{$quiz->id}}">
                          <input type="hidden" id="token" value="{{ csrf_token() }}">
						
						@if(isset($quiz->video))
							<div class="video_sec">{!!html_entity_decode($quiz->video)!!}</div>
						@endif
							<div class="_left_side"> 
								@php 
									$links = json_decode($quiz->links, true); 
								@endphp
																
							    @if(isset($links))
									@foreach($links as  $link=>$url)
										<div class="signin_box1">
                        @if($link == 'Discussion Questions')
										        <a href="{{$url}}" download="Discussion Questions"><h5>{{$link}}</h5></a>
                          @else
                               @if ($data = in_array($link, $response))
                                  <a href="javascript:void(0);" onclick="return showmsg();"><h5>{{$link}}</h5></a>
                               @else
                                  <a href="{{$url}}"><h5>{{$link}}</h5></a>
                               @endif
                          @endif
										</div>
    								@endforeach
    							@endif
						    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
@section('myjs')
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            site_url = {!! json_encode(url('/')) !!};

            $('.video_sec').on('click', function (e) {
                var smid = $('#smid').val();
                var token = $('#token').val();
                $.ajax({                        
                    type: "POST",
                    url:  site_url+'/admin/videoviewed',
                    data: {method: 'addvideoview', mid: smid, '_token': token,},
                    success: function( msg ) {                              
                        // alert(msg);                        
                    }
                });
            });

            $(".closebtn").click(function(){
               $(".error_msg").hide(); 
            });
        });

        function showmsg(){
            $(".error_msg").show();
        }
    </script>
    <script>
        $(window).scroll(function() {    
           var scroll = $(window).scrollTop();

           if (scroll >= 100) {                
               $(".error_msg").addClass("darkHeader");
           } else {
               $(".error_msg").removeClass("darkHeader");
           }
        });
    </script>
@endsection


