@extends('layouts.app')
@section('content')
	<section class="dasboard-banner-section">
		<div class="container">			
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-12 border">
					<h3 class="my-video-heading">Dashboard</h3>
					<div class="dashboard-text">
						<h4 class="profile01">Teacher: <a href="{{url('/admin/teachers')}}">{{count($teacherList)}}</a> </h4>
						<h4 class="profile01">Students: <a href="{{url('/admin/students')}}">{{count($studentList)}}</a></h4>
						<h4 class="profile01">Modules: <a href="{{url('/admin/modules')}}">{{count($moduleList)}}</a>  </h4>
						<h4 class="profile01">Video Analytics: <a href="{{url('/admin/videoanalytics')}}">{{$videoAnalytics}}</a></h4>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
