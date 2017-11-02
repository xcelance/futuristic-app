@extends('app')
@section('content')
	<section class="users-banner-section">
			<div class="container">
				<h1 class="my-video-heading">Users</h1>
				<div class="row user-page">
					<div class="col-md-12 col-sm-12">
					<div class="table-responsive">
						<input type="hidden" id="tusers" value="{{$tusers}}">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Subscription Plan</th>
									<th>Number of videos</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($userList as $user)
									<tr class="user_{{$user->id}}">
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{ $user->plan == '0' ? 'Free' : ($user->plan == '1' ? 'Basic' : 'Extended') }}</td>
										<td>{{$user->videocount}}</td>
										<td><a href="{{url('/admin/user?uid=')}}{{$user->id}}"><span><i class="fa fa-eye" aria-hidden="true"></i></span></a><a href="javascript:void(0);"  data-id="{{$user->id}}" class="deluser"><span class="edit delete"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
									</tr>
								@endforeach								
							</tbody>
						</table>
						</div>
						<div id="loading"><img src="{{url('/public/images/loader.gif')}}" /></div>
					</div>
				</div>
			</div>
		</section>
		@section('myjs')
		<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				site_url = {!! json_encode(url('/')) !!}+'/admin';		    
			    jQuery(window).scroll(function() {
		            if(jQuery(window).scrollTop() + jQuery(window).height() >= jQuery(document).height()){ 
		            	var limitStart = jQuery("tbody tr").length;			            	
		            	if(limitStart < jQuery("#tusers").val()){
							$("#loading").show();
				            jQuery.ajax({
				            	type: "POST",
					            url:  site_url+'/getusers',
					            data: {limit: limitStart},					       
						        success: function(data) {	
						            $("tbody").append(data);					          
						            $("#loading").hide();     
						        }
						    });
						}
		            }
		        });
		    });

		    jQuery(document).ready(function(){	
		        jQuery(document).on('click', '.deluser', function(){
					var uid = jQuery(this).attr("data-id");	
     	
		        	jQuery.ajax({
		            	type: "POST",
			            url:  site_url+'/deleteuser',
			            data: {uid: uid},					       
				        success: function(data){		        	
				            jQuery(".user_"+uid).remove();				            
				        }
				    });
		        });
			});

		</script>
	@stop
@endsection
