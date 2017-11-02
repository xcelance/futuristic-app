@extends('layouts.app')
@section('content')
	
	<section class="teacher_modules_list">
        <div class="container">   
            <div class="row">
                 @if(isset($tid))
                 <div class="col-md-4 col-md-offset-4 border">
					<h2>{{$teacherData->firstname}} {{$teacherData->lastname}}</h2>
                        <div class="_left_side">                            
                            <div class="">                                
                                <div class="student"><b>Email : </b> {{$teacherData->email}}</div>
                                <div class="school_name"><b>School Name :</b> {{$teacherData->school_name}}</div>
                                <div class="dob"><b>Dob  :  </b>{{$teacherData->dob}}</div>
                                <div class="year_school"><b>Year in school :</b>{{$teacherData->year_in_school}}</div>
                                <div class="payment_mode"><b>Payment mode :</b>{{$teacherData->payment_mode}}</div>
                                <div class="payment"><b>Payment :</b>{{$teacherData->payment_mode}}</div>
                            </div>                               
                        </div>
                    </div>
                @else
                    <h2>Teacher List</h2>
                    <div class="table-responsive">                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Payment Method</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>  
                            <tbody>
                                @foreach($teacherList as $teacher)
                                    <tr class="user_{{$teacher->id}}">
                                        <td>{{$teacher->firstname}} {{$teacher->lastname}}</td>
                                        <td>{{$teacher->email}}</td>
                                        <td>{{$teacher->payment_mode == 'R' ? 'Monthly' : ($teacher->payment_mode == 'O' ? 'Onetime' : 'Pending') }}</td>                                        
                                        <td><a href="{{url('admin/teachers/?tid=')}}{{$teacher->id}}"><span><i class="fa fa-eye" aria-hidden="true"></i></span></a><a href="javascript:void(0);"  data-id="{{$teacher->id}}" class="deluser"><span class="edit delete"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
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